export default class Computer {
    constructor(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price) {
        this.brand = brand;
        this.processorSpeed = processorSpeed;
        this.primaryMemorySize = primaryMemorySize;
        this.secondaryMemorySize = secondaryMemorySize;
        this.price = price;
    }
}

class Desktop extends Computer {
    constructor(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price, monitorBrand, keyboardBrand) {
        super(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price);
        this.monitorBrand = monitorBrand;
        this.keyboardBrand = keyboardBrand;
    }

    description() {
        return 'Your system is a ${this.brand} desktop with a ${this.processorSpeed} processor, ${this.primaryMemorySize} RAM, and a ${this.secondaryMemorySize} hard drive.\nIt uses a ${this.monitorBrand} monitor and a ${this.keyboardBrand} keyboard. It cost $${this.price}.';
    }
}

class Laptop extends Computer {
    constructor(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price, weight) {
        super(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price);
        this.monitorBrand = brand;
        this.keyboardBrand = brand;
        this.weight = weight;
    }

    description() {
        return 'Your system is a ${this.brand} laptop with a ${this.processorSpeed} processor, ${this.primaryMemorySize} RAM, and a ${this.secondaryMemorySize} hard drive.\nIt weighs ${this.weight} and cost $${this.price}.';
    }
}

class Tablet extends Computer {
    constructor(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price, weight) {
        super(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price);
        this.monitorBrand = brand;
        this.weight = weight;
    }

    description() {
        return 'Your system is a ${this.brand} tablet with a ${this.processorSpeed} processor, ${this.primaryMemorySize} RAM, and ${this.secondaryMemorySize} of built-in memory.\nIt weighs ${this.weight} and cost $${this.price}.';
    }
}


class SmartPhone extends Computer {
    constructor(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price, weight, carrier) {
        super(brand, processorSpeed, primaryMemorySize, secondaryMemorySize, price);
        this.monitorBrand = brand;
        this.weight = weight;
        this.carrier = carrier;
    }

    description() {
        return 'Your system is a ${this.brand} smart-phone with a ${this.processorSpeed} processor, ${this.primaryMemorySize} RAM, and ${this.secondaryMemorySize} of built-in memory.\nIt weighs ${this.weight} and cost $${this.price}. Your carrier is ${this.carrier}.';
    }
}