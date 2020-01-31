<?php
/**
 * User class.
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
 * @copyright Copyright 2019-2020, Rob Garcia
 */

namespace Model;

// Include this file to access common functions and variables
require_once 'CommonFunctions.php';

/**
 * User class.
 *
 * @category  Basics
 * @package   PHP
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright Copyright 2019-2020, Rob Garcia
 */
class User
{
    /**
     *  Class properties.
     */
    private $_userID;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_score;
    private $_creationDate;
    private $_comment;

    /**
     * User ID getter.
     *
     * @return integer The user ID property.
     */
    public function getUserID()
    {
        return $this->_userID;
    }

    /**
     * User ID setter.
     *
     * @param integer $userID The user's ID.
     *
     * @return void
     */
    public function setUserID($userID)
    {
        if (validateUserID($userID)) {
            $this->_userID = $userID;
        } else {
            throw new \InvalidArgumentException(
                'User ID cannot be empty, 0, NULL, or FALSE.'
            );
        }
    }

    /**
     * First name getter.
     *
     * @return string The first name property.
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * First name setter.
     *
     * @param string $firstName The user's first name.
     *
     * @return void
     */
    public function setFirstName($firstName)
    {
        $firstName = trim($firstName);
        if (validateText($firstName)) {
            $this->_firstName = $firstName;
        } else {
            throw new \InvalidArgumentException(
                'First name cannot be empty or contain illegal characters.'
            );
        }
    }

    /**
     * Last name getter.
     *
     * @return string The last name property.
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * Last name setter.
     *
     * @param string $lastName The user's last name.
     *
     * @return void
     */
    public function setLastName($lastName)
    {
        $firstName = trim($lastName);
        if (validateText($lastName)) {
            $this->_lastName = $lastName;
        } else {
            throw new \InvalidArgumentException(
                'Last name cannot be empty or contain illegal characters.'
            );
        }
    }

    /**
     * Email getter.
     *
     * @return string The email property.
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Email setter.
     *
     * @param string $email The user's email address (can be used as a user name).
     *
     * @return void
     */
    public function setEmail($email)
    {
        $email = trim($email);
        if (validateEmail($email)) {
            $this->_email = $email;
        } else {
            throw new \InvalidArgumentException(
                'Email cannot be empty, incorrectly formatted, or contain ' .
                'illegal characters.'
            );
        }
    }

    /**
     * Score getter.
     *
     * @return float The score property.
     */
    public function getScore()
    {
        return $this->_score;
    }

    /**
     * Score setter.
     *
     * @param float $score The user's score from 0.0 to 100.0.
     *
     * @return void
     */
    public function setScore($score)
    {
        if (($score == "" || $score == null || $score == false || $score == array())
            || ($score < 0.0 || $score > 100.0)) {
            throw new \InvalidArgumentException(
                'Score cannot be empty and must be equal to or between 0.0 and 100.0'
            );
        } else {
            $this->_score = $score;
        }
    }

    /**
     * Creation date getter.
     *
     * @return string The creation date property.
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * Creation date setter.
     *
     * @param string $creationDate The date the user was added to the database.
     *
     * @return void
     */
    public function setCreationDate($creationDate)
    {
        if (validateDate($creationDate)) {
            $this->_creationDate = $creationDate;
        } else {
            throw new \InvalidArgumentException(
                'Creation date cannot be empty or incorrectly formatted.'
            );
        }
    }

    /**
     * Comment getter.
     *
     * @return string The comment property.
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * Comment setter.
     *
     * @param string $comment Any additional comments.
     *
     * @return void
     */
    public function setComment($comment)
    {
        $this->_comment = $comment;
    }

    /**
     * Class constructor.
     *
     * @param integer $userID       The user's ID.
     * @param string  $firstName    The user's first name.
     * @param string  $lastName     The user's last name.
     * @param string  $email        The user's email address (can be used as a user name).
     * @param float   $score        The user's score from 0.0 to 100.0.
     * @param string  $creationDate The date the user was added to the database.
     * @param string  $comment      Any additional comments.
     *
     * @return void
     */
    public function __construct($userID, $firstName, $lastName, $email, $score,
        $creationDate, $comment
    ) {
        $this->setUserID($userID);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setScore($score);
        $this->setCreationDate($creationDate);
        $this->_comment = $comment;
    }
}
