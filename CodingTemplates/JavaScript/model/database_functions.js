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
const sqlite3 = require("sqlite3");
const path = require("path")
const promise = require("bluebird");

const PATH_TO_SQLITE_DB = cf.MODEL_DIR + path.sep + "DB" + path.sep + "Users.db";

module.exports = {

    PATH_TO_SQLITE_DB: PATH_TO_SQLITE_DB,

    dfTest() {
        console.log("What, what?");
    },

    createUserTable() {

    },

    createUser(firstName, lastName, email, score, comment) {

    },

    getAllUsers() {},
    getUserByUserID(userID) {},
    getUserByEmail(email) {},
    updateUser(userID, firstName, lastName, email, score, comment) {},
    deleteUser(userID) {},
    getNextUser_id() {},
    userExists(email) {},
    connect() {},
    databaseExists() {},
}
