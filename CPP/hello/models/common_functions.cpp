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

#ifdef _WIN32
#define FILE_SEPARATOR "\\"
#else
#define FILE_SEPARATOR "/"
#endif

#include <string>

using namespace std;

class CommonFunctions
{
private:
public:
    /**
     * @brief Set the application's root directory.
     */
    string ROOT_DIR = GetRootDir();

    /**
     * @brief Set the application's model directory.
     */
    string MODEL_DIR = ROOT_DIR + FILE_SEPARATOR + "models";

    /**
     * @brief Set the visibility of errors. Set to True to log and display
     * during development and to False to only log during production.
     */
    bool DISPLAY_ERRORS = true;

    /**
     * @brief Reformats error and exception details and records them in plain
     * text in the error_log file.
     * 
     * @param ex The exception's details.
     * @return string Reformatted error and exception details in plain text.
     */
    string LogError(Exception ex)
    {
        string formatted_exception = null;

        return formatted_exception;
    }

    /**
     * @brief Validate UserID.
     * 
     * @param userID The UserID that will be entered in the database.
     * @return True if the UserID is an integer greater than 0, false if not.
     */
    bool ValidateUserID(long userID)
    {
        return userID > 0;
    }

    /**
     * @brief Validate text input.
     * 
     * @param text The text that will be entered into the database.
     * @return True if the text is valid, false if not.
     */
    bool ValidateText(string text)
    {
        return (Trim(text) == "") ? false : true;
    }

    /**
     * @brief Validate email address.
     * 
     * @param email The email address that will be entered into the database.
     * @return True if the email is valid, false if not.
     */
    bool ValidateEmail(string email)
    {
        return (Trim(email) == "") ? false : true;
    }

    /**
     * @brief Validate date format.
     * 
     * @param date The date that will be entered into the database.
     * @return True if the date format is valid, false if not.
     */
    bool ValidateDate(string date)
    {
        return (Trim(date) == "" || date.length() != 19) ? false : true;
    }

    /**
     * @brief Removes leading and tailing whitespace.
     * 
     * @param str The string to trim.
     * @return string The trimmed string.
     */
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

    /**
     * @brief Get the Root Dir object.
     * 
     * @return string The working directory of the calling file.
     */
    string GetRootDir()
    {
        char buffer[FILENAME_MAX];
        GetCurrentDir(buffer, FILENAME_MAX);
        string current_dir(buffer);
        return current_dir;
    }

    /**
     * @brief Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */
    CommonFunctions()
    {
        throw "Do not instantiate. The methods in CommonFunctions should be accessed in a static way.";
    }
};