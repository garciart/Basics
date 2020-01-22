<?php
/**
 * Code common to one or more files.
 *
 * PHP version used: 7.3.12
 *
 * Styling guide: PSR-12: Extended Coding Style
 *     (https://www.php-fig.org/psr/psr-12/)
 *
 * @category Basics
 * @package  PHP
 * @author   Rob Garcia <rgarcia@rgprogramming.com>
 * @license  https://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/garciart/Basics
 */
?>

<?php
const ROOT_DIR = __DIR__ . DIRECTORY_SEPARATOR;
chdir(ROOT_DIR);

// Report all errors and log them in ErrorLog.txt
error_reporting(-1);
ini_set('log_errors', 1);
ini_set('error_log', ROOT_DIR . 'ErrorLog.txt');

/*
 * IMPORTANT!
 *
 * FOR DEVELOPMENT ERROR REPORTING:
 * Uncomment ini_set('DISPLAY_ERRORS', 1) and comment out set_error_handler()
 * and set_exception_handler()
 *
 * FOR PRODUCTION ERROR REPORTING:
 * Uncomment set_error_handler() and set_exception_handler() and comment out
 * ini_set('DISPLAY_ERRORS', 1)
 */

// Development error reporting
// ini_set('DISPLAY_ERRORS', 1);

/*
 * Production error reporting
 * Use '32767' instead of 'E_ALL' and make sure to set 'DISPLAY_ERRORS = On'
 * in php.ini
 */
set_error_handler("errorHandler", 32767);
set_exception_handler("exceptionHandler");

/**
 * Error handler. Can be used to redirect users to error page
 * 
 * @param integer $errno   The error report level
 * @param string  $errstr  The error message
 * @param string  $errfile The filename with the error
 * @param integer $errline The line number of the error
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
 * Exception handler. Can be used to redirect users to exception page
 * 
 * @param string $exception Exception class object
 * 
 * @return void
 */
function exceptionHandler($exception)
{
    echo "Type {$exception->getCode()} Exception: {$exception->getMessage()} " .
         "in {$exception->getFile()} at line {$exception->getLine()}.\n";
    error_log($exception);
    // Do not die. Redirect the user to an appropriate exception page.
}
