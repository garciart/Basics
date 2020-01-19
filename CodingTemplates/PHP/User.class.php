<?php

/**
 * User Class.
 *
 * PHP version 5.3
 *
 * @author  Rob Garcia <rgarcia@rgprogramming.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @version 1.0
 * @link    https://github.com/garciart/Basics/tree/master/CodingTemplates/PHP GitHub Repository
 */

namespace PHP;

class User {

    // Class fields:
    private $_userID;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_score;
    private $_createDate;
    private $_comment;

    /**
     * Class constructor.
     * @param integer $userID The user's ID.
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $email The user's email address (used for user name).
     * @param float $score The user's score from 0.0 to 100.0.
     * @param string $createDate The date the user was added to the database.
     * @param string $comment Any additional comments.
     */
    public function __construct($userID, $firstName, $lastName, $email, $score, $createDate, $comment) {
        $this->_userID = $userID;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_score = $score;
        $this->_createDate = $createDate;
        $this->_comment = $comment;
    }

    // Class methods:
    public function getUserID() {
        return $this->_userID;
    }

    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function getFirstName() {
        return $this->_firstName;
    }

    public function setFirstName($firstName) {
        $this->_firstName = $firstName;
    }

    public function getLastName() {
        return $this->_lastName;
    }

    public function setLastName($lastName) {
        $this->_lastName = $lastName;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function getScore() {
        return $this->_score;
    }

    public function setScore($score) {
        $this->_score = $score;
    }

    public function getCreateDate() {
        return $this->_createDate;
    }

    public function setCreateDate($createDate) {
        $this->_createDate = $createDate;
    }

    public function getComment() {
        return $this->_comment;
    }

    public function setComment($comment) {
        $this->_comment = $comment;
    }

}
