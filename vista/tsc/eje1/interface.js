function saludar(persona) {
    return "Hola, " + persona.nombre + " " + persona.apellido;
}
var usuario = {
    nombre: "Kelvin",
    apellido: "Olano"
};
document.write(saludar(usuario));
