<?php

/**
 * Migration script to convert ARXIV_NEW and ARXIV_REPLACE tables from MySQL to SQLite
 *
 * Usage: php scripts/migrate_arxiv_to_sqlite.php
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up paths
$phpbb_root_path = dirname(__DIR__) . '/';
$phpEx = 'php';

// Include phpBB common setup
define('IN_PHPBB', true);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

// Create data directory if it doesn't exist
$data_dir = $phpbb_root_path . 'data';
if (!is_dir($data_dir)) {
    mkdir($data_dir, 0755, true);
}

$sqlite_path = $data_dir . '/arxiv.db';

echo "ArXiv MySQL to SQLite Migration Script\n";
echo "=====================================\n\n";

// Remove existing SQLite database if it exists
if (file_exists($sqlite_path)) {
    echo "Removing existing SQLite database...\n";
    unlink($sqlite_path);
}

try {
    // Initialize SQLite database
    echo "Initializing SQLite database at: $sqlite_path\n";
    $arxiv_db = new ArxivDatabase($sqlite_path);

    // Check if ARXIV_NEW table exists first
    echo "\nChecking if ARXIV_NEW table exists...\n";
    $table_check_sql = "SHOW TABLES LIKE '" . $table_prefix . "ARXIV_NEW'";
    $table_result = $db->sql_query($table_check_sql);
    $table_exists = $db->sql_fetchrow($table_result);
    $db->sql_freeresult($table_result);

    if (!$table_exists) {
        echo "ARXIV_NEW table does not exist in MySQL database. Skipping...\n";
        $count_new = 0;
    } else {
        // Migrate ARXIV_NEW table
        echo "\nMigrating ARXIV_NEW table...\n";
        $sql = "SELECT arxiv_tag, date, arxiv, number, title, authors, comments, abstract FROM " . $table_prefix . "ARXIV_NEW";
        $result = $db->sql_query($sql);

        if (!$result) {
            throw new Exception("Failed to query ARXIV_NEW table: " . $db->sql_error());
        }

        $count_new = 0;
        while ($row = $db->sql_fetchrow($result)) {
        $success = $arxiv_db->replaceArxivNew(
            $row['arxiv_tag'],
            $row['date'],
            $row['arxiv'],
            $row['number'],
            $row['title'],
            $row['authors'],
            $row['comments'],
            $row['abstract']
        );

        if ($success) {
            $count_new++;
            if ($count_new % 100 == 0) {
                echo "Migrated $count_new records from ARXIV_NEW...\n";
            }
        } else {
            echo "Failed to migrate record: " . $row['arxiv_tag'] . "\n";
        }
        $db->sql_freeresult($result);
    }

    echo "Successfully migrated $count_new records from ARXIV_NEW\n";

    // Check if ARXIV_REPLACE table exists first
    echo "\nChecking if ARXIV_REPLACE table exists...\n";
    $table_check_sql = "SHOW TABLES LIKE '" . $table_prefix . "ARXIV_REPLACE'";
    $table_result = $db->sql_query($table_check_sql);
    $table_exists = $db->sql_fetchrow($table_result);
    $db->sql_freeresult($table_result);

    if (!$table_exists) {
        echo "ARXIV_REPLACE table does not exist in MySQL database. Skipping...\n";
        $count_replace = 0;
    } else {
        // Migrate ARXIV_REPLACE table
        echo "\nMigrating ARXIV_REPLACE table...\n";
        $sql = "SELECT arxiv_tag, date, arxiv, number, title, authors, comments FROM " . $table_prefix . "ARXIV_REPLACE";
        $result = $db->sql_query($sql);

        if (!$result) {
            throw new Exception("Failed to query ARXIV_REPLACE table: " . $db->sql_error());
        }

        $count_replace = 0;
        while ($row = $db->sql_fetchrow($result)) {
        $success = $arxiv_db->replaceArxivReplace(
            $row['arxiv_tag'],
            $row['date'],
            $row['arxiv'],
            $row['number'],
            $row['title'],
            $row['authors'],
            $row['comments']
        );

        if ($success) {
            $count_replace++;
            if ($count_replace % 100 == 0) {
                echo "Migrated $count_replace records from ARXIV_REPLACE...\n";
            }
        } else {
            echo "Failed to migrate record: " . $row['arxiv_tag'] . "\n";
        }
        $db->sql_freeresult($result);
    }

    echo "Successfully migrated $count_replace records from ARXIV_REPLACE\n";

    // Verify migration
    echo "\nVerifying migration...\n";

    // Count records in SQLite
    $sqlite_new_count = 0;
    $sqlite_replace_count = 0;

    $result = $arxiv_db->exec("SELECT COUNT(*) as count FROM ARXIV_NEW");
    if ($result) {
        $sqlite_result = $arxiv_db->prepare("SELECT COUNT(*) as count FROM ARXIV_NEW");
        $sqlite_exec = $sqlite_result->execute();
        $row = $sqlite_exec->fetchArray(SQLITE3_ASSOC);
        $sqlite_new_count = $row['count'];
        $sqlite_result->close();
    }

    $sqlite_result = $arxiv_db->prepare("SELECT COUNT(*) as count FROM ARXIV_REPLACE");
    $sqlite_exec = $sqlite_result->execute();
    $row = $sqlite_exec->fetchArray(SQLITE3_ASSOC);
    $sqlite_replace_count = $row['count'];
    $sqlite_result->close();

    echo "SQLite ARXIV_NEW count: $sqlite_new_count\n";
    echo "SQLite ARXIV_REPLACE count: $sqlite_replace_count\n";

    if ($sqlite_new_count == $count_new && $sqlite_replace_count == $count_replace) {
        echo "\n✓ Migration completed successfully!\n";
        echo "Total records migrated: " . ($count_new + $count_replace) . "\n";
    } else {
        echo "\n✗ Migration verification failed!\n";
        echo "Expected: ARXIV_NEW=$count_new, ARXIV_REPLACE=$count_replace\n";
        echo "Got: ARXIV_NEW=$sqlite_new_count, ARXIV_REPLACE=$sqlite_replace_count\n";
    }

    $arxiv_db->close();
} catch (Exception $e) {
    echo "Error during migration: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nMigration script completed.\n";
echo "SQLite database created at: $sqlite_path\n";
echo "\nNext steps:\n";
echo "1. Test the new SQLite database with your applications\n";
echo "2. Update your applications to use the new ArxivDatabase class\n";
echo "3. Once verified, you can drop the MySQL ARXIV_NEW and ARXIV_REPLACE tables\n";
