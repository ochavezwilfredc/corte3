class Estudiante {
    nombre_completo: string;

    constructor(public nombre: string, public inicial_nombre: string, public apellido: string) {
        this.nombre_completo = nombre + " " + inicial_nombre + " " + apellido;
    }
}

interface Persona {
    nombre: string;
    apellido: string;
}

function saludar(Persona: Persona) {
    return "Hola, " + Persona.nombre + " " + Persona.apellido;
}

let usuario = new Estudiante("Kelvin", "K.", "Olano");

document.body.innerHTML = saludar(usuario);
