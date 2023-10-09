<?php
include 'php/conexion.php';
$conexion = conexion();
session_start();
if (!isset($_SESSION['tiempo'])) {
  $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 300) {
  date_default_timezone_set('America/Mexico_City');
  $hoy = date("Y-m-d");
  $nomusuario = $_SESSION['user'];
  $fecha1 = $_COOKIE["tiempo"];
  $fecha2 = date("H:i");
  $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
  $tiempoTotal = ($tiempo / 60 . " Minutos");


  $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
            values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
  $inserT = mysqli_query($conexion, $ti);
  session_destroy();
  session_unset();
  header('location: index.php');
  die();
}

$_SESSION['tiempo'] = time();

$edat = $_SESSION['user'];
date_default_timezone_set('America/Mexico_City');
$fecha = date("H:i");
setcookie("tiempo", $fecha);



//Comprobamos existencia de sesión
if (!isset($_SESSION['user'])) {
  header('location: index.php');
}


mysqli_set_charset($conexion, 'utf8'); //Esta linea arregla que los acentos combobits
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

//desde aqui se hace lo de fecha fin


$fecha_actual = date('Y-m-d');

$fecha_desde = date('Y-m') . "-01";


//comprobacion de contactos de parte de edat
$contacto_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
$edat_result = $conexion->query($contacto_edat);
$contactos = mysqli_num_rows($edat_result);

//comprobacion de citas de parte de edat
$citas_edat = "select * from llenado_formulario where resul_llamada = 'CITA' and edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
$citas_result = $conexion->query($citas_edat);
$citas = mysqli_num_rows($citas_result);

//comprobacion de conexion de parte de edat

$conexion_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "' and  conexion = ('Provisional' or 'Definitiva')";
$conexion_result = $conexion->query($conexion_edat);
$conexionr = mysqli_num_rows($conexion_result);

//***termina

//consulta para primer combo de fuente
$sql = "SELECT * from fuente";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

//consulta para segundo combo si o no decision
$sql2 = "select * from resul_llamada";
$result2 = $conexion->query($sql2);

//consulta .ficha identidad / edo civil
$sql3 = "select * from edo_civil";
$result3 = $conexion->query($sql3);

//consulta .ficha identidad / direccion
$sql4 = "select * from direccion";
$result4 = $conexion->query($sql4);

//consulta .ficha identidad / escolaridad
$sql5 = "select * from escolaridad";
$result5 = $conexion->query($sql5);

//consulta .ficha identidad / imagen
$sql6 = "select * from puntuacion";
$result6 = $conexion->query($sql6);

//consulta .evaluacion / factores know-out
$sql7 = "select * from knowout";
$result7 = $conexion->query($sql7);

//comprobacion de resultados 1
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit = "";
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $combobit .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 2
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit2 = "";
  while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
    $combobit2 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 3
