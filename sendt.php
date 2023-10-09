<?php
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();


$persona = $_POST['edat'];
$rango = $_POST['rango'];
$fec1 = $_POST['datet1'];
$fec2 = $_POST['datet2'];


for ($i = $fec1; $i <= $fec2; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
  $dias++;
}



/*echo $persona;
echo $rango;
echo $fec1;*/




echo "Resultados de la búsqueda entre las fechas <b>" . $fec1 . "</b> y <b>" . $fec2 . "</b> de <b>Todos los EDAT'S</b>.<br>";
?>

  <div id="todos" style="width: 60%; display: inline-block; "></div>


  <!-- RESULTADOS DEL AÑO PASADO BASE ANTERIOR -->
<div class="form-group" align="center" style="width: 40%; float: right; display: inline-block; border-left: 1px solid #AEB6BF;">
  <button id="botonG" type="button" class="btn btn-secondary" onclick="PALOMA();">Paloma</button>
  <button id="botonC" type="button" class="btn btn-secondary" onclick="ALAN();">Alan</button>
  <button id="botonE" type="button" class="btn btn-secondary" onclick="YAZMIN();">Yazmin</button>
  <button id="botonEv" type="button" class="btn btn-secondary" onclick="NALLELY();">Nallely</button>

<div id="Gpaloma"></div>
<div id="Galan" style="display: none;"></div>
<div id="Gyazmin" style="display: none;"></div>
<div id="Gnallely" style="display: none;"></div>

</div>




<table class="table table-striped table-bordered" id="tabladinamicaload">
  <thead>
    <tr align="center">
      <td colspan="2" class="tdEncab_admin">Edat</td>
      <td colspan="2" class="tdEncab_admin">Contactos</td>
      <td colspan="2" class="tdEncab_admin">Entrevista</td>
      <td colspan="2" class="tdEncab_admin">Evaluación</td>
      <td colspan="2" class="tdEncab_admin">Venta de Carrera</td>
      <td colspan="2" class="tdEncab_admin">Inducción</td>
      <td colspan="2" class="tdEncab_admin">Conexión</td>
    </tr>
  </thead>
  <tbody>
    <tr align="center">
      <td colspan="2">Paloma Razo</td>
      <td colspan="2">
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>
      </td>
    </tr>
    <tr align="center">
      <td colspan="2">Nallely Quintana</td>
      <td colspan="2">
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>
      </td>
    </tr>
    <tr align="center">
      <td colspan="2">Alan Soto</td>
      <td colspan="2">
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>
      </td>
    </tr>
    <tr align="center">
      <td colspan="2">Yazmin Albarrán</td>
      <td colspan="2">
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>
      </td>
      <td colspan="2">
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>
      </td>
    </tr>
  </tbody>
</table>

<!-- codigo para ver nombre de los conectados  -->
<table class="table table-striped table-bordered" id="tabladinamicaload_tod">
  <thead>
    <tr align="center">
      <td colspan="2" class="tdEncab_admin">EDAT</td>
      <td colspan="2" class="tdEncab_admin">PROSPECTO</td>
      <td colspan="2" class="tdEncab_admin">Fecha de conexión</td>
      <td colspan="2" class="tdEncab_admin">Fecha de con. EDAT</td>
      <td colspan="2" class="tdEncab_admin">EDO. CIVIL</td>
      <td colspan="2" class="tdEncab_admin">DEPENDIENTES</td>
      <td colspan="2" class="tdEncab_admin">OCUPACION</td>
      <td colspan="2" class="tdEncab_admin">TRANSPORTE</td>
      <td colspan="2" class="tdEncab_admin">ESCOLARIDAD</td>
      <td colspan="2" class="tdEncab_admin">INSTITUCION</td>
      <td colspan="2" class="tdEncab_admin">CARRERA</td>
      <td colspan="2" class="tdEncab_admin">INGRESO $</td>
      <td colspan="2" class="tdEncab_admin">FUENTE</td>
      <td colspan="2" class="tdEncab_admin">REFERIDO</td>
      <td colspan="2" class="tdEncab_admin">TIEMPO DISP</td>
      <td colspan="2" class="tdEncab_admin">PRECISION VENTA</td>
      <td colspan="2" class="tdEncab_admin">ESTILO VENTA</td>
      <td colspan="2" class="tdEncab_admin">GDD</td>
    </tr>
  </thead>

  <?php
  $sql = "SELECT * FROM llenado_formulario WHERE edat!='ignacio' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%' ORDER BY nombre";
  $resultT = mysqli_query($conexion, $sql);
  while ($conexiones = mysqli_fetch_array($resultT)) {
    $edat = $conexiones['edat'];
    $fec5 = $conexiones['fec5'];
    $nombre = $conexiones['nombre'];
    $fecha_conexion = $conexiones['fecha_conexion'];
    $edo_civil = $conexiones['edo_civil'];
    $dependientes = $conexiones['dependientes'];
    $ocupacion = $conexiones['ocupacion'];
    $transporte = $conexiones['transporte'];
    $escolaridad = $conexiones['escolaridad'];
    $institucion = $conexiones['institucion'];
    $carrera = $conexiones['carrera'];
    $ingreso = $conexiones['ingreso'];
    $fuente = $conexiones['fuente'];
    $referido = $conexiones['referido'];
    $t_disponible = $conexiones['t_disponible'];
    $precision_venta = $conexiones['precision_venta'];
    $estilo_venta = $conexiones['estilo_venta'];
    $gerente = $conexiones['gerente'];

  ?>
    <tr>
      <td align="center" colspan="2">
        <?php echo $edat;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $nombre;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $fec5;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $fecha_conexion;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $edo_civil;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $dependientes;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $ocupacion;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $transporte;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $escolaridad;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $institucion;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $carrera;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $ingreso;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $fuente;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $referido;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $t_disponible;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $precision_venta;  ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $estilo_venta;   ?>
      </td>
      <td align="center" colspan="2">
        <?php echo $gerente;   ?>
      </td>
    </tr>
  <?php
  } ?>

