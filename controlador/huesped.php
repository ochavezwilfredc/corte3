<?php
require_once "../modelo/Conectar.php";
require_once "../modelo/Huesped.php";

$idhuesped = isset($_POST["idhuesped"]) ? $_POST["idhuesped"] : "";
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "";

$huesped = new Huesped($nombre, $cedula, $telefono, $email, $direccion);

switch ($_GET["opc"]) {
    case 'insertaroeditar':
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
        foreach ($huespedes as $hue) {
            $data[] = array(
                "0" => $hue["nombre"],
                "1" => $hue["cedula"],
                "2" => $hue["telefono"],
                "3" => $hue["email"],
                "4" => $hue["direccion"],
                "5" => '<button class="btn btn-sm" onclick="mostrar(' . $hue["idhuesped"] . ')"><i class="fas fa-edit"></i></button>' .
                    ' <button class="btn btn-sm" onclick="eliminar(' . $hue["idhuesped"] . ')"><i class="fas fa-trash"></i></button>'
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
        $datos = $huesped->mostrar($idhuesped);
        foreach ($datos as $hue) {
            $huesp["idhuesped"] = $hue["idhuesped"];
            $huesp["nombre"] = $hue["nombre"];
            $huesp["cedula"] = $hue["cedula"];
            $huesp["telefono"] = $hue["telefono"];
            $huesp["email"] = $hue["email"];
            $huesp["direccion"] = $hue["direccion"];
        }
        echo json_encode($huesp);

        break;


}
