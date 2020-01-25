/**
 * Code common to one or more files.
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
using System.IO;
using System.Text.RegularExpressions;

namespace CSharp
{
    public class Common
    {
        // Use readonly instead of const for RootDir, since it must be generated dynamically in C#
        public readonly string RootDir = string.Format("{0}{1}", Directory.GetCurrentDirectory(), Path.DirectorySeparatorChar);
        public const bool DisplayErrors = true;

        /// <summary>
        /// Constructor. Also sets the correct path for the application.
        /// </summary>
        public Common()
        {
            Directory.SetCurrentDirectory(RootDir);
        }

        /// <summary>
        /// Reformats error and exception details and records them in plain text in the error_log file.
        /// </summary>
        /// <param name="ex">The exception's details.</param>
        /// <returns>Reformated exception details in plain text.</returns>
        public string ErrorLog(Exception ex)
        {
            using StreamWriter errorLog = File.AppendText(Path.Combine(RootDir, "ErrorLog.txt"));
            string exception = string.Format("[{0}] {1}", DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss K"), ex);
            errorLog.WriteLine(exception);
            return exception;
        }

        /// <summary>
        /// Validate UserID.
        /// </summary>
        /// <param name="userID">The UserID that will be entered in the database.</param>
        /// <returns>True if the UserID is an integer greater than 0, false if not.</returns>
        public bool ValidateUserID(int userID)
        {
            return userID > 0;
        }

        /// <summary>
        /// Validate text input.
        /// </summary>
        /// <param name="text">The text that will be entered into the database.</param>
        /// <returns>True if the text is valid, false if not.</returns>
        public bool ValidateText(string text)
        {
            return (string.IsNullOrEmpty(text.Trim())
                    || (Regex.IsMatch(text, @"^[A-Za-z0-9\s\-._~:\/?#\[\]@!$&'()*+,;=]*$") == false)) ? false : true;
        }

        /// <summary>
        /// Validate email address.
        /// </summary>
        /// <param name="email">The email address that will be entered into the database.</param>
        /// <returns>True if the email is valid, false if not.</returns>
        public bool ValidateEmail(string email)
        {
            return (string.IsNullOrEmpty(email.Trim())
                    || (Regex.IsMatch(email, @"^[A-Za-z0-9\-._~\/?#!$&'%*+=`{|}^]+@[A-Za-z0-9.-]+$") == false)) ? false : true;
        }

        /// <summary>
        /// Validate date format.
        /// </summary>
        /// <param name="date">The date that will be entered into the database.</param>
        /// <returns>True if the date format is valid, false if not.</returns>
        public bool ValidateDate(string date)
        {
            return (string.IsNullOrEmpty(date.Trim())
                    || (Regex.IsMatch(date, @"^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$") == false)
                    || date.Length != 19) ? false : true;
        }

    }
}
