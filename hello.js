/**
 * Implementation of all 32 reserved keywords from C, as well as other common tasks and features, in various languages:
 * 
 * auto, break, case, char, const, continue, default, do,
 * double, else, enum, extern, float, for, goto, if,
 * int, long, register, return, short, signed, sizeof, static,
 * struct, switch, typedef, union, unsigned, void, volatile, and while
 * 
 * Styling using the Google Java Style Guide at https://google.github.io/styleguide/javaguide.html
 * 
 * @author  Rob Garcia
 * @see     Kernighan, B. W., & Ritchie, D. (1988). A.2.4 Keywords. In C Programming Language (2nd ed.). Upper Saddle River, NJ: Prentice Hall.
 * @version 1.0
 * @since   2019-02-11
 */

const PROGRAM_NAME = process.argv[1];
var userName;
var userNameLength = 0;
console.log("Hello, World!");
console.log("My name is " + PROGRAM_NAME + " and I am written in JavaScript.");
/*
 * var readlineSync = require('readline-sync');
 * userName = readlineSync.question("What is your name: ");
 */

var readline = require("readline");

var rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question("What is your name:  ", function(answer) {
  userName = answer;
  rl.close();
});

console.log("Hello " + userName + "!");
userNameLength = userName.length;
console.log("Your name is " + userNameLength + " characters long!");


