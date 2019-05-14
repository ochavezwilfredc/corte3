var Estudiante = /** @class */ (function () {
    function Estudiante(nombre, inicial_nombre, apellido) {
        this.nombre = nombre;
        this.inicial_nombre = inicial_nombre;
        this.apellido = apellido;
        this.nombre_completo = nombre + " " + inicial_nombre + " " + apellido;
    }
    return Estudiante;
}());
function saludar(Persona) {
    return "Hola, " + Persona.nombre + " " + Persona.apellido;
}
var usuario = new Estudiante("Kelvin", "K.", "Olano");
document.body.innerHTML = saludar(usuario);
