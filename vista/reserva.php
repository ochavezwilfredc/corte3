<?php
require 'header.php';
?>
<!-- Inicio contenido-->

<div class="container small">
    <div class="row card-deck mb-12" id="listadoregistros">
        <div class="card mb-12">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal titulo">Reservas
                    <button type="button" class="btn btn-success btn-sm" id="btnagregar"
                            onclick="mostrarform(true)"><i
                                class="fa fa-plus-circle"></i> Agregar
                    </button>
                </h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tbllistado">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Número de Habitación</th>
                            <th>Costo</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row card-deck mb-12" id="formularioregistros">
        <div class="card mb-12">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal titulo">Nueva Reserva</h4>
                <br>
                <div class="needs-validation">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label>Huésped</label>
                                <input type="hidden" name="idreserva" id="idreserva">
                                <select id="idhuesped" name="idhuesped" class="form-control selectpicker"
                                        data-live-search="true" data-style="btn-info" required>
                                </select>

                            </div>
                            <div class="col-4 mb-3">
                                <label>Fecha Inicio</label>
                                <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label>Fecha Fin</label>
                                <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mb-3">
                                <label>Habitación</label>
                                <select id="idhabitacion" name="idhabitacion" class="form-control selectpicker"
                                        data-live-search="true" data-style="btn-info" required>
                                </select>

                            </div>
                            <div class="col-8 mb-3">
                                <label>Comentario</label>
                                <input type="text" class="form-control" name="comentario" id="comentario" required>
                            </div>

                        </div>
                        <br>
                        <div class="col-12 mb-3">
                            <button class="btn btn-primary btn-sm" type="submit" id="btnGuardar"><i
                                        class="fa fa-save"></i>
                                Guardar
                            </button>

                            <button class="btn btn-danger btn-sm" onclick="cancelarform()" type="button"><i
                                        class="fa fa-arrow-circle-left"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Fin del contenido-->
<?php
require 'footer.php';
?>
<script src="librerias/reserva.js"></script>