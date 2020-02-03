/**
 * Summary. Handles all calls to the User database.
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

const cf = require("./common_functions");
const fs = require("fs");
const sqlite3 = require("sqlite3");
const path = require("path")
const promise = require("bluebird");

// Private methods and constants
const PATH_TO_SQLITE_DB = cf.MODEL_DIR + path.sep + "DB" + path.sep + "Users.db";

function connect() {
    var conn = null;
    try {
        conn = new sqlite3.Database(PATH_TO_SQLITE_DB, (err) => {
            if (err) {
                console.log('Could not connect to database', err)
            } else {
                console.log('Connected to database')
            }
        })
    }
    catch (ex) {
        let exception = cf.logError(ex);
        if (cf.DISPLAY_ERRORS) {
            console.error(exception);
        }
    }
    return conn;
}

var DatabaseFunctions = {

    createUserTable() {
        var rowsAffected = -1;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return rowsAffected;
    },

    createUser(firstName, lastName, email, score, comment) {
        var lastRowID = 0;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return lastRowID;
    },

    getAllUsers() {

    },

    getUserByUserID(userID) { },
    getUserByEmail(email) { },
    updateUser(userID, firstName, lastName, email, score, comment) {
        var rowsAffected = 0;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return rowsAffected;
    },
    deleteUser(userID) {
        var rowsAffected = 0;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return rowsAffected;
    },
    getNextUserID() {
        var lastRowID = 0;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return lastRowID;
    },
    userExists(email) {
        var exists = false;
        try {

        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return exists;
    },
    databaseExists() {
        var exists = true;
        try {
            let dbFolder = cf.MODEL_DIR + path.sep + "DB";
            if (!fs.existsSync(dbFolder)) {
                fs.mkdirSync(dbFolder);
            }
            connect();
        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return exists;
    },
}

module.exports = DatabaseFunctions;