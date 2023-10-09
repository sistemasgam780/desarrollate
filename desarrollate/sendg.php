<?php 
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();

$fec1 = $_POST['date1'];
$fec2 = $_POST['date2'];
$usuario = $_POST['usuario'];

echo "Resultados de la busqueda entre las fechas <b>".$fec1."</b> y <b>".$fec2."</b> de <b>".$usuario."</b><br>";
?>

<br>
<table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluaci��n</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducci��n</small></b></td>
                      <td colspan="2"><b><small>Conexi��n</small></b></td>
                  </tr>
              </thead>
              <tbody>
              	<tr align="center">
              		<td colspan="2"><small>
              			<?php
              				$sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat = '$usuario' AND fechareg BETWEEN '$fec1' AND '$fec2'";
              				$res1 = mysqli_query($conexion,$sql1);
              				while($ver1=mysqli_fetch_row($res1)){
              					$datos1e = $ver1[0];
              				}
              				echo $datos1e;
              			?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec1 BETWEEN'$fec1' AND '$fec2' AND acudio_entrevista LIKE '%S%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec2 BETWEEN'$fec1' AND '$fec2' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND gerente LIKE '%n%' AND fec3 BETWEEN'$fec1' AND '$fec2'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec4 BETWEEN'$fec1' AND '$fec2' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
              		</small></td>
              		<td colspan="2"><small>
              			<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$usuario' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
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
          
          
          
  <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td colspan="2"><b><small>Fecha de conexión</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
              </thead>

              		
        

 <?php
                  $sql = "SELECT * FROM llenado_formulario WHERE edat='$usuario' AND fec5 BETWEEN'$fec1' AND '$fec2' AND conexion LIKE '%i%'";
                  $resultT = mysqli_query($conexion, $sql);
                  while ($conexiones = mysqli_fetch_array($resultT)) {
                    $edat = $conexiones['fec5'];
                    $prospecto = $conexiones['nombre'];
                           ?>
                    <tr>
                        <td align="center" colspan="1">
                          <small>
                            <?php  echo $edat;  ?>
                         </small>
                       </td>

              		<td align="center" colspan="2"><small>
                  <?php
                          echo $prospecto;
                       ?>
              		</small></td>
                </tr>
                <?php
                       } ?>

    </table>
