/**
 * Code common to one or more files.
 * Do not instantiate; the methods in CommonFunctions should be accessed in a static way.
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
 * @package   Model
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

package model;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.regex.Pattern;

public class CommonFunctions {

    /**
     * Get the application's model directory.
     * 
     * @return The application's model directory.
     */
    public static final String MODEL_DIR = System.getProperty("user.dir") + File.separator + "model";

    /**
     * Set the visibility of errors. Set to True to log and display during
     * development and to False to only log during production.
     */
    public static final Boolean DISPLAY_ERRORS = true;

    /**
     * Reformats error and exception details and records them in plain text in the
     * error_log file.
     * 
     * @param ex The exception's details.
     * @return Reformated error and exception details in plain text.
     */
    public static String logError(Exception ex) {
        String exception = null;
        try (BufferedWriter errorLog = new BufferedWriter(
                new FileWriter(MODEL_DIR + File.separator + "ErrorLog.txt", true))) {
            SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss z");
            exception = String.format("[%s] ", simpleDateFormat.format(new Date()));
            StackTraceElement[] stackTrace = ex.getStackTrace();
            for (StackTraceElement s : stackTrace) {
                exception += String.format("- %s in %s on line %s.\n", ex.toString(), s.getFileName(),
                        s.getLineNumber());
            }
            errorLog.append(exception);
            errorLog.close();
        } catch (Exception exc) {
            // if (CommonFunctions.DISPLAY_ERRORS)
            System.out.println(exc.toString());
        }
        return exception;
    }

    /**
     * Validate UserID.
     * 
     * @param userID The UserID that will be entered in the database.
     * @return True if the UserID is an integer greater than 0, false if not.
     */
    public static Boolean validateUserID(long userID) {
        return userID > 0;
    }

    /**
     * Validate text input.
     * 
     * @param text The text that will be entered into the database.
     * @return True if the text is valid, false if not.
     */
    public static Boolean validateText(String text) {
        return (text.trim() == null || text.trim().isEmpty()
                || (Pattern.matches("^[A-Za-z0-9\\s\\-._~:\\/?#\\[\\]@!$&'()*+,;=]*$", text) == false)) ? false : true;
    }

    /**
     * Validate email address.
     * 
     * @param email The email address that will be entered into the database.
     * @return True if the email is valid, false if not.
     */
    public static Boolean validateEmail(String email) {
        return (email.trim() == null || email.trim().isEmpty()
                || (Pattern.matches("^[A-Za-z0-9\\-._~\\/?#!$&'%*+=`{|}^]+@[A-Za-z0-9.-]+$", email) == false)) ? false
                        : true;
    }

    /**
     * Validate date format.
     * 
     * @param date The date that will be entered into the database.
     * @return True if the date format is valid, false if not.
     */
    public static Boolean validateDate(String date) {
        return (date.trim() == null || date.trim().isEmpty() || date.length() != 19 || (Pattern
                .matches("^([0-9]){4}-([0-9]){2}-([0-9]){2} ([0-9]){2}:([0-9]){2}:([0-9]){2}$", date) == false)) ? false
                        : true;
    }

    /**
     * Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */
    public CommonFunctions() {
        System.out.println("Do not instantiate. The methods in CommonFunctions should be accessed in a static way.");
        System.exit(-1);
    }
}