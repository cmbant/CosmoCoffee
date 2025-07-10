<?php

/**
 * ArXiv SQLite Database Handler
 *
 * This class provides a clean interface to the SQLite database containing
 * ARXIV_NEW and ARXIV_REPLACE tables, separate from the main phpBB database.
 */

class ArxivDatabase
{
    private $db;
    private $db_path;

    public function __construct($db_path = null)
    {
        if ($db_path === null) {
            $db_path = dirname(__DIR__) . '/data/arxiv.db';
        }
        $this->db_path = $db_path;
        $this->connect();
        $this->createTables();
    }

    private function connect()
    {
        try {
            $this->db = new SQLite3($this->db_path);
            $this->db->busyTimeout(60000);
            // Enable WAL mode for better concurrency
            $this->db->exec('PRAGMA journal_mode=WAL;');
            $this->db->exec('PRAGMA synchronous=NORMAL;');
        } catch (Exception $e) {
            throw new Exception("Failed to connect to ArXiv database: " . $e->getMessage());
        }
    }

    private function createTables()
    {
        // Create ARXIV_NEW table
        $sql_new = "CREATE TABLE IF NOT EXISTS ARXIV_NEW (
            arxiv_tag VARCHAR(32) PRIMARY KEY,
            date DATE,
            arxiv VARCHAR(16),
            number VARCHAR(16),
            title VARCHAR(512),
            authors TEXT,
            comments TEXT,
            abstract TEXT
        )";

