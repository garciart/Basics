<?php
/**
 * Handles all calls to the User database using PDO.
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
declare(strict_types=1);

// Include this file to access common functions and variables
require_once "CommonFunctions.php";

const PATH_TO_SQLITE_DB = ROOT_DIR . DIRECTORY_SEPARATOR . "data" .
    DIRECTORY_SEPARATOR . "Users.db";

/**
 * List of Functions:
 * integer createUserTable()
 * integer createUser($firstName, $lastName, $email, $score, $comment)
 * array getAllUsers()
 * array getUserByUserID($userID)
 * array getUserByEmail($email)
 * int updateUser($userID, $firstName, $lastName, $email, $score, $comment)
 * int deleteUser($userID)
 * int getNextUserID()
 * boolean userExists($email)
 * object connect()
 * boolean databaseExists()
 */

/**
 * Creates the User table if it does not exist in the database.
 *
 * @return integer The number of rows affected.
 *                 A value less than 0 indicates an error.
 */
function createUserTable()
{
    $rowsAffected = null;
    try {
        $conn = connect();
        $sql = "CREATE TABLE IF NOT EXISTS User (
                UserID integer PRIMARY KEY,
                FirstName text NOT NULL,
                LastName text NOT NULL,
                Email text UNIQUE NOT NULL,
                Score real NOT NULL DEFAULT '100.0',
                CreationDate text NOT NULL,
                Comment text
            );";
        $rowsAffected = $conn->exec($sql);
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $rowsAffected;
}

/**
 * Inserts a new user into the database.
 *
 * @param string $firstName The user's first name.
 * @param string $lastName  The user's last name.
 * @param string $email     The user's email address (can be used as a user name).
 * @param float  $score     The user's score from 0.0 to 100.0.
 * @param string $comment   Any additional comments.
 *
 * @return integer The rowid of the new user. A value of 0 indicates an error.
 */
