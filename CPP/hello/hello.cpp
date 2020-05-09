/*
 * Hello World in C++ with database integration.
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

/* ========== Include files and other header files ========== */

#include <iostream>

/* ========== Constants, #define, and enum statements ========== */

/* ========== Public Datatypes ========== */

/* ========== Public Function prototypes ========== */

int main(int argc, char **argv)
{
    /**
     * To identify what functions are used by the standard namespace, we will preface each one with "std::",
     * instead of implementing the preprocessor directive "using namespace std;"
     */
    std::cout << "hello, world" << std::endl;
    if (__cplusplus == 201703L) std::cout << "C++17\n";
    else if (__cplusplus == 201402L) std::cout << "C++14\n";
    else if (__cplusplus == 201103L) std::cout << "C++11\n";
    else if (__cplusplus == 199711L) std::cout << "C++98\n";
    else std::cout << "pre-standard C++\n";
    return EXIT_SUCCESS;
}