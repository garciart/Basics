<?php

/**
 * Hello World in PHP with database integration.
 *
 * PHP version used: 7.3.12
 *
 * Styling guide: PSR-12: Extended Coding Style (https://www.php-fig.org/psr/psr-12/)
 *
 * @author  Rob Garcia <rgarcia@rgprogramming.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 */
?>

<?php

// Include this file to access common functions and variables
require_once 'Common.php';
// Include this file to access database methods and create user objects
require_once 'UserDB.class.php';
require_once 'User.class.php';

/*
 * Get the class names. Must be declared in the global scope of the file:
 * see https://www.php.net/manual/en/language.namespaces.importing.php
 */

use PHP\User;
use PHP\UserDB;

echo "Hello, World!\n";
helloUsers();

// Functions:

/**
 * Gets users from the database and says hello to each one.
 */
function helloUsers()
{
    // Remove the try...catch to use enhanced error logging and reporting (in Common.php)
    try {
        // Connect to the database and get users
        $userDB = new UserDB();
        $result = $userDB->getAllUsers();
        // Say hello to each user in the database
        if ($result) {
            foreach ($result as $row) {
                $user = new User($row['UserID'], $row['FirstName'], $row['LastName'], $row['Email'], $row['Score'], $row['CreateDate'], $row['Comment']);
                echo "Hello, {$user->getFirstName()} {$user->getLastName()}! {$user->getCreateDate()}\n";
            }
        } else {
            echo "No records were found.\n";
        }
    } catch (Exception $ex) {
        error_log($ex);
        echo "Error: {$ex->getMessage()}\n";
    }
}
