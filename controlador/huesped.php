<?php
require_once "../modelo/Huesped.php";

$idhuesped = isset($_POST["idhuesped"]) ? limpiarCadena($_POST["idhuesped"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$cedula = isset($_POST["cedula"]) ? limpiarCadena($_POST["cedula"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";

$huesped = new Huesped($nombre, $cedula, $telefono, $email, $direccion);

switch ($_GET["opc"]) {
    case 'guardaroeditar':
        if (empty($idhuesped)) {
            $rspta = $huesped->insertar();
            echo $rspta ? "Huésped registrado correctamente" : "No se pudo registarar el huésped";
        } else {
            $huesped->setIdhuesped($idhuesped);
//            echo $huesped;
            $rspta = $huesped->editar();
            echo $rspta ? "Huésped actualizado correctamente" : "No se pudo actualizar el huésped";
        }
        break;

    case 'listar':
        $huespedes = $huesped->listar();
        $data = array();
        while ($hab = $huespedes->fetch_object()) {
            $data[] = array(
                "0" => $hab->nombre,
                "1" => $hab->cedula,
                "2" => $hab->telefono,
                "3" => $hab->email,
                "4" => $hab->direccion,
                "5" => '<button class="btn btn-sm" onclick="mostrar(' . $hab->idhuesped . ')"><i class="fas fa-edit"></i></button>' .
                    ' <button class="btn btn-sm" onclick="eliminar(' . $hab->idhuesped . ')"><i class="fas fa-trash"></i></button>'
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
        $rspta = $huesped->eliminar($idhuesped);
        echo $rspta ? "Huésped eliminado correctamente" : "No se pudo eliminar el huésped";
        break;

    case 'mostrar':
        $rspta = $huesped->mostrar($idhuesped);
        echo json_encode($rspta);
        break;


}
