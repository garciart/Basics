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
 * @copyright 2018-2019 Rob Garcia
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 */

using System;
using System.Data.SQLite;

namespace CSharp
{
    class Program
    {
        private static readonly Common c = new Common();

        static void HelloUsers()
        {
            try
            {
                Console.WriteLine(DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss K"));

                Console.WriteLine("Version: {0}", Environment.Version.ToString());
                string cs = "Data Source=:memory:";
                string stm = "SELECT SQLITE_VERSION()";

                using var con = new SQLiteConnection(cs);
                con.Open();

                using var cmd = new SQLiteCommand(stm, con);
                string version = cmd.ExecuteScalar().ToString();

                Console.WriteLine($"SQLite version: {version}");

                Console.WriteLine(c.ValidateDate("2009-03-31 00:59:00"));
                Console.WriteLine(c.ValidateUserID(1));
                Console.WriteLine(c.ValidateText("Robert"));
                Console.WriteLine(c.ValidateEmail("rgarcia@rgprogramming.com"));
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