        // Create ARXIV_REPLACE table
        $sql_replace = "CREATE TABLE IF NOT EXISTS ARXIV_REPLACE (
            arxiv_tag VARCHAR(32) PRIMARY KEY,
            date DATE,
            arxiv VARCHAR(16),
            number VARCHAR(16),
            title VARCHAR(512),
            authors TEXT,
            comments TEXT
        )";

        // Create indexes for better performance
        $index_new_date = "CREATE INDEX IF NOT EXISTS idx_arxiv_new_date ON ARXIV_NEW(date)";
        $index_replace_date = "CREATE INDEX IF NOT EXISTS idx_arxiv_replace_date ON ARXIV_REPLACE(date)";
        $index_new_arxiv = "CREATE INDEX IF NOT EXISTS idx_arxiv_new_arxiv ON ARXIV_NEW(arxiv)";
        $index_replace_arxiv = "CREATE INDEX IF NOT EXISTS idx_arxiv_replace_arxiv ON ARXIV_REPLACE(arxiv)";

        $this->db->exec($sql_new);
        $this->db->exec($sql_replace);
        $this->db->exec($index_new_date);
        $this->db->exec($index_replace_date);
        $this->db->exec($index_new_arxiv);
        $this->db->exec($index_replace_arxiv);
    }

    /**
     * Insert or replace a record in ARXIV_NEW table
     */
    public function replaceArxivNew($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments, $abstract)
    {
        $sql = "REPLACE INTO ARXIV_NEW (arxiv_tag, date, arxiv, number, title, authors, comments, abstract)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $stmt->bindValue(2, $date, SQLITE3_TEXT);
        $stmt->bindValue(3, $arxiv, SQLITE3_TEXT);
        $stmt->bindValue(4, $number, SQLITE3_TEXT);
        $stmt->bindValue(5, $title, SQLITE3_TEXT);
        $stmt->bindValue(6, $authors, SQLITE3_TEXT);
        $stmt->bindValue(7, $comments, SQLITE3_TEXT);
        $stmt->bindValue(8, $abstract, SQLITE3_TEXT);

        $result = $stmt->execute();
        $stmt->close();

        return $result !== false;
    }

    /**
     * Insert or replace a record in ARXIV_REPLACE table
     */
    public function replaceArxivReplace($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments)
    {
        $sql = "REPLACE INTO ARXIV_REPLACE (arxiv_tag, date, arxiv, number, title, authors, comments)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $stmt->bindValue(2, $date, SQLITE3_TEXT);
        $stmt->bindValue(3, $arxiv, SQLITE3_TEXT);
        $stmt->bindValue(4, $number, SQLITE3_TEXT);
        $stmt->bindValue(5, $title, SQLITE3_TEXT);
        $stmt->bindValue(6, $authors, SQLITE3_TEXT);
        $stmt->bindValue(7, $comments, SQLITE3_TEXT);

        $result = $stmt->execute();
        $stmt->close();

        return $result !== false;
    }

    /**
     * Delete a record from ARXIV_NEW table
     */
    public function deleteArxivNew($arxiv_tag)
    {
        $sql = "DELETE FROM ARXIV_NEW WHERE arxiv_tag = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $result = $stmt->execute();
        $stmt->close();
        return $result !== false;
    }

    /**
     * Delete a record from ARXIV_REPLACE table
     */
    public function deleteArxivReplace($arxiv_tag)
    {
        $sql = "DELETE FROM ARXIV_REPLACE WHERE arxiv_tag = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $result = $stmt->execute();
        $stmt->close();
        return $result !== false;
    }

    /**
     * Check if an arxiv_tag exists in ARXIV_NEW table
     */
    public function existsInArxivNew($arxiv_tag)
    {
        $sql = "SELECT 1 FROM ARXIV_NEW WHERE arxiv_tag = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        $stmt->close();
        return $row !== false;
    }

    /**
     * Get paper details for multiple arxiv_tags (for bookmark display)
     * Returns all fields needed for bookmark display
     */
    public function getPaperDetailsByTags($arxiv_tags)
    {
        if (empty($arxiv_tags)) {
            return [];
        }

        $placeholders = str_repeat('?,', count($arxiv_tags) - 1) . '?';
        $sql = "SELECT arxiv_tag, title, authors, date, arxiv, number, comments, abstract FROM ARXIV_NEW WHERE arxiv_tag IN ($placeholders)";

        $stmt = $this->db->prepare($sql);
        $param_count = 1;
        foreach ($arxiv_tags as $tag) {
            $stmt->bindValue($param_count++, $tag, SQLITE3_TEXT);
        }

        $result = $stmt->execute();
        $papers = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $papers[$row['arxiv_tag']] = $row;
        }
        $stmt->close();

        return $papers;
    }

    /**
     * Get arxiv field for a given arxiv_tag from ARXIV_NEW table
     */
    public function getArxivFromNew($arxiv_tag)
    {
        $sql = "SELECT arxiv FROM ARXIV_NEW WHERE arxiv_tag = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $arxiv_tag, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $stmt->close();
        return $row ? $row['arxiv'] : null;
    }

    /**
     * Query ARXIV_NEW table with date range and arxiv filter
     */
    public function queryArxivNew($date_start, $date_end, $arxiv_list, $arxiv_tag_pattern = null)
    {
        $where_conditions = [];
        $params = [];
        $param_count = 0;

        // Handle date range
        if ($date_start && $date_end && $date_start === $date_end) {
            // Single date
            $where_conditions[] = "date = ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_start && $date_end) {
            // Date range
            $where_conditions[] = "date >= ? AND date <= ?";
            $params[++$param_count] = $date_start;
            $params[++$param_count] = $date_end;
        } elseif ($date_start) {
            // From date onwards
            $where_conditions[] = "date >= ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_end) {
            // Up to date
            $where_conditions[] = "date <= ?";
            $params[++$param_count] = $date_end;
        }

        // Handle arxiv tag pattern (for month-based queries)
        if ($arxiv_tag_pattern) {
            $where_conditions[] = "arxiv_tag LIKE ?";
            $params[++$param_count] = $arxiv_tag_pattern;
        }

        // Handle arxiv list
        if (!empty($arxiv_list)) {
            $placeholders = str_repeat('?,', count($arxiv_list) - 1) . '?';
            $where_conditions[] = "arxiv IN ($placeholders)";
            foreach ($arxiv_list as $arxiv) {
                $params[++$param_count] = $arxiv;
            }
        }

        $where_clause = implode(' AND ', $where_conditions);
        $sql = "SELECT arxiv_tag, arxiv, title, authors, comments, abstract
                FROM ARXIV_NEW" . ($where_clause ? " WHERE $where_clause" : "");

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $index => $value) {
                $stmt->bindValue($index, $value, SQLITE3_TEXT);
            }

            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Query failed: " . $this->db->lastErrorMsg());
            }

            $rows = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows[] = $row;
            }
            $stmt->close();
            return $rows;
        } catch (Exception $e) {
            // Log error for debugging
            error_log("ArxivDatabase queryArxivNew error: " . $e->getMessage() . " SQL: " . $sql);
            throw $e;
        }
    }

    /**
     * Query ARXIV_REPLACE table with date range and arxiv filter
     */
    public function queryArxivReplace($date_start, $date_end, $arxiv_list)
    {
        $where_conditions = [];
        $params = [];
        $param_count = 0;

        // Handle date range
        if ($date_start && $date_end && $date_start === $date_end) {
            // Single date
            $where_conditions[] = "date = ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_start && $date_end) {
            // Date range
            $where_conditions[] = "date >= ? AND date <= ?";
            $params[++$param_count] = $date_start;
            $params[++$param_count] = $date_end;
        } elseif ($date_start) {
            // From date onwards
            $where_conditions[] = "date >= ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_end) {
            // Up to date
            $where_conditions[] = "date <= ?";
            $params[++$param_count] = $date_end;
        }

        // Handle arxiv list
        if (!empty($arxiv_list)) {
            $placeholders = str_repeat('?,', count($arxiv_list) - 1) . '?';
            $where_conditions[] = "arxiv IN ($placeholders)";
            foreach ($arxiv_list as $arxiv) {
                $params[++$param_count] = $arxiv;
            }
        }

        $where_clause = implode(' AND ', $where_conditions);
        $sql = "SELECT arxiv_tag, title, authors, comments
                FROM ARXIV_REPLACE" . ($where_clause ? " WHERE $where_clause" : "");

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $index => $value) {
                $stmt->bindValue($index, $value, SQLITE3_TEXT);
            }

            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Query failed: " . $this->db->lastErrorMsg());
            }

            $rows = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows[] = $row;
            }
            $stmt->close();
            return $rows;
        } catch (Exception $e) {
            // Log error for debugging
            error_log("ArxivDatabase queryArxivReplace error: " . $e->getMessage() . " SQL: " . $sql);
            throw $e;
        }
    }

    /**
     * Get paper details for bookmarks with efficient date filtering
     * This method is optimized for bookmark queries that can now filter by paper_date in MySQL
     * before fetching paper details from SQLite
     */
    public function getPaperDetailsForBookmarks($arxiv_tags, $date_start = null, $date_end = null)
    {
        if (empty($arxiv_tags)) {
            return [];
        }

        $where_conditions = [];
        $params = [];
        $param_count = 0;

        // Handle arxiv_tag list
        $placeholders = str_repeat('?,', count($arxiv_tags) - 1) . '?';
        $where_conditions[] = "arxiv_tag IN ($placeholders)";
        foreach ($arxiv_tags as $arxiv_tag) {
            $params[++$param_count] = $arxiv_tag;
        }

        // Handle date range if provided
        if ($date_start && $date_end && $date_start === $date_end) {
            // Single date
            $where_conditions[] = "date = ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_start && $date_end) {
            // Date range
            $where_conditions[] = "date >= ? AND date <= ?";
            $params[++$param_count] = $date_start;
            $params[++$param_count] = $date_end;
        } elseif ($date_start) {
            // From date onwards
            $where_conditions[] = "date >= ?";
            $params[++$param_count] = $date_start;
        } elseif ($date_end) {
            // Up to date
            $where_conditions[] = "date <= ?";
            $params[++$param_count] = $date_end;
        }

        $where_clause = implode(' AND ', $where_conditions);
        $sql = "SELECT arxiv_tag, date, arxiv, title, authors, comments, abstract
                FROM ARXIV_NEW
                WHERE $where_clause";

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $index => $value) {
                $stmt->bindValue($index, $value, SQLITE3_TEXT);
            }

            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Query failed: " . $this->db->lastErrorMsg());
            }

            $papers = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $papers[$row['arxiv_tag']] = $row; // Index by arxiv_tag for easy lookup
            }
            $stmt->close();

            return $papers;
        } catch (Exception $e) {
            error_log("ArxivDatabase getPaperDetailsForBookmarks error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Execute a raw SQL query (for migration purposes)
     */
    public function exec($sql)
    {
        return $this->db->exec($sql);
    }

    /**
     * Prepare a statement (for migration purposes)
     */
    public function prepare($sql)
    {
        return $this->db->prepare($sql);
    }

    /**
     * Close the database connection
     */
    public function close()
    {
        if ($this->db) {
            $this->db->close();
        }
    }

    /**
     * Helper function to merge bookmark data with paper details
     * This replaces the complex SQL joins that can't work across databases
     */
    public static function mergeBookmarkWithPaperData($bookmark_rows, $arxiv_db)
    {
        if (empty($bookmark_rows)) {
            return [];
        }

        // Extract unique arxiv_tags from bookmark data
        $arxiv_tags = [];
        foreach ($bookmark_rows as $row) {
            if (!empty($row['arxiv_tag']) && !in_array($row['arxiv_tag'], $arxiv_tags)) {
                $arxiv_tags[] = $row['arxiv_tag'];
            }
        }

        // Get paper details from SQLite
        $paper_details = $arxiv_db->getPaperDetailsByTags($arxiv_tags);

        // Merge the data
        $merged_rows = [];
        foreach ($bookmark_rows as $row) {
            $arxiv_tag = $row['arxiv_tag'];
            if (isset($paper_details[$arxiv_tag])) {
                // Merge bookmark data with paper details
                $merged_row = array_merge($row, $paper_details[$arxiv_tag]);
                $merged_rows[] = $merged_row;
            }
        }

        return $merged_rows;
    }

    public function __destruct()
    {
        $this->close();
    }
}
