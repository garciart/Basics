export default class Challenge {
    fizzBuzz(upperLimit) {
        if (upperLimit < 1) {
            throw "The FizzBuzz method requires a number greater than 0.";
        }
        else {
            var count = 1;
            var fizzBuzzArray = [];
            var index = 0;
            while (count <= upperLimit) {
                switch (true) {
                    case (count % 15 === 0):
                        fizzBuzzArray[index] = "fizzbuzz";
                        break;
                    case (count % 3 === 0):
                        fizzBuzzArray[index] = "fizz";
                        break;
                    case (count % 5 === 0):
                        fizzBuzzArray[index] = "buzz";
                        break;
                    default:
                        fizzBuzzArray[index] = count;
                        break;
                }
                count++;
                index++;
            }
            /*
             * or...
             * fizzBuzzArray[index] = (count % 3 != 0 ? '' : 'fizz') + (count % 5 != 0 ? '' : 'buzz') + (count % 3 != 0 && count % 5 != 0 ? count : '');
             */
            return fizzBuzzArray;
        }
    }

    palindrome(str) {
        /* Check if value is falsy (i.e., matches all possible falsy values (null, undefined, NaN, empty string (""), 0, false) in ECMA-/Javascript) */
        if (!str) {
            throw "The Palindrome method requires a string with 1 or more characters."
        }
        else {
            for (let index = 0; index < str.length / 2; index++) {
                if (str[index] !== str[(str.length - 1) - index]) return false;
            }
            return true;
        }
    }

    variableSwap(swapArray) {
        if (swapArray.length != 2) {
            throw "The Variable Swap method requires an array with two arguments."
        }
        else {
            var temp = swapArray[0];
            swapArray[0] = swapArray[1];
            swapArray[1] = temp;
            return swapArray;
        }
    }
}