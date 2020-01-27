
/**
 * Hello World in Java with database integration.
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

import model.*;

import java.io.File;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Hello {

    private static void helloUsers() {
        System.out.println("Hello, from helloUsers!");
    }

    public static void connect(String PATH_TO_SQLITE_DB) {
        Connection conn = null;
        try {
            // db parameters
            String url = "jdbc:sqlite:" + PATH_TO_SQLITE_DB;
            // create a connection to the database
            conn = DriverManager.getConnection(url);

            System.out.println("Connection to SQLite has been established.");

        } catch (SQLException e) {
            System.out.println(e.getMessage());
        } finally {
            try {
                if (conn != null) {
                    conn.close();
                }
            } catch (SQLException ex) {
                System.out.println(ex.getMessage());
            }
        }
    }

    public static void main(String[] args) {
        System.out.println("Hello, World from Java!");
        File f = new File(CommonFunctions.MODEL_DIR + "DB");
        f.mkdir();
        String PATH_TO_SQLITE_DB = CommonFunctions.MODEL_DIR + "DB" + File.separator + "Users.db";
        System.out.println(PATH_TO_SQLITE_DB);
        connect(PATH_TO_SQLITE_DB);
        helloUsers();
    }
}