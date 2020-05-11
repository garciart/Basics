/*
 * Code common to one or more files.
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
#include <string>

using namespace std;

class CommonFunctions
{
private:
public:
    string ROOT_DIR = "";
    /**
     * Validate UserID.
     * 
     * @param userID The UserID that will be entered in the database.
     * @return True if the UserID is an integer greater than 0, false if not.
     */
    bool validateUserID(long userID)
    {
        return userID > 0;
    }

    /**
     * Validate text input.
     * 
     * @param text The text that will be entered into the database.
     * @return True if the text is valid, false if not.
     */
    bool validateText(string text)
    {
        return (trim(text) == "") ? false : true;
    }

    /**
     * Validate email address.
     * 
     * @param email The email address that will be entered into the database.
     * @return True if the email is valid, false if not.
     */
    bool validateEmail(string email)
    {
        return (trim(email) == "") ? false : true;
    }

    /**
     * Validate date format.
     * 
     * @param date The date that will be entered into the database.
     * @return True if the date format is valid, false if not.
     */
    bool validateDate(string date)
    {
        return (trim(date) == "" || date.length() != 19) ? false : true;
    }

    string trim(const string &str)
    {
        size_t first = str.find_first_not_of(' ');
        if (string::npos == first)
        {
            return str;
        }
        size_t last = str.find_last_not_of(' ');
        return str.substr(first, (last - first + 1));
    }
};