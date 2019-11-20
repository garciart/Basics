/**
 * @brief Implementation of all C++ reserved keywords:
 * 
 * and, and_eq, asm, auto, bitand, bitor, bool, break, case, catch, char,
 * class, compl, const, const_cast, continue, default, delete, do, double,
 * dynamic_cast, else, enum, explicit, export, extern, false, float, for,
 * friend, goto, if, inline, int, long, mutable, namespace, new, not, not_eq,
 * operator, or, or_eq, private, protected, public, register, reinterpret_cast,
 * return, short, signed, sizeof, static, static_cast, struct, switch,
 * template, this, throw, true, try, typedef, typeid, typename, union,
 * unsigned, using, virtual, void, volatile, wchar_t, while, xor, and xor_eq
 * 
 * Styling using the Google C++ Style Guide at
 * https://google.github.io/styleguide/cppguide.html
 * 
 * @author  Rob Garcia
 * @version 1.0
 * @see https://en.cppreference.com/w/cpp/keyword
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

#include <iostream>

/**
 * To identify what functions are used by the standard namespace, we will preface each one with "std::",
 * instead of implementing the preprocessor directive "using namespace std;"
 */

int main(int argc, char **argv)
{
    std::cout << "hello, world" << std::endl;
    return EXIT_SUCCESS;
}