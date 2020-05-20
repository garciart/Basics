/**
 * @brief Code common to one or more files.
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

#ifdef _WIN32
#include <direct.h>
#define GetCurrentDir _getcwd
#define FILE_SEPARATOR "\\"
#else
#include <unistd.h>
#define GetCurrentDir getcwd
#define FILE_SEPARATOR "/"
#endif

#include <ctime>
#include <fstream>
#include <iomanip>
#include <iostream>
#include <sstream>
#include <string>
#include <vector>

using namespace std;

string trim(const string &str);
string getRootDir();
string logError(string ex);

const string WHITESPACE = " \n\r\t\f\v";

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
 * @brief Get the directory of the calling file.
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
    catch (exception &ex)
    {
        logError((string)ex.what() + " in getRootDir() function.");
    }
}

/**
 * @brief Reformats error and exception details and records them in plain
 * text in the error_log file.
 * 
 * @param ex The exception's details.
 * @return string Reformatted error and exception details in plain text.
 */
string logError(string ex)
{
    time_t now = time(0);
    tm *ltm = localtime(&now);
    stringstream ss;
    ss << (1900 + ltm->tm_year) << "-"
       << setw(2) << setfill('0') << ltm->tm_mon << "-"
       << setw(2) << setfill('0') << ltm->tm_mday << " "
       << setw(2) << setfill('0') << ltm->tm_hour << "-"
       << setw(2) << setfill('0') << ltm->tm_min << "-"
       << setw(2) << setfill('0') << ltm->tm_sec;

    ofstream errorFile;
    errorFile.open("ErrorLog.txt", ios_base::app);
    errorFile << ss.str() << ": " << ex << endl;
    errorFile.close();

    if (DISPLAY_ERRORS)
    {
        cout << "Error/Exception: " << ex << endl;
    }
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
    // Get the index of the first non-whitespace character in the string
    size_t first = str.find_first_not_of(WHITESPACE);
    // If the string is searched and no whitespace is found, return the string
    if (first == string::npos)
    {
        return str;
    }
    // Get the index of the last non-whitespace character in the string
    size_t last = str.find_last_not_of(WHITESPACE);
    return str.substr(first, (last - first + 1));
}