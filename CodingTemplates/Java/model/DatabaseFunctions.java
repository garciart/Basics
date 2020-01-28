/**
 * Handles all calls to the User database.
 * Do not instantiate; the methods in DatabaseFunctions should be accessed in a static way.
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

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;

public class DatabaseFunctions {

    private static final String PATH_TO_SQLITE_DB = CommonFunctions.MODEL_DIR + File.separator + "DB" + File.separator + "Users.db";

    public static int createUserTable() {
        int rowsAffected = -1;
        try {
            Connection conn = connect();
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DisplayErrors)
                System.out.println(exception);
        }
        return rowsAffected;
    }

    private static Connection connect() {
        Connection conn = null;
        try {
            System.out.println("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
            conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DisplayErrors)
                System.out.println(exception);
        }
        return conn;
    }

    /**
     * Creates and populates the database if it does not exist.
     * @return True if the database exists or was create, false if not.
     */
    public static Boolean databaseExists() {
        Boolean exists = false;
        try {
            File dbFolder = new File(CommonFunctions.MODEL_DIR + File.separator + "DB");
            File dbFile = new File(PATH_TO_SQLITE_DB);
            if (!dbFolder.exists() || !dbFile.exists()) {
                // Creates the db directory if it does not exist
                dbFolder.mkdir();
                if(connect() != null) {
                    exists = true;
                }
            }
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DisplayErrors)
                System.out.println(exception);
        }
        return exists;
    }

    /**
     * Only instantiate the User class, never the CommonFunctions and DatabaseFunctions classes.
     * The methods in CommonFunctions and DatabaseFunctions should be accessed in a static way.
     */
    public DatabaseFunctions() {
        System.out.println("Do not instantiate. The methods in DatabaseFunctions should be accessed in a static way.");
    }
}