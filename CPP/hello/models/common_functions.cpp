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
#ifdef WINDOWS
#include <direct.h>
#define GetCurrentDir _getcwd
#else
#include <unistd.h>
#define GetCurrentDir getcwd
#endif

#include <string>

using namespace std;

class CommonFunctions
{
private:
public:
    string ROOT_DIR = GetRootDir();
    /**
     * Validate UserID.
     * 
     * @param userID The UserID that will be entered in the database.
     * @return True if the UserID is an integer greater than 0, false if not.
     */
    bool ValidateUserID(long userID)
    {
        return userID > 0;
    }

    /**
     * Validate text input.
     * 
     * @param text The text that will be entered into the database.
     * @return True if the text is valid, false if not.
     */
    bool ValidateText(string text)
    {
        return (Trim(text) == "") ? false : true;
    }

    /**
     * Validate email address.
     * 
     * @param email The email address that will be entered into the database.
     * @return True if the email is valid, false if not.
     */
    bool ValidateEmail(string email)
    {
        return (Trim(email) == "") ? false : true;
    }

    /**
     * Validate date format.
     * 
     * @param date The date that will be entered into the database.
     * @return True if the date format is valid, false if not.
     */
    bool ValidateDate(string date)
    {
        return (Trim(date) == "" || date.length() != 19) ? false : true;
    }

    string Trim(const string &str)
    {
        size_t first = str.find_first_not_of(' ');
        if (string::npos == first)
        {
            return str;
        }
        size_t last = str.find_last_not_of(' ');
        return str.substr(first, (last - first + 1));
    }

    string GetRootDir()
    {
        char buffer[FILENAME_MAX];
        GetCurrentDir(buffer, FILENAME_MAX);
        string current_dir(buffer);
        return current_dir;
    }
};