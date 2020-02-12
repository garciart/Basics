# Hello, World! (Python Template)

This is a basic Python console application, which includes some of the most common Python keywords, functions, and methods from the Python Standard Library. For portability and simplicity, it uses the SQLite relational database management system (RDBMS) and demonstrates how to:

- Access a module from another module.
- Create, read, update, and delete data from a database.
- Validate numbers and formated text, such as email addresses.
- Instantiate class objects.
- Handle and log exceptions and errors.
- Run unit tests.
- Apply styling and comments per [Python Enhancement Proposal (PEP) 8 , Style Guide for Python Code](https://www.python.org/dev/peps/pep-0008/), and [PEP 257, Docstring Conventions](https://www.python.org/dev/peps/pep-0257/).

Before starting, ensure the following applications are installed:

- Python 3.6.8
- PIP 18.1
- SQLite 3.21.0 (included with Python3)
- pylint 2.4.4
- astroid 2.3.3

This template uses a very simple directory structure. Just remember to create a blank `__init__.py` file in the `Models` directory to identify it as Python package folders:

    Python
    |-- hello
        |-- data
            |-- users.db
        |-- models
            |-- __init__.py
            |-- common_functions.py
            |-- database_functions.py
            |-- user_class.py
        |-- error_log.txt
        |-- hello.py
    |-- hello_tests
        |-- tests.py
    |-- LICENSE
    |-- README.MD
    |-- requirements.txt
    |-- setup.py