if ($result3->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit3 = "";
  while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
    $combobit3 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 4
if ($result4->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit4 = "";
  while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
    $combobit4 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 5
if ($result5->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit5 = "";
  while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
    $combobit5 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 6
if ($result6->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit6 = "";
  while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
    $combobit6 .= " <option value='" . $row['puntuacion'] . "'>" . $row['puntuacion'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 7
if ($result7->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit7 = "";
  while ($row = $result7->fetch_array(MYSQLI_ASSOC)) {
    $combobit7 .= " <option value='" . $row['factor'] . "'>" . $row['factor'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
$conexion->close(); //cerramos la conexión

?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <title></title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <!--<script src="js/funciones2.js"></script>-->
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
</head>


<script type="text/javascript">
  $(document).ready(function() {
    $('#checkbox').on('change', function() {
      if (this.checked) {
        $("#referido").show();
      } else {
        $("#referido").hide();
      }
    })
  });

  $(document).ready(function() {
    $('#modalNuevo').on('hidden.bs.modal', function() {
      $(this).find("input,textarea,select,checkbox").val('').end();
    });
  });
</script>

<body onload="mostrarcarrera(); contarcheckbox(); res_gdd(); res_pp200(); fc21();">

  <!--Barra de navegacion -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li><a><span class="label label-primary">Bienvenido: <?php echo $edat ?></span></a></li>
          <input hidden id="edat" value="<?php echo $edat ?>">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="resultados_conectados.php">Seguimiento</a></li>
          <li><a href="metas.php">Metas y resultados</a></li>
          <li><a href="php/logout.php">Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <!--Termina barra de navegacion-->
  <div class="container">
    <div id="tabla"></div>
  </div>
  <!-- Modal para registros nuevos -->
  <form role="form" id="newModalForm" method="post" action="agregardatos.php">
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Prospecto</h4>
          </div>
          <div class="modal-body">

            <label>Nombre Completo</label>
            <input type="text" name="" value="" id="nombre" class="form-control input-sm" placeholder="Nombre A.Paterno A.Materno">
            <label>Apellido Paterno</label> 
            <input type="text" name="" value="" id="a_paterno" class="form-control input-sm" >
            <label>Apellido Materno</label> 
            <input type="text" name="" value="" id="a_materno" class="form-control input-sm" >
            <label>Telefono</label>
            <input type="text" name="" value="" id="telefono" class="form-control input-sm" placeholder="9876543210">
            <label>Correo</label>
            <input type="email" name="" value="" id="correo" class="form-control input-sm" placeholder="correo@ejemplo.com.mx">
            <span id="emailOK"></span>
            <script>
              document.getElementById('correo').addEventListener('input', function() {
                campo = event.target;
                valido = document.getElementById('emailOK');

                emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //Se muestra un texto a modo de ejemplo, luego va a ser un icono
                if (emailRegex.test(campo.value)) {
                  valido.innerText = "";
                } else {
                  valido.innerText = "Incorrecto, debe tener el formato algo@dominio.com\n" + "";
                }
              });
            </script>
            <label>Fuente</label>
            <select onClick="mostrarOcultar(this)" id="fuente2" name="fuente" onchange="copiar();" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php echo $combobit; ?>
            </select>
            <script type="text/javascript">
              function copiar() {
                document.getElementById("fuente").value = document.getElementById("fuente2").value;
              }
            </script>
            <input hidden type="text" id="fuente" name="fuente">
            <label>¿Es referido? </label> <input id="checkbox" name="checkbox" type="checkbox" onchange="myFunction();" style="width: 15px; height: 15px;"><br>
            <input id="referido" name="referido" type="text" placeholder="Nombre de quien refiere" style="display:none" class="form-control input-sm">
            <!--Fecha de registro invisible para los edat´s se usa php y muestra la fecha actual -->
            <input hidden placeholder="fecharegistro" type="text" name="" id="fechareg" value="<?php echo date('Y-m-d') ?>">
            <label>Resultado de llamada: </label>
            <select id="resultado_llamada" name="resultado_llamada" onChange="mostrar();" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php echo $combobit2; ?>
            </select>
            <script>
              function mostrar() {
                var opcion = document.getElementById("resultado_llamada").value;
                // alert(opcion);
                if (opcion == "CITA") {
                  document.getElementById('res_cita').style.display = 'block';
                } else {
                  document.getElementById('res_cita').style.display = 'none';
                }
              }
            </script>

            <div id="res_cita" name="res_cita" style="display:none;">
              <label>Fecha Cita</label>
              <input type="date" name="" value="" id="fecha_cita" class="form-control input-sm">
              <label>Hora Cita</label>
              <input type="time" name="" value="" id="hora_cita" class="form-control input-sm">
              <input type="text" name="" value="<?php echo "$edat"; ?>" id="edat" class="form-control input-sm" style="visibility:hidden" disabled>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">Agregar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="contenido"></div>
  </form>
  <!-- Modal para edicion de datos -->
  <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
        </div>
        <div class="modal-body">
          <input type="text" hidden="" id="idpersona" name="">
          <label>Nombre Completo</label>
          <input type="text" name="" value="" id="nombreu" class="form-control input-sm">
          <!-- <label>Apellido</label> -->
          <input type="text" name="" value="" id="apellidou" hidden>
          <label>Telefono</label>
          <input type="text" name="" value="" id="telefonou" class="form-control input-sm">
          <label>Correo</label>
          <input type="text" name="" value="" id="correou" class="form-control input-sm">
          <label>Fuente</label>
          <select onClick="mostrarOcultar(this)" id="fuenteu" class="form-control input-sm">
            <option value="0">Seleccione:</option>
            <?php echo $combobit; ?>
          </select>
          <label>Lo refiere</label>
          <input type="text" name="" value="" id="referidou" class="form-control input-sm">
          <label>Resultado Llamada</label>
          <input type="text" name="" value="" id="resultado_llamadau" class="form-control input-sm">
          <label>Fecha Cita</label>
          <input type="date" name="" value="" id="fecha_citau" class="form-control input-sm">
          <label>Hora Cita</label>
          <input type="time" name="" value="" id="hora_citau" class="form-control input-sm">
          <label>Fecha Registro</label>
          <input disabled type="date" name="" value="" id="fecharegu" class="form-control input-sm">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="eliminar" data-dismiss="modal">Eliminar</button>
          <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para ficha identidad -->
  <div class="modal fade" id="modalFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ficha Identidad</h4>
        </div>
        <div class="modal-body">


          <label>Acudió Entrevista?</label>
          <select type="text" name="acudio" value="" id="acudio" onChange="mostrar1();" class="form-control input-sm">
            <option value="Seleccionar:">Seleccionar:</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
            <option value="Si/No">Si, No le intereso</option>>
          </select>

          <script>
            function mostrar1() {
              var opcion = document.getElementById("acudio").value;

              if (opcion == "Si") {
                document.getElementById('t_entrevista').style.display = 'block';
              } else {
                document.getElementById('t_entrevista').style.display = 'none';
              }
            }
          </script>

          <div id="t_entrevista" name="t_entrevista" style="display:none;">
            <label>Edad</label>
            <input type="number" name="" value="" id="edad" class="form-control input-sm">
            <label>Estado Civil:</label>
            <select type="text" name="" value="" id="edo_civil" class="form-control input-sm">
              <option value="Seleccionar:">Seleccione:</option>
              <?php echo $combobit3; ?>
            </select>
            <label>Alcaldia</label>
            <select type="text" name="" value="" id="direccion" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php
              echo $combobit4; ?>
            </select>
            <label>No. Dependientes Económicos </label>
            <input type="number" name="" value="" id="dependientes" class="form-control input-sm">
            <label>Ocupación Actual</label>
            <input type="text" name="" value="" id="ocupacion" class="form-control input-sm">
            <label>Escolaridad</label>
            <select type="text" name="" value="" id="escolaridad" onchange="mostrarcarrera();" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php
              echo $combobit5; ?>
            </select>
            <label id="label_carrera" style="display:none;">Carrera</label>
            <input type="text" name="" value="" id="carrera" class="form-control input-sm" style="display:none;">
            <script>
              function mostrarcarrera() {
                //  PAra aparecer o desaparecer
                var opcion = document.getElementById("escolaridad").value;
                //alert(opcion);
                if (opcion == "BACHILLERATO CONCLUIDO" || "0") {
                  document.getElementById('label_carrera').style.display = 'none';
                  document.getElementById('carrera').style.display = 'none';
                }
                if (opcion != "BACHILLERATO CONCLUIDO") {
                  document.getElementById('label_carrera').style.display = 'block';
                  document.getElementById('carrera').style.display = 'block';
                }
              }
            </script>
            <label>Institución</label>
            <input type="text" name="" value="" id="institucion" class="form-control input-sm" placeholder="UNAM, UAM, IPN, ETC...">
            <label>Ingreso Actual o Anterior</label>
            <input type="number" name="" value="" id="ingreso" class="form-control input-sm" placeholder="$">
            <label>Transporte</label>
            <select type="text" name="" value="" id="trans" class="form-control input-sm">
              <option value="0">Seleccionar:</option>
              <option value="Auto">Auto</option>
              <option value="Moto">Moto</option>
            </select>
            <label>Tiempo Disponible para Actividad</label>
            <select type="text" name="" value="" id="tiempo" class="form-control input-sm">
              <option value="0">Seleccionar:</option>
              <option value="Mas de 6 horas">Más de 6 horas</option>
              <option value="Menos de 6 horas">Menos de 6 horas</option>
            </select>
            <label>Imagen</label>
            <select type="text" name="" value="" id="imagen" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php
              echo $combobit6; ?>
            </select>
          </div>


        </div>



        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizaficha" data-dismiss="modal">Actualizar</button>
        </div>


      </div>
    </div>
  </div>
  <!-- Modal para Evaluacion -->
  <div class="modal fade" id="modalEvaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluacion</h4>
        </div>
        <div class="modal-body">
          <input hidden type="text" value="" id="idpersona" name="">

          <center><label><strong><u>Factores Vitales</u></strong></label></center>
          <br>
          <table>
            <tr>
              <td><label>Caracter e Integridad</label></td>
              <td> <select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="caracter" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td><label>Sentido Común</label></td>
              <td><select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="sentido" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td><label>Orientación al Logro</label></td>
              <td><select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="orientacion" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td> <label>Alto Nivel de Energia</label></td>
              <td><select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="energia" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td><label>Motivación por el Dinero</label></td>
              <td> <select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="motivacion" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td><label>Perseverancia</label></td>
              <td><select type="text" name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="perseverancia" class="form-control input-sm" onchange="suma_vitales();">
                  <?php
                  echo $combobit6; ?>
                </select></td>
            </tr>
            <tr>
              <td><label>Suma: </label></td>
              <td><input type="text" disabled name="" value="" style="width: 65px; height: 25px; margin-left: 5px" id="suma_vitales" class="form-control input-sm"></td>
            </tr>
            <script>
              function suma_vitales() {
                //Script para suma de datos al cargar la pagina suma automaticamente y cuando se cambia o se toca algun boton igual se actualiza automaticamente
                var caracter = document.getElementById("caracter").value;
                var sentido = document.getElementById("sentido").value;
                var orientacion = document.getElementById("orientacion").value;
                var energia = document.getElementById("energia").value;
                var motivacion = document.getElementById("motivacion").value;
                var perseverancia = document.getElementById("perseverancia").value;

                document.getElementById("suma_vitales").value = parseFloat(caracter) + parseFloat(sentido) + parseFloat(orientacion) + parseFloat(energia) + parseFloat(motivacion) + parseFloat(perseverancia);
              }
            </script>
          </table>
        </div>
        <div class="modal-footer">
          <center><u>Recuerda que el mínimo sugerido es de 42 puntos (Sin ningún 5)</u>
            <br><br>
            <button type="button" class="btn btn-warning" id="factores_vitales" data-dismiss="modal" data-toggle="modal" data-target="#modalknowout">Actualizar</button>
          </center>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para Factores know-out-->
  <div class="modal fade" id="modalknowout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Factores Know-Out</u></strong></label></center>
          <br>
          <style>
            #modalknowout td {
              padding-left: 5px;
              vertical-align: middle;
            }

            #modalknowout .modal-body {
              height: 500px;
              width: 100%;
              overflow-y: auto;
            }
          </style>
          <table class="table" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
            <thead>
              <tr>
                <th>Concepto</th>
                <th>CheckBox</th>
                <th>Concepto</th>
                <th>CheckBox</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label>Falta de patrón de exito </label> </td>
                <td> <input type="checkbox" value="Patron exito" id="kopatron" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>No posee seguros</label></td>
                <td> <input type="checkbox" value="Seguros" id="koseguros" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Bajo nivel de energia</label></td>
                <td><input type="checkbox" value="Energia" id="koenergia" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>Recientemente divorciado</label></td>
                <td> <input type="checkbox" value="Divorciado" id="kodivorciado" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Malos habitos de vida</label></td>
                <td><input type="checkbox" value="Habitos" id="kohabitos" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>Cambia de trabajo con frecuencia (inestable)</label></td>
                <td> <input type="checkbox" value="Inestable" id="koinestable" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Mercado natural débil - falta de contactos</label></td>
                <td><input type="checkbox" value="Mercado" id="komercado" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>Considera las ventas como un retroceso</label></td>
                <td> <input type="checkbox" value="Retroceso" id="koretroceso" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Falta de movilidad social</label></td>
                <td><input type="checkbox" value="Movilidad" id="komovilidad" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>En zona confort</label></td>
                <td> <input type="checkbox" value="Confort" id="koconfort" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Muchas deudas / quiebra reciente</label></td>
                <td><input type="checkbox" value="Deudas" id="kodeudas" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>Necesita trabajo desesperada e inmediatamente</label></td>
                <td> <input type="checkbox" value="Desesperado" id="kodesesperado" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td><label>Culpa a los demas por su falta de exito</label></td>
                <td><input type="checkbox" value="Culpa" id="koculpa" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>No tiene colchón economico</label></td>
                <td><input type="checkbox" value="Colchon" id="kocolchon" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
            </tbody>
          </table>

          <script>
            function contarcheckbox() {
              var cant = 0;
              if (document.getElementById('kopatron').checked) {
                cant++;
              }
              if (document.getElementById('koenergia').checked) {
                cant++;
              }
              if (document.getElementById('kohabitos').checked) {
                cant++;
              }
              if (document.getElementById('komercado').checked) {
                cant++;
              }
              if (document.getElementById('komovilidad').checked) {
                cant++;
              }
              if (document.getElementById('kodeudas').checked) {
                cant++;
              }
              if (document.getElementById('koculpa').checked) {
                cant++;
              }
              if (document.getElementById('koseguros').checked) {
                cant++;
              }
              if (document.getElementById('kodivorciado').checked) {
                cant++;
              }
              if (document.getElementById('koinestable').checked) {
                cant++;
              }
              if (document.getElementById('koretroceso').checked) {
                cant++;
              }
              if (document.getElementById('koconfort').checked) {
                cant++;
              }
              if (document.getElementById('kodesesperado').checked) {
                cant++;
              }
              if (document.getElementById('kocolchon').checked) {
                cant++;
              }
              if (cant == 0) {
                document.getElementById("koresultado").value = "Aceptable";
              }
              if (cant == 1) {
                document.getElementById("koresultado").value = "1 Factor = Preocupante";
              }
              if (cant == 2) {
                document.getElementById("koresultado").value = ("2 Factores = Menos del 50% de \n probabilidad de exito");
              }
              if (cant >= 3) {
                document.getElementById("koresultado").value = "3 Factores = No continuar";
              }
            }
          </script>
          <center><label>Resultado Factores Know-Out</label>
            <input disabled placeholder="Aceptable" type="text" id="koresultado" style="height:50px" class="form-control input-sm">
          </center>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="knowout" data-dismiss="modal" data-toggle="modal" data-target="#modalprevisibilidad">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Modal para Previsibilidad de exito-->
  <div class="modal fade" id="modalprevisibilidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Previsibilidad de Éxito</u></strong></label></center>
          <br>
          <style>
            #modalprevisibilidad td {
              padding-left: 5px;
              vertical-align: middle;
              text-align: center;
            }

            #modalprevisibilidad th {
              padding-left: 5px;
              vertical-align: middle;
              text-align: center;
            }

            #modalprevisibilidad .modal-body {
              height: 500px;
              width: 100%;
              overflow-y: auto;
            }
          </style>
          <table class="table" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
            <thead>
              <tr>
                <th>Criterio</th>
                <th>(Menos)</th>
                <th colspan="2">Puntuacion</th>
                <th>(Mas)</th>
              </tr>
            </thead>
            <tbody>
              <form id="form1" name="form1" method="post" action="">
                <tr>
                  <th rowspan="2">Presentado/Recomendado por un colega exprimentado.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" value="0" id="reco_0" name="inlineDefaultRadiosExample">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" value="20" id="reco_20" name="inlineDefaultRadiosExample">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2">Ha demostrado orientacion hacia el logro durante el proceso de selección.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_0" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_10" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_15" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_20" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene alto potencial de arranque rapido y un mercado solido.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_0" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_10" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_15" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_20" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene una actitud optimista</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_0" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_10" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_15" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_20" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2">Ha tenido éxito como vendedor a comision, entrenador o empresario independiente.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="exito_0" name="inlineDefaultRadiosExample5">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="exito_10" name="inlineDefaultRadiosExample5">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene/tuvo un ingreso entre $30,000 y $50,000.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="ingreso_0" name="inlineDefaultRadiosExample6">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="ingreso_10" name="inlineDefaultRadiosExample6">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene titulo universitario.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="titulo_0" name="inlineDefaultRadiosExample7">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="titulo_10" name="inlineDefaultRadiosExample7">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Posee un seguro de vida permanente.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_5" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_7" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_10" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>5</label></th>
                  <th><label>7</label></th>
                  <th><label>10</label></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">No ha estado desempleado durante los últimos 18 meses.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="desempleado_0" name="inlineDefaultRadiosExample9">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="desempleado_5" name="inlineDefaultRadiosExample9">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene estabilidad economica.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_0" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_5" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_10" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th><label>10</label></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Ha desmotrado superacion personal en los ultimos 12 meses.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="superacion_0" name="inlineDefaultRadiosExample11">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="superacion_5" name="inlineDefaultRadiosExample11">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th rowspan="2">Tiene dependientes economicos.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="dependientes_0" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="dependientes_5" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <tr>
                  <th><label>0 (1)</label></th>
                  <th><label>5 (+2)</label></th>
                  <th bgcolor="#F5710F"></th>
                  <th bgcolor="#F5710F"></th>
                </tr>
                <script>
                  //funciones primera linea recomendado
                  function sumadecheckbox() {
                    //primer linea
                    var reco_0 = document.getElementById("reco_0").checked;
                    var reco_20 = document.getElementById("reco_20").checked;
                    if (reco_0 == true) {
                      document.getElementById("uno").value = "0";
                    }
                    if (reco_20 == true) {
                      document.getElementById("uno").value = "20";
                    }
                    //segunda linea
                    var orientacion_0 = document.getElementById("orientacion_0").checked;
                    var orientacion_10 = document.getElementById("orientacion_10").checked;
                    var orientacion_15 = document.getElementById("orientacion_15").checked;
                    var orientacion_20 = document.getElementById("orientacion_20").checked;
                    if (orientacion_0 == true) {
                      document.getElementById("dos").value = "0";
                    }
                    if (orientacion_10 == true) {
                      document.getElementById("dos").value = "10";
                    }
                    if (orientacion_15 == true) {
                      document.getElementById("dos").value = "15";
                    }
                    if (orientacion_20 == true) {
                      document.getElementById("dos").value = "20";
                    }
                    //tercera linea
                    var potencial_0 = document.getElementById("potencial_0").checked;
                    var potencial_10 = document.getElementById("potencial_10").checked;
                    var potencial_15 = document.getElementById("potencial_15").checked;
                    var potencial_20 = document.getElementById("potencial_20").checked;
                    if (potencial_0 == true) {
                      document.getElementById("tres").value = "0";
                    }
                    if (potencial_10 == true) {
                      document.getElementById("tres").value = "10";
                    }
                    if (potencial_15 == true) {
                      document.getElementById("tres").value = "15";
                    }
                    if (potencial_20 == true) {
                      document.getElementById("tres").value = "20";
                    }
                    //cuarta linea
                    var actitud_0 = document.getElementById("actitud_0").checked;
                    var actitud_10 = document.getElementById("actitud_10").checked;
                    var actitud_15 = document.getElementById("actitud_15").checked;
                    var actitud_20 = document.getElementById("actitud_20").checked;
                    if (actitud_0 == true) {
                      document.getElementById("cuatro").value = "0";
                    }
                    if (actitud_10 == true) {
                      document.getElementById("cuatro").value = "10";
                    }
                    if (actitud_15 == true) {
                      document.getElementById("cuatro").value = "15";
                    }
                    if (actitud_20 == true) {
                      document.getElementById("cuatro").value = "20";
                    }
                    //quinta linea
                    var exito_0 = document.getElementById("exito_0").checked;
                    var exito_10 = document.getElementById("exito_10").checked;
                    if (exito_0 == true) {
                      document.getElementById("cinco").value = "0";
                    }
                    if (exito_10 == true) {
                      document.getElementById("cinco").value = "10";
                    }
                    //sexta linea
                    var ingreso_0 = document.getElementById("ingreso_0").checked;
                    var ingreso_10 = document.getElementById("ingreso_10").checked;
                    if (ingreso_0 == true) {
                      document.getElementById("seis").value = "0";
                    }
                    if (ingreso_10 == true) {
                      document.getElementById("seis").value = "10";
                    }
                    //septima linea
                    var titulo_0 = document.getElementById("titulo_0").checked;
                    var titulo_10 = document.getElementById("titulo_10").checked;
                    if (titulo_0 == true) {
                      document.getElementById("siete").value = "0";
                    }
                    if (titulo_10 == true) {
                      document.getElementById("siete").value = "10";
                    }
                    //octava linea
                    var seguro_5 = document.getElementById("seguro_5").checked;
                    var seguro_7 = document.getElementById("seguro_7").checked;
                    var seguro_10 = document.getElementById("seguro_10").checked;
                    if (seguro_5 == true) {
                      document.getElementById("ocho").value = "0";
                    }
                    if (seguro_7 == true) {
                      document.getElementById("ocho").value = "7";
                    }
                    if (seguro_10 == true) {
                      document.getElementById("ocho").value = "10";
                    }
                    //novena linea
                    var desempleado_0 = document.getElementById("desempleado_0").checked;
                    var desempleado_5 = document.getElementById("desempleado_5").checked;
                    if (desempleado_0 == true) {
                      document.getElementById("nueve").value = "0";
                    }
                    if (desempleado_5 == true) {
                      document.getElementById("nueve").value = "5";
                    }
                    //decima linea
                    var estabilidad_0 = document.getElementById("estabilidad_0").checked;
                    var estabilidad_5 = document.getElementById("estabilidad_5").checked;
                    var estabilidad_10 = document.getElementById("estabilidad_10").checked;
                    if (estabilidad_0 == true) {
                      document.getElementById("diez").value = "0";
                    }
                    if (estabilidad_5 == true) {
                      document.getElementById("diez").value = "5";
                    }
                    if (estabilidad_10 == true) {
                      document.getElementById("diez").value = "10";
                    }
                    //undecimo linea
                    var superacion_0 = document.getElementById("superacion_0").checked;
                    var superacion_5 = document.getElementById("superacion_5").checked;
                    if (superacion_0 == true) {
                      document.getElementById("once").value = "0";
                    }
                    if (superacion_5 == true) {
                      document.getElementById("once").value = "5";
                    }
                    //duodecimo linea
                    var dependientes_0 = document.getElementById("dependientes_0").checked;
                    var dependientes_5 = document.getElementById("dependientes_5").checked;
                    if (dependientes_0 == true) {
                      document.getElementById("doce").value = "0";
                    }
                    if (dependientes_5 == true) {
                      document.getElementById("doce").value = "5";
                    }
                  };

                  function sumaexito() {

                    var uno = document.getElementById("uno").value;
                    var dos = document.getElementById("dos").value;
                    var tres = document.getElementById("tres").value;
                    var cuatro = document.getElementById("cuatro").value;
                    var cinco = document.getElementById("cinco").value;
                    var seis = document.getElementById("seis").value;
                    var siete = document.getElementById("siete").value;
                    var ocho = document.getElementById("ocho").value;
                    var nueve = document.getElementById("nueve").value;
                    var diez = document.getElementById("diez").value;
                    var once = document.getElementById("once").value;
                    var doce = document.getElementById("doce").value;

                    var suma = parseInt(uno) + parseInt(dos) + parseInt(tres) + parseInt(cuatro) + parseInt(cinco) + parseInt(seis) + parseInt(siete) + parseInt(ocho) + parseInt(nueve) + parseInt(diez) + parseInt(once) + parseInt(doce);

                    if (suma <= "65") {
                      document.getElementById("sumaexito1").value = "La suma es: " + suma + " No Califica";
                      document.getElementById("sumapotencial").value = suma;
                      document.getElementById("mensajepotencial").value = "No Califica";
                    }
                    if (suma >= "66" && suma <= "79") {
                      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Dudoso";
                      document.getElementById("sumapotencial").value = suma;
                      document.getElementById("mensajepotencial").value = "Dudoso";
                    }
                    if (suma >= "80" && suma <= "99") {
                      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Aceptable";
                      document.getElementById("sumapotencial").value = suma;
                      document.getElementById("mensajepotencial").value = "Aceptable";
                    }
                    if (suma >= "99") {
                      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Superior";
                      document.getElementById("sumapotencial").value = suma;
                      document.getElementById("mensajepotencial").value = "Superior";
                    }
                  }
                </script>
                <tr>
                  <input hidden value="0" onkeypress="sumaexito();" id="uno" type="text" name="uno">
                  <input hidden value="0" onchange="sumaexito();" id="dos" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="tres" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="cuatro" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="cinco" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="seis" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="siete" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="ocho" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="nueve" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="diez" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="once" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="doce" type="text">



                </tr>
                <th colspan="5">
                  <center><label>Suma de puntos potencial de exito</label>
                    <input disabled type="text" id="sumaexito1" style="height:50px" class="form-control input-sm">
                  </center>
                </th>
                <input hidden id="sumapotencial" name="sumapotencial" value="">
                <input hidden id="mensajepotencial" name="mensajepotencial" value="">
              </form>
            </tbody>
          </table>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="potencial" data-dismiss="modal" data-toggle="modal" data-target="#modalPSP">Actualizar y pasar a Evaluación PSP</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Indicadores del psp -->
  <div class="modal fade" id="modalPSP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Indicadores PSP</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Indicadores PSP</u></strong></label></center>
          <label>Rendimiento de venta</label>
          <select value="" id="rendimiento" name="rendimiento" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Inferior al Promedio">Inferior al Promedio</option>
            <option value="Promedio">Promedio</option>
            <option value="Superior al Promedio">Superior al Promedio</option>
          </select>
          <label>Precision de evaluación</label>
          <select id="precision" name="precision" value="" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Seguridad">Seguridad</option>
            <option value="Precaucion">Precaucion</option>
            <option value="Exagerado">Exagerado</option>
          </select>
          <label>Estilo de ventas</label>
          <select id="estilo" name="estilo" value="" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Analitico">Analitico</option>
            <option value="Dinamico">Dinamico</option>
            <option value="Interpersonal">Interpersonal</option>
            <option value="Analitico/Dinamico">Analitico/Dinamico</option>
            <option value="Analitico/Interpersonal">Analitico/Interpersonal</option>
            <option value="Dinamico/Analitico">Dinamico/Analitico</option>
            <option value="Dinamico/Interpersonal">Dinamico/Interpersonal</option>
            <option value="Interpersonal/Analitico">Interpersonal/Analitico</option>
            <option value="Interpersonal/Dinamico">Interpersonal/Dinamico</option>
          </select>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="psp" data-dismiss="modal">Actualizar PSP</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Entrevista GDD Modal -->
  <div class="modal fade" id="modalGDD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Entrevista / Venta de Carrera GDD</u></strong></label></center>
          <label>Gerente asignado</label>
          <select id="gerente" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Nancyn">Nancy</option>
            <option value="Roberton">Roberto</option>
            <option value="Omarn">Omar</option>
          </select>
          <label>¿Llego a venta de carrera?</label>
          <select id="venta" class="form-control input-sm" onChange="mostrar2();">
            <option value="0">Seleccione:</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>

          <script>
            function mostrar2() {
              var opcion = document.getElementById("venta").value;

              if (opcion == "Si") {
                document.getElementById('t_venta').style.display = 'block';
              } else {
                document.getElementById('t_venta').style.display = 'none';
              }
            }
          </script>

          <div id="t_venta" name="t_venta" style="display:none;">
            <label>Resultado Entrevista Gerente</label>
            <select id="res_gdd" class="form-control input-sm" onkeyup="res_gdd();">
              <option value="0">Seleccione:</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <label>Razones</label>
            <input id="razon" placeholder="Razones" class="form-control input-sm">
            <label>PP200</label>
            <select id="pp200" class="form-control input-sm" onchange="res_pp200();">
              <option value="0">Seleccione:</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <script>
              function res_pp200() {
                var res = document.getElementById("pp200").value;
                if (res == "Si") {
                  document.getElementById("pp200_observaciones").style.display = 'block';
                }
                if (res != "Si") {
                  document.getElementById("pp200_observaciones").style.display = 'none';
                }
              }
            </script>
            <input id="pp200_observaciones" placeholder="Observaciones de PP200" style="display: none" class="form-control input-sm">
            <label>Comentarios u observaciones GDD</label>
            <textarea id="comentarios_gdd" rows="4" cols="36">
          </textarea>
          </div>

          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="GDD" data-dismiss="modal">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Resultados -->
  <div class="modal fade" id="modalResultados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Resultados</u></strong></label></center>
          <label>Estatus de prospecto</label>
          <select id="estatus" onChange="mostrarr();" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Arranque">Arranque</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Declinó">Declinó</option>
            <option value="Documentos incompletos">Documentos incompletos</option>
          </select>

          <script>
            function mostrarr() {
              var opcion = document.getElementById("estatus").value;

              if (opcion == "Arranque") {
                document.getElementById('t_arranque').style.display = 'block';
              } else {
                document.getElementById('t_arranque').style.display = 'none';
              }
            }
          </script>

          <div id="t_arranque" name="t_arranque" style="display:none;">
            <label>Arranque</label>
            <select id="arranque" class="form-control">
              <option value="0">Selecciona:</option>
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <label>Fecha Inducción</label>
            <input type="date" id="fecha_induccion" class="form-control">
            <label>Comentarios</label>
            <textarea id="documentacion" rows="4" cols="36">
          </textarea>
          </div>


          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="resultados" data-dismiss="modal">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Conexion -->
  <div class="modal fade" id="modalConexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Evaluación</h4>
        </div>
        <div class="modal-body">
          <center><label><strong><u>Conexión</u></strong></label></center>

          <label>Conexión</label>
          <select id="conexion" class="form-control">
            <option value="0">Selecciona:</option>
            <option value="Provisional">Provisional</option>
            <option value="Definitiva">Definitiva</option>
          </select>
          <label>Fecha de Conexión</label>
          <input type="date" class="form-control" id="fecha_conexion1" onchange="fc()">
          <input type="text" hidden id="fecha_conexion" name="" value="">
          <script>
            function fc() {


              var fc1 = document.getElementById("fecha_conexion1").value;
              document.getElementById("fecha_conexion").value = fc1;

            };

            function fc2() {
              var fc21 = document.getElementById("fecha_conexion").value;
              document.getElementById("fecha_conexion1").value = fc21;
            }
          </script>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="cnx" data-dismiss="modal">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--DETALLES-->
  <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalles</h4>
        </div>

        <center><label><strong><u>Linea del tiempo del folio</u></strong></label></center>
        <table class="table table-hover table-condensed table-bordered" id="tabladinamicaload">
          <thead>
            <td align="center"><small><b>Contacto</small></b></td>
            <td align="center"><small><b>Entrevista</small></b></td>
            <td align="center"><small><b>Inducción</small></b></td>
            <td align="center"><small><b>Conexión</small></b></td>
          </thead>
          <tbody>
            <tr align="center">
              <td align="center"><small><b>
                    <input type="text" value="" id="f_contacto" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_entrevista" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_induccion" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_conexion" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
    <script src="js/funciones1.js"></script>
  </div>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabla').load('componentes/tabla.php');
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {


    $('#guardarnuevo').click(function() {

      edat = $('#edat').val();
      nombre = $('#nombre').val();
      a_paterno = $('#a_paterno').val();
      a_materno = $('#a_materno').val();
  
      fechareg = $('#fechareg').val();
      telefono = $('#telefono').val();
      correo = $('#correo').val();
      fuente = $('#fuente').val();
      referido = $('#referido').val();
      resultado_llamada = $('#resultado_llamada').val();
      fecha_cita = $('#fecha_cita').val();
      hora_cita = $('#hora_cita').val();
      agregardatos(edat, nombre, a_paterno, a_materno, fechareg, telefono, correo, fuente, referido, resultado_llamada, fecha_cita, hora_cita);
      reload();
    });

    $('#eliminar').click(function() {
      eliminar();
    });

    $('#actualizadatos').click(function() {
      actualizadatos();
    });

    $('#actualizaficha').click(function() {
      actualizaficha();
    });

    $('#factores_vitales').click(function() {
      actualizafactores();
    });

    $('#knowout').click(function() {
      actualizako();
    });

    $('#potencial').click(function() {
      actualizapotencial();
    });

    $('#psp').click(function() {
      actualizapsp();
    });

    $('#GDD').click(function() {
      actualizagdd();
    });

    $('#resultados').click(function() {
      actualizaresultado();
    });

    $('#cnx').click(function() {
      actualizacnx();
    });
  });
</script>