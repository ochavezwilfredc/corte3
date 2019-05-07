<?php
require_once "../modelo/Conectar.php";
require_once "../modelo/Reserva.php";

$idreserva = isset($_POST["idreserva"]) ? $_POST["idreserva"] : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? $_POST["fecha_inicio"] : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? $_POST["fecha_fin"] : "";
$comentario = isset($_POST["comentario"]) ? $_POST["comentario"] : "";
$idhabitacion = isset($_POST["idhabitacion"]) ? $_POST["idhabitacion"] : "";
$idhuesped = isset($_POST["idhuesped"]) ? $_POST["idhuesped"] : "";

$reserva = new Reserva($fecha_inicio, $fecha_fin, $comentario, $idhabitacion, $idhuesped);

switch ($_GET["opc"]) {
    case 'insertar':
        if (empty($idreserva)) {
            $rpta = $reserva->insertar();
            echo $rpta ? "Reserva resistrada correctamente" : "No se pudo resistrar la reserva";
        }
        break;

    case 'anular':
        $rpta = $reserva->anular($idreserva);
        echo $rpta ? "Reserva anulada correctamente" : "No se pudo anular la reserva";
        break;

    case 'mostrar':
        $reservas = $reserva->mostrar($idreserva);
        foreach ($reservas as $res) {
            $reserv["idreserva"] = $res["idreserva"];
            $reserv["fecha_inicio"] = $res["fecha_inicio"];
            $reserv["fecha_fin"] = $res["fecha_fin"];
            $reserv["hab_num"] = $res["hab_num"];
            $reserv["hab_costo"] = $res["hab_costo"];
            $reserv["hue_nombre"] = $res["hue_nombre"];
            $reserv["hue_telefono"] = $res["hue_telefono"];
            $reserv["estado"] = $res["estado"];
            $reserv["comentario"] = $res["comentario"];
            $reserv["idhabitacion"] = $res["idhabitacion"];
            $reserv["idhuesped"] = $res["idhuesped"];
        }
        echo json_encode($reserv);
        break;

    case 'listar':
        $reservas = $reserva->listar();
        $data = Array();
        foreach ($reservas as $res) {
            $data[] = array(
                "0" => $res["hue_nombre"],
                "1" => $res["hue_telefono"],
                "2" => $res["fecha_inicio"],
                "3" => $res["fecha_fin"],
                "4" => $res["hab_num"],
                "5" => $res["hab_costo"],
                "6" => $res["comentario"],
                "7" => ($res["estado"] == "1") ? '<span class="text-success">Activa</span>' :
                    '<span class="text-danger">Anulada</span>',
                "8" => ($res["estado"] == '1') ? '<button class="btn btn-sm text-info" onclick="mostrar(' . $res["idreserva"] . ')"><i class="fas fa-eye"></i></button>' .
                    ' <button class="btn btn-sm text-danger" onclick="anular(' . $res["idreserva"] . ')"><i class="fas fa-window-close"></i></button>' :
                    '<button class="btn btn-sm text-info" onclick="mostrar(' . $res["idreserva"] . ')"><i class="fas fa-eye"></i></button>',
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total resistros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total resistros a visualizar
            "aaData" => $data);
        echo json_encode($results);
        break;

    case 'listarHuespedes':
        require_once "../modelo/Huesped.php";
        $huesped = new Huesped();
        $data = array();
        $huespedes = $huesped->listar();
        foreach ($huespedes as $hue) {
            $data[] = array(
                "0" => $hue["nombre"],
                "1" => $hue["cedula"],
                "2" => $hue["telefono"],
                "3" => $hue["email"],
                "4" => $hue["direccion"],
                "5" => '<button class="btn btn-sm btn-sm text-primary"  data-dismiss="modal" aria-hidden="true"
                    onclick="agregarHuesped(' . $hue["idhuesped"] . ',\'' . $hue["nombre"] . '\')">
                    <i class=" text-success fas fa-user-plus"></i>
                    </button>');
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //se envia el total registros al datatable
            "iTotalDisplayRecords" => count($data), //se envia el total registros a visualizar
            "aaData" => $data);
        echo json_encode($results);
        break;

    case 'selectHabitaciones':
        require_once "../modelo/Habitacion.php";
        $habitacion = new Habitacion();
        $habitaciones = $habitacion->listar();
        foreach ($habitaciones as $hab) {
            echo '<option data-icon="fas fa-door-open" value=' . $hab["idhabitacion"] . '>' . $hab["numero"] . '</option>';
        }
        break;

    case 'selectHuespedes':
        require_once "../modelo/Huesped.php";
        $huesped = new Huesped();
        $huespedes = $huesped->listar();
        foreach ($huespedes as $hue) {
            echo '<option data-icon="fas fa-user" value=' . $hue["idhuesped"] . '>' . $hue["nombre"] . '</option>';
        }
        break;
}