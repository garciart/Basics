/**
 * Hello World in C++ with database integration.
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

/* ========== Include files and other header files ========== */

// #include "models/common_functions.cpp"
#include "models/common_functions.cpp"
#include <iostream>
#include <string>

using namespace std;

/* ========== Constants, #define, and enum statements ========== */

/* ========== Public Datatypes ========== */

/* ========== Public Function prototypes ========== */

int main(int argc, char **argv)
{
    cout << "hello, world" << endl;
    if (__cplusplus == 201703L)
        cout << "C++17\n";
    else if (__cplusplus == 201402L)
        cout << "C++14\n";
    else if (__cplusplus == 201103L)
        cout << "C++11\n";
    else if (__cplusplus == 199711L)
        cout << "C++98\n";
    else
        cout << "pre-standard C++\n";

    cout << "Root Directory: " << ROOT_DIR << endl;
    cout << "Model Directory: " << MODEL_DIR << endl;

    cout << "User ID 3 is " << (validateUserID(3) ? "Good!" : "Bad.") << endl;
    cout << "User ID -3 is " <<  (validateUserID(-3) ? "Good!" : "Bad.") << endl;


    return EXIT_SUCCESS;
}