</table>



  <!-- RESULTADOS DEL AÑO PASADO BASE ANTERIOR -->
<div class="form-group" align="center" style="">

  <button id="botonC" type="button" class="btn btn-secondary" onclick="CONTACTOS();">Contactos</button>
  <button id="botonE" type="button" class="btn btn-secondary" onclick="ENTREVISTA();">Entrevista</button>
  <button id="botonEv" type="button" class="btn btn-secondary" onclick="EVALUACION();">Evaluación</button>
  <button id="botonV" type="button" class="btn btn-secondary" onclick="VENTA();">Venta Carrera</button>
  <button id="botonI" type="button" class="btn btn-secondary" onclick="INDUCCION();">Inducción</button>
  <button id="botonCon" type="button" class="btn btn-secondary" onclick="CONEXION();">Conexión</button>

<div id="totalmesC" style="width:100%"></div>
<div id="totalmesE" style="width:100%; display: none;"></div>
<div id="totalmesEV" style="width:100%; display: none;"></div>
<div id="totalmesV" style="width:100%; display: none;"></div>
<div id="totalmesI" style="width:100%; display: none;"></div>
<div id="totalmesCO" style="width:100%; display: none;"></div>

</div>






<script type="text/javascript">
function CONTACTOS() {
    
    document.getElementById("totalmesC").style.display = "block";
    document.getElementById("totalmesE").style.display = "none";
    document.getElementById("totalmesEV").style.display = "none";
    document.getElementById("totalmesV").style.display = "none";
    document.getElementById("totalmesI").style.display = "none";
    document.getElementById("totalmesCO").style.display = "none";
  }

  function ENTREVISTA() {
    
    document.getElementById("totalmesE").style.display = "block";
    document.getElementById("totalmesC").style.display = "none";
    document.getElementById("totalmesEV").style.display = "none";
    document.getElementById("totalmesV").style.display = "none";
    document.getElementById("totalmesI").style.display = "none";
    document.getElementById("totalmesCO").style.display = "none";
  }

  function EVALUACION() {
    
    document.getElementById("totalmesEV").style.display = "block";
    document.getElementById("totalmesC").style.display = "none";
    document.getElementById("totalmesE").style.display = "none";
    document.getElementById("totalmesV").style.display = "none";
    document.getElementById("totalmesI").style.display = "none";
    document.getElementById("totalmesCO").style.display = "none";
  }

  function VENTA() {
    
    document.getElementById("totalmesV").style.display = "block";
    document.getElementById("totalmesC").style.display = "none";
    document.getElementById("totalmesE").style.display = "none";
    document.getElementById("totalmesEV").style.display = "none";
    document.getElementById("totalmesI").style.display = "none";
    document.getElementById("totalmesCO").style.display = "none";
  }

  function INDUCCION() {
    
    document.getElementById("totalmesI").style.display = "block";
    document.getElementById("totalmesC").style.display = "none";
    document.getElementById("totalmesE").style.display = "none";
    document.getElementById("totalmesV").style.display = "none";
    document.getElementById("totalmesEV").style.display = "none";
    document.getElementById("totalmesCO").style.display = "none";
  }

  function CONEXION() {
    
    document.getElementById("totalmesCO").style.display = "block";
    document.getElementById("totalmesC").style.display = "none";
    document.getElementById("totalmesE").style.display = "none";
    document.getElementById("totalmesV").style.display = "none";
    document.getElementById("totalmesEV").style.display = "none";
    document.getElementById("totalmesI").style.display = "none";
  }


