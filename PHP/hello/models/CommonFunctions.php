<?php
/**
 * Code common to one or more files.
 *
 * PHP version used: 7.3.12
 * SQLite version used: 3.28.0
 *
 * Styling guide: PSR-12: Extended Coding Style
 *     (https://www.php-fig.org/psr/psr-12/)
 *
 * @category  CodersCompanion
 * @package   PHP
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @copyright 2019-2020 Rob Garcia
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 */
declare(strict_types=1);

/**
 * Get the application's model directory.
 */
const MODEL_DIR = __DIR__;
define("ROOT_DIR", dirname(dirname(__FILE__)));
/**
 * Set error reporting:
 * DEV = For development; more verbose and more details 
 * PROD = For production; less details
 */
const ERROR_REPORTING = "PROD";

// Report all errors and log them in ErrorLog.txt
error_reporting(-1);
ini_set("log_errors", "1");
ini_set("error_log", ROOT_DIR . DIRECTORY_SEPARATOR . "ErrorLog.txt");

if ($ERROR_REPORTING == "PROD") {
    /*
     * Production error reporting
     * Use "32767" instead of "E_ALL" and make sure to set "DISPLAY_ERRORS = On"
     * in php.ini
     */
    set_error_handler("errorHandler", 32767);
    set_exception_handler("exceptionHandler");
} else {
    // Development error reporting
    ini_set("DISPLAY_ERRORS", "1");
}

/**
 * Error handler. Can be used to redirect users to error page.
 *
 * @param integer $errno   The error report level.
 * @param string  $errstr  The error message.
 * @param string  $errfile The filename with the error.
 * @param integer $errline The line number of the error.
 *
 * @return void
 */
function errorHandler($errno, $errstr, $errfile, $errline)
{
    $error = "Type {$errno} Error: {$errstr} in {$errfile} at line {$errline}.";
    echo "{$error}\n";
    error_log($error);
    // Do not die. Redirect the user to an appropriate error page.
}

/**
 * Exception handler. Can be used to redirect users to exception page.
 *
 * @param string $exception Exception class object.
 *
 * @return void
 */
function exceptionHandler($ex)
{
    $exception = "Type {$ex->getCode()} Exception: {$ex->getMessage()} " .
        "in {$ex->getFile()} at line {$ex->getLine()}.\n";
    echo $exception;
    error_log($exception);
    // Do not die. Redirect the user to an appropriate exception page.
}

/**
 * Validate UserID.
 *
 * @param int $userID The UserID that will be entered in the database.
 *
 * @return boolean True if the UserID is an integer greater than 0, false if not.
 */
function validateUserID($userID)
{
    // throw new \Exception("Test...");
    if (empty($userID) || $userID < 1 || !filter_var($userID, FILTER_VALIDATE_INT)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Validate text input.
 *
 * @param string $text The text that will be entered into the database.
 *
 * @return boolean True if the text is valid per RFC 3986, false if not.
 */
function validateText($text)
{
    if (empty(trim($text)) 
        || (!preg_match("/^[A-Za-z0-9\s\-._~:\/?#\[\]@!$&'()*+,;=]*$/", $text))
    ) {
        return false;
    } else {
        return true;
    }
}

/**
 * Validate email address.
 *
 * @param string $email The email address that will be entered into the database.
 *
 * @return boolean True if the email is valid per RFC 3986, false if not.
 */
function validateEmail($email)
{
    if (empty(trim($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        return false;
    } else {
        return true;
    }
}

/**
 * Validate date format.
 *
 * @param string $date The date that will be entered into the database.
 *
 * @return boolean True if the date format is well formed with valid characters, false if not.
 */
function validateDate($date)
{
    if (empty(trim($date)) 
        || (!preg_match(
            "/^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$/",
            $date
        )    ) 
        || strlen($date) != 19
    ) {
        return false;
    } else {
        return true;
    }
}
