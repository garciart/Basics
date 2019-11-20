# The Basics - My Styling Guide Reference
<p>Having worked with ASP.NET for so long, I tended to camelCase everything, even if I was programming in C++ or Python. Of course, this is bad form, since the code </p>
<p>So, here is my down and dirty Naming Convention Cheat Sheet:</p>
<p>First, the case names I use are camelCase, CONSTANT_CASE, kebab-case, PascalCase, and snake_case.</p>
<p>Second, here are the general capitalization rules for the languages I use:</p>
<table style="border-collapse: collapse; border: 1px solid;">
<thead>
<tr>
<th></th>
<th>C++</th>
<th>C#</th>
<th>Java</th>
<th>PHP</th>
<th>Python</th>
<th>JavaScript</th>
</tr>
</thead>
<tbody>
<tr>
<td>Extensions</td>
<td>file_name.cpp</td>
<td>FileName.cs</td>
<td>FileName.java</td>
<td>FileName.php</td>
<td>file_name.py</td>
<td>file-name.js</td>
</tr>
<tr>
<td>Projects</td>
<td>ProjectName</td>
<td>ProjectName</td>
<td>ProjectName</td>
<td>ProjectName</td>
<td>ProjectName</td>
<td>ProjectName</td>
</tr>
<tr>
<td>Folders</td>
<td>folder_name</td>
<td>FolderName</td>
<td>foldername</td>
<td>FolderName</td>
<td>folder_name</td>
<td>folder-name</td>
</tr>
<tr>
<td>Files / Modules</td>
<td>file_name</td>
<td>FileName</td>
<td>FileName</td>
<td>FileName</td>
<td>module_name</td>
<td>file-name</td>
</tr>
<tr>
<td>Namespaces / Packages</td>
<td>namespace_name</td>
<td>NamespaceName</td>
<td>com.example.packagename</td>
<td>NamespaceName</td>
<td>package_name</td>
<td>com.example.packageName</td>
</tr>
<tr>
<td>Classes</td>
<td>ClassName</td>
<td>ClassName</td>
<td>ClassName</td>
<td>ClassName</td>
<td>ClassName</td>
<td>ClassName</td>
</tr>
<tr>
<td>Functions / Methods</td>
<td>FunctionName</td>
<td>FunctionName</td>
<td>methodName</td>
<td>methodName</td>
<td>function_name
method_name</td>
<td>methodName</td>
</tr>
<tr>
<td>Constants</td>
<td>CONSTANT_NAME</td>
<td>ConstantName</td>
<td>CONSTANT_NAME</td>
<td>CONSTANT_NAME</td>
<td>CONSTANT_NAME</td>
<td>CONSTANT_NAME</td>
</tr>
<tr>
<td>Variables / Parameters</td>
<td>variable_name</td>
<td>variableName</td>
<td>variableName</td>
<td>$variableName</td>
<td>variable_name</td>
<td>variableName</td>
</tr>
</tbody>
</table>
<p>For Structured Query Language (SQL):</p>
<table style="border-collapse: collapse; border: 1px solid;">
<thead>
<tr>
<th></th>
<th>MySQL / MariaDB</th>
<th>SQLServer</th>
</tr>
</thead>
<tbody>
<tr>
<td>Database</td>
<td>Database_Name</td>
<td>Database_Name</td>
</tr>
<tr>
<td>Tables</td>
<td>table_name</td>
<td>table_name</td>
</tr>
<tr>
<td>Fields</td>
<td>field_name</td>
<td>field_name</td>
</tr>
<tr>
<td>Aliases (append number)</td>
<td>a1, a2, etc.</td>
<td>a1, a2, etc.</td>
</tr>
<tr>
<td>Stored Procedures (must have a verb)</td>
<td>create_record, update_record, etc.</td>
<td>create_record, update_record, etc.</td>
</tr>
<tr>
<td>Indexes</td>
<td>index_idx</td>
<td>index_idx</td>
</tr>
</tbody>
</table>
<p>However, the best practice is to review an actual style guide and decide on the styling rules for your application, whether you are coding by yourself or with a team. Here is a list of corporate style guides you can use:</p>
<p>C++ - Google Style Guide (with Visual Studio extensions): <a href="https://google.github.io/styleguide/cppguide.html" title="Google Style Guide">https://google.github.io/styleguide/cppguide.html</a></p>
<p>C# - Microsoft Framework Design Guidelines: <a href="https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions" title="Microsoft Framework Design Guidelines">https://docs.microsoft.com/en-us/dotnet/standard/design-guidelines/capitalization-conventions</a></p>
<p>Java – Google Style Guide: <a href="https://google.github.io/styleguide/javaguide.html" title="Google Style Guide">https://google.github.io/styleguide/javaguide.html</a></p>
<p>PHP - PHP Standard Recommendation (PSR): <a href="https://www.php-fig.org/psr/" title="PHP Standard Recommendation (PSR)">https://www.php-fig.org/psr/</a></p>
<p>Python - Google Style Guide: <a href="https://google.github.io/styleguide/pyguide.html" title="Google Style Guide">https://google.github.io/styleguide/pyguide.html</a></p>
<p>JavaScript – Google Style Guide: <a href="https://google.github.io/styleguide/jsguide.html" title="Google Style Guide">https://google.github.io/styleguide/jsguide.html</a></p>
<p>MySQL - MySQL Internals Manual: <a href="https://dev.mysql.com/doc/internals/en/coding-style.html" title="MySQL Internals Manual">https://dev.mysql.com/doc/internals/en/coding-style.html</a></p>
<p>SQL Server - Transact-SQL Syntax Conventions: <a href="https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017" title="Transact-SQL Syntax Conventions">https://docs.microsoft.com/en-us/sql/t-sql/language-elements/transact-sql-syntax-conventions-transact-sql?view=sql-server-2017</a></p>
