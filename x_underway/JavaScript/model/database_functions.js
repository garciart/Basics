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
 * @category  CodersCompanion
 * @package   model
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */

const cf = require("./common_functions");
const fs = require("fs");
const sqlite3 = require("sqlite3").verbose();
const path = require("path")
const promise = require("bluebird");

// Private methods and constants
const PATH_TO_SQLITE_DB = cf.MODEL_DIR + path.sep + "DB" + path.sep + "Users.db";

/*
function connect() {
    let conn = null;
    try {
        conn = new sqlite3.Database(PATH_TO_SQLITE_DB, (err) => {
            if (err) {
                throw err;
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
function run(sql, params = []) {
    return new Promise((resolve, reject) => {
        let conn = connect();
        conn.run(sql, params, function (err) {
            if (err) {
                let error = cf.logError(err);
                if (cf.DISPLAY_ERRORS) {
                    console.error(error);
                }
                reject(err);
            } else {
                resolve({ id: this.lastID })
            }
        })
        conn.close();
    })
}
*/
let bob = 0;

var DatabaseFunctions = {

    createUserTable() {
        console.log("At Create User Table...");
        let rowsAffected = -1;
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            let sql = "DROP TABLE IF EXISTS User;";
            conn.run(sql);
            sql = "CREATE TABLE IF NOT EXISTS User (UserID integer PRIMARY KEY,FirstName text NOT NULL, LastName text NOT NULL, Email text UNIQUE NOT NULL, Score real NOT NULL DEFAULT '100.0', CreationDate text NOT NULL, Comment text);"
            conn.run(sql);
            conn.close();
            rowsAffected = 0;
        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return rowsAffected;
    },

    createAndPopulateUserTable() {
        console.log("At Create and Populate User Table...");
        let rowsAffected = -1;
        let nextUserID = 0;
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            conn.serialize(function () {
                let sql = "DROP TABLE IF EXISTS User;";
                conn.run(sql);
                sql = "CREATE TABLE IF NOT EXISTS User (UserID integer PRIMARY KEY,FirstName text NOT NULL, LastName text NOT NULL, Email text UNIQUE NOT NULL, Score real NOT NULL DEFAULT '100.0', CreationDate text NOT NULL, Comment text);"
                conn.run(sql);
                sql = "INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?);";
                let stmt = conn.prepare(sql);
                let dt = new Date(Date.now());
                let creationDate = dt.getFullYear() + "-"
                    + ("0" + (dt.getMonth() + 1)).slice(-2) + "-"
                    + ("0" + dt.getDate()).slice(-2) + " "
                    + ("0" + dt.getHours()).slice(-2) + ":"
                    + ("0" + dt.getMinutes()).slice(-2) + ":"
                    + ("0" + dt.getSeconds()).slice(-2);

                stmt.run(1, "Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0, creationDate, "Administrator.");
                stmt.finalize();
                sql = "SELECT MAX(UserID) as maxUserID FROM User;";
                conn.each(sql, function (err, row) {
                    console.log("Max user ID = " + row.maxUserID);
                    nextUserID = row.maxUserID + 1;
                });
                sql = "INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?);";
                stmt = conn.prepare(sql);
                stmt.run(nextUserID, "Baby", "Yoda", "byoda@rgprogramming.com", 100.0, creationDate, "New user.");
                stmt.finalize();
                sql = "SELECT MAX(UserID) as maxUserID FROM User;";
                conn.each(sql, function (err, row) {
                    console.log("Max user ID = " + row.maxUserID);
                    nextUserID = row.maxUserID + 1;
                });
            });

            conn.close();
            console.log("Next user ID = " + nextUserID);
            rowsAffected = 0;
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
        let lastRowID = 0;
        console.log("At Create User...");
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            let sql = "INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?);";
            let stmt = conn.prepare(sql);
            let userID = this.getNextUserID();
            let dt = new Date(Date.now());
            let creationDate = dt.getFullYear() + "-"
                + ("0" + (dt.getMonth() + 1)).slice(-2) + "-"
                + ("0" + dt.getDate()).slice(-2) + " "
                + ("0" + dt.getHours()).slice(-2) + ":"
                + ("0" + dt.getMinutes()).slice(-2) + ":"
                + ("0" + dt.getSeconds()).slice(-2);
            console.log("User ID: " + userID);
            console.log("Creation Date: " + creationDate);
            stmt.run(userID, firstName, lastName, email, score, creationDate, comment);
            stmt.finalize();
            conn.close();
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
        let rowsAffected = 0;
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            conn.close();
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
        let rowsAffected = 0;
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            conn.close();
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
        /*
        let nextUserID = 0;
        try {
            let conn = new sqlite3.Database(PATH_TO_SQLITE_DB);
            let sql = "SELECT MAX(UserID) as maxUserID FROM User;";
            result = conn.get(sql, function (err, row) {
                return row.maxUserID;
            });
            if (result == undefined) {
                nextUserID = 10;
            }
            else {
                console.log(result);
                nextUserID = 100;
            }
            conn.close();
        }
        catch (ex) {
            let exception = cf.logError(ex);
            if (cf.DISPLAY_ERRORS) {
                console.error(exception);
            }
        }
        return nextUserID + 1;
        */
        bob = bob + 1;
        return bob;
    },
    userExists(email) {
        let exists = false;
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
        let exists = true;
        try {
            let dbFolder = cf.MODEL_DIR + path.sep + "DB";
            if (!fs.existsSync(dbFolder)) {
                fs.mkdirSync(dbFolder);
                this.createAndPopulateUserTable();
                /*
                if (this.createUserTable() == 0) {
                    this.createUser("Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0, "Administrator.");
                    this.createUser("Baby", "Yoda", "byoda@rgprogramming.com", 100.0, "New user.");
                    this.createUser("John", "Adams", "jadams@rgprogramming.com", 90.0, "Old user.");
                }
                */
            }
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