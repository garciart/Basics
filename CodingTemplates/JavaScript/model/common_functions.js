/**
 * Summary. Code common to one or more files.
 *
 * Node.js version used: 12.10.0
 * Node Package Manager (npm) version used: 6.13.0
 * SQLite3 (npm) version used: 4.1.1
 * Bluebird (npm) version used: 3.7.2
 *
 * Styling guide: Google Java Style Guide
 *     (https://google.github.io/styleguide/jsguide.html)
 *
 * @category  Basics
 * @package   model
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

/**
 * Functions list:
 * String logError(Exception ex)
 * Boolean validateUserID(long userID)
 * Boolean validateText(String text)
 * Boolean validateEmail(String email)
 * Boolean validateDate(String date)
 */

const fs = require("fs");
const path = require("path")

const MODEL_DIR = __dirname;

const DISPLAY_ERRORS = true;

var CommonFunctions = {

    MODEL_DIR: MODEL_DIR,

    DISPLAY_ERRORS: DISPLAY_ERRORS,

    logError(ex) {
        var exception = null;
        try {
            let dt = new Date(Date.now());
            let timestamp = dt.getFullYear() + "-"
                + ("0" + (dt.getMonth() + 1)).slice(-2) + "-"
                + ("0" + dt.getDate()).slice(-2) + " "
                + ("0" + dt.getHours()).slice(-2) + ":"
                + ("0" + dt.getMinutes()).slice(-2) + ":"
                + ("0" + dt.getSeconds()).slice(-2) + " "
                + Intl.DateTimeFormat().resolvedOptions().timeZone;
            exception = "[" + timestamp + "] " + ex + "\n" + ex.stack + "\n";
            fs.appendFile(MODEL_DIR + path.sep + "error_log.txt", exception, function (err) {
                if (err /* && cf.DISPLAY_ERRORS */) console.error(err);
            });
        }
        catch (exc) {
            // if (cf.DISPLAY_ERRORS) {
            console.error(exc);
            // }
        }
        return exception;
    },

    validateUserID(userID) {
        return userID > 0;
    },

    validateText(text) {
        return (text.trim() == null || !(text.trim()) ||
            /^[A-Za-z0-9 -._~:/?#[\]@!\$&'()\*\+,;=]*$/.test(text.trim()) == false) ? false : true;
    },

    validateEmail(email) {
        return (email.trim() == null || !(email.trim()) ||
            /^[A-Za-z0-9-._~/?#!$&'%*+=`{|}^]+@[A-Za-z0-9.-]+$/.test(email.trim()) == false) ? false : true;
    },

    validateDate(date) {
        return (date.trim() == null || !(date.trim()) ||
            /^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$/.test(date.trim()) == false) ? false : true;
    }
}

module.exports = CommonFunctions;
