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
require_once '../modelo/Conexion.php';

$con = new Conexion();

$sql = "SELECT * FROM huesped";
$rpt = $con->ejecutarConsulta($sql);

while($hue = $rpt->fetch(PDO::FETCH_ASSOC)) {
    echo $hue['nombre'];
    echo $hue['cedula'];
    echo "<br>";
}