<?php
error_reporting(0);
require_once "php/conexion.php";
$conexion = conexion();

$fec1 = $_POST['date1'];
$fec2 = $_POST['date2'];
$dias = 0;

$hoy = date('Y-m-d 00:00:00', strtotime($fec1));
$hoy2 = date('Y-m-d 23:59:59', strtotime($fec2));
$dias = 0;


for ($i = $fec1; $i <= $fec2; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
  $dias++;
}


$uno = 1;

setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
$d = "2010-03-09";
$fechaletra1 = strftime("%d de %B de %Y", strtotime($fec1));
$fechaletra2 = strftime("%d de %B de %Y", strtotime($fec2));
$date_past1 = date('Y-m-d', strtotime($fec1 . ' - ' . $dias . ' days'));
$date_past2 = date('Y-m-d', strtotime($fec1 . ' - ' . $uno . ' days'));
$fecbda1 =  date("Y-m-d", strtotime($fec1 . "- 1 year"));
$fecbda2 =  date("Y-m-d", strtotime($fec2 . "- 1 year"));

$usuario = $_POST['usuario'];

echo "Resultados del <b>" . $fechaletra1 . "</b> al <b>" . $fechaletra2;
?>

<head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
</head>


<!-- RESULTADOS DEL AÑO PASADO BASE ANTERIOR -->
<div class="form-group" align="center">
  <button id="botonG" type="button" class="btn btn-secondary" onclick="GENERAL();">General</button>
  <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOS();">Contactos</button>
  <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTA();">Entrevista</button>
  <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACION();">Evaluación</button>
  <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTA();">Venta Carrera</button>
  <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCION();">Inducción</button>
  <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXION();">Conexión</button>
</div>

