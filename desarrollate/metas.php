<?php
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

if ($conexion->connect_error) {
  die('Error de conexion: ' . $conexion->connect_error);
}

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d", $time);

$fechareal = date("Y-m-d", strtotime($fechaactual . "- 1 days"));


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
?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="librerias/alertifyjs/css/themes/default.css" rel="stylesheet" id="alertifyjs-css-themes">
  <link href="librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
  <link href="librerias/alertifyjs/css/alertify.css" rel="stylesheet" id="alertifyjs-css">
  <link href="librerias/select2/css/select2.css" rel="stylesheet" id="select2-css">
  <link href="librerias/datatables/dataTables.bootstrap.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="../imagenes/gam.ico">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script src="jquery-3.3.1.min.js"></script>
  <script src="javascript.js"></script>
  <link rel="stylesheet" href="stylesheet.css">

</head> <!-- LIBRERIAS-->

<body>
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
          <li><a href="index1.php">Regresar</a></li>
          <li><a href="php/logout.php">Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <!--Termina barra de navegacion-->

  <!--COMBOS DINAMICOS-->
  <div class="container">
    <label>Selecciona una opcion:</label>
    <select type="text" name="select" id="select" onChange="mostrarmes();" class="form-control input-sm" style="width:250px">
      <option value="Seleccionar">Seleccionar:</option>
      <option value="fdate">Por Fecha</option>
      <option value="Enero">Enero</option>
      <option value="Febrero">Febrero</option>
      <option value="Marzo">Marzo</option>
      <option value="Abril">Abril</option>
      <option value="Mayo">Mayo</option>
      <option value="Junio">Junio</option>
      <option value="Julio">Julio</option>
      <option value="Agosto">Agosto</option>
      <option value="Septiembre">Septiembre</option>
      <option value="Octubre">Octubre</option>
      <option value="Noviembre">Noviembre</option>
      <option value="Diciembre">Diciembre</option>
      <option value="Anual">Anual</option>
    </select>
  </div>
  <br>
  <!--Terminan combos-->
  <script>
    function mostrarmes() {
      var opcion = document.getElementById("select").value;
      if (opcion == "fdate") {
        document.getElementById('fdate').style.display = 'block';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';

      } else if (opcion == "Enero") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'block';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Febrero") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'block';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Marzo") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'block';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Abril") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'block';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Mayo") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'block';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Junio") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'block';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Julio") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'block';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Agosto") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'block';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Septiembre") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'block';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Octubre") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'block';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Noviembre") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'block';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Diciembre") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'block';
        document.getElementById('Anual').style.display = 'none';
      } else if (opcion == "Anual") {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'block';
      } else {
        document.getElementById('fdate').style.display = 'none';
        document.getElementById('Enero').style.display = 'none';
        document.getElementById('Febrero').style.display = 'none';
        document.getElementById('Marzo').style.display = 'none';
        document.getElementById('Abril').style.display = 'none';
        document.getElementById('Mayo').style.display = 'none';
        document.getElementById('Junio').style.display = 'none';
        document.getElementById('Julio').style.display = 'none';
        document.getElementById('Agosto').style.display = 'none';
        document.getElementById('Septiembre').style.display = 'none';
        document.getElementById('Octubre').style.display = 'none';
        document.getElementById('Noviembre').style.display = 'none';
        document.getElementById('Diciembre').style.display = 'none';
        document.getElementById('Anual').style.display = 'none';
      }
    }
  </script>
  <script>
    function enviar() {
      var date1 = document.getElementById('date1').value;
      var date2 = document.getElementById('date2').value;
      var usuario = document.getElementById('usuario').value;

      var dataen = 'date1=' + date1 + '&date2=' + date2 + '&usuario=' + usuario;

      $.ajax({
        type: 'POST',
        url: 'sendg.php',
        data: dataen,
        success: function(resp) {
          $('#respa').html(resp);
        }
      });
      return false;
    }
  </script>

  <div class="container" id="fdate" name="fdate" style="display:none;">
    <form method="POST" onsubmit="return enviar();">
      <fieldset>
        <label>Desde:</label>
        <input type="date" id="date1" name="date1" />
        <label>Hasta:</label>
        <input type="date" id="date2" name="date2" />
        <button type="submit" value="Enviar">Buscar</button>
        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$edat"; ?>">
      </fieldset>
    </form>
    <br><br>
    <p id="respa"></p>
  </div>

  <!--ENERO------------------------------------------------------------------------------------------------>
  <div class="container" id="Enero" name="Enero" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Enero</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-01-01' AND '2021-01-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-01-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-01-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-01-01' AND '2021-01-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-01-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-01-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN ENERO***********************************************************************************************************************-->

  <!--FEBRERO------------------------------------------------------------------------------------------------>
  <div class="container" id="Febrero" name="Febrero" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Febrero</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-02-01' AND '2021-02-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-02-01' AND '2021-02-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-02-01' AND '2021-02-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-02-01' AND '2021-02-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-02-01' AND '2021-02-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-02-01' AND '2021-02-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN FEBRERO***********************************************************************************************************************-->

  <!--MARZO------------------------------------------------------------------------------------------------>
  <div class="container" id="Marzo" name="Marzo" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Marzo</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-03-01' AND '2021-03-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-03-01' AND '2021-03-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-03-01' AND '2021-03-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-03-01' AND '2021-03-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-03-01' AND '2021-03-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-03-01' AND '2021-03-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN MARZO***********************************************************************************************************************-->

  <!--ABRIL------------------------------------------------------------------------------------------------>
  <div class="container" id="Abril" name="Abril" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Abril</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-04-01' AND '2021-04-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-04-01' AND '2021-04-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-04-01' AND '2021-04-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-04-01' AND '2021-04-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-04-01' AND '2021-04-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-04-01' AND '2021-04-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN ABRIL***********************************************************************************************************************-->

  <!--MAYO------------------------------------------------------------------------------------------------>
  <div class="container" id="Mayo" name="Mayo" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Mayo</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-05-01' AND '2021-05-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-05-01' AND '2021-05-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-05-01' AND '2021-05-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-05-01' AND '2021-05-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-05-01' AND '2021-05-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-05-01' AND '2021-05-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN MAYO***********************************************************************************************************************-->

  <!--JUNIO------------------------------------------------------------------------------------------------>
  <div class="container" id="Junio" name="Junio" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Junio</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-06-01' AND '2021-06-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-06-01' AND '2021-06-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-06-01' AND '2021-06-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-06-01' AND '2021-06-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-06-01' AND '2021-06-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-06-01' AND '2021-06-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN JUNIO***********************************************************************************************************************-->

  <!--JULIO------------------------------------------------------------------------------------------------>
  <div class="container" id="Julio" name="Julio" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Julio</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-07-01' AND '2021-07-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-07-01' AND '2021-07-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-07-01' AND '2021-07-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-07-01' AND '2021-07-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-07-01' AND '2021-07-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-07-01' AND '2021-07-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN JULIO***********************************************************************************************************************-->

  <!--AGOSTO------------------------------------------------------------------------------------------------>
  <div class="container" id="Agosto" name="Agosto" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Agosto</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-08-01' AND '2021-08-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-08-01' AND '2021-08-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-08-01' AND '2021-08-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-08-01' AND '2021-08-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-08-01' AND '2021-08-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-08-01' AND '2021-08-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN AGOSTO***********************************************************************************************************************-->


  <!--SEPTIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Septiembre" name="Septiembre" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Septiembre</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-09-01' AND '2021-09-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-09-01' AND '2021-09-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-09-01' AND '2021-09-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-09-01' AND '2021-09-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-09-01' AND '2021-09-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-09-01' AND '2021-09-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN SEPTIEMBRE***********************************************************************************************************************-->

  <!--OCTUBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Octubre" name="Octubre" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Octubre</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-10-01' AND '2021-10-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-10-01' AND '2021-10-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-10-01' AND '2021-10-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-10-01' AND '2021-10-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-10-01' AND '2021-10-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-10-01' AND '2021-10-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN OCTUBRE***********************************************************************************************************************-->

  <!--NOVIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Noviembre" name="Noviembre" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Noviembre</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-11-01' AND '2021-11-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-11-01' AND '2021-11-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-11-01' AND '2021-11-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-11-01' AND '2021-11-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-11-01' AND '2021-11-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-11-01' AND '2021-11-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN NOVIEMBRE***********************************************************************************************************************-->

  <!--DICIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Diciembre" name="Diciembre" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>MES</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Diciembre</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-12-01' AND '2021-12-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-12-01' AND '2021-12-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              echo $datos22;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-12-01' AND '2021-12-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              echo $datos33;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-12-01' AND '2021-12-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              echo $datos44;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-12-01' AND '2021-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              echo $datos55;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-12-01' AND '2021-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              echo $datos66;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datos11;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datos22;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datos33;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datos44;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datos55;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datos66;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN DICIEMBRE***********************************************************************************************************************-->

  <!--ANUAL------------------------------------------------------------------------------------------------>
  <div class="container" id="Anual" name="Anual" style="display:none;">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2021-01-01' AND '2021-12-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos1 = $ver[0];
              }
              echo $datos1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-12-31' AND acudio_entrevista like '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2 = $ver[0];
              }
              echo $datos2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-12-31' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3 = $ver[0];
              }
              echo $datos3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fecha_cita BETWEEN'2021-01-01' AND '2021-12-31'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4 = $ver[0];
              }
              echo $datos4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5 = $ver[0];
              }
              echo $datos5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fecha_cita BETWEEN'2021-01-01' AND '2021-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6 = $ver[0];
              }
              echo $datos6;
              ?>
            </small></td>
          <td rowspan="1"><small>
              <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos66 = $ver[0];
              }
              $datosa6 = $datos66 * 12;
              echo $datosa6;
              ?>
            </small></td>
        </tr>
        <tr align="center">
          <!--PORCENTAJES-->
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos1;
                $n2 = $datosa1;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos2;
                $n2 = $datosa2;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos3;
                $n2 = $datosa3;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos4;
                $n2 = $datosa4;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos5;
                $n2 = $datosa5;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
          <td colspan="2"><b><small>
                <?php
                $n1 = $datos6;
                $n2 = $datosa6;
                $total = $n1 * 100 / $n2;
                echo round($total);
                ?> %
              </small></b></td>
        </tr>
        <tr align="center">
          <!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!--FIN ANUAL***********************************************************************************************************************-->
</body>

</html>