<?php
date_default_timezone_set('America/Mexico_City');
$fecha = date("H:i");
setcookie("tiempo", $fecha);
error_reporting(0);

require_once "php/conexion.php";
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];

//Comprobamos existencia de sesión
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

if ($conexion->connect_error) {
    die('Error de conexion: ' . $conexion->connect_error);
}

date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'es_MX.UTF-8');
$fechaActual = strftime("%Y-%m-%d");

if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 2400) {
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
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <title>M E T A S</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ICONO -->
    <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
    <!-- HOJA DE ESTILO -->
    <link href="style/style_metas_admin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="librerias/datatable/jquery.dataTables.min.js"></script>
    <script src="js/funciones_metasAdmin.js"></script>
    <script src="js/ajax_metasAdmin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body>
    <!--Barra de navegacion -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="usuarioE"><span class="glyphicon glyphicon-user"></span> Bienvenido <?= $_SESSION['user']; ?></li>

                    <!-- <li><a><span class="label label-primary">Bienvenido: <?php echo $_SESSION['user']; ?></span></a></li> -->
                    <input hidden id="edat" value="<?php echo $edat ?>">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#" data-toggle="modal" data-target="#modalcrearuser">Crear Usuario</a></li> -->
                    <li><a href="conexiones.php"><span class="glyphicon glyphicon-link"></span> Conexiones</a></li>
                    <li><a href="admin.php"><span class="glyphicon glyphicon-chevron-left"></span>Regresar</a></li>
                    <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- BOTONES -->
    <div class="container text-center">
        <button type="button" class="btn btn-secondary" onclick="showSelect_obj()">Objetivos</button>
        <button type="button" class="btn btn-secondary" onclick="showSelect_pond()">Ponderación</button>
    </div>

    <!-- SELECTS -->
    <div class="container">
        <!-- SELECT OBJETIVO -->
        <div id="select_obj" style="display: none;">
            <div class="form-group form-control-sm">
                <label for="exampleFormControlSelect1">Seleccione su consulta:</label>
                <select type="text" class="form-control input-sm" id="result_obj" name="result_obj" onchange="showObj()">
                    <option value="Seleccionar" selected disabled hidden>Seleccione:</option>
                    <option value="obj_gen">General</option>
                    <option value="obj_esp">Especifico</option>
                </select>
            </div>
        </div>

        <!-- SELECT PONDERACION -->
        <div id="select_pond" style="display: none;">
            <div class="form-group form-control-sm">
                <label for="exampleFormControlSelect1">Seleccione su consulta:</label>
                <select type="text" class="form-control input-sm" id="result_pond" name="result_pond" onchange="showPon()">
                    <option value="Seleccionar" selected disabled hidden>Seleccione:</option>
                    <option value="pon_gen">General</option>
                    <option value="pon_esp">Especifico</option>
                </select>
            </div>
        </div>

        <!-- TABLAS OBJETIVOS-->
        <div id="tableObj_General" style="display: none;">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-refresh"></span> Actualiza</button>
            <div id="objetivosG">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadObj">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE LOS EDAT´S
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_obj">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_obj">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_obj">
                            EVALUACIONES
                        </td>
                        <td class="tdVen_obj">
                            VENTAS
                        </td>
                        <td class="tdInd_obj">
                            INDUCCIONES
                        </td>
                        <td class="tdCone_obj">
                            CONEXIONES
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_obj">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_obj = "SELECT contacto FROM metaa WHERE edat = 'General'";
                            $resCon_obj = mysqli_query($conexion, $sqlCon_obj);
                            list($datosCon_obj) = mysqli_fetch_row($resCon_obj);
                            echo $datosCon_obj;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_obj = "SELECT entrevista FROM metaa WHERE edat = 'General'";
                            $resEnt_obj = mysqli_query($conexion, $sqlEnt_obj);
                            list($datosEnt_obj) = mysqli_fetch_row($resEnt_obj);
                            echo $datosEnt_obj;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_obj = "SELECT evaluacion FROM metaa WHERE edat = 'General'";
                            $resEv_obj = mysqli_query($conexion, $sqlEv_obj);
                            list($datosEv_obj) = mysqli_fetch_row($resEv_obj);
                            echo "$datosEv_obj";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_obj = "SELECT venta FROM metaa WHERE edat = 'General'";
                            $resVen_obj = mysqli_query($conexion, $sqlVen_obj);
                            list($datosVen_obj) = mysqli_fetch_row($resVen_obj);
                            echo $datosVen_obj;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_obj = "SELECT induccion FROM metaa WHERE edat = 'General'";
                            $resIn_obj = mysqli_query($conexion, $sqlIn_obj);
                            list($datosIn_obj) = mysqli_fetch_row($resIn_obj);
                            echo $datosIn_obj;
                            ?>

                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_obj = "SELECT conexion FROM metaa WHERE edat = 'General'";
                            $resCone_obj = mysqli_query($conexion, $sqlCone_obj);
                            list($datosCone_obj) = mysqli_fetch_row($resCone_obj);
                            echo $datosCone_obj;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $pts = $datosCon_obj + $datosEnt_obj + $datosEv_obj + $datosVen_obj + $datosIn_obj + $datosCone_obj;
                            echo $pts;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_obj = "SELECT fecha FROM metaa WHERE edat = 'General'";
                            $resFec_obj = mysqli_query($conexion, $sqlFec_obj);
                            list($datosFec_obj) = mysqli_fetch_row($resFec_obj);
                            //Formateo para la fecha y hora que arroja
                            $date = date_create($datosFec_obj);
                            echo date_format($date, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- MODAL OBJETIVO/GENERAL -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Metas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="datosGenerales_obj" method="POST" name="datosGenerales_obj">
                                <div id="refrescarModalObjG">
                                    <label class="col-form-label">Contactos:</label>
                                    <input type="text" class="form-control" name="contactos" value="<?= $datosCon_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Entrevistas:</label>
                                    <input type="text" class="form-control" name="entrevistas" value="<?= $datosEnt_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Evaluación:</label>
                                    <input type="text" class="form-control" name="evaluaciones" value="<?= $datosEv_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Ventas:</label>
                                    <input type="text" class="form-control" name="ventas" value="<?= $datosVen_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Inducciones:</label>
                                    <input type="text" class="form-control" name="inducciones" value="<?= $datosIn_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Conexiones:</label>
                                    <input type="text" class="form-control" name="conexiones" value="<?= $datosCone_obj ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOg()">
                                    <label class="col-form-label">Puntos totales:</label>
                                    <input class="form-control" name="ptsObjG" value="<?= $pts ?>" disabled>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="modificarObj">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- OBJETIVO / ESPECIFICO -->
        <div id="tableObj_Esp" style="display: none;">
            <button id="btnObjEsp" type="button" class="btn btn-warning" data-toggle="modal" data-target="#objEsp"><span class="glyphicon glyphicon-refresh"></span> Actualiza</button>

            <div id="objEspecificos_A">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadObj_A">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE ALAN SOTO
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_obj">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_obj">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_obj">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_obj">
                            VENTA
                        </td>
                        <td class="tdInd_obj">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_obj">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_obj">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_objA = "SELECT contacto FROM metaa WHERE edat = 'Alan Soto'";
                            $resCon_objA = mysqli_query($conexion, $sqlCon_objA);
                            list($datosCon_objA) = mysqli_fetch_row($resCon_objA);
                            echo $datosCon_objA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_objA = "SELECT entrevista FROM metaa WHERE edat = 'Alan Soto'";
                            $resEnt_objA = mysqli_query($conexion, $sqlEnt_objA);
                            list($datosEnt_objA) = mysqli_fetch_row($resEnt_objA);
                            echo $datosEnt_objA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_objA = "SELECT evaluacion FROM metaa WHERE edat = 'Alan Soto'";
                            $resEv_objA = mysqli_query($conexion, $sqlEv_objA);
                            list($datosEv_objA) = mysqli_fetch_row($resEv_objA);
                            echo "$datosEv_objA";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_objA = "SELECT venta FROM metaa WHERE edat = 'Alan Soto'";
                            $resVen_objA = mysqli_query($conexion, $sqlVen_objA);
                            list($datosVen_objA) = mysqli_fetch_row($resVen_objA);
                            echo $datosVen_objA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_objA = "SELECT induccion FROM metaa WHERE edat = 'Alan Soto'";
                            $resIn_objA = mysqli_query($conexion, $sqlIn_objA);
                            list($datosIn_objA) = mysqli_fetch_row($resIn_objA);
                            echo $datosIn_objA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_objA = "SELECT conexion FROM metaa WHERE edat = 'Alan Soto'";
                            $resCone_objA = mysqli_query($conexion, $sqlCone_objA);
                            list($datosCone_objA) = mysqli_fetch_row($resCone_objA);
                            echo $datosCone_objA;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsA = $datosCon_objA + $datosEnt_objA + $datosEv_objA + $datosVen_objA + $datosIn_objA + $datosCone_objA;
                            echo $ptsA;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_objA = "SELECT fecha FROM metaa WHERE edat = 'Alan Soto'";
                            $resFec_objA = mysqli_query($conexion, $sqlFec_objA);
                            list($datosFec_objA) = mysqli_fetch_row($resFec_objA);
                            //Formateo para la fecha y hora que arroja
                            $dateA = date_create($datosFec_objA);
                            echo date_format($dateA, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="objEspecificos_N">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadObj_N">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE NALLELY QUINTANA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_obj">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_obj">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_obj">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_obj">
                            VENTA
                        </td>
                        <td class="tdInd_obj">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_obj">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_obj">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_objN = "SELECT contacto FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resCon_objN = mysqli_query($conexion, $sqlCon_objN);
                            list($datosCon_objN) = mysqli_fetch_row($resCon_objN);
                            echo $datosCon_objN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_objN = "SELECT entrevista FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resEnt_objN = mysqli_query($conexion, $sqlEnt_objN);
                            list($datosEnt_objN) = mysqli_fetch_row($resEnt_objN);
                            echo $datosEnt_objN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_objN = "SELECT evaluacion FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resEv_objN = mysqli_query($conexion, $sqlEv_objN);
                            list($datosEv_objN) = mysqli_fetch_row($resEv_objN);
                            echo "$datosEv_objN";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_objN = "SELECT venta FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resVen_objN = mysqli_query($conexion, $sqlVen_objN);
                            list($datosVen_objN) = mysqli_fetch_row($resVen_objN);
                            echo $datosVen_objN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_objN = "SELECT induccion FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resIn_objN = mysqli_query($conexion, $sqlIn_objN);
                            list($datosIn_objN) = mysqli_fetch_row($resIn_objN);
                            echo $datosIn_objN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_objN = "SELECT conexion FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resCone_objN = mysqli_query($conexion, $sqlCone_objN);
                            list($datosCone_objN) = mysqli_fetch_row($resCone_objN);
                            echo $datosCone_objN;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsN = $datosCon_objN + $datosEnt_objN + $datosEv_objN + $datosVen_objN + $datosIn_objN + $datosCone_objN;
                            echo $ptsN;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_objN = "SELECT fecha FROM metaa WHERE edat = 'Nallely Quintana'";
                            $resFec_objN = mysqli_query($conexion, $sqlFec_objN);
                            list($datosFec_objN) = mysqli_fetch_row($resFec_objN);
                            //Formateo para la fecha y hora que arroja
                            $dateN = date_create($datosFec_objN);
                            echo date_format($dateN, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="objEspecificos_P">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadObj_P">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE PALOMA RAZO
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_obj">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_obj">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_obj">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_obj">
                            VENTA
                        </td>
                        <td class="tdInd_obj">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_obj">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_obj">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_objP = "SELECT contacto FROM metaa WHERE edat = 'Paloma Razo'";
                            $resCon_objP = mysqli_query($conexion, $sqlCon_objP);
                            list($datosCon_objP) = mysqli_fetch_row($resCon_objP);
                            echo $datosCon_objP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_objP = "SELECT entrevista FROM metaa WHERE edat = 'Paloma Razo'";
                            $resEnt_objP = mysqli_query($conexion, $sqlEnt_objP);
                            list($datosEnt_objP) = mysqli_fetch_row($resEnt_objP);
                            echo $datosEnt_objP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_objP = "SELECT evaluacion FROM metaa WHERE edat = 'Paloma Razo'";
                            $resEv_objP = mysqli_query($conexion, $sqlEv_objP);
                            list($datosEv_objP) = mysqli_fetch_row($resEv_objP);
                            echo "$datosEv_objP";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_objP = "SELECT venta FROM metaa WHERE edat = 'Paloma Razo'";
                            $resVen_objP = mysqli_query($conexion, $sqlVen_objP);
                            list($datosVen_objP) = mysqli_fetch_row($resVen_objP);
                            echo $datosVen_objP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_objP = "SELECT induccion FROM metaa WHERE edat = 'Paloma Razo'";
                            $resIn_objP = mysqli_query($conexion, $sqlIn_objP);
                            list($datosIn_objP) = mysqli_fetch_row($resIn_objP);
                            echo $datosIn_objP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_objP = "SELECT conexion FROM metaa WHERE edat = 'Paloma Razo'";
                            $resCone_objP = mysqli_query($conexion, $sqlCone_objP);
                            list($datosCone_objP) = mysqli_fetch_row($resCone_objP);
                            echo $datosCone_objP;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsP = $datosCon_objP + $datosEnt_objP + $datosEv_objP + $datosVen_objP + $datosIn_objP + $datosCone_objP;
                            echo $ptsP;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_objP = "SELECT fecha FROM metaa WHERE edat = 'Paloma Razo'";
                            $resFec_objP = mysqli_query($conexion, $sqlFec_objP);
                            list($datosFec_objP) = mysqli_fetch_row($resFec_objP);
                            //Formateo para la fecha y hora que arroja
                            $dateP = date_create($datosFec_objP);
                            echo date_format($dateP, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="objEspecificos_Y">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadObj_Y">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE YAZMIN ALBARRÁN
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_obj">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_obj">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_obj">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_obj">
                            VENTA
                        </td>
                        <td class="tdInd_obj">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_obj">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_obj">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_objY = "SELECT contacto FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resCon_objY = mysqli_query($conexion, $sqlCon_objY);
                            list($datosCon_objY) = mysqli_fetch_row($resCon_objY);
                            echo $datosCon_objY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_objY = "SELECT entrevista FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resEnt_objY = mysqli_query($conexion, $sqlEnt_objY);
                            list($datosEnt_objY) = mysqli_fetch_row($resEnt_objY);
                            echo $datosEnt_objY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_objY = "SELECT evaluacion FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resEv_objY = mysqli_query($conexion, $sqlEv_objY);
                            list($datosEv_objY) = mysqli_fetch_row($resEv_objY);
                            echo "$datosEv_objY";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_objY = "SELECT venta FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resVen_objY = mysqli_query($conexion, $sqlVen_objY);
                            list($datosVen_objY) = mysqli_fetch_row($resVen_objY);
                            echo $datosVen_objY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_objY = "SELECT induccion FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resIn_objY = mysqli_query($conexion, $sqlIn_objY);
                            list($datosIn_objY) = mysqli_fetch_row($resIn_objY);
                            echo $datosIn_objY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_objY = "SELECT conexion FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resCone_objY = mysqli_query($conexion, $sqlCone_objY);
                            list($datosCone_objY) = mysqli_fetch_row($resCone_objY);
                            echo $datosCone_objY;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsY = $datosCon_objY + $datosEnt_objY + $datosEv_objY + $datosVen_objY + $datosIn_objY + $datosCone_objY;
                            echo $ptsY;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_objY = "SELECT fecha FROM metaa WHERE edat = 'Yazmin Albarran'";
                            $resFec_objY = mysqli_query($conexion, $sqlFec_objY);
                            list($datosFec_objY) = mysqli_fetch_row($resFec_objY);
                            //Formateo para la fecha y hora que arroja
                            $dateY = date_create($datosFec_objY);
                            echo date_format($dateY, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- MODAL OBJETIVOS/ESPECIFICOS -->
            <div class="modal fade" id="objEsp" tabindex="-1" role="dialog" aria-labelledby="objEspLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="objEspLabel">Metas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="datosEspecificos_obj" method="POST" name='datosEspecificos_obj'>
                                <div class="form-group form-control-sm">
                                    <label>EDAT:</label>
                                    <select type="text" class="form-control input-sm" id="edat_obj" name="edat_obj" onchange="showObj_esp()">
                                        <option value="Seleccionar" selected disabled hidden>Seleccione:</option>
                                        <option value="Alan Soto">Alan Soto</option>
                                        <option value="Nallely Quintana">Nallely Quintana</option>
                                        <option value="Paloma Razo">Paloma Razo</option>
                                        <option value="Yazmin Albarran">Yazmin Albarrán</option>
                                    </select>
                                </div>
                                <div id="espObj_a" style="display:none;">
                                    <div id="refrescarModal_A">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosA" value="<?= $datosCon_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasA" value="<?= $datosEnt_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesA" value="<?= $datosEv_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasA" value="<?= $datosVen_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesA" value="<?= $datosIn_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesA" value="<?= $datosCone_objA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsObjG_a" value="<?= $ptsA ?>" disabled>
                                    </div>
                                </div>

                                <div id="espObj_n" style="display:none;">
                                    <div id="refrescarModal_N">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosN" value="<?= $datosCon_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasN" value="<?= $datosEnt_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesN" value="<?= $datosEv_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasN" value="<?= $datosVen_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesN" value="<?= $datosIn_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesN" value="<?= $datosCone_objN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsObjG_n" value="<?= $ptsN ?>" disabled>
                                    </div>
                                </div>

                                <div id="espObj_p" style="display:none;">
                                    <div id="refrescarModal_P">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosP" value="<?= $datosCon_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasP" value="<?= $datosEnt_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesP" value="<?= $datosEv_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasP" value="<?= $datosVen_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesP" value="<?= $datosIn_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesP" value="<?= $datosCone_objP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsObjG_p" value="<?= $ptsP ?>" disabled>
                                    </div>
                                </div>

                                <div id="espObj_y" style="display:none;">
                                    <div id="refrescarModal_Y">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosY" value="<?= $datosCon_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasY" value="<?= $datosEnt_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesY" value="<?= $datosEv_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasY" value="<?= $datosVen_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesY" value="<?= $datosIn_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesY" value="<?= $datosCone_objY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsOb_esp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsObjG_y" value="<?= $ptsY ?>" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="modificarObj_esp" disabled>Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- TABLAS PONDERACION-->
        <div id="tablePon_General" style="display: none;">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#pondeGen"><span class="glyphicon glyphicon-refresh"></span> Actualiza</button>

            <div id="ponderacionG">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadPon">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            PONDERACIÓN GENERAL DE LOS EDAT´S
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_Pon">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_Pon">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_Pon">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_Pon">
                            VENTA
                        </td>
                        <td class="tdInd_Pon">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_Pon">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_Pon">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_Pon">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_pon = "SELECT contacto FROM ponderacion WHERE edat = 'General'";
                            $resCon_pon = mysqli_query($conexion, $sqlCon_pon);
                            list($datosCon_pon) = mysqli_fetch_row($resCon_pon);
                            echo $datosCon_pon;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_pon = "SELECT entrevista FROM ponderacion WHERE edat = 'General'";
                            $resEnt_pon = mysqli_query($conexion, $sqlEnt_pon);
                            list($datosEnt_pon) = mysqli_fetch_row($resEnt_pon);
                            echo $datosEnt_pon;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_pon = "SELECT evaluacion FROM ponderacion WHERE edat = 'General'";
                            $resEv_pon = mysqli_query($conexion, $sqlEv_pon);
                            list($datosEv_pon) = mysqli_fetch_row($resEv_pon);
                            echo "$datosEv_pon";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_pon = "SELECT venta FROM ponderacion WHERE edat = 'General'";
                            $resVen_pon = mysqli_query($conexion, $sqlVen_pon);
                            list($datosVen_pon) = mysqli_fetch_row($resVen_pon);
                            echo $datosVen_pon;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_pon = "SELECT induccion FROM ponderacion WHERE edat = 'General'";
                            $resIn_pon = mysqli_query($conexion, $sqlIn_pon);
                            list($datosIn_pon) = mysqli_fetch_row($resIn_pon);
                            echo $datosIn_pon;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_pon = "SELECT conexion FROM ponderacion WHERE edat = 'General'";
                            $resCone_pon = mysqli_query($conexion, $sqlCone_pon);
                            list($datosCone_pon) = mysqli_fetch_row($resCone_pon);
                            echo $datosCone_pon;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsPon = $datosCon_pon + $datosEnt_pon + $datosEv_pon + $datosVen_pon + $datosIn_pon + $datosCone_pon;
                            echo $ptsPon;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_pon = "SELECT fecha FROM ponderacion WHERE edat = 'General'";
                            $resFec_pon = mysqli_query($conexion, $sqlFec_pon);
                            list($datosFec_pon) = mysqli_fetch_row($resFec_pon);
                            //Formateo para la fecha y hora que arroja
                            $datePon = date_create($datosFec_pon);
                            echo date_format($datePon, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- MODAL PONDERACION/GENERAL -->
            <div class="modal fade" id="pondeGen" tabindex="-1" role="dialog" aria-labelledby="pondeGenLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pondeGenLabel">Metas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="datosGenerales_pon" method="POST" name="datosGenerales_pon">
                                <div id="refrescarModalPonG">
                                    <label class="col-form-label">Contactos:</label>
                                    <input type="text" class="form-control" name="contactosPg" value="<?= $datosCon_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Entrevistas:</label>
                                    <input type="text" class="form-control" name="entrevistasPg" value="<?= $datosEnt_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Evaluación:</label>
                                    <input type="text" class="form-control" name="evaluacionesPg" value="<?= $datosEv_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Ventas:</label>
                                    <input type="text" class="form-control" name="ventasPg" value="<?= $datosVen_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Inducciones:</label>
                                    <input type="text" class="form-control" name="induccionesPg" value="<?= $datosIn_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Conexiones:</label>
                                    <input type="text" class="form-control" name="conexionesPg" value="<?= $datosCone_pon ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPg()">
                                    <label class="col-form-label">Puntos totales:</label>
                                    <input class="form-control" name="ptsPonEsp" value="<?= $ptsPon ?>" disabled>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="modificarPond">Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PONDERACION / ESPECIFICO -->
        <div id="tablePon_Esp" style="display: none;">
            <button id="btnPonEsp" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ponEsp"><span class="glyphicon glyphicon-refresh"></span> Actualiza</button>

            <div id="ponEspecificos_A">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadPon_A">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE ALAN SOTO
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_Pon">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_Pon">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_Pon">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_Pon">
                            VENTA
                        </td>
                        <td class="tdInd_Pon">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_Pon">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_Pon">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_Pon">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_ponA = "SELECT contacto FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resCon_ponA = mysqli_query($conexion, $sqlCon_ponA);
                            list($datosCon_ponA) = mysqli_fetch_row($resCon_ponA);
                            echo $datosCon_ponA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_ponA = "SELECT entrevista FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resEnt_ponA = mysqli_query($conexion, $sqlEnt_ponA);
                            list($datosEnt_ponA) = mysqli_fetch_row($resEnt_ponA);
                            echo $datosEnt_ponA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_ponA = "SELECT evaluacion FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resEv_ponA = mysqli_query($conexion, $sqlEv_ponA);
                            list($datosEv_ponA) = mysqli_fetch_row($resEv_ponA);
                            echo "$datosEv_ponA";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_ponA = "SELECT venta FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resVen_ponA = mysqli_query($conexion, $sqlVen_ponA);
                            list($datosVen_ponA) = mysqli_fetch_row($resVen_ponA);
                            echo $datosVen_ponA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_ponA = "SELECT induccion FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resIn_ponA = mysqli_query($conexion, $sqlIn_ponA);
                            list($datosIn_ponA) = mysqli_fetch_row($resIn_ponA);
                            echo $datosIn_ponA;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_ponA = "SELECT conexion FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resCone_ponA = mysqli_query($conexion, $sqlCone_ponA);
                            list($datosCone_ponA) = mysqli_fetch_row($resCone_ponA);
                            echo $datosCone_ponA;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsPonA = $datosCon_ponA + $datosEnt_ponA + $datosEv_ponA + $datosVen_ponA + $datosIn_ponA + $datosCone_ponA;
                            echo $ptsPonA;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_ponA = "SELECT fecha FROM ponderacion WHERE edat = 'Alan Soto'";
                            $resFec_ponA = mysqli_query($conexion, $sqlFec_ponA);
                            list($datosFec_ponA) = mysqli_fetch_row($resFec_ponA);
                            //Formateo para la fecha y hora que arroja
                            $datePonA = date_create($datosFec_ponA);
                            echo date_format($datePonA, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="ponEspecificos_N">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadPon_N">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE NALLELY QUINTANA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_Pon">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_Pon">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_Pon">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_Pon">
                            VENTA
                        </td>
                        <td class="tdInd_Pon">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_Pon">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_Pon">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_ponN = "SELECT contacto FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resCon_ponN = mysqli_query($conexion, $sqlCon_ponN);
                            list($datosCon_ponN) = mysqli_fetch_row($resCon_ponN);
                            echo $datosCon_ponN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_ponN = "SELECT entrevista FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resEnt_ponN = mysqli_query($conexion, $sqlEnt_ponN);
                            list($datosEnt_ponN) = mysqli_fetch_row($resEnt_ponN);
                            echo $datosEnt_ponN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_ponN = "SELECT evaluacion FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resEv_ponN = mysqli_query($conexion, $sqlEv_ponN);
                            list($datosEv_ponN) = mysqli_fetch_row($resEv_ponN);
                            echo "$datosEv_ponN";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_ponN = "SELECT venta FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resVen_ponN = mysqli_query($conexion, $sqlVen_ponN);
                            list($datosVen_ponN) = mysqli_fetch_row($resVen_ponN);
                            echo $datosVen_ponN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_ponN = "SELECT induccion FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resIn_ponN = mysqli_query($conexion, $sqlIn_ponN);
                            list($datosIn_ponN) = mysqli_fetch_row($resIn_ponN);
                            echo $datosIn_ponN;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_ponN = "SELECT conexion FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resCone_ponN = mysqli_query($conexion, $sqlCone_ponN);
                            list($datosCone_ponN) = mysqli_fetch_row($resCone_ponN);
                            echo $datosCone_ponN;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsPonN = $datosCon_ponN + $datosEnt_ponN + $datosEv_ponN + $datosVen_ponN + $datosIn_ponN + $datosCone_ponN;
                            echo $ptsPonN;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_ponN = "SELECT fecha FROM ponderacion WHERE edat = 'Nallely Quintana'";
                            $resFec_ponN = mysqli_query($conexion, $sqlFec_ponN);
                            list($datosFec_ponN) = mysqli_fetch_row($resFec_ponN);
                            //Formateo para la fecha y hora que arroja
                            $datePonN = date_create($datosFec_ponN);
                            echo date_format($datePonN, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                    </tr>
                </table>
            </div>

            <div id="ponEspecificos_P">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadPon_P">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE PALOMA RAZO
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_Pon">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_Pon">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_Pon">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_Pon">
                            VENTA
                        </td>
                        <td class="tdInd_Pon">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_Pon">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_Pon">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_ponP = "SELECT contacto FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resCon_ponP = mysqli_query($conexion, $sqlCon_ponP);
                            list($datosCon_ponP) = mysqli_fetch_row($resCon_ponP);
                            echo $datosCon_ponP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_ponP = "SELECT entrevista FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resEnt_ponP = mysqli_query($conexion, $sqlEnt_ponP);
                            list($datosEnt_ponP) = mysqli_fetch_row($resEnt_ponP);
                            echo $datosEnt_ponP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_ponP = "SELECT evaluacion FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resEv_ponP = mysqli_query($conexion, $sqlEv_ponP);
                            list($datosEv_ponP) = mysqli_fetch_row($resEv_ponP);
                            echo "$datosEv_ponP";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_ponP = "SELECT venta FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resVen_ponP = mysqli_query($conexion, $sqlVen_ponP);
                            list($datosVen_ponP) = mysqli_fetch_row($resVen_ponP);
                            echo $datosVen_ponP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_ponP = "SELECT induccion FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resIn_ponP = mysqli_query($conexion, $sqlIn_ponP);
                            list($datosIn_ponP) = mysqli_fetch_row($resIn_ponP);
                            echo $datosIn_ponP;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_ponP = "SELECT conexion FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resCone_ponP = mysqli_query($conexion, $sqlCone_ponP);
                            list($datosCone_ponP) = mysqli_fetch_row($resCone_ponP);
                            echo $datosCone_ponP;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsPonP = $datosCon_ponP + $datosEnt_ponP + $datosEv_ponP + $datosVen_ponP + $datosIn_ponP + $datosCone_ponP;
                            echo $ptsPonP;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_ponP = "SELECT fecha FROM ponderacion WHERE edat = 'Paloma Razo'";
                            $resFec_ponP = mysqli_query($conexion, $sqlFec_ponP);
                            list($datosFec_ponP) = mysqli_fetch_row($resFec_ponP);
                            //Formateo para la fecha y hora que arroja
                            $datePonP = date_create($datosFec_ponP);
                            echo date_format($datePonP, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="ponEspecificos_Y">
                <table class="table table-condensed table-bordered text-center" id="tabladinamicaloadPon_Y">
                    <tr>
                        <td colspan=8 class="tdEncab_gen">
                            DATOS GENERALES DE YAZMIN ALBARRÁN
                        </td>
                    </tr>
                    <tr>
                        <td class="tdCont_Pon">
                            CONTACTOS
                        </td>
                        <td class="tdEnt_Pon">
                            ENTREVISTAS
                        </td>
                        <td class="tdEva_Pon">
                            EVALUACIÓN
                        </td>
                        <td class="tdVen_Pon">
                            VENTA
                        </td>
                        <td class="tdInd_Pon">
                            INDUCCIÓN
                        </td>
                        <td class="tdCone_Pon">
                            CONEXIÓN
                        </td>
                        <td class="tdTot_obj">
                            PTS. TOTALES
                        </td>
                        <td class="tdFec_Pon">
                            FECHA Y HORA
                        </td>
                    </tr>
                    <tr>
                        <td class="tdResult">
                            <?php
                            $sqlCon_ponY = "SELECT contacto FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resCon_ponY = mysqli_query($conexion, $sqlCon_ponY);
                            list($datosCon_ponY) = mysqli_fetch_row($resCon_ponY);
                            echo $datosCon_ponY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEnt_ponY = "SELECT entrevista FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resEnt_ponY = mysqli_query($conexion, $sqlEnt_ponY);
                            list($datosEnt_ponY) = mysqli_fetch_row($resEnt_ponY);
                            echo $datosEnt_ponY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlEv_ponY = "SELECT evaluacion FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resEv_ponY = mysqli_query($conexion, $sqlEv_ponY);
                            list($datosEv_ponY) = mysqli_fetch_row($resEv_ponY);
                            echo "$datosEv_ponY";
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlVen_ponY = "SELECT venta FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resVen_ponY = mysqli_query($conexion, $sqlVen_ponY);
                            list($datosVen_ponY) = mysqli_fetch_row($resVen_ponY);
                            echo $datosVen_ponY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlIn_ponY = "SELECT induccion FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resIn_ponY = mysqli_query($conexion, $sqlIn_ponY);
                            list($datosIn_ponY) = mysqli_fetch_row($resIn_ponY);
                            echo $datosIn_ponY;
                            ?>
                        </td>
                        <td class="tdResult">
                            <?php
                            $sqlCone_ponY = "SELECT conexion FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resCone_ponY = mysqli_query($conexion, $sqlCone_ponY);
                            list($datosCone_ponY) = mysqli_fetch_row($resCone_ponY);
                            echo $datosCone_ponY;
                            ?>
                        </td>
                        <td class="tdResultPts">
                            <?php
                            $ptsPonY = $datosCon_ponY + $datosEnt_ponY + $datosEv_ponY + $datosVen_ponY + $datosIn_ponY + $datosCone_ponY;
                            echo $ptsPonY;
                            ?>
                        </td>
                        <td class="tdResult_fec">
                            <?php
                            $sqlFec_ponY = "SELECT fecha FROM ponderacion WHERE edat = 'Yazmin Albarran'";
                            $resFec_ponY = mysqli_query($conexion, $sqlFec_ponY);
                            list($datosFec_ponY) = mysqli_fetch_row($resFec_ponY);
                            //Formateo para la fecha y hora que arroja
                            $datePonY = date_create($datosFec_ponY);
                            echo date_format($datePonY, "d-m-Y H:i:s");
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- MODAL PONDERACION/ESPECIFICO -->
            <div class="modal fade" id="ponEsp" tabindex="-1" role="dialog" aria-labelledby="ponEspLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ponEspLabel">Metas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="datosEspecificos_pon" method="POST" name="datosEspecificos_pon">
                                <div class="form-group form-control-sm">
                                    <label>EDAT:</label>
                                    <select type="text" class="form-control input-sm" id="edat_pon" name="edat_pon" onchange="showPon_esp()">
                                        <option value="Seleccionar" selected disabled hidden>Seleccione:</option>
                                        <option value="Alan Soto">Alan Soto</option>
                                        <option value="Nallely Quintana">Nallely Quintana</option>
                                        <option value="Paloma Razo">Paloma Razo</option>
                                        <option value="Yazmin Albarran">Yazmin Albarrán</option>
                                    </select>
                                </div>

                                <div id="espPon_a" style="display:none;">
                                    <div id="refrescarModalPonEsp_A">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosA_ponE" value="<?= $datosCon_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasA_ponE" value="<?= $datosEnt_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesA_ponE" value="<?= $datosEv_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasA_ponE" value="<?= $datosVen_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesA_ponE" value="<?= $datosIn_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesA_ponE" value="<?= $datosCone_ponA ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsPonEsp_a" value="<?= $ptsPonA ?>" disabled>
                                    </div>
                                </div>

                                <div id="espPon_n" style="display:none;">
                                    <div id="refrescarModalPonEsp_N">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosN_ponE" value="<?= $datosCon_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasN_ponE" value="<?= $datosEnt_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesN_ponE" value="<?= $datosEv_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasN_ponE" value="<?= $datosVen_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesN_ponE" value="<?= $datosIn_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesN_ponE" value="<?= $datosCone_ponN ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsPonEsp_n" value="<?= $ptsPonN ?>" disabled>
                                    </div>
                                </div>

                                <div id="espPon_p" style="display:none;">
                                    <div id="refrescarModalPonEsp_P">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosP_ponE" value="<?= $datosCon_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasP_ponE" value="<?= $datosEnt_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesP_ponE" value="<?= $datosEv_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasP_ponE" value="<?= $datosVen_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesP_ponE" value="<?= $datosIn_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesP_ponE" value="<?= $datosCone_ponP ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsPonEsp_p" value="<?= $ptsPonP ?>" disabled>
                                    </div>
                                </div>

                                <div id="espPon_y" style="display:none;">
                                    <div id="refrescarModalPonEsp_Y">
                                        <label class="col-form-label">Contactos:</label>
                                        <input type="text" class="form-control" name="contactosY_ponE" value="<?= $datosCon_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Entrevistas:</label>
                                        <input type="text" class="form-control" name="entrevistasY_ponE" value="<?= $datosEnt_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Evaluación:</label>
                                        <input type="text" class="form-control" name="evaluacionesY_ponE" value="<?= $datosEv_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Ventas:</label>
                                        <input type="text" class="form-control" name="ventasY_ponE" value="<?= $datosVen_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Inducciones:</label>
                                        <input type="text" class="form-control" name="induccionesY_ponE" value="<?= $datosIn_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Conexiones:</label>
                                        <input type="text" class="form-control" name="conexionesY_ponE" value="<?= $datosCone_ponY ?>" onKeyPress="return soloNumeros(event)" onKeyUp="pierdeFoco(this)" oninput="ptsPesp()">
                                        <label class="col-form-label">Puntos totales:</label>
                                        <input type="text" class="form-control" name="ptsPonEsp_y" value="<?= $ptsPonY ?>" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="modificarPon_esp" disabled>Modificar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>