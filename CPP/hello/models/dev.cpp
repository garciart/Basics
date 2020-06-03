/**
 * @file dev.cpp
 * @author your name (you@domain.com)
 * @brief 
 * @version 0.1
 * @date 2020-05-17
 * 
 * @copyright Copyright (c) 2020
 * 
 */

#include <iomanip>
#include <iostream>
#include <string>
#include "common_functions.cpp"
#include "database_functions.cpp"
#include <sqlite3.h>

using namespace std;

int get_cpp_version();
int validate_input();
int trim_test();
int list_directories();
int db_test();
int test_error();

int get_cpp_version()
{
    try
    {
        if (__cplusplus == 201703L)
            cout << "C++ 17" << endl;
        else if (__cplusplus == 201402L)
            cout << "C++ 14" << endl;
        else if (__cplusplus == 201103L)
            cout << "C++ 11" << endl;
        else if (__cplusplus == 199711L)
            cout << "C++ 98" << endl;
        else
            cout << "Pre-standard C++" << endl;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.get_cpp_version() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int validate_input()
{
    try
    {
        cout << "User ID 3 is " << (validateUserID(3) ? "Good!" : "Bad.") << endl;
        cout << "User ID -3 is " << (validateUserID(-3) ? "Good!" : "Bad.") << endl;
        cout << "Text \"Hello, World!\" is " << (validateText("Hello, World!") ? "Good" : "Bad.") << endl;
        cout << "Text \"<script>alert()</script>\" is " << (validateText("<script>alert()</script>") ? "Good!" : "Bad.") << endl;
        cout << "Email \"Jose@Jose.com\" is " << (validateEmail("Jose@Jose.com") ? "Good!" : "Bad.") << endl;
        cout << "Email \"Jose@Jose\" is " << (validateEmail("Jose@Jose.com") ? "Good!" : "Bad.") << endl;
        cout << "Date \"2019-01-31 08:00:00\" is " << (validateDate("2019-01-31 08:00:00") ? "Good!" : "Bad.") << endl;
        cout << "Date \"2019-01-31 8:00:00 PM\" is " << (validateDate("2019-01-31 8:00:00 PM") ? "Good!" : "Bad.") << endl;
        cout << "Date \"2019-01-31 55:00:00\" is " << (validateDate("2019-01-31 25:00:00") ? "Good!" : "Bad.") << endl;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.validate_input() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int trim_test()
{
    try
    {
        string test_trim = "   What\'s up, yo?   ";
        cout << test_trim << "<-- This is the end." << endl;
        cout << trim(test_trim) << "<-- This is the end." << endl;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.trim_test() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int list_directories()
{
    try
    {
        cout << "Root Directory: " << ROOT_DIR << endl;
        cout << "Model Directory: " << MODEL_DIR << endl;
        DatabaseFunctions db;
        cout << "Database Directory: " << db.PATH_TO_SQLITE_DB << endl;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.list_directories() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int db_test()
{
    try
    {
        DatabaseFunctions db;
        bool test = db.test();
        cout << test << endl;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.db_test() function.");
        if (DISPLAY_ERRORS)
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int test_error()
{
    try
    {
        vector<int> v(5);
        int answer = v.at(10);
        return answer;
    }
    catch (const exception &ex)
    {
        logError((string)ex.what() + " in dev.test_error() function.");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}

int main()
{
    try
    {
        /*
        // Buffer overflow
        string s = "Bob" + 20;
        cout << s << endl;
        */
        get_cpp_version();
        validate_input();
        trim_test();
        list_directories();
        db_test();
        test_error();
    }
    catch (exception &ex)
    {
        logError((string)ex.what() + " in dev.main().");
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}
