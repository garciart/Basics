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

#include <stdio.h>
#include <string.h> // required for strcspn

int main(int argc, char *argv[]) {
    const char *kProgramName = (argc >= 0 ? argv[0] : "Hello");
    char userName[40] = {'\0'};
    auto bufferLength = sizeof(userName);
    printf("hello, world\n");
    printf("My name is %s and I am written in C.\n", kProgramName);
    printf("What is your name: ");
    fgets(userName, bufferLength, stdin);
    userName[strcspn(userName, "\n")] = 0;
    printf("Hello %s!\n", userName);
    auto userNameLength = strnlen(userName, bufferLength);
    printf("Your name is %d characters long!\n", userNameLength);
    return 0;
}