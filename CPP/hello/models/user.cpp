/**
 * @brief User class.
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
    long user_id;
    string first_name;
    string last_name;
    string email;
    float score;
    string creation_date;
    string comment;

public:
    /**
     * User ID getter.
     *
     * @return The user ID property.
     */
    long get_user_id()
    {
        return user_id;
    }

    /**
     * User ID setter.
     *
     * @param user_id The user's ID.
     */
    void set_user_id(long user_id)
    {
        try
        {
            if (validate_user_id(user_id))
            {
                user_id = user_id;
            }
            else
            {
                throw "User ID cannot be empty, 0, NULL, or FALSE.";
            }
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_user_id() function.");
        }
    }

    /**
     * First name getter.
     *
     * @return The first name property.
     */
    string get_first_name()
    {
        return first_name;
    }

    /**
     * First name setter.
     *
     * @param first_name The user's first name.
     */
    void set_first_name(string first_name)
    {
        try
        {
            first_name = trim(first_name);
            if (validate_text(first_name))
            {
                first_name = first_name;
            }
            else
            {
                throw "First name cannot be empty or contain illegal characters.";
            }
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_first_name() function.");
        }
    }

    /**
     * Last name getter.
     *
     * @return The last name property.
     */
    string get_last_name()
    {
        return last_name;
    }

    /**
     * Last name setter.
     *
     * @param last_name The user's last name.
     */
    void set_last_name(string last_name)
    {
        try
        {
            last_name = trim(last_name);
            if (validate_text(last_name))
            {
                last_name = last_name;
            }
            else
            {
                throw "Last name cannot be empty or contain illegal characters.";
            }
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_last_name() function.");
        }
    }

    /**
     * Email getter.
     *
     * @return The email property.
     */
    string get_email()
    {
        return email;
    }

    /**
     * Email setter.
     *
     * @param email The user's email address (can be used as a user name).
     */
    void set_email(string email)
    {
        try
        {
            email = trim(email);
            if (validate_email(email))
            {
                email = email;
            }
            else
            {
                throw "Email cannot be empty, incorrectly formatted, or contain illegal characters.";
            }
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_email() function.");
        }
    }

    /**
     * Score getter.
     *
     * @return float The score property.
     */
    float get_score()
    {
        return score;
    }

    /**
     * Score setter.
     *
     * @param score The user's score from 0.0 to 100.0.
     */
    void set_score(float score)
    {
        try
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
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_score() function.");
        }
    }

    /**
     * Creation date getter.
     *
     * @return The creation date property.
     */
    string get_creation_date()
    {
        return creation_date;
    }

    /**
     * Creation date setter.
     *
     * @param creation_date The date the user was added to the database.
     */
    void set_creation_date(string creation_date)
    {
        try
        {
            if (validate_date(creation_date))
            {
                creation_date = creation_date;
            }
            else
            {
                throw "Creation date cannot be empty or incorrectly formatted.";
            }
        }
        catch (exception &ex)
        {
            log_error((string)ex.what() + " in user.set_creation_date() function.");
        }
    }

    /**
     * Comment getter.
     *
     * @return The comment property.
     */
    string get_comment()
    {
        return comment;
    }

    /**
     * Comment setter.
     *
     * @param comment Any additional comments.
     */
    void set_comment(string comment)
    {
        comment = comment;
    }

    /**
     * Class constructor.
     *
     * @param user_id       The user's ID.
     * @param first_name    The user's first name.
     * @param last_name     The user's last name.
     * @param email         The user's email address (can be used as a user name).
     * @param score         The user's score from 0.0 to 100.0.
     * @param creation_date The date the user was added to the database.
     * @param comment       Any additional comments.
     */
    User(long user_id, string first_name, string last_name, string email, float score, string creation_date,
         string comment)
    {
        set_user_id(user_id);
        set_first_name(first_name);
        set_last_name(last_name);
        set_email(email);
        set_score(score);
        set_creation_date(creation_date);
        set_comment(comment);
    }
};