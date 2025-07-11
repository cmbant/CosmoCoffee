<?php

/**
 * Add date column to bookmarks table for efficient filtering
 *
 * This script adds a 'paper_date' column to the bookmarks table and populates it
 * with the corresponding date from the ARXIV_NEW table in SQLite.
 */

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

// Initialize ArXiv SQLite database
$arxiv_db = new ArxivDatabase();

echo "Adding date column to bookmarks table for efficient filtering\n";
echo "===========================================================\n\n";

try {
    // Step 1: Add the paper_date column to bookmarks table
    echo "Step 1: Adding paper_date column to bookmarks table...\n";

    $sql = "ALTER TABLE bookmarks ADD COLUMN paper_date DATE DEFAULT NULL";
    $result = $db->sql_query($sql);

    if ($result) {
        echo "✓ Successfully added paper_date column\n";
    } else {
        // Column might already exist, check if that's the case
        $sql = "SHOW COLUMNS FROM bookmarks LIKE 'paper_date'";
        $result = $db->sql_query($sql);
        if ($db->sql_fetchrow($result)) {
            echo "✓ paper_date column already exists\n";
        } else {
            throw new Exception("Failed to add paper_date column: " . $db->sql_error());
        }
        $db->sql_freeresult($result);
    }
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

try {
    // Step 2: Create index on paper_date for efficient filtering
    echo "\nStep 2: Creating index on paper_date column...\n";

    $sql = "CREATE INDEX idx_bookmarks_paper_date ON bookmarks(paper_date)";
    $result = $db->sql_query($sql);

    if ($result) {
        echo "✓ Successfully created index on paper_date\n";
    } else {
        // Index might already exist
        echo "ℹ Index might already exist (this is normal if running script multiple times)\n";
    }

    // Step 3: Populate paper_date for existing bookmarks
    echo "\nStep 3: Populating paper_date for existing bookmarks...\n";

    // Get all bookmarks that don't have paper_date set
    $sql = "SELECT DISTINCT arxiv_tag FROM bookmarks WHERE paper_date IS NULL";
    $result = $db->sql_query($sql);

    $arxiv_tags = [];
    while ($row = $db->sql_fetchrow($result)) {
        $arxiv_tags[] = $row['arxiv_tag'];
    }
    $db->sql_freeresult($result);

    echo "Found " . count($arxiv_tags) . " unique arxiv_tags without paper_date\n";

    if (count($arxiv_tags) > 0) {
        // Get paper details from SQLite in batches
        $batch_size = 1000; // Increased batch size since we're doing batch updates
        $updated_count = 0;

        for ($i = 0; $i < count($arxiv_tags); $i += $batch_size) {
            $batch = array_slice($arxiv_tags, $i, $batch_size);

            echo "Processing batch " . (floor($i / $batch_size) + 1) . " (" . count($batch) . " papers)...\n";

            // Get paper details from SQLite
            $paper_details = $arxiv_db->getPaperDetailsByTags($batch);

            if (empty($paper_details)) {
                echo "  ⚠ No paper details found for this batch\n";
                continue;
            }

            // Build a single UPDATE statement using CASE for batch processing
            $case_statements = [];
            $arxiv_tags_with_dates = [];

            foreach ($paper_details as $arxiv_tag => $paper) {
                $escaped_tag = $db->sql_escape($arxiv_tag);
                $escaped_date = $db->sql_escape($paper['date']);
                $case_statements[] = "WHEN '$escaped_tag' THEN '$escaped_date'";
                $arxiv_tags_with_dates[] = "'$escaped_tag'";
            }

            if (!empty($case_statements)) {
                // Start transaction for batch update
                $db->sql_transaction('begin');

                try {
                    $case_clause = implode(' ', $case_statements);
                    $in_clause = implode(',', $arxiv_tags_with_dates);

                    $sql = "UPDATE bookmarks
                            SET paper_date = CASE arxiv_tag
                                $case_clause
                            END
                            WHERE arxiv_tag IN ($in_clause) AND paper_date IS NULL";

                    if ($db->sql_query($sql)) {
                        $affected_rows = $db->sql_affectedrows();
                        $updated_count += $affected_rows;
                        echo "  ✓ Updated $affected_rows bookmark(s) in batch\n";
                        $db->sql_transaction('commit');
                    } else {
                        echo "  ✗ Failed to update batch: " . $db->sql_error() . "\n";
                        $db->sql_transaction('rollback');
                    }
                } catch (Exception $e) {
                    echo "  ✗ Exception during batch update: " . $e->getMessage() . "\n";
                    $db->sql_transaction('rollback');
                }
            }
        }

        echo "\n✓ Successfully updated $updated_count bookmark records with paper dates\n";
    }

    // Step 4: Create compound index for efficient filtering
    echo "\nStep 4: Creating compound index for efficient date filtering...\n";

    $sql = "CREATE INDEX idx_bookmarks_user_date ON bookmarks(user_id, paper_date)";
    $result = $db->sql_query($sql);

    if ($result) {
        echo "✓ Successfully created compound index on (user_id, paper_date)\n";
    } else {
        echo "ℹ Compound index might already exist\n";
    }

    // Step 5: Verify the changes
    echo "\nStep 5: Verifying the changes...\n";

    $sql = "SELECT COUNT(*) as total_bookmarks,
                   COUNT(paper_date) as bookmarks_with_date,
                   COUNT(*) - COUNT(paper_date) as bookmarks_without_date
            FROM bookmarks";
    $result = $db->sql_query($sql);
    $stats = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    echo "Total bookmarks: " . $stats['total_bookmarks'] . "\n";
    echo "Bookmarks with paper_date: " . $stats['bookmarks_with_date'] . "\n";
    echo "Bookmarks without paper_date: " . $stats['bookmarks_without_date'] . "\n";

    if ($stats['bookmarks_without_date'] > 0) {
        echo "\n⚠ Warning: " . $stats['bookmarks_without_date'] . " bookmarks still don't have paper_date.\n";
        echo "This might be because the papers are not in the ARXIV_NEW table.\n";
    }

    echo "\n🎉 Successfully completed adding date column to bookmarks table!\n";
    echo "\nNext steps:\n";
    echo "1. Update bookmark.php to use paper_date for filtering\n";
    echo "2. Update bookmark creation code to populate paper_date automatically\n";
    echo "3. Test the new efficient filtering\n";
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}

$arxiv_db->close();
