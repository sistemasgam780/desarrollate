<?php
error_reporting(E_ALL);

require_once "php/conexion.php";
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

//Comprobamos existencia de sesi車n
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

//INACTIVIDAD
if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
    //Comparación para redigir página, si la vida de sesión sea mayor al tiempo insertado en inactivo.
} else if (time() - $_SESSION['tiempo'] > 300) {
    date_default_timezone_set('America/Mexico_City');
    $hoy = date("Y-m-d");
    $nomusuario = $_SESSION['user'];
    $horaInicio = $_COOKIE["tiempo"];
    $horaFin = date("H:i");
    $tiempo = abs(strtotime($horaFin) - strtotime($horaInicio));
    $tiempoTotal = ($tiempo / 60 . " Minutos");

    $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha) values ('$nomusuario','$horaInicio','$horaFin', '$tiempoTotal', '$hoy')";
    $inserT = mysqli_query($conexion, $ti);
    //Removemos sesión.
    session_unset();
    //Destruimos sesión.
    session_destroy();
    //Redirigimos pagina.
    header("location: index.php");
    die();
}


// Activamos sesion tiempo.
$_SESSION['tiempo'] = time();

date_default_timezone_set('America/Mexico_City');
$fecha = date("H:i");
setcookie("tiempo", $fecha);

$ids = isset($_GET['id']) ? $_GET['id'] : 1;

if ($conexion->connect_error) {
    die('Error de conexion: ' . $conexion->connect_error);
}

date_default_timezone_set("America/Mexico_City");
$time = time();
$fechaactual = date("Y-m-d", $time);

$fechareal = date("Y-m-d", strtotime($fechaactual . "- 1 days"));
?>
<html>

<head>
    <title>Conexi&oacute;n</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="imagenes/gam.ico" />
    <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
    <link rel="icon" type="image/x-icon" href="../imagenes/gam.ico">
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
    <link href="style/style_fechas.css" rel="stylesheet" type="text/css">

</head> <!-- LIBRERIAS-->

<body>
    <!--Barra de navegacion -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <?php
                    if ($edat == 'Alan Soto') { ?>
                        <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenido <?= $edat ?></li>
                    <?php
                    } elseif ($edat == 'Paloma Razo' || $edat == 'Nallely Quintana' || $edat == 'Yazmin Albarran') { ?>
                        <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenida <?= $edat ?></li>
                    <?php
                    }
                    ?>
                    <input hidden id="edat" value="<?php echo $edat ?>">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!--<li><a href="resultados_conectados.php"><span class="glyphicon glyphicon-search"></span> Seguimiento</a></li>-->
                    <li><a href="metas.php"><span class="glyphicon glyphicon-file"></span> Metas y resultados</a></li>
                    <li><a href="edat.php"><span class="glyphicon glyphicon-chevron-left"></span>Regresar</a></li>
                    <li><a href="php/logout.php" id="salir"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container" id="fechas">
        <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
            <thead>
                <tr>
                    <td colspan="10" class="tdTitulo">MI CONEX&Oacute;N</td>
                </tr>
                <tr>
                    <td colspan="2" class="tdEncabezados"><small>PROSPECTO</small></td>
                    <td colspan="2" class="tdEncabezados"><small>CONTACTO</small></td>
                    <td colspan="2" class="tdEncabezados"><small>ENTREVISTA</small></td>
                    <td colspan="2" class="tdEncabezados"><small>INDUCCI&Oacute;N</small></td>
                    <td colspan="2" class="tdEncabezados"><small>CONEXI&Oacute;N</small></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $sql = "SELECT id, nombre, fechareg, fecha_cita, fecha_induccion, fecha_conexion FROM llenado_formulario WHERE id='$ids'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0] . "||" .
                            $ver[1] . "||" .
                            $ver[2] . "||" .
                            $ver[3] . "||" .
                            $ver[4] . "||" .
                            $ver[5]; ?>

                        <td colspan="2"><small><?php echo $ver[1]; ?></small></td>
                        <td colspan="2">
                            <small>
                                <?php
                                $date = date_create($ver[2]);
                                $fecha = date_format($date, 'Y-m-d');
                                echo $fecha;
                                ?>
                            </small>
                        </td>
                        <td colspan="2"><small><?php echo $ver[3]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[4]; ?></small></td>
                        <td colspan="2"><small><?php echo $ver[5]; ?></small></td>


                </tr>
                <tr>
                    <?php
                        // Resultado de la diferencia entre dos fechas -> contacto/conexion
                        $date1_result = $ver[2];
                        $date2_result = $ver[5];

                        $feriados = array(
                            '2022-02-07',
                            '2022-03-21',
                            '2022-04-14',
                            '2022-04-15',
                            '2022-09-16',
                            '2022-11-01',
                            '2022-11-02',
                            '2022-10-21',
                        );

                        $startDate = (new DateTime($date1_result));
                        $endDate = (new DateTime($date2_result))->modify('+1 day');
                        $interval = new DateInterval('P1D');
                        $date_range = new DatePeriod($startDate, $interval, $endDate); //creamos rango de fechas

                        $workdays = -1;

                        foreach ($date_range as $date) {
                            //Se considera el fin de semana y los feriados como no h芍biles
                            if ($date->format("N") < 6 and !in_array($date->format("Y-m-d"), $feriados))
                                ++$workdays; // se cuentan los d赤as habiles
                        }

                    ?>

                    <td colspan="10"><small>El periodo transcurrido del prospecto <b><?= $ver[1]; ?></b> desde su contacto hasta su conexi&oacute;n es de: <b><?= $workdays ?> d&iacute;as</b></small></td>
                </tr>
            <?php
                    }
            ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<script type="text/javascript">
    var timeoutID;

    function setup() {
        this.addEventListener("mousemove", resetTimer, false);
        this.addEventListener("mousedown", resetTimer, false);
        this.addEventListener("keypress", resetTimer, false);
        // Se activa al mover la rueda del mouse
        this.addEventListener("mousewheel", resetTimer, false);
        // Se activa al tocar la pantalla y estar posicionado en el html
        this.addEventListener("touchmove", resetTimer, false);
        this.addEventListener("MSPointerMove", resetTimer, false);
        this.addEventListener("onhaschange", resetTimer, false);

        startTimer();
    }
    setup();

    function startTimer() {
        // Espera 2 segundos antes de llamar a goInactive
        timeoutID = window.setTimeout(goInactive, 300000);
    }

    function resetTimer(e) {
        window.clearTimeout(timeoutID);
        goActive();
    }

    function goInactive() {
        document.getElementById("salir").click();
    }

    function goActive() {
        startTimer();
    }
</script>