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
    const string PATH_TO_SQLITE_DB = ROOT_DIR + FILE_SEPARATOR + "data" + FILE_SEPARATOR + "Users.db";

    int create_user_table()
    {
        int rows_affected = -1;
        sqlite3 *db;
        try
        {

        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in common_functions.get_root_dir() function.");
        }
        sqlite3_close(db);
        return rows_affected;
    }

    long create_user(string first_name, string last_name, string email, float score, string comment)
    {
        long last_row_id = 0;

        return last_row_id;
    }

    int test()
    {
        int success = 0;
        try
        {
            string DB_DIR = ROOT_DIR + FILE_SEPARATOR + "data";
            success = mkdir(DB_DIR.c_str());
            if (success == 0)
            {
                cout << "Directory created." << endl;
            }
            else if (errno != EEXIST)
            {
                cout << strerror(errno) << endl;
            }
            else
            {
                cout << "Directory already exists." << endl;
            }
            /*
            sqlite3 *DB;
            int exit = 0;
            exit = sqlite3_open("example.db", &DB);

            if (exit)
            {
                cerr << "Error open DB " << sqlite3_errmsg(DB) << std::endl;
                return (-1);
            }
            else
                cout << "Opened Database Successfully!" << std::endl;
            sqlite3_close(DB);
            */
        }
        catch (exception &ex)
        {
            cout << ex.what() << " in test()." << endl;
            return success;
        }
        return success;
    }
};