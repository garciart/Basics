<?php

/**
 * User database class. Handles all interactions with the User database using PDO.
 *
 * PHP version used: 7.3.12
 *
 * Styling guide: PSR-12: Extended Coding Style (https://www.php-fig.org/psr/psr-12/)
 *
 * @author  Rob Garcia <rgarcia@rgprogramming.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 */

namespace PHP;

// Include this file to access common functions and variables
require_once 'Common.php';

class UserDB
{

    // Class fields:
    private $_pdo;

    // Class properties:
    public $pathToSQLiteDB = ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . 'users.db';

    // Class constants:
    const PATH_TO_SQLITE_DB = ROOT_DIR . 'db' . DIRECTORY_SEPARATOR . 'users.db';

    /**
     * Class methods:
     * _construct
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
     */

    /**
     * Class constructor. Creates the database and loads initial values if the
     * database does not exists.
     */
    public function __construct()
    {
        if (!file_exists(self::PATH_TO_SQLITE_DB)) {
            // Create database and table if it does not exist
            echo "Creating user database...\n";
            $this->createUserTable();
            echo "Database created...\n";
        }
    }

    // Class methods:

    /**
     * Creates the User table if it does not exist in the database.
     * @return integer The new user's ID. A value less than 0 indicates an error.
     */
    private function createUserTable()
    {
        try {
            $this->_pdo = $this->connect();
            $sql = "CREATE TABLE IF NOT EXISTS User (
                UserID integer PRIMARY KEY,
                FirstName text NOT NULL,
                LastName text NOT NULL,
                Email text UNIQUE NOT NULL,
                Score real NOT NULL DEFAULT '100.0',
                CreateDate text NOT NULL,
                Comment text
            );";
            $this->_pdo->exec($sql);
            // Set initial values
            $this->createUser('Rob', 'Garcia', 'rgarcia@rgprogramming.com', 100, 'Administrator.');
            $this->createUser('Ben', 'Franklin', 'bfranklin@rgprogramming.com', 100, 'Old user.');
            $lastRowId = $this->createUser('Baby', 'Yoda', 'byoda@rgprogramming.com', 100, 'New user.');
            return $lastRowId;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Inserts a new user into the database.
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $email The user's email address (used for user name).
     * @param float $score The user's score from 0.0 to 100.0.
     * @param string $comment Any additional comments.
     * @return integer The rowid of the new user. A value other than 1 indicates an error.
     */
    public function createUser($firstName, $lastName, $email, $score, $comment)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'INSERT INTO User
                VALUES (:UserID, :FirstName, :LastName, :Email, :Score, :CreateDate, :Comment);';
            // Set other initial values
            $createDate = date('Y-m-d H:i:s');
            // Execute SQL
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':UserID', $this->getNextUserID());
            $stmt->bindValue(':FirstName', $firstName);
            $stmt->bindValue(':LastName', $lastName);
            $stmt->bindValue(':Email', $email);
            $stmt->bindValue(':Score', $score);
            $stmt->bindValue(':CreateDate', $createDate);
            $stmt->bindValue(':Comment', $comment);
            $stmt->execute();
            // The last insert ID should be greater than 0
            $lastRowId = $this->_pdo->lastInsertId();
            return $lastRowId;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Gets all the users in the database and their information.
     * @return array An array of all the users in the database and their information. An empty array indicates an error.
     */
    public function getAllUsers()
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'SELECT *
                FROM User
                ORDER BY LastName ASC;';
            // Returns an empty result set if not found
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Returns a single user and his or her information.
     * @param integer $userID The user's ID.
     * @return array The user's information indexed by column name or empty if the user's ID is not found.
     */
    public function getUserByUserID($userID)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'SELECT *
                FROM User
                WHERE UserID = :UserID;';
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':UserID', $userID);
            $stmt->execute();
            // Returns an empty result set if not found
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Returns a single user and his or her information.
     * @param string $email The user's email.
     * @return array The user's information indexed by column name or empty if the user's email is not found.
     */
    public function getUserByEmail($email)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'SELECT *
                FROM User
                WHERE Email = :Email;';
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':Email', $email);
            $stmt->execute();
            // Returns an empty result set if not found
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Updates a user's information in the database.
     * @param integer $userID The user's ID.
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $email The user's email address (used for user name).
     * @param float $score The user's score from 0.0 to 100.0.
     * @param string $comment Any additional comments.
     * @return integer The number of rows affected. A value other than 1 indicates an error.
     */
    public function updateUser($userID, $firstName, $lastName, $email, $score, $comment)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'UPDATE User
                SET FirstName = :FirstName,
                LastName = :LastName,
                Email = :Email,
                Score = :Score,
                Comment = :Comment
                WHERE  UserID = :UserID;';
            $stmt = $this->_pdo->prepare($sql);
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
        }
    }

    /**
     * Deletes a user from the database.
     * @param integer $userID The user's ID.
     * @return integer The number of rows affected. A value other than 1 indicates an error.
     */
    public function deleteUser($userID)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'DELETE FROM User
                WHERE UserID = :UserID;';
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':UserID', $userID);
            $stmt->execute();
            // Rows affected should equal 1
            $rowsAffected = $stmt->rowCount();
            return $rowsAffected;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Gets the anticipated value of the next UserID (usually the last row inserted) from the User table.
     * @return integer The value of the next UserID or 0 if there is no data.
     */
    private function getNextUserID()
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'SELECT MAX(UserID) as maxUserID FROM User;';
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            $maxUserID = $row['maxUserID'] == '' ? 0 : $row['maxUserID'];
            // Add 1 to the last user ID
            return $maxUserID + 1;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Checks if the given users exists in the database.
     * Julen Pardo came up with this.
     * Thought about changing the method to retrieve the UserID instead,
     * but Email is supposed to be unique.
     * If the count != 1, that means there are no users or more than one,
     * which means something is wrong. This is a better method.
     * @param string $email The email to check.
     * @return boolean True if the users exists, false if not.
     */
    public function userExists($email)
    {
        try {
            $this->_pdo = $this->connect();
            $sql = 'SELECT COUNT(*) AS Count
                FROM User
                WHERE Email = :Email;';
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':Email', $email);
            $stmt->execute();
            // Fetch the result set
            // $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $exists = ($result['Count']) == 1 ? true : false;
            return $exists;
        } catch (\PDOException $ex) {
            error_log($ex->getMessage());
        }
    }

    /**
     * Connects to the database.
     * @return \PDO The PDO object that connects to the SQLite database
     */
    private function connect()
    {
        // Check if connection does not exists
        if (!isset($this->_pdo)) {
            try {
                // Create (connect to) SQLite database in file
                $pdo = new \PDO('sqlite:' . self::PATH_TO_SQLITE_DB);
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

}
