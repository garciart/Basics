/**
 * Handles all calls to the User database.
 *
 * .NET Core version used: 3.1.0
 * C# version used: 8.0
 * SQLite version used: 3.30.1
 *
 * Styling guide: .NET Core Engineering guidelines
 *     (https://github.com/dotnet/aspnetcore/wiki/Engineering-guidelines) and
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
using System.Data.SQLite;

namespace CSharp
{
    /**
     * Class methods:
     * CreateUserTable()
     * CreateUser(firstName, lastName, email, score, comment)
     * GetAllUsers()
     * GetUserByUserID(userID)
     * GetUserByEmail(email)
     * UpdateUser(userID, firstName, lastName, email, score, comment)
     * DeleteUser(userID)
     * GetNextUserID()
     * UserExists(email)
     * DatabaseFunctions()
     * 
     * Initialization code at bottom
     */

    using System;
    using System.Data;
    using System.IO;

    public class DatabaseFunctions
    {
        private static readonly Common c = new Common();
        // Use readonly instead of const for PathToSQLiteDB, since it must be generated dynamically in C#
        private readonly string PathToSQLiteDB = string.Format("{0}db{1}users.db", c.RootDir, Path.DirectorySeparatorChar);

        public long CreateUserTable()
        {
            long lastRowID = 0;
            SQLiteConnection conn = null;
            SQLiteCommand cmd = null;
            try
            {
                conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                conn.Open();

                string sql = "DROP TABLE IF EXISTS User;";
                cmd = new SQLiteCommand(sql, conn);
                cmd.ExecuteNonQuery();

                sql = @"CREATE TABLE IF NOT EXISTS User (
                    UserID integer PRIMARY KEY,
                    FirstName text NOT NULL,
                    LastName text NOT NULL,
                    Email text UNIQUE NOT NULL,
                    Score real NOT NULL DEFAULT '100.0',
                    CreationDate text NOT NULL,
                    Comment text
                );";
                cmd = new SQLiteCommand(sql, conn);
                cmd.ExecuteNonQuery();
                // Set initial values
                CreateUser(
                    "Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0f,
                    "Administrator."
                );
                CreateUser(
                    "Thomas", "Jefferson", "tjefferson@rgprogramming.com", 90.0f,
                    "Old user."
                );
                lastRowID = CreateUser(
                    "Baby", "Yoda", "byoda@rgprogramming.com", 100.0f, "New user."
                );

            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            finally
            {
                cmd.Dispose();
                conn.Close();
            }
            return lastRowID;
        }

        public long CreateUser(string firstName, string lastName, string email, float score, string comment)
        {
            long lastRowID = 0;
            SQLiteConnection conn = null;
            SQLiteCommand cmd = null;
            try
            {
                conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                conn.Open();

                string sql = @"INSERT INTO User VALUES (
                    @UserID,
                    @FirstName,
                    @LastName,
                    @Email,
                    @Score,
                    @CreationDate,
                    @Comment
                );";
                cmd = new SQLiteCommand(sql, conn);
                string creationDate = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
                cmd.Parameters.AddWithValue("@UserID", GetNextUserID());
                cmd.Parameters.AddWithValue("@FirstName", firstName);
                cmd.Parameters.AddWithValue("@LastName", lastName);
                cmd.Parameters.AddWithValue("@Email", email);
                cmd.Parameters.AddWithValue("@Score", score);
                cmd.Parameters.AddWithValue("@CreationDate", creationDate);
                cmd.Parameters.AddWithValue("@Comment", comment);
                cmd.Prepare();
                cmd.ExecuteNonQuery();
                lastRowID = conn.LastInsertRowId;
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            finally
            {
                cmd.Dispose();
                conn.Close();
            }
            return lastRowID;
        }

        public SQLiteDataReader GetAllUsers()
        {
            SQLiteDataReader result = null;
            SQLiteConnection conn = null;
            SQLiteCommand cmd = null;
            try
            {
                conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                conn.Open();

                string sql = @"SELECT *
                    FROM User
                    ORDER BY UserID ASC;";
                cmd = new SQLiteCommand(sql, conn);
                // Use this to allow result to persist after connection is closed
                result = cmd.ExecuteReader(CommandBehavior.CloseConnection);
            }
            catch (Exception ex)
            {
                cmd.Dispose();
                conn.Close();
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return result;
        }

        public long GetNextUserID()
        {
            long lastRowID = 0;
            SQLiteConnection conn = null;
            SQLiteCommand cmd = null;
            try
            {
                conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                conn.Open();
                string sql = "SELECT MAX(UserID) as maxUserID FROM User;";
                cmd = new SQLiteCommand(sql, conn);
                object o = cmd.ExecuteScalar();
                lastRowID = (o is System.DBNull) ? 0 : Convert.ToInt64(o);
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            finally
            {
                cmd.Dispose();
                conn.Close();
            }
            return lastRowID + 1;
        }

        /// <summary>
        /// Constructor.
        /// </summary>
        public DatabaseFunctions()
        {
            Directory.SetCurrentDirectory(c.RootDir);
            string dbFolder = string.Format("{0}db", c.RootDir);
            string dbFile = string.Format("{0}{1}users.db", dbFolder, Path.DirectorySeparatorChar);
            if (!Directory.Exists(dbFolder) || !File.Exists(dbFile))
            {
                Console.WriteLine("Creating user database...");
                // Creates the db directory if it does not exist
                Directory.CreateDirectory(dbFolder);
                // Creates the db file if it does not exist
                CreateUserTable();
                Console.WriteLine("Database created...");
            }
        }
    }
}
