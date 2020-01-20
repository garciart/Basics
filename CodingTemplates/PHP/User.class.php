<?php

/**
 * User class.
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

class User
{

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
    public function __construct($userID, $firstName, $lastName, $email, $score, $createDate, $comment)
    {
        $this->setUserID($userID);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setScore($score);
        $this->setCreateDate($createDate);
        $this->_comment = $comment;
    }

    // Class methods:
    public function getUserID()
    {
        return $this->_userID;
    }

    public function setUserID($userID)
    {
        if (empty($userID)) {
            throw new \InvalidArgumentException('User ID cannot be empty, 0, NULL, or FALSE.');
        } else {
            $this->_userID = $userID;
        }
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setFirstName($firstName)
    {
        if (empty($firstName)) {
            throw new \InvalidArgumentException('First name cannot be empty, 0, NULL, or FALSE.');
        } else {
            $this->_firstName = $firstName;
        }
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setLastName($lastName)
    {
        if (empty($lastName)) {
            throw new \InvalidArgumentException('Last name cannot be empty, 0, NULL, or FALSE.');
        } else {
            $this->_lastName = $lastName;
        }
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException('Email cannot be empty, 0, NULL, or FALSE.');
        } else {
            $this->_email = $email;
        }
    }

    public function getScore()
    {
        return $this->_score;
    }

    public function setScore($score)
    {
        if ($score == "" || $score == null || $score == false || $score == array()) {
            throw new \InvalidArgumentException('Score cannot be empty, NULL, or FALSE.');
        } else if ($score < 0.0 || $score > 100.0) {
            throw new \OutOfRangeException('Score must be equal to or between 0.0 and 100.0');
        } else {
            $this->_score = $score;
        }
    }

    public function getCreateDate()
    {
        return $this->_createDate;
    }

    public function setCreateDate($createDate)
    {
        if (empty($createDate)) {
            throw new \InvalidArgumentException('Create date cannot be empty, 0, NULL, or FALSE.');
        } else {
            $this->_createDate = $createDate;
        }
    }

    public function getComment()
    {
        return $this->_comment;
    }

    public function setComment($comment)
    {
        $this->_comment = $comment;
    }

}
