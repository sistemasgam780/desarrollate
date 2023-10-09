<?php

  require_once "conexion.php";
    $conexion = conexion();
    $id = $_POST['id'];
    $precision = $_POST['precision'];
    $estilo = $_POST['estilo'];
    $rendimiento = $_POST['rendimiento'];

    $sql="UPDATE llenado_formulario set rendimiento_venta = '$rendimiento', precision_venta = '$precision', estilo_venta = '$estilo'
                where id='$id'";
    echo $result = mysqli_query($conexion,$sql);
?>
