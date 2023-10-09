<?php
error_reporting(0);
include 'php/conexion.php';
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

//Comprobamos existencia de sesion
if (!isset($_SESSION['user'])) {
  header('location: index.php');
}

mysqli_set_charset($conexion, 'utf8'); //Esta linea arregla que los acentos combobits
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicaci��n y mostramos el error
}

if (!isset($_SESSION['tiempo'])) {
  $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 1800) {
  date_default_timezone_set('America/Mexico_City');
  $hoy = date("Y-m-d");
  $nomusuario = $_SESSION['user'];
  $fecha1 = $_COOKIE["tiempo"];
  $fecha2 = date("H:i");
  $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
  $tiempoTotal = ($tiempo / 60 . " Minutos");


  $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
              values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
  $inserT = mysqli_query($conexion, $ti);
  session_destroy();
  session_unset();
  header('location: index.php');
  die();
}
echo $nombre;
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=big5">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Conexiones</title>
  <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- HOJAS DE ESTILO -->
  <link href="style/style_conexiones.css" rel="stylesheet" type="text/css">

</head>

<body>
  <!--Barra de navegacion -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenido <?= $_SESSION['user']; ?></li>
          <input hidden id="edat" value="<?php echo $edat ?>">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="admin.php"><span class="glyphicon glyphicon-chevron-left"></span>Regresar</a></li>
          <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div id="tablacon"></div>
  </div>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablacon').load('componentes/tablacon.php');
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#metas').click(function() {
      //alert("Se clickeo");
      actualizametas();
    });
    $('#agregauser').click(function() {

      agregausuario();
    });

  });
</script>