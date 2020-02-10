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
using Model;

namespace CSharp
{
    /// <summary>
    /// Test class
    /// </summary>
    [TestFixture]
    public class Tests
    {
        /// <summary>
        /// Test that the method rejects values less than or equal to 0.
        /// </summary>
        [Test]
        public void TestValidateUserIDFalse()
        {
            long arg = -1;
            Assert.IsTrue(CommonFunctions.ValidateUserID(arg));
        }
    }
}