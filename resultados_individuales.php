<?php
error_reporting(E_ALL);
session_start();
include 'php/conexion.php';
$conexion = conexion();
$seleccionAgente = $_POST['seleccion2'];
$fec1Ind = $_POST['fecha1Ind'];
$fec2Ind = $_POST['fecha2Ind'];
$nombre = $_SESSION['user'];

echo "Resultados de la búsqueda entre las fechas <b>" . $fec1Ind . "</b> / <b>" . $fec2Ind . "</b> de <b>$seleccionAgente</b>.<br>";

?>

<div class="container">
    <div class="divIndividual">
        <figure class="table table-hove table-condensed table-bordered text-center">
            <div id="containerInd"></div>
        </figure>

        <!-- GRAFICA CONEXION CON GAMACADEMY -->
        <script type="text/javascript">
            Highcharts.chart('containerInd', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'RESULTADOS COACHING DE NEGOCIOS'
                },
                subtitle: {
                    text: 'Source: GAM Academy'
                },
                xAxis: {
                    categories: [<?php
                                    $sql = "SELECT X.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente";
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
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
                        $sql = "SELECT SUM(y.resultado_prospecto), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente;";
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
                            $sql = "SELECT SUM(y.resultado_cita), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente;";
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
                            $sql = "SELECT SUM(y.resultado_entrevista), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente;";
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
                            $sql = "SELECT SUM(y.resultado_solicitud), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente;";
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

                            $sql = "SELECT SUM(y.resultado_pago), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_adn25pts.resultados Y ON X.nombre = Y.nombreAgente WHERE Y.nombreAgente = '$seleccionAgente' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1Ind' AND '$fec2Ind' GROUP BY Y.nombreAgente;";
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
        </script>
    </div>

</div>