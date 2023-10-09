<?php

  require_once "conexion.php";
    $conexion = conexion();
    $id = $_POST['id'];
    $c = $_POST['conexion'];
    $fc = $_POST['fecha_conexion'];
    date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d",$time);   

    $sql="UPDATE llenado_formulario set conexion='$c', fecha_conexion='$fc', fec5='$fec1'
                where id='$id'";
    echo $result = mysqli_query($conexion,$sql);
?>
