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
    public function queryArxivNew($date_range_sql, $arxiv_sql)
    {
        $sql = "SELECT arxiv_tag, arxiv, title, authors, comments, abstract
                FROM ARXIV_NEW
                WHERE $date_range_sql AND $arxiv_sql";

        try {
            $result = $this->db->query($sql);
            if (!$result) {
                throw new Exception("Query failed: " . $this->db->lastErrorMsg());
            }

            $rows = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows[] = $row;
            }
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
    public function queryArxivReplace($date_range_sql, $arxiv_sql)
    {
        $sql = "SELECT arxiv_tag, title, authors, comments
                FROM ARXIV_REPLACE
                WHERE $date_range_sql AND $arxiv_sql";

        try {
            $result = $this->db->query($sql);
            if (!$result) {
                throw new Exception("Query failed: " . $this->db->lastErrorMsg());
            }

            $rows = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        } catch (Exception $e) {
            // Log error for debugging
            error_log("ArxivDatabase queryArxivReplace error: " . $e->getMessage() . " SQL: " . $sql);
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

    public function __destruct()
    {
        $this->close();
    }
}
