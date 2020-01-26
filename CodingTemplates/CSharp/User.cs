/*
 * User class.
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
 * @copyright 2018-2019 Rob Garcia
 */

using System;

namespace CSharp
{
    /// <summary>
    /// User class.
    /// </summary>
    public class User
    {
        private static readonly Common c = new Common();
        private long _userID;
        private string _firstName;
        private string _lastName;
        private string _email;
        private float _score;
        private string _creationDate;
        // The comment field does not need validation and is an autoimplemeted property

        /// <summary>
        /// Getters and setters for the UserID property.
        /// </summary>
        /// <value>The user's ID.</value>
        public long UserID
        {
            get { return this._userID; }
            set
            {
                if (c.ValidateUserID(value)) this._userID = value;
                else throw new ArgumentException("User ID cannot be empty, 0, NULL, or FALSE.");
            }
        }

        /// <summary>
        /// Getters and setters for the FirstName property.
        /// </summary>
        /// <value>The user's first name.</value>
        public string FirstName
        {
            get { return this._firstName; }
            set
            {
                value.Trim();
                if (c.ValidateText(value)) this._firstName = value;
                else throw new ArgumentException("First name cannot be empty or contain illegal characters.");
            }
        }

        /// <summary>
        /// Getters and setters for the LastName property.
        /// </summary>
        /// <value>The user's last name.</value>
        public string LastName
        {
            get { return this._lastName; }
            set
            {
                value.Trim();
                if (c.ValidateText(value)) this._lastName = value;
                else throw new ArgumentException("Last name cannot be empty or contain illegal characters.");
            }
        }

        /// <summary>
        /// Getters and setters for the Email property.
        /// </summary>
        /// <value>The user's email address (used for user name).</value>
        public string Email
        {
            get { return this._email; }
            set
            {
                value.Trim();
                if (c.ValidateEmail(value)) this._email = value;
                else throw new ArgumentException("Email cannot be empty, incorrectly formatted, or contain illegal characters.");
            }
        }

        /// <summary>
        /// Getters and setters for the Score property.
        /// </summary>
        /// <value>The user's score from 0.0 to 100.0.</value>
        public float Score
        {
            get { return this._score; }
            set
            {
                if (value >= 0.0 || value <= 100.0) this._score = value;
                else throw new ArgumentException("Score cannot be empty and must be equal to or between 0.0 and 100.0");
            }
        }

        /// <summary>
        /// Getters and setters for the CreationDate property.
        /// </summary>
        /// <value>The date the user was added to the database.</value>
        public string CreationDate
        {
            get { return this._creationDate; }
            set
            {
                value.Trim();
                if (c.ValidateDate(value)) this._creationDate = value;
                else throw new ArgumentException("Creation date cannot be empty or incorrectly formatted.");
            }
        }

        /// <summary>
        /// Getters and setters for the Comment property.
        /// The comment field does not need validation and is an autoimplemeted property
        /// </summary>
        /// <value>Any additional comments.</value>
        public string Comment { get; set; }

        /// <summary>
        /// Class constructor.
        /// </summary>
        /// <param name="userID">The user's ID.</param>
        /// <param name="firstName">The user's first name.</param>
        /// <param name="lastName">The user's last name.</param>
        /// <param name="email">The user's email address (used for user name).</param>
        /// <param name="score">The user's score from 0.0 to 100.0.</param>
        /// <param name="creationDate">The date the user was added to the database.</param>
        /// <param name="comment">Any additional comments.</param>
        public User(long userID, string firstName, string lastName, string email, float score, string creationDate, string comment)
        {
            UserID = userID;
            FirstName = firstName;
            LastName = lastName;
            Email = email;
            Score = score;
            CreationDate = creationDate;
            Comment = comment;
        }
    }
}