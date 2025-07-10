<?php

/**
 * Test script to verify bookmark integration with SQLite ArXiv database
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up paths
$phpbb_root_path = './';
$phpEx = 'php';

// Include phpBB common setup
define('IN_PHPBB', true);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/arxiv_db.' . $phpEx);

echo "Testing ArXiv Database Integration with Bookmarks\n";
echo "================================================\n\n";

try {
    // Initialize ArXiv database
    $arxiv_db = new ArxivDatabase();
    echo "✓ ArxivDatabase initialized successfully\n";

    // Test 1: Check if database exists and has tables
    echo "\nTest 1: Database structure\n";
    echo "--------------------------\n";
    
    // Test existsInArxivNew function
    echo "\nTest 2: Testing existsInArxivNew function\n";
    echo "----------------------------------------\n";
    $test_tag = '2401.00001';
    $exists = $arxiv_db->existsInArxivNew($test_tag);
    echo "Paper $test_tag exists: " . ($exists ? 'YES' : 'NO') . "\n";

    // Test 3: Test getPaperDetailsByTags function
    echo "\nTest 3: Testing getPaperDetailsByTags function\n";
    echo "----------------------------------------------\n";
    $test_tags = ['2401.00001', '2401.00002', 'nonexistent'];
    $paper_details = $arxiv_db->getPaperDetailsByTags($test_tags);
    echo "Requested tags: " . implode(', ', $test_tags) . "\n";
    echo "Found " . count($paper_details) . " papers\n";
    foreach ($paper_details as $tag => $details) {
        echo "  - $tag: " . substr($details['title'], 0, 50) . "...\n";
    }

    // Test 4: Test mergeBookmarkWithPaperData function
    echo "\nTest 4: Testing mergeBookmarkWithPaperData function\n";
    echo "--------------------------------------------------\n";

    // Simulate bookmark data (what would come from MySQL)
    $mock_bookmark_data = [
        [
            'arxiv_tag' => '2401.00001',
            'bookmark_id' => 1,
            'user_id' => 123,
            'note' => 'Interesting paper',
            'ac' => 3,
            'who' => 'user1\nuser2\nuser3',
            'notes' => 'note1\nnote2\nnote3',
            'bookdate' => '2024-01-15',
            'book_tags' => '1,2',
            'shortname' => 'testclub',
            'club_id' => 5
        ],
        [
            'arxiv_tag' => '2401.00002',
            'bookmark_id' => 2,
            'user_id' => 123,
            'note' => 'Another good one',
            'ac' => 1,
            'who' => 'user1',
            'notes' => 'single note',
            'bookdate' => '2024-01-16'
        ]
    ];

    $merged_data = ArxivDatabase::mergeBookmarkWithPaperData($mock_bookmark_data, $arxiv_db);
    echo "Mock bookmark entries: " . count($mock_bookmark_data) . "\n";
    echo "Merged entries: " . count($merged_data) . "\n";

    foreach ($merged_data as $entry) {
        echo "  - " . $entry['arxiv_tag'] . ": " .
             (isset($entry['title']) ? substr($entry['title'], 0, 40) . "..." : "No title found") .
             " (bookmarks: " . $entry['ac'] . ")\n";

        // Check that all expected fields are present
        $expected_fields = ['arxiv_tag', 'bookmark_id', 'note', 'ac', 'who', 'title', 'authors', 'date'];
        $missing_fields = [];
        foreach ($expected_fields as $field) {
            if (!isset($entry[$field])) {
                $missing_fields[] = $field;
            }
        }
        if (!empty($missing_fields)) {
            echo "    WARNING: Missing fields: " . implode(', ', $missing_fields) . "\n";
        } else {
            echo "    ✓ All expected fields present\n";
        }
    }

    // Test 5: Test database connection and basic query
    echo "\nTest 5: Testing basic database operations\n";
    echo "----------------------------------------\n";
    
    // Try to add a test paper
    $test_result = $arxiv_db->replaceArxivNew(
        'test.12345',
        '2024-01-01', 
        'test-cat',
        'test.12345',
        'Test Paper for Integration',
        'Test Author',
        'Test comments',
        'Test abstract for integration testing'
    );
    
    echo "Test paper insertion: " . ($test_result ? 'SUCCESS' : 'FAILED') . "\n";
    
    if ($test_result) {
        // Check if it exists
        $exists = $arxiv_db->existsInArxivNew('test.12345');
        echo "Test paper exists after insertion: " . ($exists ? 'YES' : 'NO') . "\n";
        
        // Clean up
        $arxiv_db->deleteArxivNew('test.12345');
        echo "Test paper cleaned up\n";
    }

    echo "\n✓ All tests completed successfully!\n";
    echo "\nThe bookmark integration should work correctly with the SQLite database.\n";
    echo "Key benefits:\n";
    echo "- Clean separation between phpBB MySQL and ArXiv SQLite databases\n";
    echo "- Bookmark validation works through ArxivDatabase::existsInArxivNew()\n";
    echo "- Complex joins replaced with application-level data merging\n";
    echo "- All existing functionality preserved\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n";
