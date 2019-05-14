interface Persona {
    nombre: string;
    apellido: string;
}

function saludar(persona: Persona) {
    return "Hola, " + persona.nombre + " " + persona.apellido;
}

let usuario = {
    nombre: "Kelvin",
    apellido: "Olano"
};

document.write(saludar(usuario));
