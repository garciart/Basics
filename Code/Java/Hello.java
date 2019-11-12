
/**
 * @brief Implementation of all Java reserved keywords:
 * 
 * abstract, assert, boolean, break, byte, case, catch, char, class, const,
 * continue, default, do, double, else, enum, extends, false, final, finally,
 * float, for, goto, if, implements, import, instanceof, int, interface, long,
 * native, new, null, package, private, protected, public, return, short,
 * static, strictfp, super, switch, synchronized, this, throw, throws,
 * transient, true, try, void, volatile, and while
 * 
 * Styling using the Google Java Style Guide at
 * https://google.github.io/styleguide/javaguide.html
 * 
 * @author  Rob Garcia
 * @version 1.0
 * @see https://www.php.net/manual/en/reserved.keywords.php
 * @since   2019-02-10
 * 
 * The MIT License
 *
 * Copyright 2019 Rob Garcia at rgarcia@rgprogramming.com.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

import java.util.Scanner;

public class Hello {

    public static int main(String[] args) {
        // Unlike C/C++, Java does not include the program name in its command-line
        // arguments, so args[0] does not exist
        System.out.println("hello, world");
        return 0;
    }
}