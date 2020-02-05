/**
 * Summary. Hello World in JavaScript with database integration.
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
 * @package   JavaScript
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

const cf = require("./model/common_functions.js");
const df = require("./model/database_functions.js");

function main() {
    console.log("Hello, World from JavaScript!");
    try {
        // throw "Test...";
        console.log("Text good: " + cf.validateText("   "));
        console.log("Email good: " + cf.validateEmail("2020-02-02 15-39-02"));
        console.log("Date good: " + cf.validateDate("2020-02-02 15:39:02"));
        df.databaseExists();
        console.log(df.getNextUserID());
    }
    catch (ex) {
        let exception = cf.logError(ex);
        if (cf.DISPLAY_ERRORS) {
            console.error(exception);
        }
    }
}

main();
