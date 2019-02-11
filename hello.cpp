/**
 * Implementation of all 32 reserved keywords in C programming, as well as other common tasks and features, in various languages:
 * 
 * auto, break, case, char, const, continue, default, do,
 * double, else, enum, extern, float, for, goto, if,
 * int, long, register, return, short, signed, sizeof, static,
 * struct, switch, typedef, union, unsigned, void, volatile, and while
 * 
 * Styling using the Google Java Style Guide at https://google.github.io/styleguide/cppguide.html
 * 
 * @author  Rob Garcia
 * @see     Kernighan, B. W., & Ritchie, D. (1988). A.2.4 Keywords. In C Programming Language (2nd ed.). Upper Saddle River, NJ: Prentice Hall.
 * @version 1.0
 * @since   2019-02-10
 */

#include <iostream>
#include <string>

/**
 * To identify what functions are used by the standard namespace, we will preface each one with "std::",
 * instead of implementing the preprocessor directive "using namespace std;"
 */

int main(int argc, char** argv) {
    const char *kProgramName = (argc >= 0 ? argv[0] : "Hello");
    std::string userName;
    auto userNameLength = 0;
    std::cout << "hello, world" << std::endl;
    std::cout << "My name is " << kProgramName << " and I am written in C++." << std::endl;
    std::cout << "What is your name: ";
    std::getline(std::cin, userName);
    std::cout << "Hello " << userName << "!" << std::endl;
    userNameLength = userName.length();
    std::cout << "Your name is " << userNameLength << " characters long!" << std::endl;
    return EXIT_SUCCESS;
}