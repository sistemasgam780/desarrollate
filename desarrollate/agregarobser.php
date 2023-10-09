<?php 

require_once "php/conexion.php";
$conexion = conexion();

$idp = $_POST['idp'];
$obs = $_POST['obs'];
date_default_timezone_set("America/Mexico_City");
$time = time();
$fec1 = date("Y-m-d",$time);

$sql = "insert into observaciones(id_prospecto,observaciones,fecha) values('$idp','$obs','$fec1')";

mysqli_query($conexion,$sql);

echo '<script type="text/javascript">
 alert("Observacion Agregada");
 window.location.href="observaciones.php?id='.$idp.'";
 </script>';

?>