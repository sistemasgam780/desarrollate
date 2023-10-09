<?php

  require_once "conexion.php";
    $conexion = conexion();
    $id = $_POST['id'];
    $in = $_POST['insert'];
    $sql="UPDATE llenado_formulario set patron='$in'
                where id='$id'";
    echo $result = mysqli_query($conexion,$sql);
?>
