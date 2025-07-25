<?php

/**
 * ArXiv Database Diagnostic Script
 *
 * This script helps diagnose issues with the SQLite database that might cause data loss.
 * Run this script to check permissions, file status, and database integrity.
 */

// Include the ArXiv database class
require_once dirname(__DIR__) . '/includes/arxiv_db.php';

echo "ArXiv Database Diagnostic Tool\n";
echo "==============================\n\n";

$db_path = dirname(__DIR__) . '/data/arxiv.db';

echo "1. File System Checks:\n";
echo "----------------------\n";
echo "Database path: $db_path\n";
echo "File exists: " . (file_exists($db_path) ? "YES" : "NO") . "\n";

if (file_exists($db_path)) {
    echo "File size: " . number_format(filesize($db_path)) . " bytes\n";
    echo "File permissions: " . substr(sprintf('%o', fileperms($db_path)), -4) . "\n";
    echo "Is readable: " . (is_readable($db_path) ? "YES" : "NO") . "\n";
    echo "Owner: " . posix_getpwuid(fileowner($db_path))['name'] . "\n";
    echo "Group: " . posix_getgrgid(filegroup($db_path))['name'] . "\n";
} else {
    echo "❌ Database file does not exist!\n";
}

echo "\n2. Directory Checks:\n";
echo "--------------------\n";
$data_dir = dirname($db_path);
echo "Data directory: $data_dir\n";
echo "Directory exists: " . (is_dir($data_dir) ? "YES" : "NO") . "\n";

echo "\n3. Database Connection Test:\n";
echo "----------------------------\n";

try {
    $arxiv_db = new ArxivDatabase();
    echo "✅ Database connection successful\n";

    $diagnostics = $arxiv_db->getDiagnostics();

    echo "\n4. Database Content:\n";
    echo "--------------------\n";

    if (isset($diagnostics['db_error'])) {
        echo "❌ Database query error: " . $diagnostics['db_error'] . "\n";
    } else {
        echo "ARXIV_NEW records: " . number_format($diagnostics['arxiv_new_count']) . "\n";
        echo "ARXIV_REPLACE records: " . number_format($diagnostics['arxiv_replace_count']) . "\n";
        echo "Journal mode: " . $diagnostics['journal_mode'] . "\n";

        if ($diagnostics['arxiv_new_count'] == 0) {
            echo "⚠️  WARNING: ARXIV_NEW table is empty!\n";
        }

        echo "\n5. Recent Records Check:\n";
        echo "------------------------\n";
        echo "Records from last 30 days: " . number_format($diagnostics['recent_count']) . "\n";

        // Check date range
        if ($diagnostics['min_date'] && $diagnostics['max_date']) {
            echo "Date range: " . $diagnostics['min_date'] . " to " . $diagnostics['max_date'] . "\n";
        } else {
            echo "No date information available\n";
        }
    }

    $arxiv_db->close();
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";

    // Try to identify the specific issue
    if (strpos($e->getMessage(), 'not readable') !== false) {
        echo "\n🔧 SOLUTION: Fix file permissions with:\n";
        echo "   chmod 664 $db_path\n";
        echo "   chown www-data:www-data $db_path\n";
    } elseif (strpos($e->getMessage(), 'does not exist') !== false) {
        echo "\n🔧 SOLUTION: Database file is missing. You need to:\n";
        echo "   1. Restore from backup, or\n";
        echo "   2. Re-run the migration script: php scripts/migrate_arxiv_to_sqlite.php\n";
    }
}

echo "\n6. Recommendations:\n";
echo "-------------------\n";

if (!file_exists($db_path)) {
    echo "❌ Database file missing - restore from backup or re-migrate\n";
} elseif (!is_readable($db_path)) {
    echo "❌ Permission issues - fix with: chmod 644 $db_path && chown www-data:www-data $db_path\n";
} elseif (filesize($db_path) < 100000) { // Less than 100KB suggests empty database
    echo "⚠️  Database appears to be empty or corrupted - consider restoring from backup\n";
} else {
    echo "✅ Database appears to be in good condition\n";
}

echo "\nDiagnostic complete.\n";
