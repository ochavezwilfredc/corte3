var Habitacion = /** @class */ (function () {
    function Habitacion(numero, piso, max_personas, costo, tiene_cama_bebe, descripcion) {
        this._numero = numero;
        this._piso = piso;
        this._max_personas = max_personas;
        this._costo = costo;
        this._tiene_cama_bebe = tiene_cama_bebe;
        this._descripcion = descripcion;
    }
    Habitacion.prototype.limpiar = function () {
        $("#idhabitacion").val("");
        $("#numero").val("");
        $("#piso").val("");
        $("#max_personas").val("");
        $("#costo").val("");
        $("#tiene_cama_bebe").val("");
        $("#descripcion").val("");
        $("h4.titulohabitacion").text("Nueva Habitación");
    };
    Habitacion.prototype.mostrarform = function (flag) {
        this.limpiar();
        if (flag) {
            $("#listadoregistros").hide(); //ocultar
            $("#formularioregistros").show(); // mostrar
            $("#btnGuardar").prop("disabled", false);
            $("#btnagregar").hide();
        }
        else {
            $("#listadoregistros").show(); //mostrar
            $("#formularioregistros").hide(); //ocultar
            $("#btnagregar").show();
        }
    };
    Habitacion.prototype.cancelarform = function () {
        this.limpiar();
        this.mostrarform(false);
    };
    Object.defineProperty(Habitacion.prototype, "idhabitacion", {
        get: function () {
            return this._idhabitacion;
        },
        set: function (value) {
            this._idhabitacion = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "numero", {
        get: function () {
            return this._numero;
        },
        set: function (value) {
            this._numero = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "piso", {
        get: function () {
            return this._piso;
        },
        set: function (value) {
            this._piso = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "max_personas", {
        get: function () {
            return this._max_personas;
        },
        set: function (value) {
            this._max_personas = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "costo", {
        get: function () {
            return this._costo;
        },
        set: function (value) {
            this._costo = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "tiene_cama_bebe", {
        get: function () {
            return this._tiene_cama_bebe;
        },
        set: function (value) {
            this._tiene_cama_bebe = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Habitacion.prototype, "descripcion", {
        get: function () {
            return this._descripcion;
        },
        set: function (value) {
            this._descripcion = value;
        },
        enumerable: true,
        configurable: true
    });
    Habitacion.prototype.toString = function () {
        return "N\u00BA " + this.numero + " \n\n                Costo " + this.costo + " \n\n                Piso " + this.piso + " \n\n                Max " + this.max_personas + " \n\n                Costo " + this.costo + " \n\n                Bebe " + this.tiene_cama_bebe;
    };
    return Habitacion;
}());
// let hab = new Habitacion("303",3,2,80000,1,"Alguna descripción");
