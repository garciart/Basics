/**
 * Handles all calls to the User database.
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

public class DatabaseFunctions {

    public static final String PATH_TO_SQLITE_DB = CommonFunctions.MODEL_DIR + "DB" + File.separator + "Users.db";

    public int CreateUserTable()
    {
        int rowsAffected = -1;
        try
        {

        }
        catch (Exception ex)
        {
            String exception = CommonFunctions.ErrorLog(ex);
            if (CommonFunctions.DisplayErrors) System.out.println(exception);
        }
        return rowsAffected;
    }

    public DatabaseFunctions() {
        File dbFolder = new File(CommonFunctions.MODEL_DIR + "DB");
        File dbFile = new File(PATH_TO_SQLITE_DB);
        if(!dbFolder.exists() || dbFile.exists()) {
            System.out.println("Creating user database...");
            // Creates the db directory if it does not exist
            dbFolder.mkdirs();
        }


    }
 }