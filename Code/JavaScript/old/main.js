// import Computer from './computer.js';

function getComputerType() {
    var eID = document.getElementById("computerType");
    var computerTypeValue = eID.options[eID.selectedIndex].value;
    var computerTypeName = eID.options[eID.selectedIndex].text;
    var element = document.getElementById("specsDiv");
    element.innerHTML = "";
    element.appendChild(createParagraph(getComputerBrand()));
    element.appendChild(createParagraph(getComputerProcessorSpeed()));
    element.appendChild(createParagraph(getComputerPrimaryMemorySize()));
    element.appendChild(createParagraph(getComputerSecondaryMemorySize()));
    element.appendChild(createParagraph(getComputerPrice()));
    if (computerTypeValue === '1') {
        element.appendChild(createParagraph(getComputerMonitorBrand()));
        element.appendChild(createParagraph(getComputerKeyboardBrand()));
    }
    if (computerTypeValue === '2' || computerTypeValue === '3' || computerTypeValue === '4') {
        element.appendChild(createParagraph(getComputerWeight()));
    }
    if (computerTypeValue === '4') {
        element.appendChild(createParagraph(getComputerCarrier()));
    }
}

function createParagraph(node) {
    var para = document.createElement("p");
    para.appendChild(node);
    return para;
}

function getComputerBrand() {
    var node = document.createTextNode("Enter the brand:");
    return node;
}

function getComputerProcessorSpeed() {
    return document.createTextNode("Enter the processor speed:");
}

function getComputerPrimaryMemorySize() {
    return document.createTextNode("Enter the RAM size:");
}

function getComputerSecondaryMemorySize() {
    return document.createTextNode("Enter the disk or card size:");
}

function getComputerPrice() {
    return document.createTextNode("Enter the price:");
}


function getComputerMonitorBrand() {
    return document.createTextNode("Enter the monitor's brand:");
}


function getComputerKeyboardBrand() {
    return document.createTextNode("Enter the keyboard's brand:");
}


function getComputerWeight() {
    return document.createTextNode("Enter the weight:");
}


function getComputerCarrier() {
    return document.createTextNode("Enter the carrier:");
}

function fizzBuzz(upperLimit) {
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

function palindrome(str) {
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

function variableSwap(swapArray) {
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