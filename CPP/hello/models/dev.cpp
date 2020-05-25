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
#include "common_functions.cpp"

using namespace std;

int main()
{
    try
    {
        cout << (validateText("<script>alert()</script>") ? "True" : "False") << endl;
        cout << (validateEmail("Jose@Jose.com") ? "True" : "False") << endl;
        cout << (validateDate("2019-01-31 08:00:00") ? "True" : "False") << endl;
    }
    catch (exception &ex)
    {
        cout << ex.what() << " in dev.main()." << endl;
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}
