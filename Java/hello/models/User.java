/**
 * User class.
 *
 * Java Runtime Environment (JRE) version used: 1.8.0_241
 * Java Development Kit (JDK) version used: 1.8.0_212
 * SQLite Java Database Connectivity (JDBC) API version used: 3.30.1
 * SQLite version used: 3.30.1
 *
 * Styling guide: Google Java Style Guide
 *     (https://google.github.io/styleguide/javaguide.html) and
 *     Code Conventions for the Java Programming Language (Oracle: Deprecated)
 *     (https://www.oracle.com/technetwork/java/javase/documentation/codeconvtoc-136057.html)
 *
 * @category  Java
 * @package   hello.models
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

package hello.models;

/**
 * User class.
 */
public class User {

    /**
     * Class properties.
     */
    private long userID;
    private String firstName;
    private String lastName;
    private String email;
    private float score;
    private String creationDate;
    private String comment;

    /**
     * User ID getter.
     *
     * @return The user ID property.
     */
    public long getUserID() {
        return this.userID;
    }

    /**
     * User ID setter.
     *
     * @param userID The user's ID.
     */
    public void setUserID(long userID) {
        if (CommonFunctions.validateUserID(userID)) {
            this.userID = userID;
        } else {
            throw new IllegalArgumentException("User ID cannot be empty, 0, NULL, or FALSE.");
        }
    }

    /**
     * First name getter.
     *
     * @return The first name property.
     */
    public String getFirstName() {
        return this.firstName;
    }

    /**
     * First name setter.
     *
     * @param firstName The user's first name.
     */
    public void setFirstName(String firstName) {
        firstName = firstName.trim();
        if (CommonFunctions.validateText(firstName)) {
            this.firstName = firstName;
        } else {
            throw new IllegalArgumentException("First name cannot be empty or contain illegal characters.");
        }
    }

    /**
     * Last name getter.
     *
     * @return The last name property.
     */
    public String getLastName() {
        return this.lastName;
    }

    /**
     * Last name setter.
     *
     * @param lastName The user's last name.
     */
    public void setLastName(String lastName) {
        lastName = lastName.trim();
        if (CommonFunctions.validateText(lastName)) {
            this.lastName = lastName;
        } else {
            throw new IllegalArgumentException("Last name cannot be empty or contain illegal characters.");
        }
    }

    /**
     * Email getter.
     *
     * @return The email property.
     */
    public String getEmail() {
        return this.email;
    }

    /**
     * Email setter.
     *
     * @param email The user's email address (can be used as a user name).
     */
    public void setEmail(String email) {
        email = email.trim();
        if (CommonFunctions.validateEmail(email)) {
            this.email = email;
        } else {
            throw new IllegalArgumentException(
                    "Email cannot be empty, incorrectly formatted, or contain illegal characters.");
        }
    }

    /**
     * Score getter.
     *
     * @return float The score property.
     */
    public float getScore() {
        return this.score;
    }

    /**
     * Score setter.
     *
     * @param score The user's score from 0.0 to 100.0.
     */
    public void setScore(float score) {
        if (score < 0.0 || score > 100.0) {
            throw new IllegalArgumentException("Score cannot be empty and must be equal to or between 0.0 and 100.0");
        } else {
            this.score = score;
        }
    }

    /**
     * Creation date getter.
     *
     * @return The creation date property.
     */
    public String getCreationDate() {
        return this.creationDate;
    }

    /**
     * Creation date setter.
     *
     * @param creationDate The date the user was added to the database.
     */
    public void setCreationDate(String creationDate) {
        if (CommonFunctions.validateDate(creationDate)) {
            this.creationDate = creationDate;
        } else {
            throw new IllegalArgumentException("Creation date cannot be empty or incorrectly formatted.");
        }
    }

    /**
     * Comment getter.
     *
     * @return The comment property.
     */
    public String getComment() {
        return this.comment;
    }

    /**
     * Comment setter.
     *
     * @param comment Any additional comments.
     */
    public void setComment(String comment) {
        this.comment = comment;
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
    public User(long userID, String firstName, String lastName, String email, float score, String creationDate,
            String comment) {
        this.setUserID(userID);
        this.setFirstName(firstName);
        this.setLastName(lastName);
        this.setEmail(email);
        this.setScore(score);
        this.setCreationDate(creationDate);
        this.comment = comment;
    }
}