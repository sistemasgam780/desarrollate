<?php
error_reporting(0);

require_once "../php/conexion.php";

$conexion = conexion();

session_start();
$edat = $_SESSION['user'];

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicaci��n y mostramos el error
}
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
</head>
<!-- metas mensuales -->
<input hidden id="cmm" value="<?php echo $filam["contactos_meta_mensual"] ?>">
<input hidden id="cimm" value="<?php echo $filacm["citas_meta_mensual"] ?>">
<input hidden id="comm" value="<?php echo $filacm["conexion_meta_mensual"] ?>">

<div class="row">
  <div class="col-sm-12">
    <h2>Desarrolla-T</h2>
    <table class="table table-striped table-bordered" id="tabladinamicaload">

      <thead>
        <tr align="center">
          <td><small>EDAT</small></td>
          <td><small>PROSPECTO</small></td>
          <td><small>GDD</small></td>
          <td><small>TIPO CONEXIÓN</small></td>
          <td><small>FECHA ARRANQUE</small></td>
          <td><small>FECHA REAL</small></td>
          <td><small>FECHA CONEXIÓN</small></td>
          <td><small>FUENTE</small></td>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select edat, nombre, gerente, conexion, fecha_induccion, fec_real, fecha_conexion, fuente from llenado_formulario where conexion='Provisional' || conexion='Definitiva'";
        $result = mysqli_query($conexion, $sql);
        while ($ver = mysqli_fetch_row($result)) {
          $datos = $ver[0] . "||" .
            $ver[1] . "||" .
            $ver[2] . "||" .
            $ver[3] . "||" .
            $ver[4] . "||" .
            $ver[5] . "||" .
            $ver[6] . "||" .
            $ver[7];
        ?>
          <tr align="center">
            <!-- EDAT -->
            <td><small><?php echo $ver[0] ?></small></td>
            <!-- PROSPECTO -->
            <td><small><?php echo $ver[1] ?></small></td>
            <!-- GDD  -->
            <td>
              <small>
                <?php
                if ($ver[2] == 'Nancyn') {
                  echo "Nancy O";
                } else if ($ver[2] == 'Danielan') {
                  echo "Daniela V";
                } else if ($ver[2] == 'Roberton') {
                  echo "Roberto R";
                } else if ($ver[2] == 'Martin') {
                  echo "Martín G";
                } else if ($ver[2] == 'Omarn' || $ver[2] == 'Omar') {
                  echo "Omar S";
                } else {
                  echo $ver[2];
                }
                ?>
              </small>
            </td>
            <!-- TIPO CONEXIÓN -->
            <td><small><?php echo $ver[3] ?></small></td>
            <!-- FECHA ARRANQUE -->
            <td><small><?php echo $ver[4] ?></small></td>
            <!-- FECHA REAL -->
            <td><small><?php echo $ver[5] ?></small></td>
            <!-- FECHA CONEXIÓN -->
            <td><small><?php echo $ver[6] ?></small></td>
            <!-- FUENTE -->
            <td><small><?php echo $ver[7] ?></small></td>
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