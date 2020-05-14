/**
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
#ifdef _WIN32
#include <direct.h>
#define GetCurrentDir _getcwd
#define FILE_SEPARATOR "\\"
#else
#include <unistd.h>
#define GetCurrentDir getcwd
#define FILE_SEPARATOR "/"
#endif

#include <iostream>
#include <string>

using namespace std;

string trim(const string &str);

/**
 * @brief Get the Root Dir object.
 * 
 * @return string The working directory of the calling file.
 */
string getRootDir()
{
    try
    {
        char buffer[FILENAME_MAX];
        GetCurrentDir(buffer, FILENAME_MAX);
        string current_dir(buffer);
        return current_dir;
    }
    catch (const char *ex)
    {
        cout << "Error: " << ex << endl;
    }
}

/**
 * @brief Set the application's root directory.
 */
const string ROOT_DIR = getRootDir();

/**
 * @brief Set the application's model directory.
 */
const string MODEL_DIR = ROOT_DIR + FILE_SEPARATOR + "models";

/**
 * @brief Set the visibility of errors. Set to True to log and display
 * during development and to False to only log during production.
 */
const bool DISPLAY_ERRORS = true;

/**
 * @brief Reformats error and exception details and records them in plain
 * text in the error_log file.
 * 
 * @param ex The exception's details.
 * @return string Reformatted error and exception details in plain text.
 */
string logError(string ex)
{
    string formatted_exception = NULL;

    return formatted_exception;
}

/**
 * @brief Validate UserID.
 * 
 * @param userID The UserID that will be entered in the database.
 * @return True if the UserID is an integer greater than 0, false if not.
 */
bool validateUserID(long userID)
{
    return userID > 0;
}

/**
 * @brief Validate text input.
 * 
 * @param text The text that will be entered into the database.
 * @return True if the text is valid, false if not.
 */
bool validateText(string text)
{
    return (trim(text) == "") ? false : true;
}

/**
 * @brief Validate email address.
 * 
 * @param email The email address that will be entered into the database.
 * @return True if the email is valid, false if not.
 */
bool validateEmail(string email)
{
    return (trim(email) == "") ? false : true;
}

/**
 * @brief Validate date format.
 * 
 * @param date The date that will be entered into the database.
 * @return True if the date format is valid, false if not.
 */
bool validateDate(string date)
{
    return (trim(date) == "" || date.length() != 19) ? false : true;
}

/**
 * @brief Removes leading and tailing whitespace.
 * 
 * @param str The string to trim.
 * @return string The trimmed string.
 */
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