<?php
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();

$fec1 = $_POST['datet1'];
$fec2 = $_POST['datet2'];

echo "Resultados de la busqueda entre las fechas <b>" . $fec1 . "</b> y <b>" . $fec2 . "</b> de <b>Alan Soto</b><br>";
?>


<figure class="highcharts-figure">
  <div id="alan"></div>
</figure>

<table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
  <thead>
    <tr align="center">
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
  </tbody>
</table>

<table class="table table-striped table-bordered" id="tabladinamicaload_al">
  <thead>
    <tr align="center">
      <td colspan="2" class="tdEncab_admin">Fecha de conexión</td>
      <td colspan="2" class="tdEncab_admin">Prospecto</td>
    </tr>
  </thead>

  <?php
  $sql = "SELECT * FROM llenado_formulario WHERE edat='Alan Soto' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
  $resultT = mysqli_query($conexion, $sql);
  while ($conexiones = mysqli_fetch_array($resultT)) {
    $edat = $conexiones['fec5'];
    $prospecto = $conexiones['nombre'];
  ?>
    <tr>
      <td align="center" colspan="2">
          <?php echo $edat;  ?>
      </td>

      <td align="center" colspan="2">
          <?php
          echo $prospecto;
          ?>
      </td>
    </tr>
  <?php
  }
  ?>

</table>

<script type="text/javascript">
  Highcharts.chart('alan', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Resultados de Alan Soto'
    },
    subtitle: {
      text: ''
    },
    xAxis: {
      categories: [
        'Resultados'
      ]
    },
    yAxis: {
      min: 0,
      title: {
        text: 'EDAT GAM'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{Resultados}</span><table>',
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
              $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Alan Soto' AND date(fechareg) BETWEEN '$fec1' AND '$fec2'";
              $res1 = mysqli_query($conexion, $sql1);
              while ($ver1 = mysqli_fetch_row($res1)) {
                $datos1e = $ver1[0];
              }
              echo $datos1e;
              ?>]

    }, {
      name: 'Entrevista',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos2f = $ver[0];
              }
              echo $datos2f;
              ?>]

    }, {
      name: 'Evaluación',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos3f = $ver[0];
              }
              echo $datos3f;
              ?>]

    }, {
      name: 'Venta de Carrera',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos4f = $ver[0];
              }
              echo $datos4f;
              ?>]

    }, {
      name: 'Inducción',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos5f = $ver[0];
              }
              echo $datos5f;
              ?>]

    }, {
      name: 'Conexión',
      data: [<?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion, $sql);
              while ($ver = mysqli_fetch_row($res)) {
                $datos6f = $ver[0];
              }
              echo $datos6f;
              ?>]

    }]
  });
</script>