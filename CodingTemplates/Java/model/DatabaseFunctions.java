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
 * @package   Model
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/Basics
 * @copyright 2019-2020 Rob Garcia
 */

package model;

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.Date;

import javax.sql.rowset.CachedRowSet;
import javax.sql.rowset.RowSetFactory;
import javax.sql.rowset.RowSetProvider;

public class DatabaseFunctions {

    /**
     * Sets the path to the user database.
     */
    private static final String PATH_TO_SQLITE_DB = CommonFunctions.MODEL_DIR + File.separator + "DB" + File.separator
            + "Users.db";

    /**
     * Creates the User table if it does not exist in the database.
     * 
     * @return The number of rows affected. Both DROP and CREATE should return 0.
     */
    public static int createUserTable() {
        int rowsAffected = -1;
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                Statement stmt = conn.createStatement()) {
            String sql = "DROP TABLE IF EXISTS User;";
            rowsAffected = stmt.executeUpdate(sql);
            sql = "CREATE TABLE IF NOT EXISTS User (" + "UserID integer PRIMARY KEY," + "FirstName text NOT NULL,"
                    + "LastName text NOT NULL," + "Email text UNIQUE NOT NULL," + "Score real NOT NULL DEFAULT '100.0',"
                    + "CreationDate text NOT NULL," + "Comment text);";
            rowsAffected = stmt.executeUpdate(sql);
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowsAffected;
    }

    /**
     * Inserts a new user into the database.
     * 
     * @param firstName The user's first name.
     * @param lastName  The user's last name.
     * @param email     The user's email address (used for user name).
     * @param score     The user's score from 0.0 to 100.0.
     * @param comment   Any additional comments.
     * 
     * @return The rowid of the new user. A value of 0 indicates an error.
     */
    public static long createUser(String firstName, String lastName, String email, float score, String comment) {
        long lastRowID = 0;
        String sql = "INSERT INTO User VALUES (?, ?, ?, ?, ?, ?, ?);";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
            String creationDate = simpleDateFormat.format(new Date());
            pstmt.setLong(1, getNextUserID());
            pstmt.setString(2, firstName);
            pstmt.setString(3, lastName);
            pstmt.setString(4, email);
            pstmt.setFloat(5, score);
            pstmt.setString(6, creationDate);
            pstmt.setString(7, comment);
            int rowsAffected = pstmt.executeUpdate();
            if (rowsAffected == 0) {
                throw new SQLException("Creating user failed, no rows affected.");
            } else {
                try (ResultSet generatedKeys = pstmt.getGeneratedKeys()) {
                    if (generatedKeys.next()) {
                        lastRowID = generatedKeys.getLong(1);
                    } else {
                        throw new SQLException("Creating user failed, no ID obtained.");
                    }
                }
            }
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return lastRowID;
    }

    /**
     * Gets all the users in the database and their information.
     * 
     * @return A cachedRowSet of all the users in the database and their
     *         information. An empty array indicates an error.
     */
    public static CachedRowSet getAllUsers() {
        // Must use CacheRowSet to save the ResultSet after the connection closes
        CachedRowSet rowset = null;
        String sql = "SELECT * FROM User ORDER BY UserID ASC;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                Statement stmt = conn.createStatement()) {
            ResultSet result = stmt.executeQuery(sql);
            // Create factory here since its SQLException must be caught
            RowSetFactory factory = RowSetProvider.newFactory();
            rowset = factory.createCachedRowSet();
            rowset.populate(result);
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowset;
    }

    /**
     * Returns a single user and his or her information.
     * 
     * @param userID The user's ID.
     * 
     * @return The user's information indexed by column name or empty if the user's
     *         ID is not found.
     */
    public static CachedRowSet getUserByUserID(long userID) {
        // Must use CacheRowSet to save the ResultSet after the connection closes
        CachedRowSet rowset = null;
        String sql = "SELECT * FROM User WHERE UserID = ?;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setLong(1, userID);
            ResultSet result = pstmt.executeQuery();
            // Create factory here since its SQLException must be caught
            RowSetFactory factory = RowSetProvider.newFactory();
            rowset = factory.createCachedRowSet();
            rowset.populate(result);
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowset;
    }

