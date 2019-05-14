let ok: boolean = false;
let decimal: number = 6;
let hex: number = 0xf00d;
let binary: number = 0b1010;
let octal: number = 0o744;

let fullName: string = `Bob Bobbington`;
let age: number = 37;
// let sentence: string = `Hello, my name is ${ fullName }.

let sentence: string = "Hello, my name is " + fullName + ".\n\n" +
    "I'll be " + (age + 1) + " years old next month.";

// let list: number[] = [1, 2, 3];

let list: Array<number> = [1, 2, 3];

// TUPLAS

// Declare a tuple type
let x: [string, number];
// Initialize it
x = ["hello", 10]; // OK

// ENUM
enum Color {Red, Green, Blue}

let c: Color = Color.Green;


// CONSTANTES
const numLivesForCat = 9;
const kitty = {
    name: "Aurora",
    numLives: numLivesForCat,
}

// all "okay"
kitty.name = "Rory";
kitty.name = "Kitty";
kitty.name = "Cat";
kitty.numLives--;