function createUser($firstName, $lastName, $email, $score, $comment)
{
    $lastRowID = 0;
    try {
        $conn = connect();
        $sql = "INSERT INTO User
                VALUES (:UserID, :FirstName, :LastName, :Email, :Score,
                        :CreationDate, :Comment);";
        // Set other initial values
        $creationDate = date("Y-m-d H:i:s");
        // Execute SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":UserID", getNextUserID());
        $stmt->bindValue(":FirstName", $firstName);
        $stmt->bindValue(":LastName", $lastName);
        $stmt->bindValue(":Email", $email);
        $stmt->bindValue(":Score", $score);
        $stmt->bindValue(":CreationDate", $creationDate);
        $stmt->bindValue(":Comment", $comment);
        $stmt->execute();
        // The last insert ID should be greater than 0
        $lastRowID = $conn->lastInsertId();
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $lastRowID;
}

/**
 * Gets all the users in the database and their information.
 *
 * @return array An array of all the users in the database and their
 *               information. An empty array indicates an error.
 */
function getAllUsers()
{
    $result = null;
    try {
        $conn = connect();
        $sql = "SELECT *
                FROM User
                ORDER BY UserID ASC;";
        // Returns an empty result set if not found
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $result;
}

/**
 * Returns a single user and his or her information.
 *
 * @param integer $userID The user's ID.
 *
 * @return array The user's information indexed by column name or empty if the
 *               user's ID is not found.
 */
function getUserByUserID($userID)
{
    $result = null;
    try {
        $conn = connect();
        $sql = "SELECT *
                FROM User
                WHERE UserID = :UserID;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":UserID", $userID);
        $stmt->execute();
        // Returns an empty result set if not found
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $result;
}

/**
 * Returns a single user and his or her information.
 *
 * @param string $email The user's email.
 *
 * @return array The user's information indexed by column name or empty if the
 *               user's email is not found.
 */
function getUserByEmail($email)
{
    $result = null;
    try {
        $conn = connect();
        $sql = "SELECT *
                FROM User
                WHERE Email = :Email;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":Email", $email);
        $stmt->execute();
        // Returns an empty result set if not found
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $result;
}

/**
 * Updates a user's information in the database.
 *
 * @param integer $userID    The user's ID.
 * @param string  $firstName The user's first name.
 * @param string  $lastName  The user's last name.
 * @param string  $email     The user's email address (can be used as a user name).
 * @param float   $score     The user's score from 0.0 to 100.0.
 * @param string  $comment   Any additional comments.
 *
 * @return integer The number of rows affected. A value other than 1 indicates
 *                 an error.
 */
function updateUser($userID, $firstName, $lastName, $email, $score, $comment)
{
    $rowsAffected = 0;
    try {
        $conn = connect();
        $sql = "UPDATE User
                SET FirstName = :FirstName,
                LastName = :LastName,
                Email = :Email,
                Score = :Score,
                Comment = :Comment
                WHERE UserID = :UserID;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":UserID", $userID);
        $stmt->bindValue(":FirstName", $firstName);
        $stmt->bindValue(":LastName", $lastName);
        $stmt->bindValue(":Email", $email);
        $stmt->bindValue(":Score", $score);
        $stmt->bindValue(":Comment", $comment);
        $stmt->execute();
        // Rows affected should equal 1
        $rowsAffected = $stmt->rowCount();
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $rowsAffected;
}

/**
 * Deletes a user from the database.
 *
 * @param integer $userID The user's ID.
 *
 * @return integer The number of rows affected. A value other than 1 indicates
 *                 an error.
 */
function deleteUser($userID)
{
    $rowsAffected = 0;
    try {
        $conn = connect();
        $sql = "DELETE FROM User
                WHERE UserID = :UserID;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":UserID", $userID);
        $stmt->execute();
        // Rows affected should equal 1
        $rowsAffected = $stmt->rowCount();
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $rowsAffected;
}

/**
 * Gets the anticipated value of the next UserID (usually the last row
 * inserted) from the User table.
 *
 * @return integer The value of the next UserID or 0 if there is no data.
 */
function getNextUserID()
{
    $nextUserID = 0;
    try {
        $conn = connect();
        $sql = "SELECT MAX(UserID) as maxUserID FROM User;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        $nextUserID = $row["maxUserID"] == "" ? 0 : $row["maxUserID"];
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    // Add 1 to the last user ID
    return $nextUserID + 1;
}

/**
 * Checks if the given users exists in the database.
 * Julen Pardo came up with this.
 * Thought about changing the method to retrieve the UserID instead,
 * but Email is supposed to be unique.
 * If the count != 1, that means there are no users or more than one,
 * which means something is wrong. This is a better method.
 *
 * @param string $email The email to check.
 *
 * @return boolean True if the users exists, false if not.
 */
function userExists($email)
{
    $exists = false;
    try {
        $conn = connect();
        $sql = "SELECT COUNT(*) AS Count
                FROM User
                WHERE Email = :Email;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":Email", $email);
        $stmt->execute();
        // Fetch the result set
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $exists = ($result["Count"]) == 1 ? true : false;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
    return $exists;
}

/**
 * Connects to the database.
 *
 * @return \PDO The PDO object that connects to the SQLite database
 */
function connect()
{
    $pdo = null;
    // Check if connection does not exists
    if (!isset($pdo) || !isset($conn)) {
        try {
            // Create (connect to) SQLite database in file
            $pdo = new \PDO("sqlite:" . PATH_TO_SQLITE_DB);
            // Turn on foreign key constraints
            $pdo->exec("PRAGMA foreign_keys = ON;");
            // Set errormode to exceptions
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }
    return $pdo;
}

/**
 * Creates and populates the database if it does not exist.
 *
 * @return boolean True if the database exists or was create, false if not.
 */
function databaseExists()
{
    $exists = true;
    try {
        // Create and populate the database if it does not exists.
        if (!file_exists(ROOT_DIR . DIRECTORY_SEPARATOR . "data")) {
            mkdir(ROOT_DIR . DIRECTORY_SEPARATOR . "data");
        }
        if (!file_exists(PATH_TO_SQLITE_DB)) {
            if (createUserTable() < 0) {
                $exists = false;
            }

            // Set initial values
            if (createUser(
                "Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0,
                "Administrator."
            ) == 0
            ) {
                $exists = false;
            }

            if (createUser(
                "Ben", "Franklin", "bfranklin@rgprogramming.com", 90.0,
                "Old user."
            ) == 0
            ) {
                $exists = false;
            }

            if (createUser(
                "Baby", "Yoda", "byoda@rgprogramming.com", 100.0, "New user."
            ) == 0
            ) {
                $exists = false;
            }

        }
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    }
    return $exists;
}
