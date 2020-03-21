/**
 * Connect to web server by running node app.js and visiting http://localhost:3000.
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
 * @package   JavaScript
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */

const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');
    res.end('Hello, World from JavaScript!');
});

server.listen(port, hostname, () => {
    console.log("Server running at http://" + hostname + ":" + port + "/");
});