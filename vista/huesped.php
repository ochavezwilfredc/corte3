<?php
require 'header.php';
?>
<!-- Inicio contenido-->

<div class="container small">
    <div class="row card-deck mb-12" id="listadoregistros">
        <div class="card mb-12">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal" style="font-family: 'Acme', sans-serif;">Huéspedes
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
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
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
                <h4 class="my-0 font-weight-normal" style="font-family: 'Acme', sans-serif;">Nuevo Huésped</h4>
                <br>
                <div class="needs-validation">
                    <form name="formulario" id="formulario" method="POST">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Nombre</label>
                                <input type="hidden" name="idhuesped" id="idhuesped">
                                <input type="text" class="form-control" name="nombre" maxlength="100" id="nombre" placeholder=""
                                       value="" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Cédula</label>
                                <input type="text" class="form-control" maxlength="10" name="cedula" id="cedula" placeholder="" value=""
                                       required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" maxlength="15" name="telefono" id="telefono"
                                       placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" maxlength="50" name="email" id="email" placeholder=""
                                       value="" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Dirección</label>
                                <input type="text" class="form-control" name="direccion" id="direccion"
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
<script src="librerias/huesped.js"></script>