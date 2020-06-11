/**
 * Hello World in C++ with database integration.
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

/* ========== Include files and other header files ========== */

#include "models/common_functions.cpp"
#include "models/database_functions.cpp"
#include <iostream>
#include <string>

using namespace std;

/* ========== Constants, #define, and enum statements ========== */

/* ========== Public Datatypes ========== */

/* ========== Public Function prototypes ========== */
int hello_users();

/**
 * @brief Hello World in C++ with database integration.
 * 
 * @return int EXIT_SUCCESS or EXIT_FAILURE
 */
int hello_users()
{
    try
    {
        cout << "Verifying database exists..." << endl;
        DatabaseFunctions db;
        if (db.database_exists())
        {
            cout << "Database is good to go!" << endl;
        }
        else
        {
            cout << "Unable to connect to the database and retrieve data." << endl;
        }
    }
    catch (const exception &ex)
    {
        log_error((string)ex.what() + " in hello.hello_users() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

/**
 * @brief Application entry point
 * 
 * @param argc Number of command line arguments
 * @param argv Command line arguments
 * @return int EXIT_SUCCESS or EXIT_FAILURE
 */
int main(int argc, char **argv)
{
    try
    {
        cout << "Hello, World from C++!" << endl;
        hello_users();
    }
    catch (const exception &ex)
    {
        log_error((string)ex.what() + " in hello.main() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}