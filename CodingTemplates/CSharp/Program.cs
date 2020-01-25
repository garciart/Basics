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
using System.Collections;
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
                // DatabaseFunctions db = new DatabaseFunctions();
                // Console.WriteLine("Next available user ID: {0}", db.GetNextUserID());

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