/*GRAFICA QUE MUESTRA TOTOTAL DE CONTACTOS EN LO QUE VA DEL AÑO 
*/


  Highcharts.chart('totalmesC', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Contactos obtenidos por EDAT en lo que va del año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Contactos'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'PNallely Quintana' AND date(fechareg) BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }]
});





Highcharts.chart('totalmesE', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Entrevistas obtenidos por EDAT en lo que va del año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Entrevistas'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>, <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND acudio_entrevista LIKE '%S%' AND fec1  BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>]
    }]
});





Highcharts.chart('totalmesEV', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Evaluaciones obtenidos por EDAT en lo que va del año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Evaluaciones'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND puntos > 0 AND fec2   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND puntos > 0 AND fec2   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND puntos > 0 AND fec2   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND puntos > 0 AND fec2   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }]
});


Highcharts.chart('totalmesV', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ventas de carrera obtenidos por EDAT en lo que va del año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Ventas de carrera'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3   BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }]
});







Highcharts.chart('totalmesI', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Inducciones obtenidos por EDAT en lo que va del año'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Inducciones'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND arranque='Si' AND fec4    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND arranque='Si' AND fec4    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND arranque='Si' AND fec4    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND arranque='Si' AND fec4    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }]
});



Highcharts.chart('totalmesCO', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Conexiones obtenidos por EDAT en lo que va del año'
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
        name: 'Paloma Razo',
        data: [   <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Alan Soto',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Yazmin Albarran',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }, {
        name: 'Nallely Quintana',
        data: [  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-01-01' AND '2023-01-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-02-01' AND '2023-02-28'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-03-01' AND '2023-03-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-04-01' AND '2023-04-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-05-01' AND '2023-05-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-06-01' AND '2023-06-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-07-01' AND '2023-07-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-08-01' AND '2023-08-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-09-01' AND '2023-09-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-10-01' AND '2023-10-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-11-01' AND '2023-11-30'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
            } echo $datos1e; ?>,  <?php
            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND conexion LIKE '%i%' AND fec5    BETWEEN '2023-12-01' AND '2023-12-31'";
            $res1 = mysqli_query($conexion, $sql1);
            while ($ver1 = mysqli_fetch_row($res1)) {
              $datos1e = $ver1[0];
              echo $datos1e;
            }?>]
    }]
});





 function PALOMA() {
    document.getElementById("Gpaloma").style.display = "block";
    document.getElementById("Galan").style.display = "none";
    document.getElementById("Gyazmin").style.display = "none";
    document.getElementById("Gnallely").style.display = "none";
  }

  function ALAN() {
    document.getElementById("Gnallely").style.display = "none";
    document.getElementById("Gpaloma").style.display = "none";
    document.getElementById("Galan").style.display = "block";
    document.getElementById("Gyazmin").style.display = "none";
  }

  function YAZMIN() {
    document.getElementById("Gnallely").style.display = "none";
    document.getElementById("Galan").style.display = "none";
    document.getElementById("Gpaloma").style.display = "none";
    document.getElementById("Gyazmin").style.display = "block";
  }

  function NALLELY() {
    document.getElementById("Gnallely").style.display = "block";
    document.getElementById("Gyazmin").style.display = "none";
    document.getElementById("Gpaloma").style.display = "none";
    document.getElementById("Galan").style.display = "none";
  }





/*GRAFICA REAL VS RESULTADOS Paloma Razo
*/
Highcharts.chart('Gpaloma', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Real VS Meta Mensual'
    },
    subtitle: {
        text: 'Paloma Razo'
    },
    xAxis: {
        categories: [
            'Contactos',
            'Entrevista',
            'Evaluación',
            'Venta de Carrera',
            'Inducción',
            'Conexión'
        ],
        ordinal: false,
    
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Paloma Razo'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.1,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Real',
         color: "#A2D9CE",
        data: [<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>, <?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND fec1 BETWEEN '$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND gerente LIKE '%n%' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>
              ]

    }, {
        name: 'Meta mensual',
         color: "#F5B7B1",
        data: [<?php  $sql = "SELECT contacto FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT entrevista FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT evaluacion FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT venta FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT induccion FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,<?php  $sql = "SELECT conexion FROM metaa WHERE edat = 'Paloma Razo'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>]

    },]
});






