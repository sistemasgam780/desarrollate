<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $caracter = $_POST['caracter'];
  $sentido = $_POST['sentido'];
  $orientacion = $_POST['orientacion'];
  $energia = $_POST['energia'];
  $motivacion = $_POST['motivacion'];
  $perseverancia = $_POST['perseverancia'];
  $suma_vitales = $_POST['suma_vitales'];
  
  


  $sql="UPDATE llenado_formulario set caracter='$caracter', sentido='$sentido', orientacion='$orientacion', energia='$energia', motivacion='$motivacion', perseverancia='$perseverancia', suma_vitales='$suma_vitales'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);