package hello.models;

import java.util.regex.Pattern;

public class Test {
    public static void main(String[] args) {
        System.out.println("Hello, World from Java!\n");
        String ssn = "123456789";
        boolean check = (Pattern.matches(
                "^(?!000)(?!666)(?<SSN3>[0-6]\\d{2}|7(?:[0-6]\\d|7[012]))([- ]?)(?!00)(?<SSN2>\\d\\d)\\1(?!0000)(?<SSN4>\\d{4})$",
                ssn) == false) ? false : true;
        System.out.println(check);
    }
}