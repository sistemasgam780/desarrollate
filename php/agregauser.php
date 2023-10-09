<?php

  require_once "conexion.php";
  $conexion = conexion();
  $nombreuser = $_POST['nombreuser'];
  $passuser = $_POST['passuser'];
  $clave_cifrada = password_hash($passuser, PASSWORD_DEFAULT, array("cost"=>10));
  $tipouser = $_POST['tipouser'];
 
  

  $sql = "insert into login(user,password,tipo) values('$nombreuser','$clave_cifrada','$tipouser')";

  echo $result = mysqli_query($conexion,$sql);
?>
