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

    private $_userID;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_score;
    private $_createDate;
    private $_comment;

    public function __construct($userID, $firstName, $lastName, $email, $score, $createDate, $comment) {
        $this->setUserID($userID);
        $this->setUsername($firstName);
        $this->setNickname($lastName);
        $this->setEmail($email);
        $this->setRoleID($score);
        $this->setCreateDate($createDate);
        $this->setComment($comment);
    }

    public function getUserID() {
        return $this->_userID;
    }

    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    function getFirstName() {
        return $this->_firstName;
    }

    public function setFirstName($firstName) {
        $this->_firstName = $firstName;
    }

    function getLastName() {
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
