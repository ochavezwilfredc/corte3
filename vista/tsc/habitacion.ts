class Habitacion {
    private _idhabitacion: number;
    private _numero: string;
    private _piso: number;
    private _max_personas: number;
    private _costo: number;
    private _tiene_cama_bebe: number;
    private _descripcion: string;


    constructor(numero?: string, piso?: number, max_personas?: number, costo?: number, tiene_cama_bebe?: number, descripcion?: string) {
        this._numero = numero;
        this._piso = piso;
        this._max_personas = max_personas;
        this._costo = costo;
        this._tiene_cama_bebe = tiene_cama_bebe;
        this._descripcion = descripcion;
    }

    public limpiar(): void {
        $("#idhabitacion").val("");
        $("#numero").val("");
        $("#piso").val("");
        $("#max_personas").val("");
        $("#costo").val("");
        $("#tiene_cama_bebe").val("");
        $("#descripcion").val("");
        $("h4.titulohabitacion").text("Nueva Habitación");
    }

    public mostrarform(flag): void {
        this.limpiar();
        if (flag) {
            $("#listadoregistros").hide(); //ocultar
            $("#formularioregistros").show(); // mostrar
            $("#btnGuardar").prop("disabled", false);
            $("#btnagregar").hide();
        } else {
            $("#listadoregistros").show(); //mostrar
            $("#formularioregistros").hide(); //ocultar
            $("#btnagregar").show();
        }
    }

    public cancelarform(): void {
        this.limpiar();
        this.mostrarform(false);
    }

    // public  listar():void {
    //     tabla = $('#tbllistado').dataTable({
    //         "aProcessing": true, //Activamos el procesamiento del datatables
    //         "aServerSide": true, //Paginación y filtrado realizados por el servidor
    //         // dom: 'Bfrtip', //Definimos los elementos del control de tabla
    //         buttons: [
    //             // 'copy', 'excel', 'pdf'
    //         ],
    //         "ajax": {
    //             url: '../controlador/habitacion.php?opc=listar',
    //             type: "get",
    //             dataType: "json",
    //             error: function (e) {
    //                 console.log(e.responseText);
    //             }
    //         },
    //         "bDestroy": true,
    //         "iDisplayLength": 10, //Paginación
    //         "order": [
    //             [0, "desc"]
    //         ],
    //         "language": {
    //             "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    //         }
    //     }).DataTable();
    // }

    get idhabitacion(): number {
        return this._idhabitacion;
    }

    set idhabitacion(value: number) {
        this._idhabitacion = value;
    }

    get numero(): string {
        return this._numero;
    }

    set numero(value: string) {
        this._numero = value;
    }

    get piso(): number {
        return this._piso;
    }

    set piso(value: number) {
        this._piso = value;
    }

    get max_personas(): number {
        return this._max_personas;
    }

    set max_personas(value: number) {
        this._max_personas = value;
    }

    get costo(): number {
        return this._costo;
    }

    set costo(value: number) {
        this._costo = value;
    }

    get tiene_cama_bebe(): number {
        return this._tiene_cama_bebe;
    }

    set tiene_cama_bebe(value: number) {
        this._tiene_cama_bebe = value;
    }

    get descripcion(): string {
        return this._descripcion;
    }

    set descripcion(value: string) {
        this._descripcion = value;
    }

    public toString(): string {
        return `Nº ${this.numero} \n
                Costo ${this.costo} \n
                Piso ${this.piso} \n
                Max ${this.max_personas} \n
                Costo ${this.costo} \n
                Bebe ${this.tiene_cama_bebe}`;
    }
    
}

// let hab = new Habitacion("303",3,2,80000,1,"Alguna descripción");