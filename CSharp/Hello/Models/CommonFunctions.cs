/*
 * Code common to one or more files.
 * Do not instantiate; the methods in CommonFunctions should be accessed in a static way.
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
 * @category  CodersCompanion
 * @package   CSharp
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */

using System;
using System.IO;
using System.Text.RegularExpressions;

namespace Hello.Models
{
    /// <summary>
    /// Code common to one or more files.
    /// </summary>
    public class CommonFunctions
    {
        /// <summary>
        /// Get the application's root directory.
        /// Use readonly instead of const for RootDir, since it must be generated dynamically in C#
        /// </summary>
        /// <returns>The application's root directory.</returns>
        public static readonly string RootDir = string.Format("{0}{1}hello", Directory.GetCurrentDirectory(), Path.DirectorySeparatorChar);

        /// <summary>
        /// Get the application's model directory.
        /// Use readonly instead of const for ModelDir, since it must be generated dynamically in C#
        /// </summary>
        /// <returns>The application's model directory.</returns>
        public static readonly string ModelDir = string.Format("{0}{1}models", RootDir, Path.DirectorySeparatorChar);

        /// <summary>
        /// Set the visibility of errors.
        /// Set to True to log and display during development and to False to only log during production.
        /// </summary>
        public static readonly bool DisplayErrors = true;

        /// <summary>
        /// Reformats error and exception details and records them in plain text in the error_log file.
        /// </summary>
        /// <param name="ex">The exception's details.</param>
        /// <returns>Reformatted error and exception details in plain text.</returns>
        public static string LogError(Exception ex)
        {
            string exception = null;
            try
            {
                using StreamWriter errorLog = File.AppendText(Path.Combine(RootDir, "ErrorLog.txt"));
                exception = string.Format("[{0}] {1}", DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss K"), ex.ToString());
                errorLog.WriteLine(exception);
            }
            catch (Exception exc)
            {
                // if (CommonFunctions.DisplayErrors)
                Console.WriteLine(exc.ToString());
            }
            return exception;
        }

        /// <summary>
        /// Validate UserID.
        /// </summary>
        /// <param name="userID">The UserID that will be entered in the database.</param>
        /// <returns>True if the UserID is an integer greater than 0, false if not.</returns>
        public static bool ValidateUserID(long userID)
        {
            return userID > 0;
        }

        /// <summary>
        /// Validate text input.
        /// </summary>
        /// <param name="text">The text that will be entered into the database.</param>
        /// <returns>True if the text is valid per RFC 3986, false if not.</returns>
        public static bool ValidateText(string text)
        {
            return (string.IsNullOrEmpty(text.Trim()) ||
                (Regex.IsMatch(text, @"^[A-Za-z0-9\s\-._~:\/?#\[\]@!$&'()*+,;=]*$") == false)) ? false : true;
        }

        /// <summary>
        /// Validate email address.
        /// </summary>
        /// <param name="email">The email address that will be entered into the database.</param>
        /// <returns>True if the email is valid per RFC 3986, false if not.</returns>
        public static bool ValidateEmail(string email)
        {
            return (string.IsNullOrEmpty(email.Trim()) ||
                (Regex.IsMatch(email, @"^[A-Za-z0-9\-._~\/?#!$&'%*+=`{|}^]+(@[a-zA-Z0-9-.]+)(.[a-zA-Z0-9]{2,}){2,}$") == false)) ? false : true;
        }

        /// <summary>
        /// Validate date format.
        /// </summary>
        /// <param name="date">The date that will be entered into the database.</param>
        /// <returns>True if the date format is well formed with valid characters, false if not.</returns>
        public static bool ValidateDate(string date)
        {
            return (string.IsNullOrEmpty(date.Trim()) ||
                (Regex.IsMatch(date, @"^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$") == false) ||
                date.Length != 19) ? false : true;
        }

        /// <summary>
        /// Constructor.
        /// </summary>
        public CommonFunctions()
        {
            Console.WriteLine("Do not instantiate. The methods in CommonFunctions should be accessed in a static way.");
            System.Environment.Exit(-1);
        }
    }
}
