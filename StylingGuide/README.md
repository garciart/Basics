# The Basics - My Styling Guide Reference

I never gave much thought to coding styles until I started to work with other programmers. For example, while working on a Java project, one of the programmers whose main language was Python, would use underscores (i.e., snake_case) when naming classes, methods, etc. I, whose go-to language at the time was C#, would use PascalCase or camelCase for the same thing, while another student, whose main language was a version of SQL, would only use uppercase or lowercase to name things.

It really wasn't a problem during development, since we all could recognize the purpose of each element of code, but since C#'s convention was closest to Java's, I cleaned up the code
  Having worked with ASP.NET for so long, I tended to camelCase everything, even if I was programming in C++ or Python. Of course, this is bad form, since the code

So, here is my down and dirty Naming Convention Cheat Sheet:

First, the case names I use are camelCase, CONSTANT_CASE, kebab-case, PascalCase, and snake_case.

Second, here are the general capitalization rules for the languages I use:

|            | C++           | C#          | Java          | PHP          | Python       | JavaScript   |
---------------------------------------------------------------------------------------------------------
| Extensions | file_name.cpp | FileName.cs | FileName.java | FileName.php | file_name.py | file-name.js |
---------------------------------------------------------------------------------------------------------
| Projects   | ProjectName   | ProjectName | ProjectName   | ProjectName  | ProjectName  | ProjectName  |
---------------------------------------------------------------------------------------------------------
| Folders    | folder_name   | FolderName  | foldername    | FolderName   | folder_name  | folder-name  |
---------------------------------------------------------------------------------------------------------
| Files      | file_name     | FileName    | FileName      | FileName     | module_name  | file-name    |
---------------------------------------------------------------------------------------------------------
| Modules    | file_name     | FileName    | FileName      | FileName     | module_name  | file-name    |
---------------------------------------------------------------------------------------------------------
| Namespaces | namespace_name | NamespaceName | com.example.packagename | NamespaceName | package_name | com.example.packageName |
---------------------------------------------------------------------------------------------------------
| Packages   | namespace_name | NamespaceName | com.example.packagename | NamespaceName | package_name | com.example.packageName |
---------------------------------------------------------------------------------------------------------
| Classes    | ClassName     | ClassName   | ClassName     | ClassName    | ClassName    | ClassName    |
---------------------------------------------------------------------------------------------------------
| Functions  | FunctionName  | FunctionName | methodName | methodName | function_name
method_name | methodName |
---------------------------------------------------------------------------------------------------------
| Methods    | FunctionName | FunctionName | methodName | methodName | function_name
method_name | methodName |
---------------------------------------------------------------------------------------------------------
| Constants  | CONSTANT_NAME | ConstantName | CONSTANT_NAME | CONSTANT_NAME | CONSTANT_NAME | CONSTANT_NAME |
---------------------------------------------------------------------------------------------------------
| Variables  | variable_name | variableName | variableName | $variableName | variable_name | variableName |
---------------------------------------------------------------------------------------------------------
| Parameters | variable_name | variableName | variableName | $variableName | variable_name | variableName |
---------------------------------------------------------------------------------------------------------

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
Parameters



For Structured Query Language (SQL):

<table style="border-collapse: collapse; border: 1px solid;">
<thead>
<tr>
<th> | MySQL / MariaDB | SQLServer</th>
</tr>
</thead>
<tbody>
<tr>
| Database | Database_Name | Database_Name |
------------------------------
| Tables | Table_Name<br>(singular) | table_name |
------------------------------
| Fields | Field_Name | field_name |
------------------------------
| Aliases (append number) | a1, a2, etc. | a1, a2, etc. |
------------------------------
| Stored Procedures (must have a verb) | create_record, update_record, etc. | create_record, update_record, etc. |
------------------------------
| Indexes | index_idx | index_idx |
</tr>
</tbody>
</table>
### Foreign Key Naming:</h3>
<p>FK_[Foreign_Key_Table]_[Primary_Key_Table]_[Field_Name]</p>
<p>FK_[Child_Key_Table]_[Parent_Key_Table]_[Field_Name]</p>
<p>FK_[Referencing_Table]_[Referenced_Table]_[Referencing_Field_Name]</p>
<hr>
<table>
<tr>
<th>SQLite</th>
------------------------------
| NULL |
------------------------------
| INTEGER |
------------------------------
| REAL |
------------------------------
| TEXT |
------------------------------
| BLOB |
</tr>
</table>
<hr>
<p>However, the best practice is to review an actual style guide and decide on the styling rules for your application, whether you are coding by yourself or with a team. Here is a list of corporate style guides you can use:</p>
<p>C++ - Google Style Guide (with Visual Studio extensions): <a href="https://google.github.io/styleguide/cppguide.html" title="Google Style Guide">https://google.github.io/styleguide/cppguide.html</a></p>
<p>C# - Microsoft Framework Design Guidelines: <a href="https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions" title="Microsoft Framework Design Guidelines">https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions</a></p>
<p>Java – Google Style Guide: <a href="https://google.github.io/styleguide/javaguide.html" title="Google Style Guide">https://google.github.io/styleguide/javaguide.html</a></p>
<p>PHP - PHP Standard Recommendation (PSR): <a href="https://www.php-fig.org/psr/" title="PHP Standard Recommendation (PSR)">https://www.php-fig.org/psr/</a></p>
<p>Python - Google Style Guide: <a href="https://google.github.io/styleguide/pyguide.html" title="Google Style Guide">https://google.github.io/styleguide/pyguide.html</a></p>
<p>JavaScript – Google Style Guide: <a href="https://google.github.io/styleguide/jsguide.html" title="Google Style Guide">https://google.github.io/styleguide/jsguide.html</a></p>
<p>MySQL - MySQL Internals Manual: <a href="https://dev.mysql.com/doc/internals/en/coding-style.html" title="MySQL Internals Manual">https://dev.mysql.com/doc/internals/en/coding-style.html</a></p>
<p>SQL Server - Transact-SQL Syntax Conventions: <a href="https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017" title="Transact-SQL Syntax Conventions">https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017</a></p>