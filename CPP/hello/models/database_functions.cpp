/**
 * @brief Handles all calls to the User database.
 *
 * C++ version used: C++ 14
 *
 * Styling guide: NRL Radar Division's C++ Coding Standard style guide at https://apps.dtic.mil/dtic/tr/fulltext/u2/a640901.pdf.
 *
 * @category  CPP
 * @package   Hello
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */
#include "common_functions.cpp"
#include <sqlite3.h>
#include <cerrno>
#include <iostream>

using namespace std;

class DatabaseFunctions
{
private:
public:
    /**
     * @brief Sets the path to the user database.
     */
    const string PATH_TO_SQLITE_DB = MODEL_DIR + FILE_SEPARATOR + "data" + FILE_SEPARATOR + "users.db";

    /**
     * @brief Create a user table object
     * 
     * @return int 
     */
    int create_user_table()
    {
        int rows_affected = -1;
        sqlite3 *db;
        try
        {
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " exception in database_functions.create_user_table() function.");
        }
        sqlite3_close(db);
        return rows_affected;
    }

    /**
     * @brief Create a user object
     * 
     * @param first_name 
     * @param last_name 
     * @param email 
     * @param score 
     * @param comment 
     * @return long 
     */
    long create_user(string first_name, string last_name, string email, float score, string comment)
    {
        long last_row_id = 0;
        sqlite3 *db;
        try
        {

        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " exception in database_functions.database_exists() function.");
        }
        sqlite3_close(db);
        return last_row_id;
    }

    /**
     * @brief 
     * 
     * @return true 
     * @return false 
     */
    bool database_exists()
    {
        bool exists = false;
        sqlite3 *db;
        try
        {
            // Create the database folder if it does not exist
            string DB_DIR = MODEL_DIR + FILE_SEPARATOR + "data";
            int success = mkdir(DB_DIR.c_str());
            if (success != 0 && errno != EEXIST)
            {
                log_error((string)strerror(errno) + " error in database_functions.database_exists() function.");
                return exists;
            }
            // Create the database if it does not exist
            success = sqlite3_open(PATH_TO_SQLITE_DB.c_str(), &db);
            if (success != SQLITE_OK)
            {
                log_error((string)sqlite3_errmsg(db) + " error in database_functions.database_exists() function.");
                sqlite3_close(db);
                return exists;
            }
            exists = true;
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " exception in database_functions.database_exists() function.");
        }
        sqlite3_close(db);
        return exists;
    }
};