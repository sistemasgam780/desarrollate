<?php
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

//Comprobamos existencia de sesión
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
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Observaciones</title>
    <link rel="icon" type="image/x-icon" href="imagenes/gam.ico" />
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
    <link href="style/style_observaciones.css" rel="stylesheet" type="text/css">
</head>

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

    <div class="container" id="observaciones">
        <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
            <thead>
                <tr align="center">
                    <?php
                    $sql = "SELECT nombre FROM llenado_formulario WHERE id='$ids'";
                    $result = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($result)) {
                        $datos = $ver[0];

                    ?>
                        <td class="tdEncabezado" colspan="10">
                            Mis Observaciones del prospecto <?php echo $ver[0]; ?>
                        </td>
                </tr>
                <tr align="center">
                    <td colspan="9" class="tdObservaciones">
                        <small>OBSERVACIONES</small>
                    </td>
                    <td class="tdObservaciones">
                        <small>FECHA</small>
                    </td>
                </tr>
                <tr>
                    <?php
                        $sql = "SELECT * FROM observaciones where id_prospecto='$ids' ORDER BY id DESC";
                        $result = mysqli_query($conexion, $sql);
                        while ($ver1 = mysqli_fetch_row($result)) {
                            $datos = $ver1[0] . "||" .
                                $ver1[1] . "||" .
                                $ver1[2] . "||" .
                                $ver1[3];
                    ?>
                        <td class="tdTexto" colspan="9">
                            <?php echo $ver1[2]; ?>
                        </td>
                        <td class="tdTexto">
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
                    <td colspan="1" class="tdAgregar">Agregar Observaciones:</td>
                    <td colspan="8" class="tdTxtArea">
                        <textarea id="obs" name="obs" class="campo-form" cols="70" rows="2" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
                        <input type="text" hidden="" id="idp" name="idp" value="<?php echo $ids; ?>">
                    </td>
                    <td colspan="1" class="tdBtn">
                        <button type="submit" class="btn btn-warning glyphicon glyphicon-ok" id="agregar"></button>
                        <!-- <input type="submit" id="agregar" value="Agregar"> -->
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
    $(document).ready(function() {
        $('#guardar').click(function() {

            agregarobservaciones();
            reload();
        });
    });
</script>

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