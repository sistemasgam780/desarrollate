<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];

  $sql="delete from llenado_formulario
              where id='$id'";
  echo $result = mysqli_query($conexion,$sql);
?>
