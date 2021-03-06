var tabla;

//Función que se ejecuta al inicio de la aplicación
function init() {
    mostrarFormulario(false);
    listar();
    $("#formulario").on("submit", function (e) {
        insertar_o_editar(e);
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
    $("h4.titulohabitacion").text("Nueva Habitación");


}

function mostrarFormulario(flag) {
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

function cancelarFormulario() {
    limpiar();
    mostrarFormulario(false);
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

function insertar_o_editar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); // aca recibe todos los datos del formulario

    $.ajax({
        url: "../controlador/habitacion.php?opc=insertaroeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            bootbox.alert({
                message: datos,
                locale: 'es',
                buttons: {
                    ok: {
                        label: '<i class="fa fa-check"></i> Aceptar',
                        className: 'btn-primary'
                    }
                },
            });
            mostrarFormulario(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

// DOC: https://www.w3schools.com/jquery/ajax_post.asp
function mostrar(idhabitacion) {
    $.post("../controlador/habitacion.php?opc=mostrar", {idhabitacion: idhabitacion}, function (data, status) {
        data = JSON.parse(data);
        mostrarFormulario(true);
        $("#numero").val(data.numero);
        $("#piso").val(data.piso);
        $("#max_personas").val(data.max_personas);
        $("#costo").val(data.costo);
        $("#tiene_cama_bebe").val(data.tiene_cama_bebe);
        $("#descripcion").val(data.descripcion);
        $("#idhabitacion").val(data.idhabitacion);
        // $("#titulohabitacion").text("Editar Habitación");
        $("h4.titulohabitacion").text("Editar Habitación");
    })
}

function eliminar(idhabitacion) {
    bootbox.confirm({
        message: "¿Está seguro de eliminar la habitación?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.post("../controlador/habitacion.php?opc=eliminar", {
                    idhabitacion: idhabitacion
                }, function (e) {
                    bootbox.alert({
                        message: e,
                        locale: 'es',
                        buttons: {
                            ok: {
                                label: '<i class="fa fa-check"></i> Aceptar',
                                className: 'btn-primary'
                            }
                        },
                    });
                    tabla.ajax.reload();
                });
            }
        }
    });
}

// Una vez que se cargan todos los métodos se ejecuta la función init()
init();