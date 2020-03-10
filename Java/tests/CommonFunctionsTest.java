
/**
 * Unit tests using JUnit.
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
package tests;

import org.junit.*;
import static org.junit.Assert.*;
import java.util.*;

import hello.*;
import hello.models.*;

public class CommonFunctionsTest {
    /**
     * One-time initialization code
     */
    @BeforeClass
    public static void oneTimeSetUp() {

    }
 
    /**
     * One-time cleanup code
     */
    @AfterClass
    public static void oneTimeTearDown() {

    }

    /**
     * Code to run before each test
     */
    @Before
    public void setUp() {

    }

    /**
     * Code to run after each test
     */
    @After
    public void tearDown() {

    }

    /**
     * Test that the method rejects values less than or equal to 0.
     */
    @Test
    public void testValidateUserIDFalse() {
        long arg = -1;
        assertFalse(CommonFunctions.validateUserID(arg));
    }

    /**
     * Test that the method accepts values greater than 0.
     */
    @Test
    public void testValidateUserIDTrue() {
        long arg = 1;
        assertTrue(CommonFunctions.validateUserID(arg));
    }

    /*
     * @Test(expected = Exception.class) public void validateUserIDException() {
     * CommonFunctions.validateUserID('a'); }
     */

    /**
     * Test that the method rejects values with invalid characters.
     */
    @Test
    public void testValidateTextFalse() {
        String arg = "<script>alert('This is an injection!');</script>";
        boolean result = CommonFunctions.validateText(arg);
        assertTrue(result == false);
    }

    /**
     * Test that the method accepts values with valid characters.
     */
    @Test
    public void testValidateTextTrue() {
        String arg = "Robert";
        boolean result = CommonFunctions.validateText(arg);
        assertTrue(result == true);
    }

    /**
     * Test that the method rejects values with illegal characters or in incorrect
     * format.
     */
    @Test
    public void testValidateEmailFalse() {
        String arg = "<script>alert('This is an injection!');</script>";
        boolean result = CommonFunctions.validateEmail(arg);
        assertTrue(result == false);
    }

    /**
     * Test that the method accepts values with legal characters and in correct
     * format.
     */
    @Test
    public void testValidateEmailTrue() {
        String arg = "rgarcia@rgprogramming.com";
        boolean result = CommonFunctions.validateEmail(arg);
        assertTrue(result == true);
    }

    /**
     * Test that the method rejects values with illegal characters or in incorrect
     * format.
     */
    @Test
    public void testValidateDateFalse() {
        String arg = "<script>alert('This is an injection!');</script>";
        boolean result = CommonFunctions.validateDate(arg);
        assertTrue(result == false);
    }

    /**
     * Test that the method accepts values with legal characters and in correct
     * format.
     */
    @Test
    public void testValidateDateTrue() {
        String arg = "2020-02-02 12:00:00";
        boolean result = CommonFunctions.validateDate(arg);
        assertTrue(result == true);
    }

    @Test
    public void testMyTest() {
        int arg = 1;
        boolean result = Hello.myTest(arg);
        assertTrue(result == true);
    }
}