/*
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

class DatabaseFunctions
{
private:
    CommonFunctions cf;

public:
    /**
     * @brief Sets the path to the user database.
     */
    string PATH_TO_SQLITE_DB = cf.ROOT_DIR + "/" + "data" + "/" + "Users.db";

    int CreateUserTable() {
        int rowsAffected = -1;

        return rowsAffected;
    }

    long createUser(String firstName, String lastName, String email, float score, String comment) {
        long lastRowID = 0;
        
        return lastRowID;
    }
};