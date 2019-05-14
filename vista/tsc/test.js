var ok = false;
var decimal = 6;
var hex = 0xf00d;
var binary = 10;
var octal = 484;
var fullName = "Bob Bobbington";
var age = 37;
// let sentence: string = `Hello, my name is ${ fullName }.
var sentence = "Hello, my name is " + fullName + ".\n\n" +
    "I'll be " + (age + 1) + " years old next month.";
// let list: number[] = [1, 2, 3];
var list = [1, 2, 3];
// TUPLAS
// Declare a tuple type
var x;
// Initialize it
x = ["hello", 10]; // OK
// ENUM
var Color;
(function (Color) {
    Color[Color["Red"] = 0] = "Red";
    Color[Color["Green"] = 1] = "Green";
    Color[Color["Blue"] = 2] = "Blue";
})(Color || (Color = {}));
var c = Color.Green;
// CONSTANTES
var numLivesForCat = 9;
var kitty = {
    name: "Aurora",
    numLives: numLivesForCat
};
// all "okay"
kitty.name = "Rory";
kitty.name = "Kitty";
kitty.name = "Cat";
kitty.numLives--;