<!-- TABLA GENERAL -->
<div id="tabla0" class="container">
  <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadGralAn">
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND fechareg BETWEEN'$fec1' AND '$hoy2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos1 = $ver[0];
        }
        echo $datos1;
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2 = $ver[0];
        }
        echo $datos2;
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3 = $ver[0];
        }
        echo $datos3;
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND gerente LIKE '%n%'  AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4 = $ver[0];
        }
        echo $datos4;
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5 = $ver[0];
        }
        echo $datos5;
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='" . $usuario . "' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
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
        $sql = "SELECT contacto FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos111 = $ver[0];
        }

        echo round($datos11 = $dias * $datos111 / 30);
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT entrevista FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos222 = $ver[0];
        }
        //echo $datos22;
        echo round($datos22 = $dias * $datos222 / 30);
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT evaluacion FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos333 = $ver[0];
        }
        //echo $datos33;
        echo round($datos33 = $dias * $datos333 / 30);
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT venta FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos444 = $ver[0];
        }
        //echo $datos44;
        echo round($datos44 = $dias * $datos444 / 30);
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT induccion FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos555 = $ver[0];
        }
        //echo $datos55;
        echo round($datos55 = $dias * $datos555 / 30);
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT conexion FROM metaa WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos666 = $ver[0];
        }
        //echo $datos66;
        echo round($datos66 = $dias * $datos666 / 30);
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
        $sql = "SELECT contacto FROM ponderacion WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos11 = $ver[0];
        }
        echo $datos11;
        ?> %
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT entrevista FROM ponderacion WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos22 = $ver[0];
        }
        echo $datos22;
        ?> %
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT evaluacion FROM ponderacion WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos33 = $ver[0];
        }
        echo $datos33;
        ?> %
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT venta FROM ponderacion WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos44 = $ver[0];
        }
        echo $datos44;
        ?> %
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT induccion FROM ponderacion WHERE edat = '$usuario'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos55 = $ver[0];
        }
        echo $datos55;
        ?> %
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $sql = "SELECT conexion FROM ponderacion WHERE edat = '$usuario'";
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

        echo round($evaluacion, 0) ."%";
        ?>
      </td>
    </tr>
  </table>

  <!-- TABLA CON LAS FECHAS CAPTURADAS POR EDAT/SISTEMA -->
  <?php
  // Consulta para validar si hay un registro o mas de uno muestra la tabla, caso contrario no muestra nada. 
  $sqlReg = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fecha_conexion AND fec5 BETWEEN '$fec1' AND '$fec2'";
  $resultReg = mysqli_query($conexion, $sqlReg);
  list($datosReg) = mysqli_fetch_row($resultReg);
  if ($datos1 >= 1) {

    // Consulta para obtener los resultados de lo que muestro en cada columna.  
    $sql = "SELECT nombre, fecha_contacto, fecha_cita, fecha_evaluacion, fecha_ventaCarrera, fecha_induccion, fecha_conexion, fechareg, fec2, fec3, fec4, fec5 FROM llenado_formulario WHERE edat = '$usuario' AND fec5 BETWEEN '$fec1' AND '$fec2' AND conexion LIKE '%i%'";
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
<div id="tabla1" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
               <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
        ?>
      </td> 
      </td>
      <td class="periodo_an">
        <p>Periodo anterior</p>
      </td>
      <td class="periodo_a2">
        <p>Periodo actual</p>
      </td>

    </tr>
    <tr>
      <td class="tdReal">
        Reales
      </td>
   
      <td class="tdEncab_reaOb">
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$usuario' AND fechareg BETWEEN '$fecbda1' AND '$fecbda2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$usuario' AND fechareg BETWEEN '$fecbda1' AND '$fecbda2'";
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
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$usuario' AND fechareg BETWEEN '$date_past1' AND '$date_past2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$usuario' AND fechareg BETWEEN '$date_past1' AND '$date_past2'";
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
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$usuario' AND fechareg BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        $sql1 = "SELECT COUNT(id) FROM base_anterior WHERE edat = '$usuario' AND fechareg BETWEEN '$fec1' AND '$fec2'";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
        <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
            <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php } ?>
      </td>

    </tr>
    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";

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
          echo round($nm = $dias * $ro1[2] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[2] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[2] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;

        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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

<!-- TERMINA LA TABLA 2 DE CONTACTOS, EMPIEZA TABLA ENTREVISTA -->
<div id="tabla2" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
      </td>
               <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec1 BETWEEN'$fecbda1' AND '$fecbda2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec1 BETWEEN'$fecbda1' AND '$fecbda2' AND acudio_entrevista LIKE '%S%'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec1 BETWEEN'$date_past1' AND '$date_past2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec1 BETWEEN'$date_past1' AND '$date_past2' AND acudio_entrevista LIKE '%S%'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
          <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
           <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
      </td>

    </tr>

    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";
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
          echo round($nm = $dias * $ro1[3] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[3] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[3] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
        <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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
<div id="tabla3" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
      </td>
             <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec2 BETWEEN'$fecbda1' AND '$fecbda2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec2 BETWEEN'$fecbda1' AND '$fecbda2' AND puntos > 0";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec2 BETWEEN'$date_past1' AND '$date_past2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec2 BETWEEN'$date_past1' AND '$date_past2' AND puntos > 0";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
         <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
            <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
      </td>

    </tr>
    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";
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
          echo round($nm = $dias * $ro1[4] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[4] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[4] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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
<div id="tabla4" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
      </td>
            <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fecbda1' AND '$fecbda2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fecbda1' AND '$fecbda2'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$date_past1' AND '$date_past2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$date_past1' AND '$date_past2'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }

        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
           <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
          <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
      </td>

    </tr>
    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";
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
          echo round($nm = $dias * $ro1[5] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[5] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[5] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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
<div id="tabla5" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
      </td>
              <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec4 BETWEEN'$fecbda1' AND '$fecbda2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec4 BETWEEN'$fecbda1' AND '$fecbda2' AND arranque='Si'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec4 BETWEEN'$date_past1' AND '$date_past2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec4 BETWEEN'$date_past1' AND '$date_past2' AND arranque='Si'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
           <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
           <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
      </td>

    </tr>
    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";

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
          echo round($nm = $dias * $ro1[6] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[6] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[6] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
        <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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
<div id="tabla6" style="display: none;" class="container">
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
        echo $fechaletra4 . "<br> al " . $fechaletra5;
        ?>
      </td>
      <td class="periodo_aca">
        <?php
        $fechaletra6 = strftime("%d de %B de %Y", strtotime($date_past1));
        $fechaletra7 = strftime("%d de %B de %Y", strtotime($date_past2));
        echo "Periodo anterior a la consulta actual <br>";
        echo $fechaletra6 . "<br> al " . $fechaletra7;
        ?>
      </td>
             <td class="periodo_a">
        <?php
        echo "Periodo actual <br>";
        echo  $fechaletra1 . "<br> al " . $fechaletra2;
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec5 BETWEEN'$fecbda1' AND '$fecbda2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec5 BETWEEN'$fecbda1' AND '$fecbda2' AND conexion LIKE '%i%'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec5 BETWEEN'$date_past1' AND '$date_past2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec5 BETWEEN'$date_past1' AND '$date_past2' AND conexion LIKE '%i%'";
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
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        $sql = "SELECT COUNT(id) FROM base_anterior WHERE edat='$usuario' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {

        ?>
          <label style="color: red; font-size: 19px">
            <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
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
          <label style="color: green; font-size: 19px">
            <?php
              if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {                 echo "N/A";             }else{             echo $format_number1 = round($var2, 0) . "%";             }
            ?>
          </label>
        <?php } else {
        ?>
          <label style="color: red; font-size: 19px">
          <?php
            if ($var2 == "100" or $var2 == "-100" or $dato3 == "0" and $dato2 == "0" or $dato3 == "0" and $dato1 == "0") {
                echo "N/A";
            }else{
            echo $format_number1 = round($var2, 0) . "%";
            }
            ?>
          </label>
        <?php }  ?>
      </td>

    </tr>
    <tr>
      <?php
      $objetivo = "SELECT * FROM metaa WHERE id = '1'";

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
          echo round($nm = $dias * $ro1[7] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[7] / 30);
          ?>
        </td>
        <td class="tdEncab_reaOb">
          <?php
          echo round($nm = $dias * $ro1[7] / 30);
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
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
      <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato2;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
        ?>
      </td>
             <td class="tdEncab_reaOb">
        <?php
        $n1 = $dato3;
        $n2 = round($nm);
        $total = $n1 * 100 / $n2;
        if (is_nan($total)) {
          $total = 0;
        }
        echo round($total, 0) . "%";
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

<script type="text/javascript">
  function GENERAL() {
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
    document.getElementById("tabla0").style.display = "block";
  }

  function CONTACTOS() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla1").style.display = "block";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
  }

  function ENTREVISTA() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla2").style.display = "block";
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
  }

  function EVALUACION() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla3").style.display = "block";
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
  }

  function VENTA() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla4").style.display = "block";
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
  }

  function INDUCCION() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla5").style.display = "block";
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla6").style.display = "none";
  }

  function CONEXION() {
    document.getElementById("tabla0").style.display = "none";
    document.getElementById("tabla6").style.display = "block";
    document.getElementById("tabla1").style.display = "none";
    document.getElementById("tabla2").style.display = "none";
    document.getElementById("tabla4").style.display = "none";
    document.getElementById("tabla3").style.display = "none";
    document.getElementById("tabla5").style.display = "none";
  }
</script>