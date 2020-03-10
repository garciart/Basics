/*
 * Hello World in C# with database integration.
 *
 * .NET Core version used: 3.1.0
 * C# version used: 8.0
 * SQLite version used: 3.30.1
 *
 * Styling guide: .NET Core Engineering guidelines
 *     (https://github.com/dotnet/aspnetcore/wiki/Engineering-guidelines#coding-guidelines) and
 *     C# Programming Guide
 *     (https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/inside-a-program/coding-conventions)
 *
 * @category  Basics
 * @package   CSharp
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

using System;
using System.Collections.Generic;
using System.Data;
using Hello.Models;

namespace Hello
{
    /// <summary>
    /// Hello World in C# with database integration.
    /// </summary>
    public class Program
    {
        private static void HelloUsers()
        {
            try
            {
                // throw new Exception("Test...");
                Console.WriteLine("Verifying database exists...");
                if (DatabaseFunctions.DatabaseExists())
                {
                    Console.WriteLine("Database is good to go!\n");
                    // Task 1: Connect and retrieve information from the database
                    DataTable result = DatabaseFunctions.GetAllUsers();

                    if (result != null)
                    {
                        List<User> listOfUsers = new List<User>();

                        foreach (DataRow row in result.Rows)
                        {
                            listOfUsers.Add(new User(long.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString()));
                        }

                        Console.WriteLine(string.Format("Number of users in the database: {0}", listOfUsers.Count));
                        Console.WriteLine(string.Format("The first user is {0}.\n", listOfUsers[0].FirstName));
                        foreach (User user in listOfUsers)
                        {
                            Console.WriteLine("Hello, {0} {1}! You are #{2}, created on {3}, and you are a(n) {4}", user.FirstName, user.LastName, listOfUsers.IndexOf(user) + 1, user.CreationDate, user.Comment);
                        }
                    }
                    else
                    {
                        Console.WriteLine("No records were found.");
                    }
                    result.Dispose();

                    Console.WriteLine();

                    // Task 2: Add, update, and delete a new user
                    User thanos = null;

                    if (DatabaseFunctions.UserExists("thanos@rgprogramming.com"))
                    {
                        Console.WriteLine("Thanos, you are already in the database!\n");
                        result = DatabaseFunctions.GetUserByEmail("thanos@rgprogramming.com");
                        if (result != null)
                        {
                            DataRow row = result.Rows[0];
                            thanos = new User(long.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString());
                        }
                        else
                        {
                            throw new Exception("Cannot retrieve user data!");
                        }
                        result.Dispose();
                    }
                    else
                    {
                        Console.WriteLine("Thanos, you are not in the database!\n");
                        long userID = DatabaseFunctions.CreateUser("Thanos", "The Mad Titan", "thanos@rgprogramming.com", 100.0f, "Unbalanced user.");
                        if (userID == 0)
                        {
                            throw new Exception("Cannot create user!");
                        }
                        else
                        {
                            result = DatabaseFunctions.GetUserByUserID(userID);
                            if (result != null)
                            {
                                DataRow row = result.Rows[0];
                                thanos = new User(long.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString());
                                Console.WriteLine("Welcome {0} {1}! You were created on {2} and you are a(n) {3}\n", thanos.FirstName, thanos.LastName, thanos.CreationDate, thanos.Comment);
                            }
                            else
                            {
                                throw new Exception("Cannot retrieve user data!");
                            }
                            result.Dispose();
                        }
                    }

                    if (thanos.Comment.Equals("Unbalanced user."))
                    {
                        Console.WriteLine("Uh oh, Thanos, you are unbalanced! Let's fix that!\n");
                        thanos.Comment = "Balanced user.";
                        if (DatabaseFunctions.UpdateUser(thanos.UserID, thanos.FirstName, thanos.LastName, thanos.Email, thanos.Score, thanos.Comment) == 1)
                        {
                            Console.WriteLine("Ahh...perfectly balanced. As all things should be.\n");
                        }
                        else
                        {
                            Console.WriteLine("You can't be balanced! Should've gone for the head!\n");
                        }
                    }
                    else
                    {
                        thanos.Comment = "Unbalanced user.";
                        if (DatabaseFunctions.UpdateUser(thanos.UserID, thanos.FirstName, thanos.LastName, thanos.Email, thanos.Score, thanos.Comment) == 1)
                        {
                            Console.WriteLine("Thanos, you've become unbalanced!\n");
                        }
                        else
                        {
                            Console.WriteLine("You can't be unbalanced! Should've gone for the head!\n");
                        }
                    }

                    Console.WriteLine("Sorry, Thanos; I am Iron Man, and you've got to go!\n");

                    if (DatabaseFunctions.DeleteUser(thanos.UserID) == 1)
                    {
                        Console.WriteLine("Thanos deleted. Destiny fulfilled.");
                    }
                    else
                    {
                        Console.WriteLine("Thanos cannot be deleted; he is inevitable!");
                    }
                }
                else
                {
                    Console.WriteLine("Unable to connect to the database and retrieve data.");
                }
            }
            catch (Exception ex)
            {
                string exception = CommonFunctions.LogError(ex);
                if (CommonFunctions.DisplayErrors) Console.WriteLine(exception);
                else Console.WriteLine("Unable to connect to the database and retrieve data. Check the error log for details.");
            }
        }

        /// <summary>
        /// Application entry point.
        /// </summary>
        /// <param name="args">Command line arguments.</param>
        static void Main(string[] args)
        {
            Console.WriteLine("Hello, World from C#!\n");
            HelloUsers();
        }
    }
}
