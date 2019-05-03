<?php
require 'header.php';
?>
<!-- Inicio contenido-->

<div class="container small">
    <div class="row card-deck mb-12" id="listadoregistros">
        <div class="card mb-12">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal" style="font-family: 'Acme', sans-serif;">Habitaciones
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
                            <th>Número</th>
                            <th>Piso</th>
                            <th>Máximo personas</th>
                            <th>Costo</th>
                            <th>Cama para bebe</th>
                            <th>Descripción</th>
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
                <h4 class="my-0 font-weight-normal" style="font-family: 'Acme', sans-serif;">Nueva Habitación</h4>
                <br>
                <div class="needs-validation">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Número</label>
                                <input type="hidden" name="idhabitacion" id="idhabitacion">
                                <input type="text" class="form-control" name="numero" maxlength="10" id="numero"
                                       placeholder=""
                                       value="" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Piso</label>
                                <input type="number" class="form-control" name="piso" id="piso" placeholder="" value=""
                                       required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Máximo de personas</label>
                                <input type="text" class="form-control" name="max_personas" id="max_personas"
                                       placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Costo</label>
                                <input type="number" class="form-control" name="costo" id="costo" placeholder=""
                                       value="" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Tiene cama para bebe</label>
                                <select class="custom-select d-block w-100" name="tiene_cama_bebe" id="tiene_cama_bebe"
                                        required>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion"
                                       placeholder="" value="">
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
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
<script src="librerias/habitacion.js"></script>
