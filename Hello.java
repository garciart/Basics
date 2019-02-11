/**
 * Implementation of all 32 reserved keywords in C programming, as well as other common tasks and features, in various languages:
 * 
 * auto, break, case, char, const, continue, default, do,
 * double, else, enum, extern, float, for, goto, if,
 * int, long, register, return, short, signed, sizeof, static,
 * struct, switch, typedef, union, unsigned, void, volatile, and while
 * 
 * Styling using the Google Java Style Guide at https://google.github.io/styleguide/javaguide.html
 * 
 * @author  Rob Garcia
 * @see     Kernighan, B. W., & Ritchie, D. (1988). A.2.4 Keywords. In C Programming Language (2nd ed.). Upper Saddle River, NJ: Prentice Hall.
 * @version 1.0
 * @since   2019-02-10
 */

import java.util.Scanner;

public class Hello {

    public static int main(String[] args) {
        // Unlike C/C++, Java does not include the program name in its command-line arguments, so args[0] does not exist
        final String PROGRAM_NAME = (args.length == 0 ? "Hello" : args[0]);
        String userName = new String();
        // var, which is the equivalent of C/C++'s auto type inference, is only supported in Java 10+
        var userNameLength = 0;
        System.out.println("hello, world");
        System.out.println("My name is " + PROGRAM_NAME + " and I am written in Java.");
        System.out.print("What is your name: ");
        // Use try-with-resources to ensure scanner is properly closed
        try(Scanner scanner = new Scanner(System.in)) {
            userName = scanner.nextLine();
            System.out.println("Hello " + userName + "!");
            userNameLength = userName.length();
            System.out.println("Your name is " + userNameLength + " characters long!");
        };
        return 0;
    }
}