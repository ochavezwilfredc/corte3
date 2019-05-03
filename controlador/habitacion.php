<?php
require_once "../modelo/Habitacion.php";

$idhabitacion = isset($_POST["idhabitacion"]) ? limpiarCadena($_POST["idhabitacion"]) : "";
$numero = isset($_POST["numero"]) ? limpiarCadena($_POST["numero"]) : "";
$piso = isset($_POST["piso"]) ? limpiarCadena($_POST["piso"]) : "";
$max_personas = isset($_POST["max_personas"]) ? limpiarCadena($_POST["max_personas"]) : "";
$costo = isset($_POST["costo"]) ? limpiarCadena($_POST["costo"]) : "";
$tiene_cama_bebe = isset($_POST["tiene_cama_bebe"]) ? limpiarCadena($_POST["tiene_cama_bebe"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

$habitacion = new Habitacion($numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion);

switch ($_GET["opc"]) {
    case 'guardaroeditar':
        if (empty($idhabitacion)) {
            $rspta = $habitacion->insertar();
            echo $rspta ? "Habitación registrada correctamente" : "No se pudo registarar la habitación";
        } else {
            $habitacion->setIdhabitacion($idhabitacion);
            $rspta = $habitacion->editar();
            echo $rspta ? "Habitación actualizada correctamente" : "No se pudo actualizar la habitación";
        }
        break;

    case 'listar':
        $habitaciones = $habitacion->listar();
        $data = array();
        while ($hab = $habitaciones->fetch_object()) {
            $opcbebe = ($hab->tiene_cama_bebe == '1') ? '<p style="color:green">Si</p>' : '<p style="color:red">No</p>';
            $data[] = array(
                "0" => $hab->numero,
                "1" => $hab->piso,
                "2" => $hab->max_personas,
                "3" => $hab->costo,
                "4" => $opcbebe,
                "5" => $hab->descripcion,
                "6" => '<button class="btn btn-sm" onclick="mostrar(' . $hab->idhabitacion . ')"><i class="fas fa-edit"></i></button>' .
                    ' <button class="btn btn-sm" onclick="eliminar(' . $hab->idhabitacion . ')"><i class="fas fa-trash"></i></button>'
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //se envia el total registros al datatable
            "iTotalDisplayRecords" => count($data), //se envia el total registros a visualizar
            "aaData" => $data);
        echo json_encode($results);
        break;

    case 'eliminar':
        $rspta = $habitacion->eliminar($idhabitacion);
        echo $rspta ? "Habitación eliminada correctamente" : "No se pudo eliminar la habitación";
        break;

    case 'mostrar':
        $rspta = $habitacion->mostrar($idhabitacion);
        echo json_encode($rspta);
        break;


}


