var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })
}

function limpiar() {
    $("#idhabitacion").val("");
    $("#numero").val("");
    $("#piso").val("");
    $("#max_personas").val("");
    $("#costo").val("");
    $("#tiene_cama_bebe").val("");
    $("#descripcion").val("");

}

function mostrarform(flag) {
    limpiar();
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

function cancelarform() {
    limpiar();
    mostrarform(false);
}

function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        // dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            // 'copy', 'excel', 'pdf'
        ],
        "ajax": {
            url: '../controlador/habitacion.php?opc=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [0, "desc"]
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); // aca recibe todos los datos del formulario

    $.ajax({
        url: "../controlador/habitacion.php?opc=guardaroeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(idhabitacion) {
    $.post("../controlador/habitacion.php?opc=mostrar", {idhabitacion: idhabitacion}, function (data, status)
    {
        data = JSON.parse(data);
        // console.log(data.toString());
        mostrarform(true);
        $("#numero").val(data.numero);
        $("#piso").val(data.piso);
        $("#max_personas").val(data.max_personas);
        $("#costo").val(data.costo);
        $("#tiene_cama_bebe").val(data.tiene_cama_bebe);
        $("#descripcion").val(data.descripcion);
        $("#idhabitacion").val(data.idhabitacion);

    })
}

function eliminar(idhabitacion) {
    bootbox.confirm("¿Está seguro de eliminar la habitación?", function (result) {
        if (result) {
            $.post("../controlador/habitacion.php?opc=eliminar", {
                idhabitacion: idhabitacion
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();