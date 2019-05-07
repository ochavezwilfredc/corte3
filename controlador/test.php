<?php
//require_once "../modelo/Habitacion.php";
//
//$hab = new Habitacion("102", "1", "2","50000", "1" ,"Algo");
//
//$rspta = $hab->insertar();
//echo $rspta ? "Habitación registrada correctamente" : "No se pudo registarar la habitación";
//
////echo $hab;
///
//require_once '../modelo/Conectar.php';
//
//$con = new Conexion();
//
//$sql = "SELECT * FROM huesped";
//$rpt = $con->ejecutarConsulta($sql);
//
//while($hue = $rpt->fetch(PDO::FETCH_ASSOC)) {
//    echo $hue['nombre'];
//    echo $hue['cedula'];
//    echo "<br>";
//}

require_once '../modelo/pdo/Huesped.php';

$hue = new Huesped("Lesly","12345678","320369852", "lesl@gmail.com","chiclayo");
//$hue->insertar();
//$hue->setNombre("Lesly pintado");
//$hue->setIdhuesped("4");
//$hue->eliminar("4");
$datos = $hue->listar();

foreach ($datos as $hue) {
    echo $hue['idhuesped'];
    echo "<br>";
}
