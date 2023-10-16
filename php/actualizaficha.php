<?php

  require_once "conexion.php";
  $conexion = conexion();
  $id = $_POST['id'];
  $a = $_POST['acudio'];
  $e = $_POST['edad'];
  $ec = $_POST['estado_civil'];
  $cp = $_POST['cp'];
  $estado = $_POST['estado'];
  $municipio = $_POST['municipio'];
  $colonia = $_POST['colonia'];
  $al = $_POST['alcaldia'];
  $d = $_POST['dependientes'];
  $o = $_POST['ocupacion'];
  $es = $_POST['escolaridad'];
  $c = $_POST['carrera'];
  $i = $_POST['institucion'];
  $in = $_POST['ingreso'];
  $t = $_POST['trans'];
  $ti = $_POST['tiempo'];
  $im = $_POST['imagen'];
  $nacimiento = $_POST['fecha_nacimiento'];
  $nacionalidad = $_POST['nacionalidad'];
  $genero = $_POST['genero'];

  date_default_timezone_set("America/Mexico_City");
            $time = time();
            $fec1 = date("Y-m-d",$time);

  $sql="UPDATE llenado_formulario set acudio_entrevista='$a',
                                      edad='$e',
                                      edo_civil='$ec',
                                      cp='$cp',
                                      estado='$estado',
                                      municipio='$municipio',
                                      colonia='$colonia',
                                      direccion='$al',
                                      dependientes='$d',
                                      ocupacion='$o',
                                      escolaridad='$es',
                                      carrera='$c',
                                      institucion='$i',
                                      ingreso='$in',
                                      transporte='$t',
                                      t_disponible='$ti',
                                      imagen='$im',
                                      fec1='$fec1',
                                      genero='$genero',
                                      nacionalidad='$nacionalidad',
                                      fecha_nacimiento='$nacimiento'
              where id='$id'";

  echo $result = mysqli_query($conexion,$sql);
?>
