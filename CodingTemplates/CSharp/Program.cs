/**
 * Hello World in C# with database integration.
 *
 * .NET Core version used: 3.1.0
 * C# version used: 8.0
 * SQLite version used: 3.30.1
 *
 * Styling guide: .NET Core Engineering guidelines
 *     (https://www.php-fig.org/psr/psr-12/) and
 *     C# Programming Guide
 *     (https://docs.microsoft.com/en-us/dotnet/csharp/programming-guide/inside-a-program/coding-conventions)
 *
 * @category  Basics
 * @package   CSharp
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2018-2019 Rob Garcia
 */

using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SQLite;

namespace CSharp
{
    class Program
    {
        private static readonly Common c = new Common();
        private static DatabaseFunctions db = new DatabaseFunctions();

        static void HelloUsers()
        {
            try
            {
                // Task 1: Connect and retrieve information from the database
                SQLiteDataReader result = db.GetAllUsers();

                if (result.HasRows)
                {
                    List<User> listOfUsers = new List<User>();

                    foreach (IDataRecord row in result)
                    {
                        listOfUsers.Add(new User(int.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString()));
                    }

                    Console.WriteLine(string.Format("Number of users in the database: {0}", listOfUsers.Count));
                    Console.WriteLine(string.Format("The first user is {0}.", listOfUsers[0].FirstName));
                    foreach (User user in listOfUsers)
                    {
                        Console.WriteLine("Hello, {0} {1}! You are #{2}, created on {3}, and you are a(n) {4}\n", user.FirstName, user.LastName, listOfUsers.IndexOf(user) + 1, user.CreationDate, user.Comment);
                    }

                    // Task 2: Add, update, and delete a new user
                    User thanos;

                    if (db.UserExists("thanos@rgprogramming.com"))
                    {
                        Console.WriteLine("Thanos, you are already in the database!");
                        result = db.GetUserByEmail("thanos@rgprogramming.com");
                        if (result.Read())
                        {
                            IDataRecord row = result;
                            thanos = new User(long.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString());
                        }
                        else
                        {
                            throw new Exception("Cannot retrieve user data!");
                        }
                    }
                    else
                    {
                        Console.WriteLine("Thanos, you are not in the database!");
                        long userID = db.CreateUser("Thanos", "The Mad Titan", "thanos@rgprogramming.com", 100.0f, "Unbalanced user.");
                        if (userID == 0)
                        {
                            throw new Exception("Cannot create user!");
                        }
                        else
                        {
                            result = db.GetUserByUserID(userID);
                            if (result.Read())
                            {
                                IDataRecord row = result;
                                thanos = new User(long.Parse(row["UserID"].ToString()), row["FirstName"].ToString(), row["LastName"].ToString(), row["Email"].ToString(), float.Parse(row["Score"].ToString()), row["CreationDate"].ToString(), row["Comment"].ToString());
                                Console.WriteLine("Welcome {0} {1}! You were created on {2} and you are a(n) {3}", thanos.FirstName, thanos.LastName, thanos.CreationDate, thanos.Comment);
                            }
                            else
                            {
                                throw new Exception("Cannot retrieve user data!");
                            }

                        }
                    }

                    if (thanos.Comment.Equals("Unbalanced user."))
                    {
                        Console.WriteLine("Uh oh, Thanos, you are unbalanced! Let's fix that!");
                        thanos.Comment = "Balanced user.";
                        if (db.UpdateUser(thanos.UserID, thanos.FirstName, thanos.LastName, thanos.Email, thanos.Score,thanos.Comment) == 1)
                        {
                            Console.WriteLine("Ahh...perfectly balanced. As all things should be.");
                        }
                        else
                        {
                            Console.WriteLine("You can't be balanced! Should've gone for the head!");
                        }
                    }
                    else
                    {
                        thanos.Comment = "Unbalanced user.";
                        if (db.UpdateUser(thanos.UserID, thanos.FirstName, thanos.LastName, thanos.Email, thanos.Score, thanos.Comment) == 1)
                        {
                            Console.WriteLine("Thanos, you've become unbalanced!");
                        }
                        else
                        {
                            Console.WriteLine("You can't be unbalanced! Should've gone for the head!");
                        }
                    }

                    Console.WriteLine("Sorry, Thanos; I am Iron Man, and you've got to go!");

                    if (db.DeleteUser(thanos.UserID) == 1)
                    {
                        Console.WriteLine("Destiny fulfilled.");
                    }
                    else
                    {
                        Console.WriteLine("Thanos cannot be deleted; he is inevitable!");
                    }
                }
                else
                {
                    Console.WriteLine("No records were found.");
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
                else Console.WriteLine("Unable to connect to the database and retrieve data. Check the error log for details.");
            }
        }

        static void Main(string[] args)
        {
            Console.WriteLine("Hello World!");
            HelloUsers();
        }
    }
}
