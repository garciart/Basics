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
 * @category Basics
 * @package  PHP
 * @author   Rob Garcia <rgarcia@rgprogramming.com>
 * @license  https://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/garciart/Basics
 */

// Include this file to access common functions and variables
require_once 'Common.php';

const PATH_TO_SQLITE_DB = ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . 'users.db';

/**
 * Class methods:
 * createUserTable()
 * createUser($firstName, $lastName, $email, $score, $comment)
 * getAllUsers()
 * getUserByUserID($userID)
 * getUserByEmail($email)
 * updateUser($userID, $firstName, $lastName, $email, $score, $comment)
 * deleteUser($userID)
 * getNextUserID()
 * userExists($email)
 * connect()
 * 
 * Initialization code at bottom
 */

/**
 * Creates the User table if it does not exist in the database.
 * 
 * @return integer The new user's ID. A value less than 0 indicates an error.
 */
function createUserTable()
{
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
        $conn->exec($sql);
        // Set initial values
        createUser(
            'Rob', 'Garcia', 'rgarcia@rgprogramming.com', 100,
            'Administrator.'
        );
        createUser(
            'Ben', 'Franklin', 'bfranklin@rgprogramming.com', 100,
            'Old user.'
        );
        $lastRowId = createUser(
            'Baby', 'Yoda', 'byoda@rgprogramming.com', 100, 'New user.'
        );
        return $lastRowId;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Inserts a new user into the database.
 * 
 * @param string $firstName The user's first name.
 * @param string $lastName  The user's last name.
 * @param string $email     The user's email address (used for user name).
 * @param float  $score     The user's score from 0.0 to 100.0.
 * @param string $comment   Any additional comments.
 * 
 * @return integer The rowid of the new user. A value of 0 indicates an error.
 */
function createUser($firstName, $lastName, $email, $score, $comment)
{
    try {
        $conn = connect();
        $sql = 'INSERT INTO User
                VALUES (:UserID, :FirstName, :LastName, :Email, :Score,
                        :CreationDate, :Comment);';
        // Set other initial values
        $creationDate = date('Y-m-d H:i:s');
        // Execute SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':UserID', getNextUserID());
        $stmt->bindValue(':FirstName', $firstName);
        $stmt->bindValue(':LastName', $lastName);
        $stmt->bindValue(':Email', $email);
        $stmt->bindValue(':Score', $score);
        $stmt->bindValue(':CreationDate', $creationDate);
        $stmt->bindValue(':Comment', $comment);
        $stmt->execute();
        // The last insert ID should be greater than 0
        $lastRowId = $conn->lastInsertId();
        return $lastRowId;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Gets all the users in the database and their information.
 * 
 * @return array An array of all the users in the database and their
 *               information. An empty array indicates an error.
 */
function getAllUsers()
{
    try {
        $conn = connect();
        $sql = 'SELECT *
                FROM User
                ORDER BY UserID ASC;';
        // Returns an empty result set if not found
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
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
    try {
        $conn = connect();
        $sql = 'SELECT *
                FROM User
                WHERE UserID = :UserID;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':UserID', $userID);
        $stmt->execute();
        // Returns an empty result set if not found
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
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
    try {
        $conn = connect();
        $sql = 'SELECT *
                FROM User
                WHERE Email = :Email;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Email', $email);
        $stmt->execute();
        // Returns an empty result set if not found
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Updates a user's information in the database.
 * 
 * @param integer $userID    The user's ID.
 * @param string  $firstName The user's first name.
 * @param string  $lastName  The user's last name.
 * @param string  $email     The user's email address (used for user name).
 * @param float   $score     The user's score from 0.0 to 100.0.
 * @param string  $comment   Any additional comments.
 * 
 * @return integer The number of rows affected. A value other than 1 indicates
 *                 an error.
 */
function updateUser($userID, $firstName, $lastName, $email, $score, $comment)
{
    try {
        $conn = connect();
        $sql = 'UPDATE User
                SET FirstName = :FirstName,
                LastName = :LastName,
                Email = :Email,
                Score = :Score,
                Comment = :Comment
                WHERE  UserID = :UserID;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':UserID', $userID);
        $stmt->bindValue(':FirstName', $firstName);
        $stmt->bindValue(':LastName', $lastName);
        $stmt->bindValue(':Email', $email);
        $stmt->bindValue(':Score', $score);
        $stmt->bindValue(':Comment', $comment);
        $stmt->execute();
        // Rows affected should equal 1
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
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
    try {
        $conn = connect();
        $sql = 'DELETE FROM User
                WHERE UserID = :UserID;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':UserID', $userID);
        $stmt->execute();
        // Rows affected should equal 1
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Gets the anticipated value of the next UserID (usually the last row
 * inserted) from the User table.
 * 
 * @return integer The value of the next UserID or 0 if there is no data.
 */
function getNextUserID()
{
    try {
        $conn = connect();
        $sql = 'SELECT MAX(UserID) as maxUserID FROM User;';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        $maxUserID = $row['maxUserID'] == '' ? 0 : $row['maxUserID'];
        // Add 1 to the last user ID
        return $maxUserID + 1;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
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
    try {
        $conn = connect();
        $sql = 'SELECT COUNT(*) AS Count
                FROM User
                WHERE Email = :Email;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Email', $email);
        $stmt->execute();
        // Fetch the result set
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        // $result = $stmt->fetchAll();
        $exists = ($result['Count']) == 1 ? true : false;
        return $exists;
    } catch (\PDOException $ex) {
        error_log($ex->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Connects to the database.
 * 
 * @return \PDO The PDO object that connects to the SQLite database
 */
function connect()
{
    // Check if connection does not exists
    if (!isset($pdo) || !isset($conn)) {
        try {
            // Create (connect to) SQLite database in file
            $pdo = new \PDO('sqlite:' . PATH_TO_SQLITE_DB);
            // Turn on foreign key constraints
            $pdo->exec('PRAGMA foreign_keys = ON;');
            // Set errormode to exceptions
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }
    return $pdo;
}

if (!file_exists(PATH_TO_SQLITE_DB)) {
    // Create and populate the database if it does not exists.
    echo "Creating user database...\n";
    createUserTable();
    echo "Database created...\n";
}
