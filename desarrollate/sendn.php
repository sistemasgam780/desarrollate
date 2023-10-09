<?php 
	error_reporting(0);
    
    require_once "php/conexion.php";
    $conexion = conexion();		
	
    $fec1 = $_POST['dateo1'];
	$fec2 = $_POST['dateo2'];

	echo "Resultados de la busqueda entre las fechas <b>".$fec1."</b> y <b>".$fec2."</b> de <b>Nallely Quintana</b><br>";
?>
 <figure  class="highcharts-figure">
  <div id="nallely"></div>
</figure>
<br>
<table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
              </thead>
              <tbody>
              	<tr align="center">
              		<td colspan="2"><small>
              			<?php
              				$sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND fechareg BETWEEN '$fec1' AND '$fec2'";
              				$res1 = mysqli_query($conexion,$sql1);
              				while($ver1=mysqli_fetch_row($res1)){
              					$datos1e = $ver1[0];
              				}
              				echo $datos1e;
              			?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
              		</small></td>
              	</tr>
              </tbody>
          </table>




<!-- Codigo nombre conectado
 -->
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td colspan="2"><b><small>Fecha de conexión</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
              </thead>
        

 <?php
                  $sql = "SELECT * FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
                  $resultT = mysqli_query($conexion, $sql);
                  while ($conexiones = mysqli_fetch_array($resultT)) {
                    $edat = $conexiones['fec5'];
                    $prospecto = $conexiones['nombre'];
                           ?>
                    <tr>
                        <td align="center" colspan="2">
                          <small>
                            <?php  echo $edat;  ?>
                         </small>
                       </td>
                  
              		<td align="center" colspan="2"><small>
                  <?php
                          echo $prospecto;
                        ?>
              		</small>
                </td>
              </tr>
                  <?php
                       } ?>

    </table>

<script type="text/javascript">
  Highcharts.chart('nallely', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Resultados de Nallely Quintana'
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
    data: [                   <?php
                      $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = 'Nallely Quintana' AND fechareg BETWEEN '$fec1' AND '$fec2'";
                      $res1 = mysqli_query($conexion,$sql1);
                      while($ver1=mysqli_fetch_row($res1)){
                        $datos1e = $ver1[0];
                      }
                      echo $datos1e;
                    ?>]

  }, {
    name: 'Entrevista',
    data: [                   <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>]

  }, {
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>]

  }, {
    name: 'Venta de Carrera',
    data: [                   <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>]

  },{
    name: 'Inducción',
    data: [                   <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>]

  },{
    name: 'Conexión',
    data: [                   <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>]

  }]
});
</script>