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
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="librerias/alertifyjs/css/themes/default.css" rel="stylesheet" id="alertifyjs-css-themes">
      <link href="librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
      <link href="librerias/alertifyjs/css/alertify.css" rel="stylesheet" id="alertifyjs-css">
      <link href="librerias/select2/css/select2.css" rel="stylesheet" id="select2-css">
      <link href="librerias/datatables/dataTables.bootstrap.css" rel="stylesheet">
      <link href="css/sb-admin.css" rel="stylesheet">

      <link rel="icon" type="image/x-icon" href="../imagenes/gam.ico">
      <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
      <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
      <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

      <script src="librerias/jquery-3.3.1.min.js"></script>
      <script src="js/funciones.js"></script>
      <script src="librerias/bootstrap/js/bootstrap.js"></script>
      <script src="librerias/alertify/alertify.js"></script>
      <script src="librerias/datatable/jquery.dataTables.min.js"></script>
      <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <script src="jquery-3.3.1.min.js"></script>
      <script src="javascript.js"></script>
      <link rel="stylesheet" href="stylesheet.css">
      
</head> <!-- LIBRERIAS-->
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
  
  <div class="container" id="fechas">
      <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
          <thead>
              <tr align="center">
                  <td colspan="10"><b>Mis Conexiones</b></td>
              </tr>
              <tr align="center">
                  <td colspan="2"><b><small>Nombre</small></b></td>
                  <td colspan="2"><b><small>Contacto</small></b></td>
                  <td colspan="2"><b><small>Entrevista</small></b></td>
                  <td colspan="2"><b><small>Inducción</small></b></td>
                  <td colspan="2"><b><small>Conexión</small></b></td>
              </tr>
          </thead>
          <tbody>
              <tr align="center">
              <?php
                $sql = "SELECT id, nombre, fechareg, fecha_cita, fecha_induccion, fecha_conexion FROM llenado_formulario WHERE id='$ids'";
                $result = mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){
                    $datos = $ver[0]."||".
                             $ver[1]."||".
                             $ver[2]."||".
                             $ver[3]."||".
                             $ver[4]."||".
                             $ver[5];?>
                    
                        <td colspan="2"><small><?php echo $ver[1]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[2]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[3]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[4]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[5]; ?></small></td>
                           
                
                </tr>
                <tr align="center">
                    <?php
                        
                        $fecha1 = date_create("$ver[2]");
                        $fecha2 = date_create("$ver[5]");
                        $diferencia = date_diff($fecha1,$fecha2);
                        
                    ?>
                    
                    <td colspan="10"><small>El tiempo transcurrido en que el prospecto <b><?php echo $ver[1]; ?></b> se contacto hasta que se conecto es de: <?php echo $fecha1;?></small></td>
                </tr>
                <?php             
                }
              ?>
          </tbody>
      </table>
  </div>
</body>
</html>