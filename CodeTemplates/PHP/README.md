# Hello, World! (PHP Template)

This is a basic PHP console application, which includes some of the most common PHP keywords, functions, and methods from the Python Standard Library. For portability and simplicity, it uses the SQLite relational database management system (RDBMS) and demonstrates how to:

- Access a module from another module.
- Create, read, update, and delete data from a database.
- Validate numbers and formated text, such as email addresses.
- Instantiate class objects.
- Handle and log exceptions and errors.
- Run unit tests.
- Apply styling and comments per [PSR-1: Basic Coding Standard](https://www.php-fig.org/psr/psr-1/), [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/), and the [PEAR Manual: Coding Standards](https://pear.php.net/manual/en/standards.php).

Before starting, ensure the following applications are installed:

- PHP 7.3.12
- SQLite 3.28.0
- Composer 1.9.2
- PHP_CodeSniffer 3.5.3 (includes phpcs and phpcbf)

You can use Composer to install PHP_CodeSniffer:

    composer require --dev squizlabs/php_codesniffer

This template uses a very simple directory structure:

    PHP
    |-- Hello
        |-- Data
            |-- Users.db
        |-- Models
            |-- CommonFunctions.php
            |-- DatabaseFunctions.php
            |-- User.class.php
        |-- ErrorLog.txt
        |-- Hello.php
    |-- Hello.tests
        |-- Tests.php
    |-- LICENSE
    |-- README.MD
