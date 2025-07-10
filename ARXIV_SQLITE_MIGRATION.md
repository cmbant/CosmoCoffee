# ArXiv Tables SQLite Migration

This document describes the refactoring of the ARXIV_NEW and ARXIV_REPLACE tables from MySQL to a separate SQLite database.

## Overview

The ARXIV_NEW and ARXIV_REPLACE tables have been moved from the main MySQL database to a separate SQLite database to improve performance and reduce load on the main phpBB database.

## Changes Made

### New Files Created

1. **`includes/arxiv_db.php`** - New SQLite database abstraction class
   - Provides clean interface to ARXIV_NEW and ARXIV_REPLACE tables
   - Handles database connection, table creation, and all CRUD operations
   - Separate from phpBB database classes for clean separation

2. **`scripts/migrate_arxiv_to_sqlite.php`** - Migration script
   - Converts existing MySQL data to SQLite format
   - Verifies data integrity after migration
   - Creates the SQLite database with proper indexes

3. **`scripts/test_arxiv_db.php`** - Test script
   - Validates SQLite database functionality
   - Creates test data for development/testing

4. **`data/arxiv.db`** - SQLite database file (created by migration script)

### Modified Files

1. **`arxiv_cron.php`**
   - Updated to use ArxivDatabase class instead of direct MySQL queries
   - Maintains same functionality with improved performance

2. **`arxiv_harvest.php`**
   - Updated to use ArxivDatabase class
   - Handles paper insertions and deletions via SQLite

3. **`arxiv_new.php`**
   - Removed LEFT JOIN with phpbb_papers table as requested
   - Updated to query SQLite database directly
   - Paper_id-dependent output skipped (assumes not defined)
   - Maintains same user interface and functionality

4. **`arxiv_start.pl`**
   - Updated to use SQLite instead of MySQL
   - Uses DBI::SQLite for database connectivity

### Database Schema

The SQLite database maintains the same table structure as the original MySQL tables:

#### ARXIV_NEW Table
- `arxiv_tag` VARCHAR(32) PRIMARY KEY
- `date` DATE
- `arxiv` VARCHAR(16)
- `number` VARCHAR(16)
- `title` VARCHAR(512)
- `authors` TEXT
- `comments` TEXT
- `abstract` TEXT

#### ARXIV_REPLACE Table
- `arxiv_tag` VARCHAR(32) PRIMARY KEY
- `date` DATE
- `arxiv` VARCHAR(16)
- `number` VARCHAR(16)
- `title` VARCHAR(512)
- `authors` TEXT
- `comments` TEXT

Both tables include indexes on `date` and `arxiv` fields for optimal query performance.

## Installation Requirements

### System Dependencies
- SQLite3
- PHP SQLite3 extension
- Perl DBI::SQLite module

Install on Ubuntu/Debian:
```bash
sudo apt install sqlite3 php-sqlite3 libdbd-sqlite3-perl
```

## Migration Process

1. **Backup existing data** (recommended)
   ```bash
   mysqldump -u username -p database_name ARXIV_NEW ARXIV_REPLACE > arxiv_backup.sql
   ```

2. **Run migration script**
   ```bash
   php scripts/migrate_arxiv_to_sqlite.php
   ```

3. **Test the new system**
   ```bash
   php scripts/test_arxiv_db.php
   ```

4. **Verify functionality**
   - Test arxiv_new.php in browser
   - Test arxiv_cron.php and arxiv_harvest.php scripts
   - Verify Perl scripts work correctly

5. **Optional: Drop MySQL tables** (after verification)
   ```sql
   DROP TABLE ARXIV_NEW;
   DROP TABLE ARXIV_REPLACE;
   ```

## Key Benefits

1. **Performance**: SQLite provides faster access for the arxiv tables
2. **Separation**: Clean separation from main phpBB database
3. **Maintenance**: Easier to backup and maintain arxiv data separately
4. **Scalability**: Reduces load on main MySQL database

## API Changes

### ArxivDatabase Class Methods

- `replaceArxivNew($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments, $abstract)`
- `replaceArxivReplace($arxiv_tag, $date, $arxiv, $number, $title, $authors, $comments)`
- `deleteArxivNew($arxiv_tag)`
- `deleteArxivReplace($arxiv_tag)`
- `existsInArxivNew($arxiv_tag)`
- `getArxivFromNew($arxiv_tag)`
- `queryArxivNew($date_range_sql, $arxiv_sql)`
- `queryArxivReplace($date_range_sql, $arxiv_sql)`

## Backward Compatibility

- All existing functionality is preserved
- User interface remains unchanged
- API calls maintain same behavior
- phpbb_papers joins removed as requested (paper_id assumed undefined)

## Testing

The migration includes comprehensive testing:
- Database connectivity and table creation
- Data insertion and retrieval
- Query functionality with filters
- Deletion operations
- Perl script integration

## Troubleshooting

### Common Issues

1. **Permission errors**: Ensure web server has write access to `data/` directory
2. **SQLite not found**: Install sqlite3 and php-sqlite3 packages
3. **Perl DBI errors**: Install libdbd-sqlite3-perl package

### File Locations

- SQLite database: `data/arxiv.db`
- Database class: `includes/arxiv_db.php`
- Migration script: `scripts/migrate_arxiv_to_sqlite.php`
- Test script: `scripts/test_arxiv_db.php`

## Future Considerations

- Consider adding database connection pooling for high-traffic scenarios
- Monitor SQLite database size and implement rotation if needed
- Add logging for database operations if required
