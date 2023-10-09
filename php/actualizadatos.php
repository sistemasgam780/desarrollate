<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $n = $_POST['nombre'];
  $a = $_POST['apellido'];
  $t = $_POST['telefono'];
  $c = $_POST['correo'];
  $fuente = $_POST['fuente'];
  $referido = $_POST['referido'];
  $resultado_llamada = $_POST['resultado_llamada'];
  $fecha_cita = $_POST['fecha_cita'];
  $hora_cita = $_POST['hora_cita'];

  $sql="UPDATE llenado_formulario set nombre='$n',
                                      a_paterno='$a',
                                      celular='$t',
                                      correo='$c',
                                      fuente='$fuente',
                                      referido='$referido',
                                      resul_llamada='$resultado_llamada',
                                      fecha_cita='$fecha_cita',
                                      hora_cita='$hora_cita'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
