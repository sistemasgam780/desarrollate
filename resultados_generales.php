<?php
error_reporting(E_ALL);
session_start();
include 'php/conexion.php';
$conexion = conexion();
$nombre = $_SESSION['user'];
$fec1 = $_POST['fecha1G'];
$fec2 = $_POST['fecha2G'];

echo "Resultados de la búsqueda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> de <b>todos tus agentes.</b><br>";

// Query para saber el total de conexiones
$sql = "SELECT COUNT(DISTINCT(X.nombre)) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2'";
$resultT = mysqli_query($conexion, $sql);
while ($conexiones = mysqli_fetch_array($resultT)) {
    $prospecto2 = $conexiones[0];

?>

    <div class="container">
        <div class="row">
            <!-- Tabla con resultados Desarrolla-t/Coaching -->
            <table class="table table-condensed table-bordered text-center" id="tablaResult">
                <tr>
                    <td colspan=2 class="espacioTd"></td>
                    <td colspan=2 class="tdCoaching">
                        <p>COACHING DE NEGOCIOS</p>
                    </td>
                </tr>
                <tr>
                    <td class="tdTitulos">
                        <p>CONEXIÓN</p>
                    </td>
                    <td class="tdTitulos">
                        <p>INDUCCIÓN</p>
                    </td>
                    <td class="tdTitulos">
                        <p>AGENTES ACT.</p>
                    </td>
                    <td class="tdTitulos">
                        <p>AGENTES INACT.</p>
                    </td>
                </tr>
                <tr class="resultados">
                    <!-- CONEXION -->
                    <td style="border-radius: 5px;">
                        <?php

                        echo $prospecto2;

                        ?>
                    </td>

                    <!-- INDUCCION -->
                    <td style="border-radius: 5px;">
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$nombre' AND fec4 BETWEEN '$fec1' AND '$fec2' AND arranque='Si'";
                        $res = mysqli_query($conexion, $sql);
                        while ($ver = mysqli_fetch_row($res)) {
                            $datos5f = $ver[0];

                            echo $datos5f;
                        }
                        ?>
                    </td>

                    <!-- ACTIVOS  -->
                    <td style="border-radius: 5px;">
                        <?php
                        $sql = "SELECT COUNT(DISTINCT(X.nombre)) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND total_resultados > 0 ORDER BY fecha;";
                        $resultT = mysqli_query($conexion, $sql);
                        while ($conexiones = mysqli_fetch_array($resultT)) {
                            $prospecto = $conexiones[0];

                            echo $prospecto;

                        ?>

                    </td>

                    <!-- INACTIVOS -->
                    <td style="border-radius: 5px;">
                <?php
                            $resta = $prospecto - $prospecto2;
                            echo abs($resta);
                        }
                    }
                ?>
                    </td>
                </tr>
            </table>

            <!-- Tabla con los nombres de agentes activos e inactivos -->
            <table class="table table-hove table-condensed table-bordered text-center" id="act_in">
                <tr>
                    <td class="agenAct">
                        <p>AGENTES ACTIVOS</p>
                    </td>
                    <td class="agenInact">
                        <p>AGENTES INACTIVOS</p>
                    </td>
                </tr>
                <tr>
                    <td class="tdActivos">
                        <?php
                        $sql = "SELECT DISTINCT(X.nombre) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND Y.total_resultados > 0 ORDER BY X.nombre";
                        $resultT = mysqli_query($conexion, $sql);
                        while ($conexiones = mysqli_fetch_array($resultT)) {
                            $prospecto = $conexiones[0];
                            echo $prospecto . '<br>';
                        }
                        ?>
                    </td>

                    <td class="tdInactivos">
                        <?php
                        $sql = "SELECT DISTINCT(X.nombre) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND Y.total_resultados <= 0 ORDER BY X.nombre";
                        $resultT = mysqli_query($conexion, $sql);
                        while ($conexiones = mysqli_fetch_array($resultT)) {
                            $prospecto = $conexiones[0];

                            echo $prospecto . '<br>';
                        }
                        ?>
                    </td>
                </tr>
            </table>

        </div>
    </div>


    <div class="container">
        <figure class="table table-hove table-condensed table-bordered text-center">
            <div id="container2"></div>
        </figure>

        <figure class="table table-hove table-condensed table-bordered text-center">
            <div id="container3"></div>
        </figure>


        <script type="text/javascript">
            // GRAFICA DE BARRA
            Highcharts.chart('container2', {
                chart: {
                    type: 'column',
                    scrollablePlotArea: {
                        minWidth: 1700,
                        scrollPositionX: 0
                    }
                },
                title: {
                    text: 'RESULTADOS COACHING DE NEGOCIOS'
                },
                subtitle: {
                    text: 'Source: GAM Academy'
                },
                xAxis: {
                    categories: [<?php
                                    $sql = "SELECT X.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente";
                                    $resultT = mysqli_query($conexion, $sql);
                                    while ($conexiones = mysqli_fetch_array($resultT)) {
                                        $prospecto = $conexiones[0];
                                    ?> ' <?php
                                            echo $prospecto;

                                            ?>',

                        <?php
                                    }

                        ?>
                    ],

                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '',
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px; text-transform: uppercase;">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} </b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Prospectos',
                    data: [
                        <?php
                        $sql = "SELECT SUM(y.resultado_prospecto), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
                        $resultT = mysqli_query($conexion, $sql);
                        while ($conexiones = mysqli_fetch_array($resultT)) {
                            $prospecto = $conexiones[0];
                        ?>

                            [<?php echo $prospecto; ?>],
                        <?php

                        }

                        ?>
                    ]

                }, {
                    name: 'Cit. de 1° ',
                    data: [<?php
                            $sql = "SELECT SUM(y.resultado_cita), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {
                                $prospecto = $conexiones[0];
                            ?>

                            [<?php echo $prospecto; ?>],
                        <?php

                            }
                        ?>
                    ]

                }, {
                    name: 'Cit. de 2°',
                    data: [<?php
                            $sql = "SELECT SUM(y.resultado_entrevista), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {
                                $prospecto = $conexiones[0];

                            ?>

                            [<?php echo $prospecto; ?>],
                        <?php

                            }
                        ?>
                    ]

                }, {
                    name: 'Solicitudes',
                    data: [<?php
                            $sql = "SELECT SUM(y.resultado_solicitud), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {
                                $prospecto = $conexiones[0];
                            ?>

                            [<?php echo $prospecto; ?>],
                        <?php

                            }
                        ?>
                    ]

                }, {
                    name: 'Pagos',
                    data: [<?php

                            $sql = "SELECT SUM(y.resultado_pago), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {
                                $prospecto = $conexiones[0];
                            ?>

                            [<?php echo $prospecto; ?>],
                        <?php

                            }
                        ?>
                    ]

                }]
            });

            // GRAFICA DE PASTEL
            Highcharts.chart('container3', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'PUNTUAJE POR CATEGORIA'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Puntuaje total',
                    colorByPoint: true,
                    data: [{
                        name: 'Prospectos',
                        y: <?php


                            $sql = "SELECT  nombre, SUM(resultado_prospecto) FROM gamse627_edats.llenado_formulario JOIN gamse627_adn25pts.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_adn25pts.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {

                                $Suma_total = $conexiones['SUM(resultado_prospecto)'];

                                echo $Suma_total;
                                // echo $edat;

                            }

                            ?>,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Citas de 1°',
                        y: <?php
                            $sql = "SELECT  nombre, SUM(resultado_cita) FROM gamse627_edats.llenado_formulario JOIN gamse627_adn25pts.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_adn25pts.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {

                                $Suma_total = $conexiones['SUM(resultado_cita)'];

                                echo $Suma_total;
                                // echo $edat;

                            }

                            ?>
                    }, {
                        name: 'Citas de 2°',
                        y: <?php
                            $sql = "SELECT  nombre, SUM(resultado_entrevista) FROM gamse627_edats.llenado_formulario JOIN gamse627_adn25pts.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_adn25pts.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {

                                $Suma_total = $conexiones['SUM(resultado_entrevista)'];

                                echo $Suma_total;
                                // echo $edat;

                            }

                            ?>
                    }, {
                        name: 'Solicitudes',
                        y: <?php
                            $sql = "SELECT  nombre, SUM(resultado_solicitud) FROM gamse627_edats.llenado_formulario JOIN gamse627_adn25pts.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_adn25pts.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {

                                $Suma_total = $conexiones['SUM(resultado_solicitud)'];

                                echo $Suma_total;
                                // echo $edat;

                            }

                            ?>
                    }, {
                        name: 'Pagos',
                        y: <?php
                            $sql = "SELECT  nombre, SUM(resultado_pago) FROM gamse627_edats.llenado_formulario JOIN gamse627_adn25pts.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_adn25pts.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
                            $resultT = mysqli_query($conexion, $sql);
                            while ($conexiones = mysqli_fetch_array($resultT)) {

                                $Suma_total = $conexiones['SUM(resultado_pago)'];

                                echo $Suma_total;
                                // echo $edat;

                            }

                            ?>
                    }]
                }]
            });
        </script>

    </div>