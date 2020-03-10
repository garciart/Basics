# Hello, World! (Java Template)

This is a basic Java console application, which includes some of the most common Java keywords, functions, and methods from the Java Platform, Standard Edition (Java SE) application programming interface (API). For portability and simplicity, it uses the SQLite relational database management system (RDBMS) and demonstrates how to:

- Access a module from another module.
- Create, read, update, and delete data from a database.
- Validate numbers and formated text, such as email addresses.
- Instantiate class objects.
- Handle and log exceptions and errors.
- Run unit tests.
- Apply styling and comments per the [Google Java Style Guide](https://google.github.io/styleguide/javaguide.html) and the [Code Conventions for the Java Programming Language (Oracle: Deprecated)](https://www.oracle.com/technetwork/java/javase/documentation/codeconvtoc-136057.html).

Before starting, ensure the following applications are installed:

- Java Runtime Environment (JRE) 1.8.0_241
- Java Development Kit (JDK) 1.8.0_212
- SQLite Java Database Connectivity (JDBC) API 3.30.1
- JUnit 4.13
- Hamcrest Core 1.3.jar

This template uses a very simple directory structure that can be incorporated into Maven or Gradle:

    Java
    |-- hello
        |-- data
            |-- Users.db
        |-- models
            |-- CommonFunctions.java
            |-- DatabaseFunctions.java
            |-- User.java
        |-- ErrorLog.txt
        |-- Hello.java
    |-- lib
        |-- hamcrest-core-1.3.jar
        |-- junit-4.13.jar
        |-- sqlite-jdbc-3.30.1.jar
    |-- tests
        |-- Tests.java
    |-- LICENSE
    |-- README.MD

To compile the file, make sure you are in the project directory (i.e., Java) and run the following command:

    javac -cp ";lib/*" hello\Hello.java

To run from terminal, make sure you are in the project directory (i.e., Java) and run the following command:

    java -classpath ";lib/*" hello.Hello

or

    java -cp ";lib/*" hello.Hello

To run unit tests and avoid "error: Class names, 'Tests', are only accepted if annotation processing is explicitly requested", make sure you are in the project directory (i.e., Java) and run the following commands:

    javac -cp ";hello/*;lib/*;" tests\CommonFunctionsTest.java
    java -cp ";hello/*;lib/*" org.junit.runner.JUnitCore tests.CommonFunctionsTest