/*GRAFICA REAL VS RESULTADOS Alan Soto
*/
Highcharts.chart('Galan', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Real VS Meta Mensual'
    },
    subtitle: {
        text: 'Alan Soto'
    },
    xAxis: {
        categories: [
            'Contactos',
            'Entrevista',
            'Evaluación',
            'Venta de Carrera',
            'Inducción',
            'Conexión'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Alan Soto'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Real',
         color: "#A2D9CE",
        data: [<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>, <?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND fec1 BETWEEN '$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND gerente LIKE '%n%' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>
              ]

    }, {
        name: 'Meta mensual',
         color: "#F5B7B1",
        data: [<?php  $sql = "SELECT contacto FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT entrevista FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT evaluacion FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT venta FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT induccion FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,<?php  $sql = "SELECT conexion FROM metaa WHERE edat = 'Alan Soto'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>]

    },]
});





/*GRAFICA REAL VS RESULTADOS Yazmin Albarran
*/
Highcharts.chart('Gyazmin', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Real VS Meta Mensual'
    },
    subtitle: {
        text: 'Yazmin Albarran'
    },
    xAxis: {
        categories: [
            'Contactos',
            'Entrevista',
            'Evaluación',
            'Venta de Carrera',
            'Inducción',
            'Conexión'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Yazmin Albarran'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Real',
         color: "#A2D9CE",
        data: [<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>, <?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND fec1 BETWEEN '$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND gerente LIKE '%n%' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>
              ]

    }, {
        name: 'Meta mensual',
         color: "#F5B7B1",
        data: [<?php  $sql = "SELECT contacto FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT entrevista FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT evaluacion FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT venta FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT induccion FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,<?php  $sql = "SELECT conexion FROM metaa WHERE edat = 'Yazmin Albarran'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>]

    },]
});




/*GRAFICA REAL VS RESULTADOS Nallely Quintana
*/
Highcharts.chart('Gnallely', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Real VS Meta Mensual'
    },
    subtitle: {
        text: 'Nallely Quintana'
    },
    xAxis: {
        categories: [
            'Contactos',
            'Entrevista',
            'Evaluación',
            'Venta de Carrera',
            'Inducción',
            'Conexión'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nallely Quintana'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Real',
         color: "#A2D9CE",
        data: [<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>, <?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND fec1 BETWEEN '$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND gerente LIKE '%n%' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>
              ]

    }, {
        name: 'Meta mensual',
         color: "#F5B7B1",
        data: [<?php  $sql = "SELECT contacto FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT entrevista FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT evaluacion FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT venta FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,
                 <?php  $sql = "SELECT induccion FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>,<?php  $sql = "SELECT conexion FROM metaa WHERE edat = 'Nallely Quintana'";
                $res = mysqli_query($conexion, $sql);
                while ($ver = mysqli_fetch_row($res)) {
                  $datos11e = $ver[0];
                }
                echo round($nm = $dias * $datos11e / 30);
                 ?>]

    },]
});




  Highcharts.chart('todos', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Resultados EDATS GAM'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: [
        'Paloma Razo',
        'Nallely Quintana',
        'Alan Soto',
        'Yazmin Albarran'
      ]
    },
    yAxis: {
      min: 0,
      title: {
        text: 'EDAT GAM'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:14px">{Resultados}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 2
      }
    },
    series: [{
      name: 'Contactos',
      data: [<?php
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Paloma Razo' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>,
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>,
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>,
        <?php
        $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Yazmin Albarran' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
        $res1 = mysqli_query($conexion, $sql1);
        while ($ver1 = mysqli_fetch_row($res1)) {
          $datos1e = $ver1[0];
        }
        echo $datos1e;
        ?>
      ]

    }, {
      name: 'Entrevista',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2f = $ver[0];
              }
              echo $datos2f;
              ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos2f = $ver[0];
        }
        echo $datos2f;
        ?>
      ]

    }, {
      name: 'Evaluación',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3f = $ver[0];
              }
              echo $datos3f;
              ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos3f = $ver[0];
        }
        echo $datos3f;
        ?>
      ]

    }, {
      name: 'Venta de Carrera',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4f = $ver[0];
              }
              echo $datos4f;
              ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos4f = $ver[0];
        }
        echo $datos4f;
        ?>
      ]

    }, {
      name: 'Inducción',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5f = $ver[0];
              }
              echo $datos5f;
              ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos5f = $ver[0];
        }
        echo $datos5f;
        ?>
      ]

    }, {
      name: 'Conexión',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6f = $ver[0];
              }
              echo $datos6f;
              ?>, <?php
                  $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
                  $res = mysqli_query($conexion, $sql);
                  while ($ver = mysqli_fetch_row($res)) {
                    $datos6f = $ver[0];
                  }
                  echo $datos6f;
                  ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>,
        <?php
        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
        $res = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($res)) {
          $datos6f = $ver[0];
        }
        echo $datos6f;
        ?>
      ]

    }]
  });
</script>