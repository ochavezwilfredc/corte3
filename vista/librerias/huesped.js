var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit", function (e) {
        insertar_o_editar(e);
    })
}

function limpiar() {
    $("#idhuesped").val("");
    $("#nombre").val("");
    $("#cedula").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#direccion").val("");
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
            url: '../controlador/huesped.php?opc=listar',
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
        url: "../controlador/huesped.php?opc=insertaroeditar",
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

function mostrar(idhuesped) {
    console.log(idhuesped);
    $.post("../controlador/huesped.php?opc=mostrar", {idhuesped: idhuesped}, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#nombre").val(data.nombre);
        $("#cedula").val(data.cedula);
        $("#telefono").val(data.telefono);
        $("#email").val(data.email);
        $("#direccion").val(data.direccion);
        $("#idhuesped").val(data.idhuesped);

    })
}

function eliminar(idhuesped) {
    bootbox.confirm("¿Está seguro de eliminar la habitación?", function (result) {
        if (result) {
            $.post("../controlador/huesped.php?opc=eliminar", {
                idhuesped: idhuesped
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();