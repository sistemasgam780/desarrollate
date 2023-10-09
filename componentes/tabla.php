<?php
error_reporting(0);
require_once "../php/conexion.php";
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}
//******************Graficas********************
$fecha_actual = date('Y-m-d');
$fecha_desde =  date('Y-m') . "-01";
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

//****************Consulta metas mensuales***********
//****************contactos***********
$meta_m_e = "select * from metas where nombre = '" . $edat . "'";
$meta_m_er = $conexion->query($meta_m_e);
$filam = mysqli_fetch_array($meta_m_er);
//****************contactos***********
$citas_m_e = "select * from metas where nombre = '" . $edat . "'";
$citas_m_er = $conexion->query($citas_m_e);
$filacm = mysqli_fetch_array($citas_m_er);
//****************conexion***********
$conexion_m_e = "select * from metas where nombre = '" . $edat . "'";
$conexion_m_er = $conexion->query($conexion_m_e);
$filacom = mysqli_fetch_array($conexion_m_er);
?>

<!-- metas mensuales -->
<input hidden id="cmm" value="<?php echo $filam["contactos_meta_mensual"] ?>">
<input hidden id="cimm" value="<?php echo $filacm["citas_meta_mensual"] ?>">
<input hidden id="comm" value="<?php echo $filacm["conexion_meta_mensual"] ?>">

