/**
 * User class.
 *
 * C++ version used: C++ 14
 *
 * Styling guide: NRL Radar Division's C++ Coding Standard style guide at https://apps.dtic.mil/dtic/tr/fulltext/u2/a640901.pdf.
 *
 * @category  CPP
 * @package   Hello
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */

#include <iostream>
#include <string>
#include "common_functions.cpp"

using namespace std;

class User
{
private:
    long userID;
    string firstName;
    string lastName;
    string email;
    float score;
    string creationDate;
    string comment;

public:
    /**
     * User ID getter.
     *
     * @return The user ID property.
     */
    long getUserID()
    {
        return userID;
    }

    /**
     * User ID setter.
     *
     * @param userID The user's ID.
     */
    void setUserID(long userID)
    {
        if (validateUserID(userID))
        {
            userID = userID;
        }
        else
        {
            throw "User ID cannot be empty, 0, NULL, or FALSE.";
        }
    }

    /**
     * First name getter.
     *
     * @return The first name property.
     */
    string getFirstName()
    {
        return firstName;
    }

    /**
     * First name setter.
     *
     * @param firstName The user's first name.
     */
    void setFirstName(string firstName)
    {
        firstName = trim(firstName);
        if (validateText(firstName))
        {
            firstName = firstName;
        }
        else
        {
            throw "First name cannot be empty or contain illegal characters.";
        }
    }

    /**
     * Last name getter.
     *
     * @return The last name property.
     */
    string getLastName()
    {
        return lastName;
    }

    /**
     * Last name setter.
     *
     * @param lastName The user's last name.
     */
    void setLastName(string lastName)
    {
        lastName = trim(lastName);
        if (validateText(lastName))
        {
            lastName = lastName;
        }
        else
        {
            throw "Last name cannot be empty or contain illegal characters.";
        }
    }

    /**
     * Email getter.
     *
     * @return The email property.
     */
    string getEmail()
    {
        return email;
    }

    /**
     * Email setter.
     *
     * @param email The user's email address (can be used as a user name).
     */
    void setEmail(string email)
    {
        email = trim(email);
        if (validateEmail(email))
        {
            email = email;
        }
        else
        {
            throw "Email cannot be empty, incorrectly formatted, or contain illegal characters.";
        }
    }

    /**
     * Score getter.
     *
     * @return float The score property.
     */
    float getScore()
    {
        return score;
    }

    /**
     * Score setter.
     *
     * @param score The user's score from 0.0 to 100.0.
     */
    void setScore(float score)
    {
        if (score < 0.0 || score > 100.0)
        {
            throw "Score cannot be empty and must be equal to or between 0.0 and 100.0";
        }
        else
        {
            score = score;
        }
    }

    /**
     * Creation date getter.
     *
     * @return The creation date property.
     */
    string getCreationDate()
    {
        return creationDate;
    }

    /**
     * Creation date setter.
     *
     * @param creationDate The date the user was added to the database.
     */
    void setCreationDate(string creationDate)
    {
        if (validateDate(creationDate))
        {
            creationDate = creationDate;
        }
        else
        {
            throw "Creation date cannot be empty or incorrectly formatted.";
        }
    }

    /**
     * Comment getter.
     *
     * @return The comment property.
     */
    string getComment()
    {
        return comment;
    }

    /**
     * Comment setter.
     *
     * @param comment Any additional comments.
     */
    void setComment(string comment)
    {
        comment = comment;
    }

    /**
     * Class constructor.
     *
     * @param userID       The user's ID.
     * @param firstName    The user's first name.
     * @param lastName     The user's last name.
     * @param email        The user's email address (can be used as a user name).
     * @param score        The user's score from 0.0 to 100.0.
     * @param creationDate The date the user was added to the database.
     * @param comment      Any additional comments.
     */
    User(long userID, string firstName, string lastName, string email, float score, string creationDate,
         string comment)
    {
        setUserID(userID);
        setFirstName(firstName);
        setLastName(lastName);
        setEmail(email);
        setScore(score);
        setCreationDate(creationDate);
        comment = comment;
    }
};