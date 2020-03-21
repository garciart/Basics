/**
 * Summary. User class.
 *
 * Node.js version used: 12.10.0
 * Node Package Manager (npm) version used: 6.13.0
 * SQLite3 (npm) version used: 4.1.1
 * Bluebird (npm) version used: 3.7.2
 *
 * Styling guide: Google Java Style Guide
 *     (https://google.github.io/styleguide/jsguide.html)
 *
 * @category  CodersCompanion
 * @package   model
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */

const cf = require("./common_functions");

function User(userID, firstName, lastName, email, score, creationDate, comment) {
    this.userID = userID;
    this.firstName = firstName;
    this.lastName = lastName;
    this.email = email;
    this.score = score;
    this.creationDate = creationDate;
    this.comment = comment;
}

User.prototype = {
    get userID() {
        return this.userID;
    },
    set userID(userID) {
        if (cf.validateUserID(userID)) {
            this.userID = userID;
        } else {
            throw "User ID cannot be empty, 0, NULL, or FALSE.";
        }
    },

    get firstName() {
        return this.firstName;
    },
    set firstName(firstName) {
        firstName = firstName.trim();
        if (cf.validateText(firstName)) {
            this.firstName = firstName;
        } else {
            throw "First name cannot be empty or contain illegal characters.";
        }
    },

    get lastName() {
        return this.lastName;
    },
    set lastName(lastName) {
        lastName = lastName.trim();
        if (cf.validateText(lastName)) {
            this.lastName = lastName;
        } else {
            throw "Last name cannot be empty or contain illegal characters.";
        }
    },

    get email() {
        return this.email;
    },
    set email(email) {
        email = email.trim();
        if (cf.validateEmail(email)) {
            this.email = email;
        } else {
            throw "Email cannot be empty, incorrectly formatted, or contain illegal characters.";
        }
    },

    get score() {
        return this.score;
    },
    set score(score) {
        if (score < 0.0 || score > 100.0) {
            throw "Score cannot be empty and must be equal to or between 0.0 and 100.0";
        } else {
            this.score = score;
        }
    },

    get creationDate() {
        return this.creationDate;
    },
    set creationDate(creationDate) {
        if (cf.validateDate(creationDate)) {
            this.creationDate = creationDate;
        } else {
            throw "Creation date cannot be empty or incorrectly formatted.";
        }
    },

    get comment() {
        return this.comment;
    },
    set comment(comment) {
        this.comment = creationDate;
    }
}

module.exports = User;