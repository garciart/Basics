# Hello, World! (C++ Template)

This is a basic C++ console application, which includes some of the most common C++ keywords, functions, and methods from the C++ 14 application programming interface (API). For portability and simplicity, it uses the SQLite relational database management system (RDBMS) and demonstrates how to:

- Access a module from another module.
- Create, read, update, and delete data from a database.
- Validate numbers and formatted text, such as email addresses.
- Instantiate class objects.
- Handle and log exceptions and errors.
- Run unit tests.
- Apply styling and comments per the [Navy Research Laboratory (NRL) Radar Division's C++ Coding Standard style guide](https://apps.dtic.mil/dtic/tr/fulltext/u2/a640901.pdf).

Before starting, you must install C++ using [Microsoft C++ Build Tools](https://visualstudio.microsoft.com/visual-cpp-build-tools/). In addition, ensure the [Microsoft Unit Testing Framework for C++](https://docs.microsoft.com/en-us/visualstudio/test/writing-unit-tests-for-c-cpp?view=vs-2019) is installed. If you are using Visual Studio Code, install [C/C++ for Visual Studio Code](https://marketplace.visualstudio.com/items?itemName=ms-vscode.cpptools) as well.

This template uses a very simple directory structure:

    CPP
    |-- hello
        |-- data
            |-- Users.db
        |-- models
            |-- common_functions.cpp
            |-- database_functions.cpp
            |-- user.cpp
        |-- error_log.txt
        |-- hello.cpp
    |-- tests
        |-- common_function_test.cpp
    |-- .gitignore
    |-- LICENSE
    |-- README.MD

If you are using Visual Studio Code, to compile and link the source code from the terminal, make sure you are in the project directory (i.e., CPP) and run the following command:

    g++ hello\hello.cpp -o hello

To run from terminal, make sure you are in the project directory (i.e., CPP) and run the following command:

    .hello.exe

To run tests, make sure you are in the project directory  (i.e., CPP) and run the following commands:

    .\tests\common_function_test.exe

## To use SQLite

- Visit [https://www.sqlite.org/download.html](https://www.sqlite.org/download.html)
- Download the SQLite source code, e.g., sqlite-amalgamation-#######.zip
- Extract the source code files and rename the directory to "sqlite3"
- Move or copy the folder into the "models" directory
- Open a terminal in the "CPP\Hello\models\sqlite3" directory
- Compile the source code to create an object file using the following command (the -c flag is to compile only):

        gcc sqlite3.c -c

- Return to the project directory (i.e., CPP) and run the following command (the -I flag lets the compiler know where the sqlite3.h header file is located):

        g++ hello\hello.cpp hello\models\sqlite3\sqlite3.o -Ihello\models\sqlite3 -o hello

- Development only: To validate code snippets using dev.cpp and sqlite3, use the following command:

        g++ hello\models\dev.cpp hello\models\sqlite3\sqlite3.o -Ihello\models\sqlite3 -o dev
