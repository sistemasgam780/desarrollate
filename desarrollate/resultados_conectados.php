<?php
include 'php/conexion.php';
error_reporting(E_ALL);
$conexion = conexion();
session_start();

if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 300) {
    date_default_timezone_set('America/Mexico_City');
    $hoy = date("Y-m-d");
    $nomusuario = $_SESSION['user'];
    $fecha1 = $_COOKIE["tiempo"];
    $fecha2 = date("H:i");
    $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
    $tiempoTotal = ($tiempo / 60 . " Minutos");


    $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha) values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
    $inserT = mysqli_query($conexion, $ti);
    session_destroy();
    session_unset();
    header('location: index.php');
    die();
}

$_SESSION['tiempo'] = time();

$edat = $_SESSION['user'];
date_default_timezone_set('America/Mexico_City');
$fecha = date("H:i");
setcookie("tiempo", $fecha);

?>

<HTML>

<HEAD>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/conectados.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/alertify/alertify.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    
    
    <!-- LIBRERIAS PARA LOS GRAFICOS  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <!-- <link rel="stylesheet" href="style/gconectados.css"> -->
    <link rel="stylesheet" href="style/estilo_seguimiento.css">

  
    
</HEAD>

<BODY>

    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a><span class="label label-primary">Bienvenido: <?php echo $edat ?></span></a></li>
                    <input hidden id="edat" value="<?php echo $edat ?>">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index1.php">Regresar</a></li>
                    <li><a href="php/logout.php">Salir</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


    <!-- SELECT OPTION QUE DESEA CONSULTAR -->
    <div class="container">
        <div class="form-group form-control-sm">
            <label for="exampleFormControlSelect1">Seleccione su consulta:</label>
            <select class="form-control" id="seleccion" name="seleccion" onchange="showInp()">
                <option selected disabled hidden>Seleccione: </option>
                <option value="1">GENERAL</option>
                <option value="2">INDIVIDUAL</option>
            </select>
        </div>
    </div>

    <!-- CONSULTA GENERAL -->
    <div id="mostrarGeneral" style="display: none;">
        <div class="container">
            <label>Ingrese la fecha que desea consultar:</label>
            <div class="text-center">
                <div class="row">
                    <form method="POST" onsubmit="return enviarGeneral();">
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Desde </label><input type="date" name="fecha1G" id="fecha1G" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <label>Hasta </label><input type="date" name="fecha2G" id="fecha2G" class="form-control form-control-sm input-sm">
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Consultar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <p id="respG"></p>
            </div>
        </div>
    </div>


    <!-- CONSULTA INDIVIDUAL -->
    <div id="mostrarIndividual" style="display: none;">
        <div class="container">
            <div class="form-group form-control-sm">
                <label for="exampleFormControlSelect1">Seleccione a quien desee consultar:</label>
                <form method="POST" onsubmit="return enviarIndividual();">
                    <select class="form-control" id="seleccion2" name="seleccion2">
                        <option selected disabled hidden value="">Seleccione: </option>
                        <?php
                        $sql = "SELECT X.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$edat' AND X.conexion IS NOT NULL GROUP BY Y.nombreAgente";
                        $resultT = mysqli_query($conexion, $sql);
                        while ($conexiones = mysqli_fetch_array($resultT)) {
                            $prospecto = $conexiones[0];
                        ?>
                            <option value="<?php echo $prospecto = $conexiones[0]; ?>"> <?php echo $prospecto = $conexiones[0]; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
            </div>
        </div>

        <div class="container">
            <label>Ingrese la fecha que desea consultar</label>
            <div class="text-center">
                <div class="row">
                    <div class='col-md-2'>
                        <div class="form-group">
                            <label>Desde </label><input type="date" name="fecha1Ind" id="fecha1Ind" class="form-control form-control-sm input-sm">
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            <label>Hasta </label><input type="date" name="fecha2Ind" id="fecha2Ind" class="form-control form-control-sm input-sm">
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <p id="respInd"></p>
        </div>
    </div>
</BODY>

</HTML>


<script type="text/javascript">
 $(document).ready(function() {
     $('[rel="tooltip"]').tooltip();
  });

  </script>
