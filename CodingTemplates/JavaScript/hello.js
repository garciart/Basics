/**
 * Hello World in JavaScript with database integration.
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

var cf = require('./model/common_functions');

init = function () {
    console.log("Hello, World from JavaScript!");
    try {
        cf.test();
        console.log(cf.DISPLAY_ERRORS);
        console.log(cf.validateUserID(a));
    }
    catch (ex) {
        exception = cf.logError(ex);
        if (cf.DISPLAY_ERRORS) {
            console.error(exception);
        }
    }
}

init();
