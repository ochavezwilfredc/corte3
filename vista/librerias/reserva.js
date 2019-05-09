var tabla;

//Función que se ejecuta al inicio
function init() {
    formato_imputs();
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        insertar(e);
    });

    // Cargamos los items al select habitaciones
    $.post("../controlador/reserva.php?opc=selectHabitaciones", function (r) {
        $("#idhabitacion").html(r);
        $('#idhabitacion').selectpicker('refresh');
    });

}

//Función limpiar
function limpiar() {
    $("#idreserva").val("");
    $("#fechas").val("");
    $("#idhabitacion").val("");
    $("#comentario").val("");
    $("#idhuesped").val("");
    $("#nombre").val("");
    // $("#btnseleccionar").show();

    // Habilitar los inputs
    $("#idhabitacion").prop('disabled', false);
    $("#fechas").prop('disabled', false);
    $("#comentario").prop('disabled', false);
    $("#idhuesped").prop('disabled', false);
    $("#nombre").prop('disabled', false);

    $("h4.tituloreserva").text("Nueva Reserva");

}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide(); //ocultar
        $("#formularioregistros").show(); // mostrar
        $("#btnagregar").hide();
        listarHuespedes();
    } else {
        $("#listadoregistros").show(); //mostrar
        $("#formularioregistros").hide(); //ocultar
        $("#btnagregar").show();
        $("#btnGuardar").show();
        $("#cont_select").show();
        $("#numero").get(0).type = 'hidden';

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

function insertar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../controlador/reserva.php?opc=insertar",
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
            mostrarform(false);
            listar();
        }

    });
    limpiar();
}

//Función listarHuespedes
function listarHuespedes() {
    tabla = $('#tblarticulos').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [],
            "ajax":
                {
                    url: '../controlador/reserva.php?opc=listarHuespedes',
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

function agregarHuesped(idhuesped, nombre) {
    if (idhuesped != "") {
        $("#idhuesped").val(idhuesped);
        $("#nombre").val(nombre);
    }
}

function mostrar(idreserva) {
    $.post("../controlador/reserva.php?opc=mostrar", {idreserva: idreserva}, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idreserva").val(data.idreserva);

        $("#numero").get(0).type = 'text';
        $("#numero").val(data.hab_num);
        $("#numero").prop('disabled', true);

        $("#cont_select").hide();

        $("#fechas").val(data.fecha_inicio + ' - ' + data.fecha_fin);
        $("#fechas").prop('disabled', true);

        $("#comentario").val(data.comentario);
        $("#comentario").prop('disabled', true);

        $("#idhuesped").val(data.idhuesped);
        $("#idhuesped").prop('disabled', true);

        $("#nombre").val(data.hue_nombre);
        $("#nombre").prop('disabled', true);

        $("h4.tituloreserva").text("Reserva");

        //Ocultar y mostrar los botones
        // $("#btnseleccionar").hide();
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
    });

}

//Función para anular registros
function anular(idreserva) {
    bootbox.confirm({
        message: "¿Está Seguro de anular el reserva?",
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
                $.post("../controlador/reserva.php?opc=anular", {
                    idreserva: idreserva
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

function formato_imputs() {

    $(function () {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var f_inicio, f_fin;
        $('input[name="fechas"]').daterangepicker({
            autoUpdateInput: false,
            minDate: today,
            locale: {
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "DE",
                "toLabel": "HASTA",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sáb"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                "firstDay": 1,
                cancelLabel: 'Cerrar'
            }
        });

        $('input[name="fechas"]').on('apply.daterangepicker', function (ev, picker) {
            f_inicio = picker.startDate.format('YYYY/MM/DD');
            f_fin = picker.endDate.format('YYYY/MM/DD');
            $(this).val(f_inicio + ' - ' + f_fin);
            $("#fecha_inicio").val(f_inicio);
            $("#fecha_fin").val(f_fin);
            console.log("Fecha fin: ", f_inicio, "Fecha fin: ", f_fin);
        });

        $('input[name="fechas"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $( "#nombre" ).click(function() {
            $('#myModal').modal({
                show:true,
                backdrop:'static'
            });
        });
    });

    $("#idhabitacion, #idhuesped").selectpicker({
        noneSelectedText: 'Seleccionar una opción',
        noneResultsText: 'No exite resultados'
    });
}

//Función que se ejecuta al inicio de la app
init();

