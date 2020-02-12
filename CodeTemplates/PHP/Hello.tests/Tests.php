<?php
/**
 * Unit tests using PHPUnit 3.7.21.
 * Run by entering "phpunit tests.php" at command line.
 *
 * PHP version used: 7.3.12
 * SQLite version used: 3.28.0
 *
 * Styling guide: PSR-12: Extended Coding Style
 *     (https://www.php-fig.org/psr/psr-12/)
 *
 * @category  Basics
 * @package   PHP
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @copyright 2019-2020 Rob Garcia
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 */

// Include this file to access common functions and variables
define("PATH_TO_MODELS", dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR .
    "Hello" . DIRECTORY_SEPARATOR . "Models");
require_once PATH_TO_MODELS . DIRECTORY_SEPARATOR . "CommonFunctions.php";

class Tests extends PHPUnit_Framework_TestCase
{
    /**
     * Used to instantiate classes and other pre-testing operations
     */
    public function setUp()
    {}

    /**
     * Used to release resources and other post-testing operations.
     */
    public function tearDown()
    {}

    /**
     * Test that the method rejects values less than or equal to 0.
     */
    public function testValidateUserIDFalse()
    {
        $arg = -1;
        $result = validateUserID($arg);
        $this->assertTrue($result == false);
    }

    /**
     * Test that the method accepts values greater than 0.
     */
    public function testValidateUserIDTrue()
    {
        $arg = 1;
        $result = validateUserID($arg);
        $this->assertTrue($result == true);
    }

    /**
     * Test that the method raises an exception/error due to invalid input.
     */
    /*
    public function testValidateUserIDException()
    {
    $this->setExpectedException(Exception::class);
    validateUserID('a');
    }
     */

    /**
     * Test that the method rejects values with invalid characters.
     */
    public function testValidateTextFalse()
    {
        $arg = "<script>alert('This is an injection!');</script>";
        $result = validateText($arg);
        $this->assertTrue($result == false);
    }

    /**
     * Test that the method accepts values with valid characters.
     */
    public function testValidateTextTrue()
    {
        $arg = "Robert";
        $result = validateText($arg);
        $this->assertTrue($result == true);
    }

    /**
     * Test that the method rejects values with illegal characters or
     * in incorrect format.
     */
    public function testValidateEmailFalse()
    {
        $arg = "<script>alert('This is an injection!');</script>";
        $result = validateEmail($arg);
        $this->assertTrue($result == false);
    }

    /**
     * Test that the method accepts values with legal characters and
     * in correct format.
     */
    public function testValidateEmailTrue()
    {
        $arg = "rgarcia@rgprogramming.com";
        $result = validateEmail($arg);
        $this->assertTrue($result == true);
    }

    /**
     * Test that the method rejects values with illegal characters or
     * in incorrect format.
     */
    public function testValidateDateFalse()
    {
        $arg = "<script>alert('This is an injection!');</script>";
        $result = validateDate($arg);
        $this->assertTrue($result == false);
    }

    /**
     * Test that the method accepts values with legal characters and
     * in correct format.
     */
    public function testValidateDateTrue()
    {
        $arg = "2020-02-02 12:00:00";
        $result = validateDate($arg);
        $this->assertTrue($result == true);
    }
}
