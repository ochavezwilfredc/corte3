var tabla;

//Función que se ejecuta al inicio
function init() {
    formato_imputs();
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    //Cargamos los items al select habitaciones
    $.post("../controlador/reserva.php?opc=selectHabitaciones", function (r) {
        $("#idhabitacion").html(r);
        $('#idhabitacion').selectpicker('refresh');
    });

    $.post("../controlador/reserva.php?opc=selectHuespedes", function (r) {
        $("#idhuesped").html(r);
        $('#idhuesped').selectpicker('refresh');
    });

}

//Función limpiar
function limpiar() {
    $("#idreserva").val("");
    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");
    $("#idhabitacion").val("");
    $("#comentario").val("");
    $("#idhuesped").val("");
}

//Función mostrar formulario
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

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            // dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                // 'copyHtml5',
                // 'excelHtml5',
                // 'csvHtml5',
                // 'pdf'
            ],
            "ajax":
                {
                    url: '../controlador/reserva.php?opc=listar',
                    type: "get",
                    dataType: "json",
                    error: function (e) {
                        console.log(e.responseText);
                    }
                },
            "bDestroy": true,
            "iDisplayLength": 10,//Paginación
            "order": [[0, "desc"]],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        }).DataTable();
}

//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controlador/reserva.php?opc=guardaroeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            listar();
        }

    });
    limpiar();
}

function mostrar(idreserva) {
    $.post("../controlador/reserva.php?opc=mostrar", {idreserva: idreserva}, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idreserva").val(data.idreserva);
        $("#idhabitacion").val(data.idhabitacion);
        $("#idhabitacion").selectpicker('refresh');
        $("#fecha_inicio").val(data.fecha_inicio);
        $("#fecha_fin").val(data.fecha_fin);
        $("#comentario").val(data.comentario);
        $("#idhuesped").val(data.idhuesped);
        $("#idhuesped").selectpicker('refresh');

        //Ocultar y mostrar los botones
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
    });
}

//Función para anular registros
function anular(idreserva) {
    bootbox.confirm("¿Está Seguro de anular el reserva?", function (result) {
        if (result) {
            $.post("../controlador/reserva.php?opc=anular", {idreserva: idreserva}, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function formato_imputs() {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    // Documentación: http://api.jqueryui.com/datepicker/
    $("#fecha_inicio, #fecha_fin").datepicker({
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        buttonImageOnly: true,
        navigationAsDateFormat: true,
        minDate: today
    });

    $("#idhabitacion, #idhuesped").selectpicker({
        noneSelectedText: 'Seleccionar una opción',
        noneResultsText: 'No exite resultados'


    });
}

init();

