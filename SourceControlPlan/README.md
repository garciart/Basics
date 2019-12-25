# The Basics - My Source Control Plan
<h2>Introduction</h2>
<p>When I first started using Git and GitHub, I did not use them properly. Instead of maintaining a code history, I would only upload to GitHub when I was done coding or create separate repositories for each phase, sprint, etc., of coding. Now, regardeless of how small the application is, I commit on a separate branch (as I would with a development team) and I use pull requests to update the master branch.</p>
<p><strong>Note:</strong> Installing Git or creating a GitHub account are out of the scope of this document. I recommend visiting the official sites, <a href="https://git-scm.com/book/en/v2/Getting-Started-Installing-Git" title="Getting Started - Installing Git" target="_blank">Getting Started - Installing Git</a> and <a href="https://github.com/" title="Welcome to GitHub" target="_blank">GitHub</a>, for the latest and greatest directions.
<h2>The Plan</h2>
<p>If you are using GitHub, take the following steps:</p>
<p>Open a browser and sign into GitHub:</p>
<div style="text-align: center;"><img src="image01.png" style="width: 640px;" /></div>
<p>If this is a new project, create a repository on GitHub first by selecting Repositories->New. Do not check the "Initialize this repository with a README" or add a .gitignore or license; we'll do that locally to avoid a pull request:</p>
<div style="text-align: center;"><img src="image00.png" style="width: 640px;" /></div>
<p>Now, open a terminal/command prompt/powershell to create a local repository and connect it to the remote repository:</p>
<pre>
cd C:\Users\[USERNAME]\source\repos # Go to where your repositories are stored (Windows shown here)
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
<p>By the way, if your code applies to multiple platforms, I recommend making sure:</p>
<ul>
<li><em>Watch your line endings if switching between OS's!</em></li>
<li><em>Make sure you stick with either tabs or spaces!</em></li>
</ul>
<p>Git can automatically fix your line feeds using one of the following commands:</p>
<ul>
<li>git config --global core.autocrlf false # For Linux</li>
<li>git config --global core.autocrlf true # For Windows</li>
</ul>
<p>You can also set the line feeds for each project by replacing "--global" with "--local".</p>
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
<p>Select Repositories and open the repository:</p>
<div style="text-align: center;"><img src="image02.png" style="width: 640px;" /></div>
<p>Note the information banner immediately above the list of recently pushed branches; it shows that there are two branches, which must be resolved into one branch. Open the pull request by clicking on "Compare & pull request":</p>
<div style="text-align: center;"><img src="image03.png" style="width: 640px;" /></div>
<p>Here, acting as [USERNAME], you can review changes, add comments to the request, assign additional reviewers, etc., before creating the pull request. For now, click on "Create Pull Request":</p>
<div style="text-align: center;"><img src="image04.png" style="width: 640px;" /></div>
<p>That would be the last step for user branch, unless there were conflicts. Next, the repository master would sign in to review changes, add comments to the request, assign additional reviewers, etc., before merging the branch pull request with the master repository. For now, since the branch has no conflicts with the base branch, click on "Merge Pull Request", followed by "Confirm merge":</p>
<div style="text-align: center;"><img src="image05.png" style="width: 640px;" /></div>
<div style="text-align: center;"><img src="image06.png" style="width: 640px;" /></div>
<p>Once the merge is successful, you can delete the branch:</p>
<div style="text-align: center;"><img src="image07.png" style="width: 640px;" /></div>
<div style="text-align: center;"><img src="image08.png" style="width: 640px;" /></div>
<p>Return to the repository's main page and you will see that there is now only one branch:</p>
<div style="text-align: center;"><img src="image09.png" style="width: 640px;" /></div>
<p>If you make changes to the repository in GitHub, you can update the local repository by using the following command at the terminal:</p>
<pre>
git status # Get the status of the repository
git pull origin master # Combines git fetch origin and git merge origin/[USERNAME]
</pre>
<p>Or you can switch back to the master branch and pull:</p>
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
<h2>Summary</h2>
<p>This is a basic, get-you-started guide to source control. I suggest you sit down with your team and create your own version, to ensure everyone is on the same sheet of music. Good luck!</p>
