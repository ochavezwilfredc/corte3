<?php
require_once "../modelo/Reserva.php";

$idreserva = isset($_POST["idreserva"]) ? limpiarCadena($_POST["idreserva"]) : "";
$fecha_inicio = isset($_POST["fecha_inicio"]) ? limpiarCadena($_POST["fecha_inicio"]) : "";
$fecha_fin = isset($_POST["fecha_fin"]) ? limpiarCadena($_POST["fecha_fin"]) : "";
$comentario = isset($_POST["comentario"]) ? limpiarCadena($_POST["comentario"]) : "";
$idhabitacion = isset($_POST["idhabitacion"]) ? limpiarCadena($_POST["idhabitacion"]) : "";
$idhuesped = isset($_POST["idhuesped"]) ? limpiarCadena($_POST["idhuesped"]) : "";

$reserva = new Reserva($fecha_inicio, $fecha_fin, $comentario, $idhabitacion, $idhuesped);

switch ($_GET["opc"]) {
    case 'guardaroeditar':
        if (empty($idreserva)) {
            $reservas = $reserva->insertar();
            echo $reservas ? "reserva resistrada correctamente" : "No se pudo resistrar la reserva";
        } else {
//            $reserva->setIdreserva($idreserva);
//            $reservas = $reserva->editar();
//            echo $reservas ? "reserva actualizada correctamente" : "No se pudo actualizar la reserva";
        }
        break;

    case 'anular':
        $reservas = $reserva->anular($idreserva);
        echo $reservas ? "reserva anulada correctamente" : "No se pudo anular la reserva";
        break;

    case 'mostrar':
        $reservas = $reserva->mostrar($idreserva);
        echo json_encode($reservas);
        break;

    case 'listar':
        $reservas = $reserva->listar();
        $data = Array();
        while ($res = $reservas->fetch_object()) {
            $data[] = array(
                "0" => $res->hue_nombre,
                "1" => $res->hue_telefono,
                "2" => $res->fecha_inicio,
                "3" => $res->fecha_fin,
                "4" => $res->hab_num,
                "5" => $res->hab_costo,
                "6" => $res->comentario,
                "7" => ($res->estado == '1') ? '<span class="label bg-green">Habilitada</span>' :
                    '<span class="label bg-red">Deshabilitada</span>',
                "8" => ($res->estado == '1') ? '<button class="btn btn-sm" onclick="mostrar(' . $res->idreserva . ')"><i class="fas fa-eye"></i></button>' .
                    ' <button class="btn btn-sm" onclick="anular(' . $res->idreserva . ')"><i class="fas fa-window-close"></i></button>' :
                    '<button class="btn btn-sm" onclick="mostrar(' . $res->idreserva . ')"><i class="fas fa-eye"></i></button>',
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total resistros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total resistros a visualizar
            "aaData" => $data);
        echo json_encode($results);
        break;

    case 'listarHabitaciones':
        require_once "../modelo/Habitacion.php";
        $habitacion = new Habitacion();
        $habitaciones = $habitacion->listar();

        $data = Array();
        while ($hab = $habitaciones->fetch_object()) {
            $data[] = array(
                "0" => $hab->numero,
                "1" => $hab->piso,
                "2" => $hab->max_personas,
                "3" => $hab->costo,
                "4" => $hab->tiene_cama_bebe,
                "5" => $hab->descripcion,
                "6" => '
                <div class="text-center"> 
                    <button class="btn btn-sm"  onclick="agresarDetalleHab(' . $hab->idhabitacion . ')"><span class="fas fa-plus"></span></button>
                </div>',
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total resistros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total resistros a visualizar
            "aaData" => $data);
        echo json_encode($results);
        break;

    case 'selectHabitaciones':
        require_once "../modelo/Habitacion.php";
        $habitacion = new Habitacion();

        $habitaciones = $habitacion->listar();

        while ($hab = $habitaciones->fetch_object()) {
            echo '<option data-icon="fas fa-door-open" value=' . $hab->idhabitacion . '>' . $hab->numero . '</option>';
        }
        break;

    case 'selectHuespedes':
        require_once "../modelo/Huesped.php";
        $huesped = new Huesped();

        $huespedes = $huesped->listar();

        while ($hab = $huespedes->fetch_object()) {
            echo '<option data-icon="fas fa-user" value=' . $hab->idhuesped . '>' . $hab->nombre . '</option>';
        }
        break;
}