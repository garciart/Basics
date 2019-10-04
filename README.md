# The Basics
<h2>This is my repository of basic stuff I should remember as a software engineer.</h2>
<h3>Introduction:</h3>
<h3>Source Control:</h3>
<p>While I do use Git and GitHub, I did not use them properly when I first started. In the beginning, instead of maintaining a code history, I would only upload to GitHub when I was done coding or create separate repositories for each phase, sprint, etc., of coding.</p>
<pre>cd C:\Users\[USERNAME]\source\repos # Go to where your repositories are stored</pre>
<p>For new projects:</p>
<pre>
md GitTest # Create the project folder
cd GitTest # Go to the project folder
git init # Initialize a repository
touch .gitattributes # Add a placeholder for an attributes file
touch .gitignore # Add a placeholder for a list of files to ignore
touch README.MD # Add a placeholder for the description of the application
touch LICENSE # Add a placeholder for the appropriate license (e.g., MIT, BSD, etc.)
git add --all # Move changes to the INDEX (i.e., the staging area)
git commit -m "Initial commit." # Commit all changes to the HEAD (i.e., the final product to submit to the REMOTE MASTER repository)
git remote add origin https://github.com/[YOUR GITHUB ACCOUNT]/GitTest
git push -u origin master # Push the repository to GitHub
</pre>
<p>For existing projects:</p>
<pre>
git clone https://github.com/[YOUR GITHUB ACCOUNT]/GitTest.git # Clone the REMOTE MASTER repository into a local WORKING DIRECTORY
cd GitTest # Go into the WORKING DIRECTORY
</pre>
<p>Once your repository is set up:</p>
<pre>
git status # Get the status of the repository
git branch [USERNAME] # Create a branch, identified by your name
git branch # Make sure the branch was created
git checkout [USERNAME] # Switch to your branch
git branch # Make sure the branch was switched
</pre>
<p>Modify the code, and if you need to take a break:</p>
<pre>
cd C:\Users\[USERNAME]\source\repos\GitTest # Go back to the root of the WORKING DIRECTORY
git status # Get the status of the repo
git add --all # Move changes to the INDEX (i.e., the staging area)
</pre>
<p>Continue making changes as necessary, repeating the above commands whenever you need a break. When you are ready to commit:</p>
<pre>
git commit -m "[COMMIT MESSAGE]" # Commit all changes to the HEAD (i.e., the final product to submit to the REMOTE MASTER repository)
git push origin [USERNAME] # Push your branch to the REMOTE MASTER repository for approval
</pre>
<p>If you are using GitHub, take the following steps:</p>
<p>Open a browser and sign into GitHub:</p>
<img href="https://github.com/garciart/Basics/master/image01.png" />
<p>Select Repositories and open the repository:</p>
<img href="https://github.com/garciart/Basics/master/image02.png" />
<p>Note the information banner immediately above the list of recently pushed branches; it shows that there are two branches, which must be resolved into one branch. Open the pull request by clicking on "Compare & pull request":</p>
<img href="https://github.com/garciart/Basics/master/image03.png" />
<p>Here, acting as [USERNAME], you can review changes, add comments to the request, assign additional reviewers, etc., before creating the pull request. For now, click on "Create Pull Request":</p>
<img href="https://github.com/garciart/Basics/master/image04.png" />
<p>That would be the last step for user branch, unless there were conflicts. Next, the repository master would sign in to review changes, add comments to the request, assign additional reviewers, etc., before merging the branch pull request with the master repository. For now, since the branch has no conflicts with the base branch, click on "Merge Pull Request", followed by "Confirm merge":</p>
<img href="https://github.com/garciart/Basics/master/image05.png" />
<img href="https://github.com/garciart/Basics/master/image06.png" />
<p>Once the merge is successful, you can delete the branch:</p>
<img href="https://github.com/garciart/Basics/master/image07.png" />
<img href="https://github.com/garciart/Basics/master/image08.png" />
<p>Return to the repository's main page and you will see that there is now only one branch:</p>
<img href="https://github.com/garciart/Basics/master/image09.png" />
<p>At the terminal:</p>
<pre>
git status # Get the status of the repository
git checkout master # Switch back to the master branch
git pull # Update master branch
</pre>
<p>If the user branch will not be used again, you may delete it using the following command:</p>
<pre>
git branch -D [USERNAME] # Delete the old branch
</pre>
<p>However, you can leave the branch open and continue updating the repository as necessary.</p>
<h3>Security:</h3>
<p>if you ever get a chance to intern at NASA, especially as a developer, do it! Working with the best and brightest is a great experience and you will learn a lot. However, you will also learn about the struggle of balancing Dev-Sec-Ops. For example, in order to do localhost development, you had to have a security plan. For many developers, this was an example of government "red tape", but, truthfully, it is a sound practice.</p>
<p>Therefore, I decided to create a set of boilerplate system security plans I could pull off the shelf and modify as needed. The gold standard for government work is the <a href="https://csrc.nist.gov/publications/detail/sp/800-18/rev-1/final" title="NIST SP 800-18">NIST SP 800-18 Rev. 1, Guide for Developing Security Plans for Federal Information Systems</a>, and Appendix A contains a sample information system security plan template.  For me, the most important part is paragraph 13, Minimum Security Controls, where you explain the steps you will take to secure your system, mapping them to the controls in <a href="https://csrc.nist.gov/publications/detail/sp/800-53/rev-4/final" title="NIST SP 800-53">NIST SP 800-53 Rev. 4, Security and Privacy Controls for Federal Information Systems and Organizations</a>. I found the easiest way to accomplish this was to use <a href=" https://www.cisecurity.org/" title="Center for Internet Security">the benchmarks</a> published by the Center for Internet Security and <a href="https://www.cisecurity.org/white-papers/cis-controls-v7-1-mapping-to-nist-csf/" title="CIS Controls V7.1 Mapping to NIST CSF">map them to the NIST 800-53 controls.</a></p>
<h3>Code:</h3>
<p>Have you ever spent a couple of months on a project, coding in one language, and then having to switch to another language quickly...sometimes too quickly? Even though I know several languages well, switching back and forth between them can lead to stupid mistakes. I sometimes have "back in the saddle" issues, and I've felt pretty dumb spending half a day debugging a Python program before I realized I wrote some of the code in Java.</p>
<p>To that end, here's several programs, written in C, Java, Python, and more, that all do the same thing: implement their versions of the common reserved keywords, as well as implement other common tasks and features, such as reading command-line arguments or unit testing.</p>
<h3>Styling:</h3>
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
