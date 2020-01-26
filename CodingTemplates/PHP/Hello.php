<?php
/**
 * Hello World in PHP with database integration.
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
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright Copyright 2018-2019, Rob Garcia
 */

// Include this file to access common functions and variables
require_once 'Common.php';

// Include this file to access database methods and create user objects
require_once 'DatabaseFunctions.php';
require_once 'User.class.php';

/*
 * Get the class names. Must be declared in the global scope of the file:
 * see https://www.php.net/manual/en/language.namespaces.importing.php
 */

use PHP\User;

echo "Hello, World!\n\n";
helloUsers();

// Functions:

/**
 * Gets users from the database and says hello to each one.
 *
 * @return void
 */
function helloUsers()
{
    /*
     * Remove the try...catch to use enhanced error logging and reporting
     * (in Common.php)
     */
    try {
        // Task 1: Connect and retrieve information from the database
        $result = getAllUsers();
        if ($result) {
            $listOfUsers = array();

            foreach ($result as $row) {
                array_push($listOfUsers, new User(
                    $row['UserID'], $row['FirstName'], $row['LastName'],
                    $row['Email'], $row['Score'], $row['CreationDate'],
                    $row['Comment']
                ));
            }

            echo "Number of users in the database: " . count($listOfUsers) . "\n";
            echo "The first user is {$listOfUsers[0]->getFirstName()}.\n\n";

            foreach ($listOfUsers as $index => $user) {
                echo "Hello, {$user->getFirstName()} {$user->getLastName()}! " .
                    "You are #" . ((int) $index + 1) .
                    ", created on {$user->getCreationDate()}, and you are " .
                    "a(n) {$user->getComment()}\n";
            }

            echo "\n";

            // Task 2: Add, update, and delete a new user
            $thanos = array();

            if (userExists('thanos@rgprogramming.com')) {
                echo "Thanos, you are already in the database!\n\n";
                $result = getUserByEmail('thanos@rgprogramming.com');
                if (empty($result)) {
                    throw new Exception('Cannot retrieve user data!');
                } else {
                    # Use splat (...) to unpack array into class
                    $args = array_values($result);
                    $thanos = new User(...$args);
                }
            } else {
                $userID = createUser(
                    'Thanos', 'The Mad Titan', 'thanos@rgprogramming.com', 100,
                    'Unbalanced user.');
                if ($userID == 0) {
                    throw new Exception('Cannot create user!');
                }
                $result = getUserByUserID($userID);
                if (empty($result)) {
                    throw new Exception('Cannot retrieve user data!');
                } else {
                    # Use splat (...) to unpack array into class
                    $args = array_values($result);
                    $thanos = new User(...$args);
                    print("Welcome {$thanos->getFirstName()} {$thanos->getLastName()}! " .
                        "You were created on {$thanos->getCreationDate()} and you are " .
                        "a(n) {$thanos->getComment()}\n\n");
                }
            }

            if ($thanos->getComment() == 'Unbalanced user.') {
                echo "Uh oh, Thanos, you are unbalanced! Let's fix that!\n\n";
                $thanos->setComment('Balanced user.');
                if (updateUser($thanos->getUserID(), $thanos->getFirstName(),
                    $thanos->getLastName(), $thanos->getEmail(),
                    $thanos->getScore(), $thanos->getComment()) == 1) {
                    echo "Ahh...perfectly balanced. As all things should be.\n\n";
                } else {
                    echo "Can't be balanced! Should've gone for the head!\n\n";
                }
            } else {
                $thanos->setComment('Unbalanced user.');
                if (updateUser($thanos->getUserID(), $thanos->getFirstName(),
                    $thanos->getLastName(), $thanos->getEmail(),
                    $thanos->getScore(), $thanos->getComment()) == 1) {
                    echo "Thanos, you've become unbalanced!\n\n";
                } else {
                    echo "You can't be unbalanced! Should've gone for the head!\n\n";
                }
            }

            echo "Sorry, Thanos; I am Iron Man, and you've got to go!\n\n";

            if (deleteUser($thanos->getUserID()) == 1) {
                echo 'Destiny fulfilled.';
            } else {
                echo "Thanos cannot be deleted; he is inevitable!";
            }
        } else {
            echo "No records were found.\n";
        }
    } catch (Exception $ex) {
        error_log($ex);
        echo "Error: {$ex->getMessage()}\n";
    }
}
