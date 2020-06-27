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
 * @category  Java
 * @package   hello
 * @author    Rob Garcia <rgarcia@rgprogramming.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/garciart/CodersCompanion
 * @copyright 2019-2020 Rob Garcia
 */
package hello;

import java.util.ArrayList;
import java.util.List;

import javax.sql.rowset.CachedRowSet;

import hello.models.CommonFunctions;
import hello.models.DatabaseFunctions;
import hello.models.User;

public class Hello {

    /**
     * Note - Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */

    private static void helloUsers() {
        try {
            // int i = 0; if (i == 0) { throw new Exception("Test..."); }
            System.out.println("Verifying database exists...");
            if (DatabaseFunctions.databaseExists()) {
                System.out.println("Database is good to go!\n");

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
                } else {
                    System.out.println("No records were found.\n");
                }
                result = null;

                System.out.println();

                // Task 2: Add, update, and delete a new user
                User thanos = null;

                if (DatabaseFunctions.userExists("thanos@rgprogramming.com")) {
                    System.out.println("Thanos, you are already in the database!\n");
                    result = DatabaseFunctions.getUserByEmail("thanos@rgprogramming.com");
                    if (result.last() == true) {
                        // Reset the CachedRowSet to the beginning
                        result.beforeFirst();
                        if (result.first()) {
                            thanos = new User(result.getLong("UserID"), result.getString("FirstName"),
                                    result.getString("LastName"), result.getString("Email"), result.getFloat("Score"),
                                    result.getString("CreationDate"), result.getString("Comment"));
                        } else {
                            throw new Exception("Cannot retrieve user data!");
                        }
                    } else {
                        throw new Exception("Cannot retrieve user data!");
                    }
                    result = null;
                } else {
                    System.out.println("Thanos, you are not in the database!\n");
                    long userID = DatabaseFunctions.createUser("Thanos", "The Mad Titan", "thanos@rgprogramming.com",
                            100.0f, "Unbalanced user.");
                    if (userID == 0) {
                        throw new Exception("Cannot create user!");
                    } else {
                        result = DatabaseFunctions.getUserByUserID(userID);
                        if (result.last() == true) {
                            // Reset the CachedRowSet to the beginning
                            result.beforeFirst();
                            if (result.first()) {
                                thanos = new User(result.getLong("UserID"), result.getString("FirstName"),
                                        result.getString("LastName"), result.getString("Email"),
                                        result.getFloat("Score"), result.getString("CreationDate"),
                                        result.getString("Comment"));
                            } else {
                                throw new Exception("Cannot retrieve user data!");
                            }
                        } else {
                            throw new Exception("Cannot retrieve user data!");
                        }
                        System.out.println(
                                String.format("Welcome %s %s! You are #%d, created on %s, and you are a(n) %s\n",
                                        thanos.getFirstName(), thanos.getLastName(), thanos.getUserID(),
                                        thanos.getCreationDate(), thanos.getComment()));
                        result = null;
                    }
                }

                if (thanos.getComment().equals("Unbalanced user.")) {
                    System.out.println("Uh oh, Thanos, you are unbalanced! Let's fix that!\n");
                    thanos.setComment("Balanced user.");
                    if (DatabaseFunctions.updateUser(thanos.getUserID(), thanos.getFirstName(), thanos.getLastName(),
                            thanos.getEmail(), thanos.getScore(), thanos.getComment()) == 1) {
                        System.out.println("Ahh...perfectly balanced. As all things should be.\n");
                    } else {
                        System.out.println("You can't be balanced! Should've gone for the head!\n");
                    }
                } else {
                    thanos.setComment("Unbalanced user.");
                    if (DatabaseFunctions.updateUser(thanos.getUserID(), thanos.getFirstName(), thanos.getLastName(),
                            thanos.getEmail(), thanos.getScore(), thanos.getComment()) == 1) {
                        System.out.println("Thanos, you've become unbalanced!\n");
                    } else {
                        System.out.println("You can't be unbalanced! Should've gone for the head!\n");
                    }
                }

                System.out.println("Sorry, Thanos; I am Iron Man, and you've got to go!\n");

                if (DatabaseFunctions.deleteUser(thanos.getUserID()) == 1) {
                    System.out.println("Thanos deleted. Destiny fulfilled.");
                } else {
                    System.out.println("Thanos cannot be deleted; he is inevitable!");
                }
            } else {
                System.out.println("Unable to connect to the database and retrieve data.");
            }
        } catch (Exception ex) {
            String exception = CommonFunctions.logError(ex);
            if (CommonFunctions.DISPLAY_ERRORS)
                System.out.println(exception);
            else
                System.out.println(
                        "Unable to connect to the database and retrieve data. Check the error log for details.");
        }
    }

    public static void main(String[] args) {
        System.out.println("Hello, World from Java!\n");
        helloUsers();
    }
}