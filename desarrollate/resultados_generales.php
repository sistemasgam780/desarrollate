<?php
error_reporting(E_ALL);
session_start();
include 'php/conexion.php';
$conexion = conexion();
$nombre = $_SESSION['user'];
$fec1 = $_POST['fecha1G'];
$fec2 = $_POST['fecha2G'];



echo "Resultados de la búsqueda entre las fechas <b>" . $fec1 . "</b> / <b>" . $fec2 . "</b> de <b>TODOS SUS AGENTES</b><br>";







// ESTA CONSULTA ES PARA DEFINIR EL TAMAÑO DE LA GRAFICA DEPENTIENDO LOS VALORES
$sql = "SELECT  DISTINCT(COUNT(nombreAgente)) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
$resultT = mysqli_query($conexion, $sql);
while ($conexiones = mysqli_fetch_array($resultT)) {

    $Suma_total = $conexiones[0];

//   echo $Suma_total;
    if ( $Suma_total > 4){
        $wGrafica = 1800;
    }else{
        $wGrafica = 500;
    }
}
///////////// La variable wGrafica se imprime en el valor del tamaño de la grafica, container2 srollbar minWith




// Query para saber el total de conexiones
$sql = "SELECT COUNT(DISTINCT(X.nombre)) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2'";
$resultT = mysqli_query($conexion, $sql);
while ($conexiones = mysqli_fetch_array($resultT)) {
    $prospecto2 = $conexiones[0];

?>
<head>
<link rel="stylesheet" href="style/gconectados.css">
</head>
<a rel="tooltip" 
      data-toggle="tooltip" 
      data-trigger="hover" 
      data-placement="bottom" 
      data-html="true" 
      data-title="
                  <div style='max-width:300px;position:relative;overflow:auto;'>
                  <div style='width:300px;background:#F2F2F2;line-height:30px;float:left;-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;text-align:left;padding-left:15px;'><strong>DETALLE DEL VUELO</strong></div>
                  <div style='width:150px;float:left; height:30px;line-height:30px;text-align:left;padding-left:15px;'>Primer tramo - Vuelo 8511							    </div>
                  <div style='width:150px;float:left; height:30px;text-align:left;padding-left:15px;'><img src='http://www.tiquetesbaratos.com/components/com_sabre/images/aerolineas/AV.png'>						</div>
                  <div style='width:150px;float:left; height:30px;text-align:left;padding-left:15px;line-height:30px;'>Sale de Bogota(BOG)</div>
                  <div style='width:150px;float:left; height:30px;text-align:left;padding-left:15px;line-height:14px;font-size:10px;'>Viernes, 20 Nov 2015						 <br>08:55:00						</div>
                  <div style='width:150px;float:left; height:30px;text-align:left;padding-left:15px;line-height:30px;'>Llega a Pereira(PEI)</div>
                  <div style='width:150px;float:left; height:30px;text-align:left;padding-left:15px;line-height:14px;font-size:10px;'>Viernes, 22 Nov 2015 <br>09:55:00						</div>
                  <div style='width:300px;background:#F2F2F2;line-height:30px;float:left;'>Duración total del vuelo: 1 Hora</div>
							                  </div>
			
">
Detalle
</a>
    <div class="container">
        <table class="table table-hove table-condensed table-bordered text-center" id="tituloGamAc">
            <tr>
                <td>
                    <p class=MsoNormal align=center style='text-align:center'>COACHING DE NEGOCIOS</p>
                </td>
            </tr>
        </table>


        <table class="table table-hove table-condensed table-bordered text-center" id="datosTable">
            <tr>
                <td class="tdDatos">
                    <p>INDUCCIÓN</p>
                </td>
                <td class="tdDatos">
                    <p>ACTIVOS</p>
                </td>
                <td class="tdDatos">
                    <p>INACTIVOS</p>
                </td>
                <td class="tdDatos">
                    <p>CONEXIÓN</p>
                </td>
            </tr>
            <tr>
                <!-- INDUCCION -->
                <td>
                    <?php
                    $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='$nombre' AND fec4 BETWEEN '$fec1' AND '$fec2' AND arranque='Si'";
                    $res = mysqli_query($conexion, $sql);
                    while ($ver = mysqli_fetch_row($res)) {
                        $datos5f = $ver[0];

                        echo $datos5f;
                    }
                    ?>
                </td>

                <!-- ACTIVOS -->
                <td>
                    <?php
                    $sql = "SELECT COUNT(DISTINCT(X.nombre)) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND total_resultados > 0 ORDER BY fecha;";
                    $resultT = mysqli_query($conexion, $sql);
                    while ($conexiones = mysqli_fetch_array($resultT)) {
                        $prospecto = $conexiones[0];
     
                        echo $prospecto;

                    ?>
                </td>

                <!-- INACTIVOS  -->
                <td>
                    <?php
                        $resta = $prospecto - $prospecto2;
                        echo abs($resta);
                    ?>

                </td>

                <!-- CONEXION -->
                <td>
            <?php
                        echo $prospecto2;
                    }
                }
            ?>
                </td>
            </tr>
        </table>

        <!-- TABLA/NOMBRE DE LOS AGENTES ACTIVOS E INACTIVOS -->
        <table class="table table-hove table-condensed table-bordered text-center" id="nombreAg">
            <tr>
                <td>
                    <p>AGENTES ACTIVOS</p>
                </td>
                <td>
                    <p>AGENTES INACTIVOS</p>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $sql = "SELECT DISTINCT(X.nombre) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND Y.total_resultados > 0 ORDER BY fecha";
                    $resultT = mysqli_query($conexion, $sql);
                    while ($conexiones = mysqli_fetch_array($resultT)) {
                        $prospecto = $conexiones[0];
                      
                        echo $prospecto . '<br>';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $sql = "SELECT DISTINCT(X.nombre) FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente AND X.edat='$nombre' AND Y.fecha BETWEEN '$fec1' AND '$fec2' AND Y.total_resultados <= 0 ORDER BY fecha";
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


    <figure class="table table-hove table-condensed table-bordered text-center">
        <div id="container2"></div>
    </figure>



    <figure class="table table-hove table-condensed table-bordered text-center">
        <div id="container3"></div>
    </figure>

    <!-- GRAFICA CONEXION CON GAMACADEMY -->
    <script type="text/javascript">





        Highcharts.chart('container2', {
            chart: {
                type: 'column',
                scrollablePlotArea: {

                    minWidth: <?php echo $wGrafica; ?>,
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
                                $sql = "SELECT X.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente";
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
                    $sql = "SELECT SUM(y.resultado_prospecto), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
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
                        $sql = "SELECT SUM(y.resultado_cita), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
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
                        $sql = "SELECT SUM(y.resultado_entrevista), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
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
                        $sql = "SELECT SUM(y.resultado_solicitud), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
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

                        $sql = "SELECT SUM(y.resultado_pago), x.nombre FROM gamse627_edats.llenado_formulario X INNER JOIN gamse627_gamacademy1.resultados Y ON X.nombre = Y.nombreAgente WHERE X.edat = '$nombre' AND total_resultados > 0 AND X.conexion IS NOT NULL AND Y.fecha BETWEEN '$fec1' AND '$fec2' GROUP BY Y.nombreAgente;";
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






        Highcharts.chart('container3', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'TOTAL POR CATEGORIA'
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
                name: 'Total de Puntos',
                colorByPoint: true,
                data: [{
                    name: 'Prospectos',
                    y: <?php


                        $sql = "SELECT  nombre, SUM(resultado_prospecto) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
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


                        $sql = "SELECT  nombre, SUM(resultado_cita) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
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


                        $sql = "SELECT  nombre, SUM(resultado_entrevista) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
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


                        $sql = "SELECT  nombre, SUM(resultado_solicitud) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
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


                        $sql = "SELECT  nombre, SUM(resultado_pago) FROM gamse627_edats.llenado_formulario JOIN gamse627_gamacademy1.resultados ON gamse627_edats.llenado_formulario.nombre = gamse627_gamacademy1.resultados.nombreAgente WHERE edat='$nombre' AND conexion LIKE '%i%' AND total_resultados > '0' AND fecha BETWEEN '$fec1' AND '$fec2'";
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