<?php

  require_once "conexion.php";
    $conexion = conexion();
    $id = $_POST['id'];
    $sumapotencial = $_POST['sumapotencial'];
    $mensajepotencial = $_POST['mensajepotencial'];
    $sql="UPDATE llenado_formulario set sumapotencial='$sumapotencial',
    mensajepotencial='$mensajepotencial'
                where id='$id'";
    echo $result = mysqli_query($conexion,$sql);
?>