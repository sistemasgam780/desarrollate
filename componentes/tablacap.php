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
?>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
</head>
 <!-- metas mensuales -->
<input hidden id="cmm" value="<?php echo $filam["contactos_meta_mensual"] ?>">
<input hidden id="cimm" value="<?php echo $filacm["citas_meta_mensual"] ?>"> 
<input hidden id="comm" value="<?php echo $filacm["conexion_meta_mensual"] ?>"> 

<div class="row">
    <div class="col-sm-12">
      <h2>DesarrollaT</h2>
      <table class="table table-hover table-condensed table-bordered" id="tabladinamicaload">
        <caption>
          
            <style>
                .grafica{
                    margin: 0 auto;
                }
            </style>
            <table align="center">
          <!--  <div class="grafica" id="columnchart_material" style="width: 650px; height: 350px;"></div> -->
            </table>
            </caption>
          <thead>
            <tr align="center">
              <td bgcolor="#5DADE2"><b>EDAT</b></td>
              <td bgcolor="#5DADE2"><b>CANDIDATO</b></td>
              <td bgcolor="#5DADE2"><b>GDD</b></td>
              <td bgcolor="#5DADE2"><b>FECHA ARRANQUE</b></td>
              <td bgcolor="#5DADE2"><b>FECHA REAL</b></td>
              <td bgcolor="#5DADE2"><b>FECHA CONEXION</b></td>
              <td bgcolor="#5DADE2"><b>FECHA REAL</b></td>
              <td bgcolor="#5DADE2"><b>FUENTE</b></td>
              <td bgcolor="#5DADE2"><b>ESTATUS</b></td>
              <td bgcolor="#5DADE2"><b>AGREGAR</b></td>
            </tr>
          </thead>
          <tbody>
            <?php
                $sql = "select id, edat, nombre, gerente, conexion, fecha_induccion, fecha_conexion, fuente, fec_real, fech_con, esta  from llenado_formulario where arranque='Si'";
                $result = mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){
                    $reg = $ver[0]."||".
                             $ver[1]."||".
                             $ver[2]."||".
                             $ver[3]."||".
                             $ver[4]."||".
                             $ver[5]."||".
                             $ver[6]."||".
                             $ver[7]."||".
                             $ver[8]."||".
                             $ver[9]."||".
                             $ver[10];
                ?>
                <tr align="center">
            <td><?php echo $ver[1] ?></td>
            <td><?php echo $ver[2] ?></td>
            <td><?php echo $ver[3] ?></td>
            <td><?php echo $ver[5] ?></td>
            <td><b><?php echo $ver[8] ?></b></td>
            <td><?php echo $ver[6] ?></td>
            <td><b><?php echo $ver[9] ?></b></td>
            <td><?php echo $ver[7] ?></td>
            <td><b><?php echo $ver[10] ?></b></td>
            <td><button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform1('<?php echo $reg ?>')"></td>
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