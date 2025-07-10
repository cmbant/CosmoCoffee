<?php
/**
 * Test script for ArXiv SQLite database functionality
 */

// Set up paths
$phpbb_root_path = dirname(__DIR__) . '/';
$phpEx = 'php';

// Include ArXiv database class
include($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

// Create data directory if it doesn't exist
$data_dir = $phpbb_root_path . 'data';
if (!is_dir($data_dir)) {
    mkdir($data_dir, 0755, true);
}

$sqlite_path = $data_dir . '/arxiv.db';

echo "ArXiv SQLite Database Test Script\n";
echo "=================================\n\n";

// Remove existing SQLite database if it exists
if (file_exists($sqlite_path)) {
    echo "Removing existing SQLite database...\n";
    unlink($sqlite_path);
}

try {
    // Initialize SQLite database
    echo "Initializing SQLite database at: $sqlite_path\n";
    $arxiv_db = new ArxivDatabase($sqlite_path);
    
    // Test data for ARXIV_NEW
    echo "\nInserting test data into ARXIV_NEW...\n";
    $test_new_data = [
        [
            'arxiv_tag' => '2024.01001',
            'date' => '2024-01-01',
            'arxiv' => 'astro-ph',
            'number' => '2024.01001',
            'title' => 'Test Paper on Cosmology',
            'authors' => 'John Doe, Jane Smith',
            'comments' => '10 pages, 5 figures',
            'abstract' => 'This is a test abstract for a cosmology paper.'
        ],
        [
            'arxiv_tag' => '2024.01002',
            'date' => '2024-01-01',
            'arxiv' => 'hep-ph',
            'number' => '2024.01002',
            'title' => 'Test Paper on Particle Physics',
            'authors' => 'Alice Johnson, Bob Wilson',
            'comments' => '15 pages, 8 figures',
            'abstract' => 'This is a test abstract for a particle physics paper.'
        ]
    ];
    
    foreach ($test_new_data as $data) {
        $success = $arxiv_db->replaceArxivNew(
            $data['arxiv_tag'],
            $data['date'],
            $data['arxiv'],
            $data['number'],
            $data['title'],
            $data['authors'],
            $data['comments'],
            $data['abstract']
        );
        
        if ($success) {
            echo "✓ Inserted: " . $data['arxiv_tag'] . "\n";
        } else {
            echo "✗ Failed to insert: " . $data['arxiv_tag'] . "\n";
        }
    }
    
    // Test data for ARXIV_REPLACE
    echo "\nInserting test data into ARXIV_REPLACE...\n";
    $test_replace_data = [
        [
            'arxiv_tag' => '2023.12001',
            'date' => '2024-01-01',
            'arxiv' => 'gr-qc',
            'number' => '2023.12001',
            'title' => 'Replacement Paper on General Relativity',
            'authors' => 'Einstein A., Hawking S.',
            'comments' => 'Updated version with corrections'
        ]
    ];
    
    foreach ($test_replace_data as $data) {
        $success = $arxiv_db->replaceArxivReplace(
            $data['arxiv_tag'],
            $data['date'],
            $data['arxiv'],
            $data['number'],
            $data['title'],
            $data['authors'],
            $data['comments']
        );
        
        if ($success) {
            echo "✓ Inserted: " . $data['arxiv_tag'] . "\n";
        } else {
            echo "✗ Failed to insert: " . $data['arxiv_tag'] . "\n";
        }
    }
    
    // Test queries
    echo "\nTesting queries...\n";
    
    // Test existence check
    $exists = $arxiv_db->existsInArxivNew('2024.01001');
    echo "Exists check for 2024.01001: " . ($exists ? "✓ Found" : "✗ Not found") . "\n";
    
    // Test arxiv retrieval
    $arxiv = $arxiv_db->getArxivFromNew('2024.01001');
    echo "ArXiv field for 2024.01001: " . ($arxiv ? "✓ $arxiv" : "✗ Not found") . "\n";
    
    // Test query with date range and arxiv filter
    $date_range = "date >= '2024-01-01'";
    $arxiv_sql = "arxiv IN ('astro-ph', 'hep-ph')";
    
    $new_results = $arxiv_db->queryArxivNew($date_range, $arxiv_sql);
    echo "Query ARXIV_NEW results: " . count($new_results) . " records\n";
    foreach ($new_results as $row) {
        echo "  - " . $row['arxiv_tag'] . ": " . $row['title'] . "\n";
    }
    
    $replace_results = $arxiv_db->queryArxivReplace($date_range, "arxiv IN ('gr-qc')");
    echo "Query ARXIV_REPLACE results: " . count($replace_results) . " records\n";
    foreach ($replace_results as $row) {
        echo "  - " . $row['arxiv_tag'] . ": " . $row['title'] . "\n";
    }
    
    // Test deletion
    echo "\nTesting deletion...\n";
    $deleted = $arxiv_db->deleteArxivNew('2024.01002');
    echo "Delete 2024.01002 from ARXIV_NEW: " . ($deleted ? "✓ Success" : "✗ Failed") . "\n";
    
    // Verify deletion
    $exists_after = $arxiv_db->existsInArxivNew('2024.01002');
    echo "Exists check after deletion: " . ($exists_after ? "✗ Still exists" : "✓ Deleted") . "\n";
    
    $arxiv_db->close();
    
    echo "\n✓ All tests completed successfully!\n";
    echo "SQLite database created at: $sqlite_path\n";
    
} catch (Exception $e) {
    echo "Error during testing: " . $e->getMessage() . "\n";
    exit(1);
}
?>
