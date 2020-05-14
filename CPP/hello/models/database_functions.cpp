/**
 * Handles all calls to the User database.
 *
 * C++ version used: C++ 14
 *
 * Styling guide: Google C++ Style Guide at https://google.github.io/styleguide/cppguide.html.
 *
 * @category  CPP
 * @package   Hello
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */
#include "common_functions.cpp"

using namespace std;

/**
 * @brief Sets the path to the user database.
 */
const string PATH_TO_SQLITE_DB = ROOT_DIR + FILE_SEPARATOR + "data" + FILE_SEPARATOR + "Users.db";

int createUserTable() {
    int rowsAffected = -1;

    return rowsAffected;
}

long createUser(string firstName, string lastName, string email, float score, string comment) {
    long lastRowID = 0;
    
    return lastRowID;
}
