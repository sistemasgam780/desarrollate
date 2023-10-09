<?php
    error_reporting(0);
    
    require_once "php/conexion.php";
    $conexion = conexion();
    session_start();
    $edat = $_SESSION['user'];
    
    $ids = isset($_GET['id']) ? $_GET['id'] : 1;
    
    if($conexion->connect_error){
        die('Error de conexion: '.$conexion->connect_error);
    }
    
    date_default_timezone_set("America/Mexico_City");
    $time = time();
    $fechaactual = date("Y-m-d",$time);
    
    $fechareal = date("Y-m-d",strtotime($fechaactual."- 1 days"));
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
 

  <title></title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <!--<script src="js/funciones2.js"></script>-->
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     
    <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
   </head>
<body>
    <!--Barra de navegacion -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-left">
            <li><a><span class="label label-primary">Bienvenido:  <?php echo $edat ?></span></a></li>
            <input hidden id="edat" value="<?php echo $edat ?>">
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="index1.php">Regresar</a></li>
            <li><a href="php/logout.php">Salir</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <!--Termina barra de navegacion-->
  <div class="container" id="observaciones">
    <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
        <thead>
              <tr align="center">
                <?php 
                 $sql = "SELECT nombre FROM llenado_formulario WHERE id='$ids'";
                $result = mysqli_query($conexion,$sql);
                    while ($ver=mysqli_fetch_row($result)) {
                        $datos = $ver[0];
                    
                ?>
                  <td colspan="10"><b>Mis Observaciones de <?php echo $ver[0];?></b></td>
              </tr>
              <tr align="center">
                  <td colspan="9"><b><small>Observacion</small></b></td>
                  <td><b><small>Fecha de Observacion</small></b></td>
              </tr>
              <tr>
                <?php 
                  $sql = "SELECT * FROM observaciones where id_prospecto='$ids' ORDER BY id DESC";
                  $result = mysqli_query($conexion,$sql);
                  while ($ver1=mysqli_fetch_row($result)) {
                    $datos = $ver1[0]."||".
                             $ver1[1]."||".
                             $ver1[2]."||".
                             $ver1[3];
                ?>
                <td align="center" colspan="9">
                  <?php echo $ver1[2];?>
                </td>
                <td align="center">
                  <?php echo $ver1[3]; ?>
                </td>
              </tr>
          </thead>
          <?php 
            }
          ?>
          <tbody>
          </tbody>
          <form class="" action="agregarobser.php" method="post">
          <tbody>
              <tr>
                <td colspan="1" align="center" bgcolor="#dad4d3"><b>Agregar Observaciones:</b></td>
                <td colspan="8" align="center" bgcolor="#dad4d3">
                    <textarea id="obs" name="obs" class="campo-form" cols="70" rows="2"></textarea>
                    <input type="text" hidden="" id="idp" name="idp" value="<?php echo $ids; ?>">
                </td>

                <td colspan="1" align="center" bgcolor="#dad4d3">
                    <input type="submit" id="agregar" value="Agregar">
                </td>

            </tr>
          </tbody> 
          <?php
            }
          ?>
          </form>  
    </table>
  </div>
</body>
</html>

<script type="text/javascript">
        $(document).ready(function(){
            $('#guardar').click(function(){

                agregarobservaciones();
                reload();
            });
        });
    </script>