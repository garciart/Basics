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

const MODEL_DIR = __dirname;

const DISPLAY_ERRORS = true;

module.exports = {
    MODEL_DIR: MODEL_DIR,

    DISPLAY_ERRORS: DISPLAY_ERRORS,

    test: function () {
        console.log("Display Errors: " + DISPLAY_ERRORS);
        console.log("Model Directory: " + MODEL_DIR);
    },

    logError: function (ex) {
        let dt = new Date(Date.now());
        let timestamp = dt.getFullYear() + "-"
            + ("0" + (dt.getMonth() + 1)).slice(-2) + "-"
            + ("0" + dt.getDate()).slice(-2) + " "
            + ("0" + dt.getHours()).slice(-2) + ":"
            + ("0" + dt.getMinutes()).slice(-2) + ":"
            + ("0" + dt.getSeconds()).slice(-2) + " "
            + Intl.DateTimeFormat().resolvedOptions().timeZone;
        let exception = "[" + timestamp + "] " + ex.stack + "\n";
        fs.appendFile(MODEL_DIR + "/error_log.txt", exception, function (err) {
            if (err) console.log(err);
        });
        return exception;
    },

    validateUserID: function (userID) {
        return userID > 0;
    },

    validateText: function (text) {

    },

    validateEmail: function (email) {

    },

    validateDate: function (date) {

    },

    area: function (width, height) {
        return width * height;
    }
}