<div class="row">
  <div class="col-sm-12">
    <h2 class="titleTable">Desarrolla-T</h2>
    <table class="table table-striped table-bordered" id="tabladinamicaload">
      <caption>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
          Agregar nuevo
          <span class="glyphicon glyphicon-plus"></span>
        </button>
      </caption>
      <thead>
        <tr>
          <td><small style="font-weight: bold;">IMPRIMIR</small></td>
          <td><small style="font-weight: bold;">NOMBRE</small></td>
          <td><small style="font-weight: bold;">CITA</small></td>
          <td><small style="font-weight: bold;">TELÉFONO</small></td>
          <td><small style="font-weight: bold;">ACT. DATOS</small></td>
          <td><small style="font-weight: bold;">IDENTIDAD</small></td>
          <td><small style="font-weight: bold;">EVALUACIÓN</small></td>
          <td><small style="font-weight: bold;">ENTREVISTA GDD</small></td>
          <td><small style="font-weight: bold;">RESULTADOS</small></td>
          <td><small style="font-weight: bold;">CONEXIÓN</small></td>
          <td><small style="font-weight: bold;">DETALLES</small></td>
          <td><small style="font-weight: bold;">OBS.</small></td>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select id, nombre, a_paterno, fechareg, celular, correo, fuente, referido, resul_llamada, fecha_cita, hora_cita,
            acudio_entrevista, edad, edo_civil, direccion, dependientes, ocupacion, escolaridad, carrera, institucion, ingreso, transporte, t_disponible, imagen,
            fecha_cita,
            caracter, sentido, logro, energia, motivacion, perseverancia, puntos,
            gerente, res_gdd, razon, pp200, pp200_observaciones, comentarios_gdd,
            estatus, arranque, fecha_induccion, documentacion,
            conexion,
            rendimiento_venta, precision_venta, estilo_venta, fecha_conexion, fecha_contacto, fecha_evaluacion, fecha_ventaCarrera,a_materno
             from llenado_formulario where edat='" . $edat . "' /*and resul_llamada = 'CITA' AND acudio_entrevista LIKE '%S%' */  order by id desc";
        $result = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($result)) {

          $datos = $ver[0] . "||" .
            $ver[1] . "||" .
            $ver[2] . "||" .
            $ver[3] . "||" .
            $ver[4] . "||" .
            $ver[5] . "||" .
            $ver[6] . "||" .
            $ver[7] . "||" .
            $ver[8] . "||" .
            $ver[9] . "||" .
            $ver[10] . "||" .

            $ver[11] . "||" .
            $ver[12] . "||" .
            $ver[13] . "||" .
            utf8_decode($ver[14]) . "||" .
            $ver[15] . "||" .
            $ver[16] . "||" .
            $ver[17] . "||" .
            $ver[18] . "||" .
            $ver[19] . "||" .
            $ver[20] . "||" .
            $ver[21] . "||" .
            $ver[22] . "||" .
            $ver[23] . "||" .

            $ver[24] . "||" .

            $ver[25] . "||" .
            $ver[26] . "||" .
            $ver[27] . "||" .
            $ver[28] . "||" .
            $ver[29] . "||" .
            $ver[30] . "||" .
            $ver[31] . "||" .

            $ver[32] . "||" .
            $ver[33] . "||" .
            $ver[34] . "||" .
            $ver[35] . "||" .
            $ver[36] . "||" .
            $ver[37] . "||" .

            $ver[38] . "||" .
            $ver[39] . "||" .
            $ver[40] . "||" .
            $ver[41] . "||" .

            $ver[42] . "||" .

            $ver[43] . "||" .
            $ver[44] . "||" .
            $ver[45] . "||" .
            $ver[46] . "||" .
            $ver[47] . "||" .
            $ver[48] . "||" .
            $ver[49] . "||" .
            $ver[50];

        ?>

          <tr align="center">
            <!-- Imprimir -->
            <td>
              <form class="" action="php/crearpdf.php" method="post">
                <button style="background-color: transparent; color: #5bc0de;" class="btn btn-info glyphicon glyphicon-print" value="<?php echo $ver[0]; ?>" id="id" name="id"></button>
              </form>
            </td>
            <!-- Nombre -->
            <td width="500px"><small><?php echo $ver[1]. " $ver[2]". " $ver[50]" ?></small></td>
            <!-- Cita -->
            <td width="150px">
              <small>
                <?php
                if ($ver[9] == "0000-00-00") {
                  echo "***";
                } else {
                  echo $ver[9];
                }
                ?>
              </small>
            </td>
            <!-- Telefono -->
            <td>
              <small>
                <?php
                if ($ver[4] == '') {
                  echo "***";
                } else {
                  echo $ver[4];
                }
                ?>
              </small>
            </td>
            <!-- Act. Datos -->
            <td>
              <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">
              </button>
            </td>
            <!-- Identidad -->
            <td>
              <?php
              if ($ver[8] == 'CITA') { ?>
                <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-user" data-toggle="modal" data-target="#modalFicha" onclick="agregaform('<?php echo $datos ?>')"></button>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-user" data-toggle="modal" data-target="#modalFicha" onclick="agregaform('<?php echo $datos ?>')" disabled></button>
              <?php
              }
              ?>
            </td>
            <!-- Evalucion  -->
            <td>
              <?php
              if ($ver[11] == 'Si') { ?>
                <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#modalEvaluacion" onclick="agregaform('<?php echo $datos ?>')"></button>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#modalEvaluacion" onclick="agregaform('<?php echo $datos ?>')" disabled></button>
              <?php
              }
              ?>
            </td>
            <!-- Entrevista GDD -->
            <td>
              <?php
              $loo = 1;
              if ($ver[25] > $loo) { ?>
                <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-edit" data-toggle="modal" data-target="#modalGDD" onclick="agregaform('<?php echo $datos ?>')"></button>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-edit" data-toggle="modal" data-target="#modalGDD" onclick="agregaform('<?php echo $datos ?>')" disabled></button>
              <?php
              }
              ?>
            </td>
            <!-- Resultados -->
            <td>
              <?php
              if ($ver[33] == 'Si') { ?>
                <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-indent-right" data-toggle="modal" data-target="#modalResultados" onclick="agregaform('<?php echo $datos ?>')"></button>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-indent-right" data-toggle="modal" data-target="#modalResultados" onclick="agregaform('<?php echo $datos ?>')" disabled></button>
              <?php
              }
              ?>
            </td>
            <!-- Conexion -->
            <td>
              <?php
              if ($ver[38] == 'Arranque') { ?>
                <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-saved" data-toggle="modal" data-target="#modalConexion" onclick="agregaform('<?php echo $datos ?>')"></button>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-saved" data-toggle="modal" data-target="#modalConexion" onclick="agregaform('<?php echo $datos ?>')" disabled></button>
              <?php
              }
              ?>
            </td>
            <!-- Detalles -->
            <td>
              <?php
              if ($ver[42] == 'Provisional' || $ver[42] == 'Definitiva') { ?>
                <form class="" action="fechas.php?id=<?php echo $ver[0]; ?>" method="post">
                  <button style="background-color: transparent; color: #5cb85c;" class="btn btn-success glyphicon glyphicon-search" value="<?php echo $ver[0]; ?>" id="id" name="id">
                  </button>
                </form>
              <?php
              } else { ?>
                <button style="background-color: transparent; color: #f21009;" class="btn btn-danger glyphicon glyphicon-search" data-toggle="modal" data-target="#modalDetalles" disabled>
                <?php
              }
                ?>
                </button>
            </td>
            <!-- Observaciones -->
            <td>
              <form class="" action="observaciones.php?id=<?php echo $ver[0]; ?>" method="post">
                <button style="background-color: transparent; color: #5bc0de;" class="btn btn-light  glyphicon glyphicon-eye-open" value="<?php echo $ver[0]; ?>" id="id" name="id"></button>
              </form>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabladinamicaload').DataTable({
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
  });
</script>