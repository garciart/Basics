/**
 * Code common to one or more files.
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
 * @category  Basics
 * @package   Java
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

package model;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class CommonFunctions {

    public static final String MODEL_DIR = System.getProperty("user.dir") + File.separator + "model" + File.separator;

    public static final Boolean DisplayErrors = true;

    public String ErrorLog(Exception ex) throws IOException
    {
        BufferedWriter errorLog = new BufferedWriter(new FileWriter(MODEL_DIR + "ErrorLog.txt"));
        LocalDateTime localDateTime = LocalDateTime.now();
        DateTimeFormatter dateTimeFormat = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss K");
        String exception = String.format("[{0}] {1}", localDateTime.format(dateTimeFormat), ex.toString());
        errorLog.append(exception);
        errorLog.close();
        return exception;
    }

    public CommonFunctions() throws IOException {
        ErrorLog(new Exception("Test"));
    }
 }