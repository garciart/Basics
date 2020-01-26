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
     * int CreateUserTable()
     * long CreateUser(string firstName, string lastName, string email, float score, string comment)
     * SQLiteDataReader GetAllUsers()
     * SQLiteDataReader GetUserByUserID(long userID)
     * SQLiteDataReader GetUserByEmail(string email)
     * int UpdateUser(long userID, string firstName, string lastName, string email, float score, string comment)
     * int DeleteUser(long userID)
     * long GetNextUserID()
     * bool UserExists(string email)
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

        /// <summary>
        /// Creates the User table if it does not exist in the database.
        /// </summary>
        /// <returns>The number of rows affected. A value less than 0 indicates an error.</returns>
        public int CreateUserTable()
        {
            int rowsAffected = 0;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = "DROP TABLE IF EXISTS User;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    cmd.ExecuteNonQuery(CommandBehavior.CloseConnection);
                }
                sql = @"CREATE TABLE IF NOT EXISTS User (
                    UserID integer PRIMARY KEY,
                    FirstName text NOT NULL,
                    LastName text NOT NULL,
                    Email text UNIQUE NOT NULL,
                    Score real NOT NULL DEFAULT '100.0',
                    CreationDate text NOT NULL,
                    Comment text
                );";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    rowsAffected = cmd.ExecuteNonQuery(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return rowsAffected;
        }

        /// <summary>
        /// Inserts a new user into the database.
        /// </summary>
        /// <param name="firstName">The user's first name.</param>
        /// <param name="lastName">The user's last name.</param>
        /// <param name="email">The user's email address (used for user name).</param>
        /// <param name="score">The user's score from 0.0 to 100.0.</param>
        /// <param name="comment">Any additional comments.</param>
        /// <returns>The rowid of the new user. A value of 0 indicates an error.</returns>
        public long CreateUser(string firstName, string lastName, string email, float score, string comment)
        {
            long lastRowID = 0;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"INSERT INTO User VALUES (
                    @UserID,
                    @FirstName,
                    @LastName,
                    @Email,
                    @Score,
                    @CreationDate,
                    @Comment
                );";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    string creationDate = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
                    cmd.Parameters.AddWithValue("@UserID", GetNextUserID());
                    cmd.Parameters.AddWithValue("@FirstName", firstName);
                    cmd.Parameters.AddWithValue("@LastName", lastName);
                    cmd.Parameters.AddWithValue("@Email", email);
                    cmd.Parameters.AddWithValue("@Score", score);
                    cmd.Parameters.AddWithValue("@CreationDate", creationDate);
                    cmd.Parameters.AddWithValue("@Comment", comment);
                    cmd.Prepare();
                    cmd.ExecuteNonQuery(CommandBehavior.CloseConnection);
                    lastRowID = conn.LastInsertRowId;
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return lastRowID;
        }

        /// <summary>
        /// Gets all the users in the database and their information.
        /// </summary>
        /// <returns>
        /// An reader object of all the users in the database and their information. An empty object indicates an error.
        /// </returns>
        public SQLiteDataReader GetAllUsers()
        {
            SQLiteDataReader result = null;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"SELECT *
                    FROM User
                    ORDER BY UserID ASC;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    result = cmd.ExecuteReader(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return result;
        }

        /// <summary>
        /// Returns a single user and his or her information.
        /// </summary>
        /// <param name="userID">The user's ID.</param>
        /// <returns>
        /// The user's information indexed by column name or empty if the user's ID is not found.
        /// </returns>
        public SQLiteDataReader GetUserByUserID(long userID)
        {
            SQLiteDataReader result = null;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"SELECT *
                    FROM User
                    WHERE UserID = @UserID;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    cmd.Parameters.AddWithValue("@UserID", userID);
                    cmd.Prepare();
                    result = cmd.ExecuteReader(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return result;
        }

        /// <summary>
        /// Returns a single user and his or her information.
        /// </summary>
        /// <param name="email">The user's email.</param>
        /// <returns>
        /// The user's information indexed by column name or empty if the user's email is not found.
        /// </returns>
        public SQLiteDataReader GetUserByEmail(string email)
        {
            SQLiteDataReader result = null;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"SELECT *
                    FROM User
                    WHERE Email = @Email;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    cmd.Parameters.AddWithValue("@Email", email);
                    cmd.Prepare();
                    result = cmd.ExecuteReader(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return result;
        }

        /// <summary>
        /// Updates a user's information in the database.
        /// </summary>
        /// <param name="userID">The user's ID.</param>
        /// <param name="firstName">The user's first name.</param>
        /// <param name="lastName">The user's last name.</param>
        /// <param name="email">The user's email address (used for user name).</param>
        /// <param name="score">The user's score from 0.0 to 100.0.</param>
        /// <param name="comment">Any additional comments.</param>
        /// <returns>
        /// The number of rows affected. A value other than 1 indicates an error.
        /// </returns>
        public int UpdateUser(long userID, string firstName, string lastName, string email, float score, string comment)
        {
            int rowsAffected = 0;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"UPDATE User
                SET FirstName = @FirstName,
                LastName = @LastName,
                Email = @Email,
                Score = @Score,
                Comment = @Comment
                WHERE  UserID = @UserID;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    cmd.Parameters.AddWithValue("@FirstName", firstName);
                    cmd.Parameters.AddWithValue("@LastName", lastName);
                    cmd.Parameters.AddWithValue("@Email", email);
                    cmd.Parameters.AddWithValue("@Score", score);
                    cmd.Parameters.AddWithValue("@Comment", comment);
                    cmd.Parameters.AddWithValue("@UserID", userID);
                    cmd.Prepare();
                    rowsAffected = cmd.ExecuteNonQuery(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return rowsAffected;
        }

        /// <summary>
        /// Deletes a user from the database.
        /// </summary>
        /// <param name="userID">The user's ID.</param>
        /// <returns>
        /// The number of rows affected. A value other than 1 indicates an error.
        /// </returns>
        public int DeleteUser(long userID)
        {
            int rowsAffected = 0;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                conn.Open();

                string sql = @"DELETE FROM User WHERE UserID = @UserID;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    cmd.Parameters.AddWithValue("@UserID", userID);
                    cmd.Prepare();
                    rowsAffected = cmd.ExecuteNonQuery(CommandBehavior.CloseConnection);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return rowsAffected;
        }

        /// <summary>
        /// Gets the anticipated value of the next UserID (usually the last row
        /// inserted) from the User table.
        /// </summary>
        /// <returns>The value of the next UserID or 0 if there is no data.</returns>
        public long GetNextUserID()
        {
            long lastRowID = 0;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = "SELECT MAX(UserID) as maxUserID FROM User;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    object o = cmd.ExecuteScalar(CommandBehavior.CloseConnection);
                    lastRowID = (o is System.DBNull) ? 0 : Convert.ToInt64(o);
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return lastRowID + 1;
        }

        /// <summary>
        /// Checks if the given users exists in the database.
        /// Julen Pardo came up with this.
        /// Thought about changing the method to retrieve the UserID instead,
        /// but Email is supposed to be unique.
        /// If the count != 1, that means there are no users or more than one,
        /// which means something is wrong. This is a better method.
        /// </summary>
        /// <param name="email">The email to check.</param>
        /// <returns>True if the users exists, false if not.</returns>
        public bool UserExists(string email)
        {
            bool exists = false;
            try
            {
                SQLiteConnection conn = new SQLiteConnection(string.Format("URI=file:{0}", PathToSQLiteDB));
                string sql = @"SELECT COUNT(*) AS Count
                    FROM User
                    WHERE Email = @Email;";
                using (SQLiteCommand cmd = new SQLiteCommand(sql, conn))
                {
                    conn.Open();
                    cmd.Parameters.AddWithValue("@Email", email);
                    cmd.Prepare();
                    long count = (long)cmd.ExecuteScalar(CommandBehavior.CloseConnection);
                    exists = count == 1 ? true : false;
                }
            }
            catch (Exception ex)
            {
                string exception = c.ErrorLog(ex);
                if (Common.DisplayErrors) Console.WriteLine(exception);
            }
            return exists;
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
                // Set initial values
                CreateUser(
                    "Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0f,
                    "Administrator."
                );
                CreateUser(
                    "Thomas", "Jefferson", "tjefferson@rgprogramming.com", 90.0f,
                    "Old user."
                );
                CreateUser(
                    "Baby", "Yoda", "byoda@rgprogramming.com", 100.0f, "New user."
                );
                Console.WriteLine("Database created...");
            }
        }
    }
}