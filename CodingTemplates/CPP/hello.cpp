/**
 * @brief Template for C++ language coding. Styling using the Google C++ Style Guide at https://google.github.io/styleguide/cppguide.html.
 * @author  Copyright 2019 Rob Garcia at rgarcia@rgprogramming.com.
 * @version 1.0
 * @since   2019-02-10
 * @see     https://en.cppreference.com/w/cpp/keyword
 * 
 * The MIT License
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

/* ========== Include files and other header files ========== */

#include <iostream>

/* ========== Constants, #define, and enum statements ========== */

/* ========== Public Datatypes ========== */

/* ========== Public Function prototypes ========== */

int main(int argc, char **argv)
{
    /**
     * To identify what functions are used by the standard namespace, we will preface each one with "std::",
     * instead of implementing the preprocessor directive "using namespace std;"
     */
    std::cout << "hello, world" << std::endl;
    return EXIT_SUCCESS;
}