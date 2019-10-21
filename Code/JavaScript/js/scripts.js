import Challenges from './challenges.js';

var c = new Challenges();
var upperLimit = prompt("Enter a number from 1 to 100:");
if (upperLimit != null) {
    try {
        console.log(c.fizzBuzz(upperLimit));
    }
    catch(ex) {
        console.log("Error: " + ex);
    }
}

var str = prompt("Enter a word to check if it is a palindrome:");
if (str != null) {
    try {
        console.log(str + (c.palindrome(str.toLowerCase()) ? " is" : " is not") + " a palindrome.");
    }
    catch(ex) {
        console.log("Error: " + ex);
    }
}

var swapArray = [1, 2];
console.log("Swapping " + swapArray + " = " + c.variableSwap(swapArray));
