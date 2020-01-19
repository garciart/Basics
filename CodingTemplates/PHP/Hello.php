<?php

/**
 * Hello World test.
 *
 * PHP version 5.3
 *
 * @author  Rob Garcia <rgarcia@rgprogramming.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @version 1.0
 * @link    https://github.com/garciart/Basics/tree/master/CodingTemplates/PHP GitHub Repository
 */
?>

<?php

// Include to access database methods and create user objects
require_once 'UserDB.class.php';
require_once 'User.class.php';

/*
 * Get the class names. Must be declared in the global scope of the file:
 * see https://www.php.net/manual/en/language.namespaces.importing.php 
 */

use PHP\UserDB;
use PHP\User;

echo "Hello World!\n";
helloUsers();

// Functions:

/**
 * Gets users from the database and says hello to each one.
 */
function helloUsers() {
    // Connect to the database and get users
    $userDB = new UserDB();
    $result = $userDB->getAllUsers();
    // Say hello to each user in the database
    if ($result) {
        foreach ($result as $row) {
            $user = new User($row['UserID'], $row['FirstName'], $row['LastName'], $row['Email'], $row['Score'], $row['CreateDate'], $row['Comment']);
            echo 'Hello, ' . $user->getFirstName() . ' ' . $user->getLastName() . "!\n";
        }
    } else {
        echo "No records were found.\n";
    }
}
