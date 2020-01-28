
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

public class Hello {

    /**
     * Note - Only instantiate the User class, never the CommonFunctions and
     * DatabaseFunctions classes. The methods in CommonFunctions and
     * DatabaseFunctions should be accessed in a static way.
     */

    private static void helloUsers() {
        try {
            System.out.println("Hello, from helloUsers!");
            System.out.println("Verifying database exists...");
            if (DatabaseFunctions.databaseExists()) {
                System.out.println("Database is good to go!");
            } else {
                System.out.println("Houston, we had a problem.");
            }
            /*
            System.out.println(CommonFunctions.validateEmail("<script>alert(\"Hello!\");</script>"));
            System.out.println(CommonFunctions.validateEmail("rgarcia@rgprogramming.com"));
            System.out.println(CommonFunctions.validateEmail(" "));
            */
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