/*
 * Unit tests using NUnit.
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

using NUnit.Framework;
using Hello.Models;

namespace Tests
{
    /// <summary>
    /// Test class
    /// </summary>
    [TestFixture]
    public class CommonFunctionsTest
    {
        /// <summary>
        /// Test that the method rejects values less than or equal to 0.
        /// </summary>
        [Test]
        public void TestValidateUserIDFalse()
        {
            long arg = 1;
            Assert.IsTrue(CommonFunctions.ValidateUserID(arg));
        }

        /// <summary>
        /// Test that the method accepts values greater than 0.
        /// </summary>
        [Test]
        public void TestValidateUserIDTrue()
        {
            long arg = 1;
            Assert.IsTrue(CommonFunctions.ValidateUserID(arg));
        }

        /*
        [Test](expected = Exception.class)
        public void validateUserIDException() {
            CommonFunctions.ValidateUserID('a');
        }
        */

        /// <summary>
        /// Test that the method rejects values with invalid characters.
        /// </summary>
        [Test]
        public void TestValidateTextFalse()
        {
            string arg = "<script>alert('This is an injection!');</script>";
            bool result = CommonFunctions.ValidateText(arg);
            Assert.IsTrue(result == false);
        }

        /// <summary>
        /// Test that the method accepts values with valid characters.
        /// </summary>
        [Test]
        public void TestValidateTextTrue()
        {
            string arg = "Robert";
            bool result = CommonFunctions.ValidateText(arg);
            Assert.IsTrue(result == true);
        }

        /// <summary>
        /// Test that the method rejects values with illegal characters or
        /// in incorrect format.
        /// </summary>
        [Test]
        public void TestValidateEmailFalse()
        {
            string arg = "<script>alert('This is an injection!');</script>";
            bool result = CommonFunctions.ValidateEmail(arg);
            Assert.IsTrue(result == false);
        }

        /// <summary>
        /// Test that the method accepts values with legal characters and
        /// in correct format.
        /// </summary>
        [Test]
        public void TestValidateEmailTrue()
        {
            string arg = "rgarcia@rgprogramming.com";
            bool result = CommonFunctions.ValidateEmail(arg);
            Assert.IsTrue(result == true);
        }

        /// <summary>
        /// Test that the method rejects values with illegal characters or
        /// in incorrect format.
        /// </summary>
        [Test]
        public void TestValidateDateFalse()
        {
            string arg = "<script>alert('This is an injection!');</script>";
            bool result = CommonFunctions.ValidateDate(arg);
            Assert.IsTrue(result == false);
        }

        /// <summary>
        /// Test that the method accepts values with legal characters and
        /// in correct format.
        /// </summary>
        [Test]
        public void TestValidateDateTrue()
        {
            string arg = "2020-02-02 12:00:00";
            bool result = CommonFunctions.ValidateDate(arg);
            Assert.IsTrue(result == true);
        }
    }
}