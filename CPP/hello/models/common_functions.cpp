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
#define get_current_dir _getcwd
#define FILE_SEPARATOR "\\"
#else
#include <unistd.h>
#define get_current_dir getcwd
#define FILE_SEPARATOR "/"
#endif

#include <iostream>
#include <ctime>
#include <fstream>
#include <iomanip>
#include <regex>
#include <sstream>
// #include <string>

using namespace std;

#ifndef COMMON_FUNCTIONS_CPP
#define COMMON_FUNCTIONS_CPP
string get_root_dir();
void log_error(const string &error_text);
bool validate_user_id(const long &user_id);
bool validate_text(const string &text);
bool validate_email(const string &email);
bool validate_date(const string &date);
string trim(string str);

/**
 * @brief Set the application's root directory.
 */
const string ROOT_DIR = get_root_dir();

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
string get_root_dir()
{
    string current_dir("");
    try
    {
        char buffer[FILENAME_MAX];
        get_current_dir(buffer, FILENAME_MAX);
        current_dir = buffer;
    }
    catch (exception &ex)
    {
        log_error((string)ex.what() + " in common_functions.get_root_dir() function.");
    }
    return current_dir;
}

/**
 * @brief Reformats error and exception details and records them in plain
 * text in the error_log file.
 * 
 * @param error_text A reference to the error or exception's details.
 */
void log_error(const string &error_text)
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

    ofstream error_file;
    error_file.open("ErrorLog.txt", ios_base::app);
    error_file << ss.str() << ": " << error_text << endl;
    error_file.close();
    if (DISPLAY_ERRORS)
    {
        cout << error_text << endl;
    }
}

/**
 * @brief Validate User ID.
 * 
 * @param user_id A reference to the User ID that will be entered in the database.
 * @return true The User ID is an integer greater than 0.
 * @return false The User ID is an integer less than or equal to 0.
 */
inline bool validate_user_id(const long &user_id)
{
    return user_id > 0;
}

/**
 * @brief Validate text input.
 * 
 * @param text A reference to the text that will be entered into the database.
 * @return true The text contains valid RFC 3986 characters.
 * @return false The text contains characters not in compliance with RFC 3986.
 */
inline bool validate_text(const string &text)
{
    regex pattern("^[A-Za-z0-9\\s\\-._~:\\/?#\\[\\]@!$&'()*+,;=]*$");
    return (trim(text) == "" || !regex_match(text, pattern)) ? false : true;
}

/**
 * @brief Validate email address.
 * 
 * @param email A reference to the email address that will be entered into the database.
 * @return true The email contains valid RFC 3986 characters.
 * @return false The email contains characters not in compliance with RFC 3986.
 */
inline bool validate_email(const string &email)
{
    regex pattern("^[A-Za-z0-9\\-._~\\/?#!$&'%*+=`{|}^]+(@[a-zA-Z0-9-.]+)(.[a-zA-Z0-9]{2,}){2,}$");
    return (trim(email) == "" || !regex_match(email, pattern)) ? false : true;
}

/**
 * @brief Validate date format.
 * 
 * @param date A reference to the date that will be entered into the database.
 * @return true The date format is well formed with valid characters.
 * @return false The date format is incorrect or contains invalid characters.
 */
inline bool validate_date(const string &date)
{
    // regex pattern ("^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$");
    regex pattern("^([0-9]){4}-([0-1][0-9])-([0-3][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$");
    return (trim(date) == "" || !regex_match(date, pattern) || date.length() != 19) ? false : true;
}

/**
 * @brief Removes leading and tailing whitespace.
 * 
 * @param str The string to trim.
 * @return string The trimmed string.
 */
string trim(string str)
{
    const string Whitespace = " \n\r\t\f\v";
    // Get the index of the first non-whitespace character in the string
    size_t first = str.find_first_not_of(Whitespace);
    // If the string is searched and no whitespace is found, return the string
    if (first == string::npos)
    {
        return str;
    }
    // Get the index of the last non-whitespace character in the string
    size_t last = str.find_last_not_of(Whitespace);
    return str.substr(first, (last - first + 1));
}
#endif