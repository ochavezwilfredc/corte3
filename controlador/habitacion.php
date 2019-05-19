<?php
require_once "../modelo/Conectar.php";
require_once "../modelo/Habitacion.php";

$idhabitacion = isset($_POST["idhabitacion"]) ? $_POST["idhabitacion"] : "";
$numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
$piso = isset($_POST["piso"]) ? $_POST["piso"] : "";
$max_personas = isset($_POST["max_personas"]) ? $_POST["max_personas"] : "";
$costo = isset($_POST["costo"]) ? $_POST["costo"] : "";
$tiene_cama_bebe = isset($_POST["tiene_cama_bebe"]) ? $_POST["tiene_cama_bebe"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";

$habitacion = new Habitacion($numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion);

switch ($_GET["opc"]) {
    case 'insertaroeditar':
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
        foreach ($habitaciones as $hab) {
            $opcbebe = ($hab["tiene_cama_bebe"] == '1') ? '<span class="badge badge-success">Si</span>' : '<span class="badge badge-danger">No</span>';
            $data[] = array(
                "0" => $hab["numero"],
                "1" => $hab["piso"],
                "2" => $hab["max_personas"],
                "3" => $hab["costo"],
                "4" => $opcbebe,
                "5" => $hab["descripcion"],
                "6" => '<button class="btn btn-sm text-primary" onclick="mostrar(' . $hab["idhabitacion"] . ')"><i class="fas fa-edit"></i></button>' .
                    ' <button class="btn btn-sm text-danger" onclick="eliminar(' . $hab["idhabitacion"] . ')"><i class="fas fa-trash"></i></button>'
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
        $datos = $habitacion->mostrar($idhabitacion);
        foreach ($datos as $hab) {
            $habita["idhabitacion"] = $hab["idhabitacion"];
            $habita["numero"] = $hab["numero"];
            $habita["piso"] = $hab["piso"];
            $habita["max_personas"] = $hab["max_personas"];
            $habita["costo"] = $hab["costo"];
            $habita["tiene_cama_bebe"] = $hab["tiene_cama_bebe"];
            $habita["descripcion"] = $hab["descripcion"];
        }
        echo json_encode($habita);
        break;


}


