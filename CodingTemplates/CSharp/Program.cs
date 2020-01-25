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
                Console.WriteLine(db.PathToSQLiteDB);
                Console.WriteLine("Next available user ID: {0}", db.GetNextUserID());

                SQLiteDataReader result = db.GetAllUsers();
                 if (result.HasRows)
                {
                    foreach (SQLiteDataReader row in result)
                    {
                        Console.WriteLine(row[0]);
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
                if (Common.DisplayErrors)
                {
                    Console.WriteLine(exception);
                }
                else
                {
                    Console.WriteLine("Unable to connect to the database and retrieve data. Check the error log for details.");
                }
            }
        }

        static void Main(string[] args)
        {
            Console.WriteLine("Hello World!");
            HelloUsers();
        }
    }
}
