
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

import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import model.*;

public class Hello {

    /**
     * Note - Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */

    private static void helloUsers() {
        try {
            // throw new Exception("Test...");
            System.out.println("Verifying database exists...");
            if (DatabaseFunctions.databaseExists()) {
                System.out.println("Database is good to go!");

                // Task 1: Connect and retrieve information from the database
                CachedRowSet result = DatabaseFunctions.getAllUsers();
                // Continue if the last record in the CachedRowSet is valid
                if (result.last() == true) {
                    // Reset the CachedRowSet to the beginning
                    result.beforeFirst();
                    List<User> listOfUsers = new ArrayList<User>();
                    while (result.next()) {
                        listOfUsers.add(new User(result.getLong("UserID"), result.getString("FirstName"),
                                result.getString("LastName"), result.getString("Email"), result.getFloat("Score"),
                                result.getString("CreationDate"), result.getString("Comment")));
                    }

                    System.out.println(String.format("Number of users in the database: %d", listOfUsers.size()));
                    System.out.println(String.format("The first user is %s.\n", listOfUsers.get(0).getFirstName()));
                    for (User user : listOfUsers) {
                        System.out.println(String.format("Hello %s %s! You are #%d, created on %s, and you are a(n) %s",
                                user.getFirstName(), user.getLastName(), (listOfUsers.indexOf(user)) + 1,
                                user.getCreationDate(), user.getComment()));
                    }
                    result.close();
                } else {
                    System.out.println("No records were found.");
                }

                System.out.println();

            } else {
                System.out.println("Houston, we had a problem.");
            }
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DisplayErrors)
                System.out.println(exception);
            else
                System.out.println(
                        "Unable to connect to the database and retrieve data. Check the error log for details.");
        }

    }

    public static void main(String[] args) {
        System.out.println("Hello, World from Java!");
        helloUsers();
    }
}