<?php
  error_reporting(0); 

  require_once "../php/conexion.php";

  $conexion=conexion();

  session_start();
  $edat = $_SESSION['user'];

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}
//******************Graficas********************
$fecha_actual = date('Y-m-d');
$fecha_desde =  date('Y-m')."-01";
?>
<head>
</head>
 <!-- metas mensuales -->
<input hidden id="cmm" value="<?php echo $filam["contactos_meta_mensual"] ?>">
<input hidden id="cimm" value="<?php echo $filacm["citas_meta_mensual"] ?>"> 
<input hidden id="comm" value="<?php echo $filacm["conexion_meta_mensual"] ?>"> 

<div class="row">
    <div class="col-sm-12">
      <h2>DesarrollaT</h2>
      <table class="table table-hover table-condensed table-bordered" id="tabladinamicaload">
          <thead>
            <tr align="center">
              
              <td>Nombre</td>
              <td>Fecha Registro</td>
              <td>Teléfono</td>
              <td>Correo</td>
              <td>Agendar Cita</td>
            </tr>
          </thead>
          <tbody>
          <?php 
            $sql = "select id, nombre, fechareg, celular, correo from llenado_formulario where edat='".$edat."' and resul_llamada = 'DAR SEGUIMIENTO' order by fechareg desc";
            $result = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($result)){

              $datos1 = $ver[0]."||".
                       $ver[1]."||".
                       $ver[2]."||".
                       $ver[3]."||".
                       $ver[4];

            
          ?>
          <tr align="center">
            <td><?php echo $ver[1] ?></td>
            <td><?php echo $ver[2] ?></td>
            <td><?php echo $ver[3] ?></td>
            <td><?php echo $ver[4] ?></td>
            <td>

              <form class="" action="reagenda.php?id=<?php echo $ver[0];?>" method="post">
                <button class="btn btn-warning  glyphicon glyphicon-search" value="<?php echo $ver[0];?>" id="id" name="id"></button>
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
    $(document).ready(function(){
      $('#tabladinamicaload').DataTable({
        language:   {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }
      });
    });
</script>