    /**
     * Returns a single user and his or her information.
     * 
     * @param email The user's email.
     * 
     * @return The user's information indexed by column name or empty if the user's
     *         email is not found.
     */
    public static CachedRowSet getUserByEmail(String email) {
        // Must use CacheRowSet to save the ResultSet after the connection closes
        CachedRowSet rowset = null;
        String sql = "SELECT * FROM User WHERE Email = ?;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, email);
            ResultSet result = pstmt.executeQuery();
            // Create factory here since its SQLException must be caught
            RowSetFactory factory = RowSetProvider.newFactory();
            rowset = factory.createCachedRowSet();
            rowset.populate(result);
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowset;
    }

    /**
     * Updates a user's information in the database.
     * 
     * @param userID    The user's ID.
     * @param firstName The user's first name.
     * @param lastName  The user's last name.
     * @param email     The user's email address (used for user name).
     * @param score     The user's score from 0.0 to 100.0.
     * @param comment   Any additional comments.
     * 
     * @return The number of rows affected. A value other than 1 indicates an error.
     */
    public static int updateUser(long userID, String firstName, String lastName, String email, float score,
            String comment) {
        int rowsAffected = 0;
        String sql = "UPDATE User SET FirstName = ?, LastName = ?, Email = ?, Score = ?, Comment = ? WHERE UserID = ?;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, firstName);
            pstmt.setString(2, lastName);
            pstmt.setString(3, email);
            pstmt.setFloat(4, score);
            pstmt.setString(5, comment);
            pstmt.setLong(6, userID);
            rowsAffected = pstmt.executeUpdate();
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowsAffected;
    }

    /**
     * Deletes a user from the database.
     * 
     * @param userID The user's ID.
     * 
     * @return The number of rows affected. A value other than 1 indicates an error.
     */
    public static int deleteUser(long userID) {
        int rowsAffected = 0;
        String sql = "DELETE FROM User WHERE UserID = ?;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setLong(1, userID);
            rowsAffected = pstmt.executeUpdate();
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return rowsAffected;
    }

    /**
     * Gets the anticipated value of the next UserID (usually the last row inserted)
     * from the User table.
     * 
     * @return The value of the next UserID or 0 if there is no data.
     */
    public static long getNextUserID() {
        long lastRowID = 0;
        String sql = "SELECT MAX(UserID) as maxUserID FROM User;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                Statement stmt = conn.createStatement()) {
            ResultSet result = stmt.executeQuery(sql);
            lastRowID = result.getLong("maxUserID") + 1;
            return lastRowID;
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return lastRowID;
    }

    /**
     * Checks if the given users exists in the database. Julen Pardo came up with
     * this. Thought about changing the method to retrieve the UserID instead, but
     * Email is supposed to be unique. If the count != 1, that means there are no
     * users or more than one, which means something is wrong. This is a better
     * method.
     * 
     * @param email The email to check.
     * 
     * @return True if the users exists, false if not.
     */
    public static Boolean userExists(String email) {
        Boolean exists = false;
        String sql = "SELECT COUNT(*) AS Count FROM User WHERE Email = ?;";
        try (Connection conn = DriverManager.getConnection("jdbc:sqlite:" + PATH_TO_SQLITE_DB);
                PreparedStatement pstmt = conn.prepareStatement(sql)) {
            pstmt.setString(1, email);
            ResultSet result = pstmt.executeQuery();
            int count = result.getInt("Count");
            exists = count == 1 ? true : false;
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return exists;
    }

    /**
     * Creates and populates the database if it does not exist.
     * 
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
                // Creates the db file if it does not exist
                exists = (createUserTable() == 0) ? true : false;
                // Set initial values
                exists = (createUser("Rob", "Garcia", "rgarcia@rgprogramming.com", 80.0f, "Administrator.") != 0) ? true
                        : false;
                exists = (createUser("John", "Adams", "jadams@rgprogramming.com", 90.0f, "Old user.") != 0) ? true
                        : false;
                exists = (createUser("Baby", "Yoda", "byoda@rgprogramming.com", 100.0f, "New user.") != 0) ? true
                        : false;
            } else {
                exists = true;
            }
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
        }
        return exists;
    }

    /**
     * Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */
    public DatabaseFunctions() {
        System.out.println("Do not instantiate. The methods in DatabaseFunctions should be accessed in a static way.");
    }
}