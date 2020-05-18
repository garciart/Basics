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

    g++ hello\hello.cpp -o hello\hello

To run from terminal, make sure you are in the project directory (i.e., CPP) and run the following command:

    .\hello\hello.exe

To run tests, make sure you are in the project directory  (i.e., CPP) and run the following commands:

    .\tests\common_function_test.exe
