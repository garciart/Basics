# The Basics - My Styling Guide Reference

I never paid attention to coding styles until I started to work with other programmers. I usually just followed the conventions in the book I was reading; the tutorial I was using; or class I was taking. When working with others, though, you should be on the same page. For example, while working on a Java project, the Python programers would mostly use underscores (i.e., snake_case) when naming files, while others would use to PascalCase or camelCase.

The good news is that most programmers can recognize a class, property, etc., for what it is, regardless of the case. However, it makes for ugly code and problems during refactoring (e.g., firstName, first_name, FirstName, etc.)

So, to mitigate that in my own repos, here is my down and dirty Naming Convention Cheat Sheet:

- First, the case names I use are:
  - **camelCase**
  - **CONSTANT_CASE**
  - **kebab-case**
  - **PascalCase**
  - **snake_case**
- Second, the definitions of coding elements I use are:
  - Project (All) - A project is a structured set of files and data that, together, produce a product or service, such as a web site or an application (e.g., the Basics repo is a project, etc.).
  - Folders (All) - A folder is a repository of files and data within a project, usually used for organization (e.g., CodingTemplates is a folder within the Basics project, etc.).
  - Files (All) - A file is a repository of code or data used by the project to produce a product or service (i.e., Hello.php, user.db, readme01.png, etc., are all files).
  - Modules (Python) - A module is a reusable set of functions and variables.
  - Extensions
  - Comments
  - Namespaces
  - Packages (Python) - A package is a collection of reusable modules and sub-packages.
  - Classes
  - Functions
  - Methods
  - Variables
  - Constants
  - Parameters - A variable declared in a function or method definition which receives argument values.
  - Arguments -The value that gets passed to a function or method through a call to the function or method.
- Third, the general capitalization rules I use for different languages are:

|                                         | C++            | C#            | Java                    | PHP            | Python         | JavaScript              |
|-----------------------------------------|----------------|---------------|-------------------------|----------------|----------------|-------------------------|
| Projects                                | ProjectName    | ProjectName   | ProjectName             | ProjectName    | ProjectName    | ProjectName             |
| Folders                                 | folder_name    | FolderName    | foldername              | FolderName     | folder_name    | folder-name             |
| Filenames                               | file_name.cpp  | FileName.cs   | FileName.java           | FileName.php   | module_name.py | file-name.js            |
| Namespaces &<br>Packages                | namespace_name | NamespaceName | com.example.packagename | NamespaceName  | package_name   | com.example.packageName |
| Classes                                 | ClassName      | ClassName     | ClassName               | ClassName      | ClassName      | ClassName               |
| Functions &<br>Methods                  | FunctionName   | FunctionName  | methodName              | functionName   | function_name  | method_name             |
| Constants                               | CONSTANT_NAME  | ConstantName  | CONSTANT_NAME           | CONSTANT_NAME  | CONSTANT_NAME  | CONSTANT_NAME           |
| Variables,<br>Arguments &<br>Parameters | variable_name  | variableName  | variableName            | $variableName  | variable_name  | variableName            |




Projects
Folders
Files
Modules
Extensions
Comments
Namespaces
Packages
Classes
Functions
Methods
Variables
Constants
Parameters - A variable declared in a function or method definition which receives argument values.
Arguments -The value that gets passed to a function or method through a call to the function or method.



For Structured Query Language (SQL):

| MySQL / MariaDB | SQLServer |
|----------|---------------|---------------|
| Database | Database_Name | Database_Name |
| Tables | Table_Name<br>(singular) | table_name |
| Fields | Field_Name | field_name |
| Aliases (append number) | a1, a2, etc. | a1, a2, etc. |
| Stored Procedures (must have a verb) | create_record, update_record, etc. | create_record, update_record, etc. |
| Indexes | index_idx | index_idx |

## Foreign Key Naming

FK_[Foreign_Key_Table]_[Primary_Key_Table]_[Field_Name]

FK_[Child_Key_Table]_[Parent_Key_Table]_[Field_Name]

FK_[Referencing_Table]_[Referenced_Table]_[Referencing_Field_Name]

|SQLite|MySQL / MariaDB|SQL Server|
|---|---|---|
| NULL |   |   |
| INTEGER |   |   |
| REAL |   |   |
| TEXT |   |   |
| BLOB |   |   |

Quotes = Single quotes when there is no text manipulation (e.g., 'My name is Rob', etc.) and double quotes when ther is text manipulation (e.g., "My name is {user->getName()}.\n").

However, the best practice is to review an actual style guide and decide on the styling rules for your application, whether you are coding by yourself or with a team. Here is a list of corporate style guides you can use:

- C++ - Google Style Guide (with Visual Studio extensions): [https://google.github.io/styleguide/cppguide.html](https://google.github.io/styleguide/cppguide.html)
- C# - Microsoft Framework Design Guidelines: [https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions](https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions)
- Java – Google Style Guide: [https://google.github.io/styleguide/javaguide.html](https://google.github.io/styleguide/javaguide.html)
- PHP - PHP Standard Recommendation (PSR): [https://www.php-fig.org/psr/](https://www.php-fig.org/psr/)
- Python - Google Style Guide: [https://google.github.io/styleguide/pyguide.html](https://google.github.io/styleguide/pyguide.html)
- JavaScript – Google Style Guide: [https://google.github.io/styleguide/jsguide.html](https://google.github.io/styleguide/jsguide.html)
- MySQL - MySQL Internals Manual: [https://dev.mysql.com/doc/internals/en/coding-style.html](https://dev.mysql.com/doc/internals/en/coding-style.html)
- SQL Server - Transact-SQL Syntax Conventions: [https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017](https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017)