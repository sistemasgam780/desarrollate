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
} else if (time() - $_SESSION['tiempo'] > 1800) {
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

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fechaActual = strftime("%Y-%m-%d");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Metas y Resultados</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.11.4/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.11.4/datatables.min.js"></script>


  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
  <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="js/funciones_mesMetas-edat.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- HOJAS DE ESTILO -->
  <link href="style/style_metas.css" rel="stylesheet" type="text/css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<body>
  <!--Barra de navegacion -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <?php
          if ($edat == 'Alan Soto') { ?>
            <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenido <?= $edat ?></li>
          <?php
          } elseif ($edat == 'Paloma Razo' || $edat == 'Nallely Quintana' || $edat == 'Yazmin Albarran') { ?>
            <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenida <?= $edat ?></li>
          <?php
          }
          ?>
          <input hidden id="edat" value="<?php echo $edat ?>">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- <li><a href="resultados_conectados.php"><span class="glyphicon glyphicon-search"></span> Seguimiento</a></li> -->
          <li><a href="edat.php"><span class="glyphicon glyphicon-chevron-left"></span>Regresar</a></li>
          <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <!--COMBOS DINAMICOS-->
  <div class="container">
    <div class="form-group form-control-sm">
      <label for="exampleFormControlSelect1">Seleccione su consulta:</label>
      <select type="text" name="select" id="select" onChange="mostrarmes();" class="form-control input-sm">
        <option value="Seleccionar" selected disabled hidden>Seleccione:</option>
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
  </div>

  <!-- FECHA PERSONALIZADA -->
  <div id="fdate" name="fdate" style="display:none;">
    <div class="container">
      <form method="POST" onsubmit="return enviar();">
        <div class="metasFecha">
          <label>Ingrese la fecha que desea consultar:</label>
          <div class="text-center">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Desde </label><input type="date" id="date1" name="date1" class="form-control form-control-sm input-sm">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Hasta </label><input type="date" id="date2" name="date2" class="form-control form-control-sm input-sm" value="<?php echo $fechaActual ?>">
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <button id="submit" type="submit" class="btn btn-info">Consultar</button>
              </div>
            </div>
          </div>
        </div>
        <input type="text" hidden="" id="usuario" name="usuario" value="<?php echo "$edat"; ?>">
      </form>
    </div>
    <div class="container">
      <p id="respa"></p>
    </div>
  </div>






  <!--ENERO------------------------------------------------------------------------------------------------>
  <div class="container" id="Enero" name="Enero" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALENE();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSENE();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAENE();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONENE();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTAENE();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONENE();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXION12();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="eneroP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-01-01' AND '2023-01-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-01-01' AND '2023-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-01-01' AND '2023-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-01-01' AND '2023-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-01-01' AND '2023-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;
            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-01-01' AND '2023-01-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-01-01' AND '2023-01-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "---";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "---";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "---";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tabla1m" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de Enero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de diciembre del 2022";
            ?>
          </td>
            <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND date(fechareg) BETWEEN '2022-01-01' AND '2022-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND date(fechareg) BETWEEN '2022-01-01' AND '2022-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-12-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2022-12-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato3 = $datos1e + $datos1ee;
            echo $datos1e;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    
                ?>
              </label>
            <?php }  ?>
          </td>
          
          
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tabla2m" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de enero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de enero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-01-01' AND '2022-01-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2022-01-01' AND '2022-01-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-12-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2022-12-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-01-01' AND '2023-01-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2023-01-01' AND '2023-01-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tabla3m" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de Enero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de enero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-01-01' AND '2022-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2022-01-01' AND '2022-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2022-12-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2022-12-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-01-01' AND '2023-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2023-01-01' AND '2023-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];

          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 12;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 12;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = 12;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = 12;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tabla4m" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de Enero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de enero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-01-01' AND '2022-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-01-01' AND '2022-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-12-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-12-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-01-01' AND '2023-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-01-01' AND '2023-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              Objetivo
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 5;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 5;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = 5;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = 5;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tabla5m" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de Enero del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de Enero del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-01-01' AND '2022-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2022-01-01' AND '2022-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-12-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2022-12-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-01-01' AND '2023-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2023-01-01' AND '2023-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];

          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tabla6m" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de Enero del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de enero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-01-01' AND '2022-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2022-01-01' AND '2022-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-12-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2022-12-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }
            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";

          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 1;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo 1;
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = 1;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = 1;
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
  
  </div> 
 </div>

  <!--FEBRERO------------------------------------------------------------------------------------------------>
  <div class="container" id="Febrero" name="Febrero" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC2" type="button" class="btn btn-secondary" onclick="GENERAL2();">General</button>
      <button id="botonC2" type="button" class="btn btn-secondary" onclick="CONTACTOS2();">Contactos</button>
      <button id="botonE2" type="button" class="btn btn-secondary" onclick="ENTREVISTA2();">Entrevista</button>
      <button id="botonEv2" type="button" class="btn btn-secondary" onclick="EVALUACION2();">Evaluación</button>
      <button id="botonV2" type="button" class="btn btn-secondary" onclick="VENTA2();">Venta Carrera</button>
      <button id="botonI2" type="button" class="btn btn-secondary" onclick="INDUCCION2();">Inducción</button>
      <button id="botonCon2" type="button" class="btn btn-secondary" onclick="CONEXION2();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="febreroP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-02-01' AND '2023-02-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-02-01' AND '2023-02-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-02-01' AND '2023-02-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-02-01' AND '2023-02-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-02-01' AND '2023-02-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-02-01' AND '2023-02-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-02-01' AND '2023-02-29'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-02-01' AND '2023-02-29' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tabla1m22" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(*) FROM llenado_formulario WHERE edat = '$edat' AND date(fechareg) BETWEEN '2022-02-01' AND '2022-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $dato1 = $datos1e;
            echo $dato1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN'2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-02-01' AND '2023-02-29'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];

          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tabla2m22" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-02-01' AND '2022-02-29' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-01-01' AND '2023-01-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-02-01' AND '2023-02-29' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tabla3m22" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-02-01' AND '2022-02-29' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-01-01' AND '2023-01-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-02-01' AND '2023-02-28' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tabla4m22" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-02-01' AND '2022-02-29'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-01-01' AND '2023-01-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-02-01' AND '2023-02-29'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tabla5m22" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-02-01' AND '2022-02-29' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-01-01' AND '2023-01-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-02-01' AND '2023-02-29' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }

            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tabla6m22" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 28 de febrero del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de Enero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 28 de febrero del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-02-01' AND '2022-02-29' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-01-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-02-01' AND '2023-02-29' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--MARZO------------------------------------------------------------------------------------------------>
  <div class="container" id="Marzo" name="Marzo" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALM();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSM();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAM();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONM();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTAM();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONM();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONM();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="marzoP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND DATE(fechareg) BETWEEN'2023-03-01' AND '2023-03-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-03-01' AND '2023-03-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-03-01' AND '2023-03-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-03-01' AND '2023-03-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-03-01' AND '2023-03-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-03-01' AND '2023-03-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-03-01' AND '2023-03-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-03-01' AND '2023-03-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaM1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-03-01' AND '2022-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-02-01' AND '2023-02-29'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaM2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-03-01' AND '2022-03-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-02-01' AND '2023-02-28' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-03-01' AND '2023-03-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaM3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-03-01' AND '2022-03-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-02-01' AND '2023-02-28' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-03-01' AND '2023-03-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <div id="tablaM4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-03-01' AND '2022-03-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-02-01' AND '2023-02-29'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-03-01' AND '2023-03-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaM5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-03-01' AND '2022-03-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-02-01' AND '2023-02-28' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-03-01' AND '2023-03-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>

          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaM6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 28 de febrero del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de marzo del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-03-01' AND '2022-03-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-02-01' AND '2023-02-28' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-03-01' AND '2023-03-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--ABRIL------------------------------------------------------------------------------------------------>
  <div class="container" id="Abril" name="Abril" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALAB();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSAB();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAAB();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONAB();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASAB();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONAB();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONAB();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="abrilP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-04-01' AND '2023-04-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-04-01' AND '2023-04-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-04-01' AND '2023-04-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-04-01' AND '2023-04-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-04-01' AND '2023-04-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-04-01' AND '2023-04-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>
      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-04-01' AND '2023-04-30'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-04-01' AND '2023-04-30' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaAB1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-04-01' AND '2022-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {

            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaAB2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-04-01' AND '2022-04-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-03-01' AND '2023-03-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-04-01' AND '2023-04-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }

            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaAB3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-04-01' AND '2022-04-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-03-01' AND '2023-03-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-04-01' AND '2023-04-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaAB4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-04-01' AND '2022-04-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-03-01' AND '2023-03-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-04-01' AND '2023-04-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaAB5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-04-01' AND '2022-04-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-03-01' AND '2023-03-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-04-01' AND '2023-04-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaAB6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de marzo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de marzo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de abril del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-04-01' AND '2022-04-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-03-01' AND '2023-03-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-04-01' AND '2023-04-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>

            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--MAYO------------------------------------------------------------------------------------------------>
  <div class="container" id="Mayo" name="Mayo" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALMAY();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSMAY();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAMAY();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONMAY();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASMAY();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONMAY();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONMAY();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="mayoP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND date(fechareg) BETWEEN'2023-05-01' AND '2023-05-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-05-01' AND '2023-05-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-05-01' AND '2023-05-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-05-01' AND '2023-05-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-05-01' AND '2023-05-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-05-01' AND '2023-05-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>
      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-05-01' AND '2023-05-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-05-01' AND '2023-05-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>
          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaMAY1" style="display:none" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023";
            ?>
          </td>
                    <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
  
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-05-01' AND '2022-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
                     <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }

            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaMAY2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
  
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023";
            ?>
          </td>
                      <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-05-01' AND '2022-05-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-04-01' AND '2023-04-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
                     <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-05-01' AND '2023-05-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
         <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
 
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];

          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaMAY3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023";
            ?>
          </td>
                      <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-05-01' AND '2022-05-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-04-01' AND '2023-04-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-05-01' AND '2023-05-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td> 
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
             <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaMAY4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023";
            ?>
          </td>
                    <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-05-01' AND '2022-05-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-04-01' AND '2023-04-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
                        <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-05-01' AND '2023-05-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaMAY5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos" 7 <tr>
        <td rowspan=2></td>
        <td colspan=3 class="tdEncab_ctos">
          INDUCCIONES
        </td>
        <td colspan=2 class="tdEncab_ctos">
          VARIACIÓN %
        </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023"; ?>
          </td>
                     <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-05-01' AND '2022-05-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-04-01' AND '2023-04-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-05-01' AND '2023-05-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaMAY6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de mayo del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de abril del 2023";
            ?>
          </td>
                     <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de mayo del 2023";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-05-01' AND '2022-05-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-04-01' AND '2023-04-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
                      <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-05-01' AND '2023-05-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
        <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>  
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--JUNIO------------------------------------------------------------------------------------------------>
  <div class="container" id="Junio" name="Junio" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALJUN();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSJUN();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAJUN();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONJUN();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASJUN();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONJUN();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONJUN();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="junioP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-06-01' AND '2023-06-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-06-01' AND '2023-06-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-06-01' AND '2023-06-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-06-01' AND '2023-06-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-06-01' AND '2023-06-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-06-01' AND '2023-06-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>
      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-06-01' AND '2023-06-30'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-06-01' AND '2023-06-30' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaJUN1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
                    <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023 ";
            ?>
          </td>
          
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-06-01' AND '2022-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaJUN2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos" > <tr>
        <td rowspan=2></td>
        <td colspan=3 class="tdEncab_ctos">
          ENTREVISTAS
        </td>
        <td colspan=2 class="tdEncab_ctos">
          VARIACIÓN %
        </td>
        </tr>
        <tr>
 
          
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
                       <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023 ";
            ?>
          </td>
            
            <td class="periodo_an">
            Periodo anterior
          </td>
        <td class="periodo_a2">
            Periodo actual
          </td>
          
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-06-01' AND '2022-06-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-05-01' AND '2023-05-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>

                 <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-06-01' AND '2023-06-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
             </td>
        
        <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
   
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                 <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaJUN3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023";
            ?>
          </td>  
          
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
       
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-06-01' AND '2022-06-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-05-01' AND '2023-05-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
                   <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-06-01' AND '2023-06-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaJUN4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
                <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023";
            ?>
          </td>
        <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-06-01' AND '2022-06-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-05-01' AND '2023-05-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
                       <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-06-01' AND '2023-06-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
            <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
 
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
        <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaJUN5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
                  <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023 ";
            ?>
          </td>
         <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
 
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-06-01' AND '2022-06-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-05-01' AND '2023-05-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
                   <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-06-01' AND '2023-06-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
            <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
         
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>          


          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaJUN6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de junio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de mayo del 2023";
            ?>
          </td>
                    <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de junio del 2023 ";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-06-01' AND '2022-06-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-05-01' AND '2023-05-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-06-01' AND '2023-06-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--JULIO------------------------------------------------------------------------------------------------>
  <div class="container" id="Julio" name="Julio" style="display:none;" 2 <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALJUL();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSJUL();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAJUL();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONJUL();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASJUL();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONJUL();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONJUL();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="julioP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-07-01' AND '2023-07-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-07-01' AND '2023-07-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-07-01' AND '2023-07-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-07-01' AND '2023-07-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-07-01' AND '2023-07-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-07-01' AND '2023-07-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-07-01' AND '2023-07-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-07-01' AND '2023-07-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $ventaCSis = $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>

      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaJUL1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>
            <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-07-01' AND '2022-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
   
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaJUL2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>
         <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023 ";
            ?>
          </td> 

          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-07-01' AND '2022-07-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-06-01' AND '2023-06-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
                    <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-07-01' AND '2023-07-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>  
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/
            if ($var2 > "0") {

            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>   
  

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaJUL3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>

           <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023 ";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
   
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-07-01' AND '2022-07-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-06-01' AND '2023-06-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>

            <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-07-01' AND '2023-07-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
         <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
 
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>  
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaJUL4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>         

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>
             <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023 ";
            ?>
          </td>
      <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
     
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-07-01' AND '2022-07-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-06-01' AND '2023-06-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
                         <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-07-01' AND '2023-07-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
              <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaJUL5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
 
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>
                     <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023 ";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-07-01' AND '2022-07-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-06-01' AND '2023-06-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>

                   <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-07-01' AND '2023-07-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
         <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
 
        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>  
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaJUL6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de julio del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de junio del 2023";
            ?>
          </td>

          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de julio del 2023 ";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-07-01' AND '2022-07-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-06-01' AND '2023-06-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
                         <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-07-01' AND '2023-07-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td> 
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--AGOSTO------------------------------------------------------------------------------------------------>
  <div class="container" id="Agosto" name="Agosto" style="display:none;" 2 <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALAGO();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSAGO();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAAGO();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONAGO();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASAGO();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONAGO();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONAGO();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="agostoP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-08-01' AND '2023-08-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-08-01' AND '2023-08-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-08-01' AND '2023-08-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-08-01' AND '2023-08-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-08-01' AND '2023-08-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-08-01' AND '2023-08-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>
      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-08-01' AND '2023-08-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-08-01' AND '2023-08-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaAGO1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
 
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023 ";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-08-01' AND '2022-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
                      <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td> 
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
                       <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaAGO2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos" 4 <tr>
        <td rowspan=2></td>
        <td colspan=3 class="tdEncab_ctos">
          ENTREVISTAS
        </td>
        <td colspan=2 class="tdEncab_ctos">
          VARIACIÓN %
        </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
                     <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023 ";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-08-01' AND '2022-08-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-07-01' AND '2023-07-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
                      <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-08-01' AND '2023-08-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaAGO3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
                       <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-08-01' AND '2022-08-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-07-01' AND '2023-07-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
                   <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-08-01' AND '2023-08-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td> 
           <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaAGO4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
                         <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023 ";
            ?>
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
  
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-08-01' AND '2022-08-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-07-01' AND '2023-07-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
                      <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-08-01' AND '2023-08-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
 
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
            <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaAGO5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
                  <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023 ";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-08-01' AND '2022-08-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-07-01' AND '2023-07-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
                       <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-08-01' AND '2023-08-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
         <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
 
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
  
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
             <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaAGO6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>

          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de agosto del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de julio del 2023";
            ?>
          </td>
                      <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de agosto del 2023 ";
            ?>
          </td> 
          <td class="periodo_an">
            Periodo anterior
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>

        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-08-01' AND '2022-08-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-07-01' AND '2023-07-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
                       <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-08-01' AND '2023-08-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td  class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>

        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>

          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
             <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td> 
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--SEPTIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Septiembre" name="Septiembre" style="display:none;" 2 <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALSEP();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSSEP();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTASEP();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONSEP();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASSEP();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONSEP();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONSEP();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="septiembreP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-09-01' AND '2023-09-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-09-01' AND '2023-09-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-09-01' AND '2023-09-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-09-01' AND '2023-09-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-09-01' AND '2023-09-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-09-01' AND '2023-09-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            
              <?php
              $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos11 = $ver[0];
              }
              echo $datos11;
              ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-09-01' AND '2023-09-30'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-09-01' AND '2023-09-30' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaSEP1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2020 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-09-01' AND '2022-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaSEP2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-09-01' AND '2022-09-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-08-01' AND '2023-08-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-09-01' AND '2023-09-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaSEP3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-09-01' AND '2022-09-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-08-01' AND '2023-08-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-09-01' AND '2023-09-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaSEP4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-09-01' AND '2022-09-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-08-01' AND '2023-08-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-09-01' AND '2023-09-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaSEP5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-09-01' AND '2022-09-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-08-01' AND '2023-08-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-09-01' AND '2023-09-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaSEP6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de septiembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de agosto del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de septiembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-09-01' AND '2022-09-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-08-01' AND '2023-08-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-09-01' AND '2023-09-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--OCTUBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Octubre" name="Octubre" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALOCT();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSOCT();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAOCT();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONOCT();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASOCT();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONOCT();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONOCT();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="octubreP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND date(fechareg) BETWEEN'2023-10-01' AND '2023-10-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-10-01' AND '2023-10-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-10-01' AND '2023-10-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-10-01' AND '2023-10-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-10-01' AND '2023-10-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-10-01' AND '2023-10-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-10-01' AND '2023-10-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-10-01' AND '2023-10-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaOCT1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-10-01' AND '2022-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaOCT2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-10-01' AND '2022-10-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-09-01' AND '2023-09-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-10-01' AND '2023-10-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaOCT3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-10-01' AND '2022-10-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-09-01' AND '2023-09-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-10-01' AND '2023-10-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }


            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaOCT4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-10-01' AND '2022-10-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-09-01' AND '2023-09-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-10-01' AND '2023-10-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaOCT5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-10-01' AND '2022-10-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-09-01' AND '2023-09-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-10-01' AND '2023-10-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaOCT6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de octubre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de septiembre del 2023";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-10-01' AND '2022-10-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-09-01' AND '2023-09-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-10-01' AND '2023-10-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?> </label>

            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--NOVIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Noviembre" name="Noviembre" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALNOV();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSNOV();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTANOV();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONNOV();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASNOV();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONNOV();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONNOV();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="noviembreP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-11-01' AND '2023-11-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-11-01' AND '2023-11-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-11-01' AND '2023-11-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-11-01' AND '2023-11-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-11-01' AND '2023-11-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-11-01' AND '2023-11-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-11-01' AND '2023-11-30'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-11-01' AND '2023-11-30' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaNOV1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-11-01' AND '2022-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }

            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php }  ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?> </label>

            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaNOV2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2> </td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-11-01' AND '2022-11-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-10-01' AND '2023-10-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-11-01' AND '2023-11-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }

            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaNOV3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-11-01' AND '2022-11-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }

            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-10-01' AND '2023-10-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }


            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-11-01' AND '2023-11-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }


            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaNOV4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-11-01' AND '2022-11-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-10-01' AND '2023-10-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-11-01' AND '2023-11-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }

            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaNOV5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-11-01' AND '2022-11-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-10-01' AND '2023-10-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-11-01' AND '2023-11-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }

            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaNOV6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 30 de noviembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 31 de octubre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-11-01' AND '2022-11-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-10-01' AND '2023-10-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-11-01' AND '2023-11-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }

            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--DICIEMBRE------------------------------------------------------------------------------------------------>
  <div class="container" id="Diciembre" name="Diciembre" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALDIC();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSDIC();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTADIC();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONDIC();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASDIC();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONDIC();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONDIC();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="diciembreP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-12-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-12-01' AND '2023-12-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-12-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-12-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-12-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-12-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $datos11;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $datos22;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $datos33;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $datos44;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $datos55;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $datos66;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-12-01' AND '2023-12-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-12-01' AND '2023-12-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaDIC1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-12-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2022-12-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaDIC2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-12-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2022-12-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-11-01' AND '2023-11-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2023-11-01' AND '2023-11-30' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-12-01' AND '2023-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2023-12-01' AND '2023-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaDIC3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2022-12-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2022-12-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-11-01' AND '2023-11-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2023-11-01' AND '2023-11-30' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-12-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2023-12-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaDIC4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-12-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-12-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-11-01' AND '2023-11-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-11-01' AND '2023-11-30'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-12-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-12-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];

          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaDIC5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-12-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2022-12-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-11-01' AND '2023-11-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2023-11-01' AND '2023-11-30' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-12-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2023-12-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaDIC6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 01 al 31 de diciembre del 2022 ";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  01 al 30 de noviembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 01 al 31 de diciembre del 2023 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-12-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2022-12-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-11-01' AND '2023-11-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2023-11-01' AND '2023-11-30' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-12-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2023-12-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>

  <!--ANUAL------------------------------------------------------------------------------------------------>
  <div class="container" id="Anual" name="Anual" style="display:none;">

    <!-- SE AGREGA EL CÓDIGO DE TABLA DE RESULTADOS -->
    <div class="form-group" align="center">
      <button id="botonC" type="button" class="btn btn-secondary" onclick="GENERALANU();">General</button>
      <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOSANU();">Contactos</button>
      <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTAANU();">Entrevista</button>
      <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACIONANU();">Evaluación</button>
      <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTASANU();">Venta Carrera</button>
      <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCIONANU();">Inducción</button>
      <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXIONANU();">Conexión</button>
    </div>

    <!-- TABLA GENERAL -->
    <div id="anualP" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGral">
        <tr>
          <td></td>
          <td class="tdEncab_gralC">
            CONTACTOS
          </td>
          <td class="tdEncab_gralE">
            ENTREVISTA
          </td>
          <td class="tdEncab_gralEv">
            EVALUACIÓN
          </td>
          <td class="tdEncab_gralVc">
            VENTA DE CARRERA
          </td>
          <td class="tdEncab_gralIn">
            INDUCCIÓN
          </td>
          <td class="tdEncab_gralCon">
            CONEXIÓN
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralR">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fechareg BETWEEN'2023-01-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos1 = $ver[0];
            }
            echo $datos1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec1 BETWEEN'2023-01-01' AND '2023-12-31' AND acudio_entrevista like '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2 = $ver[0];
            }
            echo $datos2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec2 BETWEEN'2023-01-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'2023-01-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4 = $ver[0];
            }
            echo $datos4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec4 BETWEEN'2023-01-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5 = $ver[0];
            }
            echo $datos5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $edat . "' AND fec5 BETWEEN '2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6 = $ver[0];
            }
            echo $datos6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralOb">
            Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            $anual1 = $datos11 * 12;
            echo $anual1;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            $anual2 = $datos22 * 12;
            echo $anual2;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            $anual3 = $datos33 * 12;
            echo $anual3;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            $anual4 = $datos44 * 12;
            echo $anual4;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            $anual5 = $datos55 * 12;
            echo $anual5;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM metaa WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            $anual6 = $datos66 * 12;
            echo $anual6;
            ?>
          </td>
        </tr>
        <tr>
          <td class="tdEncab_gralRo">
            % Real vs. Objetivo
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos1;
            $n2 = $anual1;
            $total1 = $n1 * 100 / $n2;
            echo round($total1, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos2;
            $n2 = $anual2;
            $total2 = $n1 * 100 / $n2;
            echo round($total2, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos3;
            $n2 = $anual3;
            $total3 = $n1 * 100 / $n2;
            echo round($total3, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos4;
            $n2 = $anual4;
            $total4 = $n1 * 100 / $n2;
            echo round($total4, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos5;
            $n2 = $anual5;
            $total5 = $n1 * 100 / $n2;
            echo round($total5, 0);
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $datos6;
            $n2 = $anual6;
            $total6 = $n1 * 100 / $n2;
            echo round($total6, 0);
            ?> %
          </td>
        </tr>
        <tr>
          <td rowspan=2 class="tdEncab_gralP">
            Ponderación
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT contacto FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos11 = $ver[0];
            }
            echo $datos11;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT entrevista FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos22 = $ver[0];
            }
            echo $datos22;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos33 = $ver[0];
            }
            echo $datos33;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT venta FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos44 = $ver[0];
            }
            echo $datos44;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT induccion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos55 = $ver[0];
            }
            echo $datos55;
            ?> %
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT conexion FROM ponderacion WHERE edat = '" . $edat . "'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos66 = $ver[0];
            }
            echo $datos66;
            ?> %
          </td>
        </tr>
        <tr>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos11 / 100;
            $pon1 = $total1 * $pon;
            echo "( " . round($total1, 0) . " x " . $pon . " = " . round($pon1, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos22 / 100;
            $pon2 = $total2 * $pon;
            echo "( " . round($total2, 0) . " x " . $pon . " = " . round($pon2, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos33 / 100;
            $pon3 = $total3 * $pon;
            echo "( " . round($total3, 0) . " x " . $pon . " = " . round($pon3, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos44 / 100;
            $pon4 = $total4 * $pon;
            echo "( " . round($total4, 0) . " x " . $pon . " = " . round($pon4, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos55 / 100;
            $pon5 = $total5 * $pon;
            echo "( " . round($total5, 0) . " x " . $pon . " = " . round($pon5, 0) . " )";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $pon = $datos66 / 100;
            $pon6 = $total6 * $pon;
            echo "( " . round($total6, 0) . " x " . $pon . " = " . round($pon6, 0) . " )";
            ?>
          </td>
        </tr>
        <tr>
          <td colspan=5></td>
          <td class="tdEncab_gralEp">
            Evaluación ponderada
          </td>
          <td class="tdEncab_ResultEp">
            <?php
            $evaluacion = $pon1 + $pon2 + $pon3 + $pon4 + $pon5 + $pon6;

            echo round($evaluacion, 0) . "%";
            ?>
          </td>
        </tr>
      </table>

      <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
      <?php
      // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
      $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fecha_conexion AND fec5 BETWEEN '2023-01-01' AND '2023-12-31'";
      $resultReg = mysqli_query($conexion, $sqlReg);
      list($datosReg) = mysqli_fetch_row($resultReg);
      if ($datos1 >= 1) {

        // Consulta para obtener los resultados de lo que muestro en cada columna.  
        $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$edat' AND fec5 BETWEEN '2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%'";
        $resultT = mysqli_query($conexion, $sql);
        while ($conexiones = mysqli_fetch_array($resultT)) {
      ?>

          <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadConex">
            <td></td>
            <td class="tdFec_cont">
              CONTACTO
            </td>
            <td class="tdFec_entr">
              ENTREVISTA
            </td>
            <td class="tdFec_eva">
              EVALUACIÓN
            </td>
            <td class="tdFec_ventC">
              VENTA DE CARRERA
            </td>
            <td class="tdFec_ind">
              INDUCCIÓN
            </td>
            <td class="tdFec_cone">
              CONEXIÓN
            </td>
            <td class="tdFec_pros">
              CONECTADO
            </td>
            </tr>

            <tr>
              <td class="tdEncab_fecEdat">
                Fecha EDAT
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaCone = $conexiones['fecha_contacto'];
                if ($fechaCone == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaCone;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaEv = $conexiones['fecha_evaluacion'];
                if ($fechaEv == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaEv;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?php
                $fechaVenC = $conexiones['fecha_ventaCarrera'];
                if ($fechaVenC == '') {
                  echo "<b>---<b>";
                } else {
                  echo $fechaVenC;
                }
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_induccion'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_conexion'] ?>
              </td>
              <td rowspan=2 class="nombreProsp">
                <?= $conexiones['nombre'] ?>
              </td>
            </tr>
            <tr>
              <td class="tdEncab_fecSis">
                Fecha Sistema
              </td>
              <td class="tdResult_fec">
                <?php
                $contactoSis = $conexiones['fechareg'];
                $newDate_ConSis = date_create($contactoSis);
                $fecha = date_format($newDate_ConSis, 'Y-m-d');
                echo $fecha;
                ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fecha_cita'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec2'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec3'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec4'] ?>
              </td>
              <td class="tdResult_fec">
                <?= $conexiones['fec5']; ?>
              </td>
            </tr>
          </table>
      <?php
        }
      }
      ?>
    </div>

    <!-- COMINEZAN LAS TABLAS DINAMICAS -->
    <div id="tablaANU1" style="display:none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONTACTOS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2020-01-01' AND '2020-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2020-01-01' AND '2020-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato1 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2022-01-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2022-01-01' AND '2022-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato2 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND fechareg BETWEEN '2023-01-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }
            $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$edat' AND fechareg BETWEEN '2023-01-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1ee = $ver1[0];
            }
            $dato3 = $datos1e + $datos1ee;
            echo $datos1e + $datos1ee;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[2];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[2];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TERMINA LA TABLA 1 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
    <div id="tablaANU2" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            ENTREVISTAS
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato1 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2022-01-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2022-01-01' AND '2022-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato2 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec1 BETWEEN'2023-01-01' AND '2023-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec1 BETWEEN'2023-01-01' AND '2023-12-31' AND acudio_entrevista LIKE '%S%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos2ff = $ver[0];
            }
            $dato3 = $datos2f + $datos2ff;
            echo $datos2f + $datos2ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[3];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[3];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 3 -->
    <div id="tablaANU3" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            EVALUACIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='edat' AND fec2 BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato1 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2022-01-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2022-01-01' AND '2022-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato2 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec2 BETWEEN'2023-01-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec2 BETWEEN'2023-01-01' AND '2023-12-31' AND puntos > 0";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos3ff = $ver[0];
            }
            $dato3 = $datos3f + $datos3ff;
            echo $datos3f + $datos3ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES */
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>

        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[4];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[4];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>

      </table>
    </div>

    <!-- TABLA 4 -->
    <div id="tablaANU4" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            VENTAS DE CARRERA
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2020-01-01' AND '2020-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2020-01-01' AND '2020-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato1 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-01-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2022-01-01' AND '2022-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato2 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-01-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND gerente LIKE '%n%' AND fec3 BETWEEN'2023-01-01' AND '2023-12-31'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos4ff = $ver[0];
            }
            $dato3 = $datos4f + $datos4ff;
            echo $datos4f + $datos4ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[5];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[5];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 5 -->
    <div id="tablaANU5" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            INDUCCIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato1 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2022-01-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2022-01-01' AND '2022-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato2 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec4 BETWEEN'2023-01-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec4 BETWEEN'2023-01-01' AND '2023-12-31' AND arranque='Si'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos5ff = $ver[0];
            }
            $dato3 = $datos5f + $datos5ff;
            echo $datos5f + $datos5ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/
            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[6];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[6];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>

    <!-- TABLA 6 -->
    <div id="tablaANU6" style="display: none;" class="container">
      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos">
        <tr>
          <td rowspan=2></td>
          <td colspan=3 class="tdEncab_ctos">
            CONEXIONES
          </td>
          <td colspan=2 class="tdEncab_ctos">
            VARIACIÓN %
          </td>
        </tr>
        <tr>
          <td class="periodo_aa">
            <?php
            $fechaletra4 = strftime("%d de %B de %Y", strtotime($fecbda1));
            $fechaletra5 = strftime("%d de %B de %Y", strtotime($fecbda2));
            echo "Periodo año anterior <br>";
            echo "<br> 2020";
            ?>
          </td>
          <td class="periodo_aca">
            <?php
            $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
            $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
            echo "Periodo anterior a la consulta actual <br>";
            echo "<br>  2021 ";
            ?>
          </td>
          <td class="periodo_a">
            <?php
            echo "Periodo actual <br>";
            echo "<br> 2022 ";
            ?>
          </td>
          <td class="periodo_a2">
            Periodo actual
          </td>
          <td class="periodo_an">
            Periodo anterior
          </td>
        </tr>
        <tr>
          <td class="tdReal">
            Reales
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato1 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2022-01-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2022-01-01' AND '2022-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato2 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6ff = $ver[0];
            }
            $dato3 = $datos6f + $datos6ff;
            echo $datos6f + $datos6ff;
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato2;
            $var2 = ($var1 / $dato2) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
          <td colspan="2" class="tdEncab_reaOb">
            <?php
            $var1 = $dato3 - $dato1;
            $var2 = ($var1 / $dato1) * 100;
            if (is_infinite($var2)) {
              $var2 = 100;
            }
            if (is_nan($var2)) {
              $var2 = 0;
            }

            /*RESULTADO CON COLORES*/

            if ($var2 > "0") {
            ?>
              <label style="color: green; font-size: 18px;">
                <?php
                   if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } else {
            ?>
              <label style="color: red; font-size: 18px;">
                <?php
                    if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo '<span style="color:#5DADE2;text-align:center;">N/A</span>';             }else{             echo $format_number1 = round($var2, 0) . "%";             }
                ?>
              </label>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <?php
          $objetivo = "SELECT * FROM metaa WHERE edat = '" . $edat . "'";
          $objr = mysqli_query($conexion, $objetivo);
          while ($ro1 = mysqli_fetch_row($objr)) {
            $datos1r = $ro1[0] . "||" .
              $ro1[1] . "||" .
              $ro1[2] . "||" .
              $ro1[3] . "||" .
              $ro1[4] . "||" .
              $ro1[5] . "||" .
              $ro1[6] . "||" .
              $ro1[7];
          ?>
            <td class="tdObjetivo">
              <b>Objetivo</b>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">
              <?php
              echo $ro1[7];
              ?>
            </td>
            <td class="tdEncab_reaOb">

            </td>
            <td class="tdEncab_reaOb">

            </td>
        </tr>
        <tr>
          <td class="tdObjetivo">
            <b>% Real vs. Objetivo</b>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato1;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato2;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">
            <?php
            $n1 = $dato3;
            $n2 = $ro1[7];
            $total = $n1 * 100 / $n2;
            echo round($total) . " %";
            ?>
          </td>
          <td class="tdEncab_reaOb">

          </td>
          <td class="tdEncab_reaOb">

          </td>
        <?php } ?>
        </tr>
      </table>
    </div>
  </div>



  <!-- CODIGO CONTE DE CONECTADOS CON TOOLTIP -->
    <div id="tooltip" class="container" style="display:none;">
      <div  style="display: inline-block; display: 25%;" 
                rel="tooltip" 
                data-toggle="tooltip" 
               data-trigger="hover" 
                data-placement="right" 
               data-html="true" 
              data-title="  
                   <div style='background:#F2F2F2; background-color:#EAEDED;  '>
                    
                      <table class='table-bordered'>

                        <th scope='row' font-size:16px; float: center'>
                          AGENTE
                        </th>

                        <th scope='row' font-size:16px; float: center'>
                          FECHA
                        </th>
                            <?php  
                              $mod = "SELECT * FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%' ";
                                                $res = mysqli_query($conexion, $mod);
                                                while ($ver = mysqli_fetch_array($res)) {
                                                  $agente = $ver['nombre'];
                                                  $fechacon = $ver['fec5'];
                             ?>
                        
                        <tr>
                            <td style=' font-size:14px; float: left'>
                             <?php  
                                 echo $agente;
                             ?>
                            </td>

                          <td  style=' text-align:right; font-size:14px'>
                             <?php  
                             $fechaletracon = strftime("  %d/%m/%y", strtotime($fechacon));
                                echo $fechaletracon;
                             ?>
                            </td>
                        </tr>

                          <?php } ?>

                         </table>

                

                    <?php ?>
                         
                    </div>
                    
                        

                


        <?php  ?> ">

      <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadCtos" >
        <tr class="tdObjetivo">
          <td >Conectados</td>
        </tr>
        <tr class="tdObjetivo">
          <td> <b>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$edat' AND fec5 BETWEEN'2023-01-01' AND '2023-12-31' AND conexion LIKE '%i%'";
            $res = mysqli_query($conexion, $sql);
            while ($ver = mysqli_fetch_row($res)) {
              $datos6f = $ver[0];
            }
            echo $datos6f;
            ?>
          </b></td>
        </tr>
      </table>
      </div>
      <div id="totalmesCO" style="float: right; display: inline-block; width:88%;"></div>
    </div>
      <!--termina tooltip y grafica  -->
</body>

</html>



<script type="text/javascript">
  Highcharts.chart('totalmesCO', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Conexiones obtenidas en el año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Conexiones'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Meta',
        color: '#FFA07A',
        data: [ 1.25,1.25,1.25,1.25,1.25,1.25,1.25,1.25,1.25,1.25,1.25,1.25]
    
    },{
        name: 'Real',
        color: '#58D68D',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$edat' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            }?>]
    
    }]
});



$( document ).ready(function() {
    $('[rel="tooltip"]').tooltip();
});



</script>