<?php
  
?>




<script type="text/javascript">
  //****************** GRAFICA 1ER TRIMESTRE PALOMA RAZO *************//
  Highcharts.chart('1t', {
  title: {
    text: 'Resultados del 1er Trimestre de Paloma Razo'
  },
  xAxis: {
    categories: ['Enero', 'Febrero', 'Marzo']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                 <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,     
                                            <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});

// TERMINA CODIGO DE LA GRAFICA NUMERO 1 "PRIMER TRIMESTRE"






/////////////////////////GRAFICA 2DO TRIMESTRE PALOMA RAZO


  Highcharts.chart('2t', {
  title: {
    text: 'Resultados del 2do Trimestre de Paloma Razo'
  },
  xAxis: {
    categories: ['Abril', 'Mayo', 'Junio']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});
















/////////////////////////////////// GRAFICA 3TR PALOMA RAZO
Highcharts.chart('3t', {
  title: {
    text: 'Resultados del 3er Trimestre de Paloma Razo'
  },
  xAxis: {
    categories: ['Julio', 'Agosto', 'Septiembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});


















////////////////////////// GRAFICA DE 4TO TRIMESTRE
Highcharts.chart('4t', {
  title: {
    text: 'Resultados del 4to Trimestre de Paloma Razo'
  },
  xAxis: {
    categories: ['Octubre', 'Noviembre', 'Diciembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});










///////////////////// GRAFICO DE ANUAL


Highcharts.chart('anualPaloma', {
  title: {
    text: 'Resultado anual de Paloma Razo'
  },
  xAxis: {
    categories: ['Contactos',
     'Entrevista',
      'Evaluación',
      'Venta de Carrera',
      'Inducción',
      'Conexión'
      ]
  },
  labels: {
    items: [{
      html: 'Resultados por año',
      style: {
        left: '50px',
        top: '10px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Resultados',
   data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>,             <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>]
  }, {
    type: 'column',
    name: 'Meta',
    data: [            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>,            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>,            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>,            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>,            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>,            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>]
  }]
});










/*
///////////////////////////////////////////////////////////////////////
TEERMINAN LAS GRAFICAS DE PALOMA RAZO 
////////////////////////////////////////////////////////////////////////// 
GRAFICAS DE Nallely Quintana*/



Highcharts.chart('1n', {
  title: {
    text: 'Resultados del 1er Trimestre de Nallely Quintana'
  },
  xAxis: {
    categories: ['Enero', 'Febrero', 'Marzo']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                 <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,     
                                            <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});

// TERMINA CODIGO DE LA GRAFICA NUMERO 1 "PRIMER TRIMESTRE"






/////////////////////////GRAFICA 2DO TRIMESTRE Nallely Quintana


  Highcharts.chart('2n', {
  title: {
    text: 'Resultados del 2do Trimestre de Nallely Quintana'
  },
  xAxis: {
    categories: ['Abril', 'Mayo', 'Junio']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});
















/////////////////////////////////// GRAFICA 3TR Nallely Quintana
Highcharts.chart('3n', {
  title: {
    text: 'Resultados del 3er Trimestre de Nallely Quintana'
  },
  xAxis: {
    categories: ['Julio', 'Agosto', 'Septiembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});


















////////////////////////// GRAFICA DE 4TO TRIMESTRE
Highcharts.chart('4n', {
  title: {
    text: 'Resultados del 4to Trimestre de Nallely Quintana'
  },
  xAxis: {
    categories: ['Octubre', 'Noviembre', 'Diciembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});










///////////////////// GRAFICO DE ANUAL


Highcharts.chart('anualNallely', {
  title: {
    text: 'Resultado anual de Nallely Quintana'
  },
  xAxis: {
    categories: ['Contactos',
     'Entrevista',
      'Evaluación',
      'Venta de Carrera',
      'Inducción',
      'Conexión'
      ]
  },
  labels: {
    items: [{
      html: 'Resultados por año',
      style: {
        left: '50px',
        top: '10px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Resultados',
   data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>,             <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>]
  }, {
    type: 'column',
    name: 'Meta',
    data: [            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>,            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>,            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>,            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>,            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>,            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>]
  }]
});






/*///////////////////////////////////////////////////////7777
TERMINAN LAS GRAFICAS DE Nallely
///////////////////////*/


  Highcharts.chart('1a', {
  title: {
    text: 'Resultados del 1er Trimestre de Alan Soto'
  },
  xAxis: {
    categories: ['Enero', 'Febrero', 'Marzo']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                 <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,     
                                            <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});

// TERMINA CODIGO DE LA GRAFICA NUMERO 1 "PRIMER TRIMESTRE"






/////////////////////////GRAFICA 2DO TRIMESTRE Alan Soto


  Highcharts.chart('2a', {
  title: {
    text: 'Resultados del 2do Trimestre de Alan Soto'
  },
  xAxis: {
    categories: ['Abril', 'Mayo', 'Junio']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});
















/////////////////////////////////// GRAFICA 3TR Alan Soto
Highcharts.chart('3a', {
  title: {
    text: 'Resultados del 3er Trimestre de Alan Soto'
  },
  xAxis: {
    categories: ['Julio', 'Agosto', 'Septiembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});


















////////////////////////// GRAFICA DE 4TO TRIMESTRE
Highcharts.chart('4a', {
  title: {
    text: 'Resultados del 4to Trimestre de Alan Soto'
  },
  xAxis: {
    categories: ['Octubre', 'Noviembre', 'Diciembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});










///////////////////// GRAFICO DE ANUAL


Highcharts.chart('anualAlan', {
  title: {
    text: 'Resultado anual de Alan Soto'
  },
  xAxis: {
    categories: ['Contactos',
     'Entrevista',
      'Evaluación',
      'Venta de Carrera',
      'Inducción',
      'Conexión'
      ]
  },
  labels: {
    items: [{
      html: 'Resultados por año',
      style: {
        left: '50px',
        top: '10px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Resultados',
   data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>,             <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>]
  }, {
    type: 'column',
    name: 'Meta',
    data: [            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>,            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>,            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>,            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>,            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>,            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>]
  }]
});

















/* ////////////////////////////////////////////////77
TERMINAN LAS GRAFICAS DE ALAN
//////////////////////////////////////////// 
*/



  Highcharts.chart('1y', {
  title: {
    text: 'Resultados del 1er Trimestre de Yazmin Albarran'
  },
  xAxis: {
    categories: ['Enero', 'Febrero', 'Marzo']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                 <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,     
                                            <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});

// TERMINA CODIGO DE LA GRAFICA NUMERO 1 "PRIMER TRIMESTRE"






/////////////////////////GRAFICA 2DO TRIMESTRE Yazmin Albarran


  Highcharts.chart('2y', {
  title: {
    text: 'Resultados del 2do Trimestre de Yazmin Albarran'
  },
  xAxis: {
    categories: ['Abril', 'Mayo', 'Junio']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});
















/////////////////////////////////// GRAFICA 3TR Yazmin Albarran
Highcharts.chart('3y', {
  title: {
    text: 'Resultados del 3er Trimestre de Yazmin Albarran'
  },
  xAxis: {
    categories: ['Julio', 'Agosto', 'Septiembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});


















////////////////////////// GRAFICA DE 4TO TRIMESTRE
Highcharts.chart('4y', {
  title: {
    text: 'Resultados del 4to Trimestre de Yazmin Albarran'
  },
  xAxis: {
    categories: ['Octubre', 'Noviembre', 'Diciembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});










///////////////////// GRAFICO DE ANUAL


Highcharts.chart('anualYazmin', {
  title: {
    text: 'Resultado anual de Yazmin Albarran'
  },
  xAxis: {
    categories: ['Contactos',
     'Entrevista',
      'Evaluación',
      'Venta de Carrera',
      'Inducción',
      'Conexión'
      ]
  },
  labels: {
    items: [{
      html: 'Resultados por año',
      style: {
        left: '50px',
        top: '10px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Resultados',
   data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>,             <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>]
  }, {
    type: 'column',
    name: 'Meta',
    data: [            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>,            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>,            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>,            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>,            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>,            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>]
  }]
});


/*
////////////////////////////////////////////////////////777
Terminan las graficas de Yazmin 
/////////////////////////
*/








  Highcharts.chart('1todos', {
  title: {
    text: 'Resultados del 1er Trimestre de EDATs'
  },
  xAxis: {
    categories: ['Enero', 'Febrero', 'Marzo']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                 <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [<?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [<?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,     
                                            <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});




/*///////////////////////////////////
Segundo trimestre de todos
//////////////////////////////

*/
 Highcharts.chart('2todos', {
  title: {
    text: 'Resultados del 2do Trimestre de EDATs'
  },
  xAxis: {
    categories: ['Abril', 'Mayo', 'Junio']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
    data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});







Highcharts.chart('3todos', {
  title: {
    text: 'Resultados del 3er Trimestre de EDATs'
  },
  xAxis: {
    categories: ['Julio', 'Agosto', 'Septiembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});


















////////////////////////// GRAFICA DE 4TO TRIMESTRE
Highcharts.chart('4todos', {
  title: {
    text: 'Resultados del 4to Trimestre de EDATs'
  },
  xAxis: {
    categories: ['Octubre', 'Noviembre', 'Diciembre']
  },
  labels: {
    items: [{
      html: 'Resultados por mes',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Contactos',
   data: [                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>]
  }, {
    type: 'column',
    name: 'Entrevista',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>,                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>]
  }, {
    type: 'column',
    name: 'Evaluación',
    data: [                   <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>,                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>,                         <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>]
  },{
    type: 'column',
    name: 'Venta de Carrera',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>]
  },{
    type: 'column',
    name: 'Inducción',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>]
  },{
    type: 'column',
    name: 'Conexión',
    data: [                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>,                          <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>,                         <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>]
  }]
});










///////////////////// GRAFICO DE ANUAL


Highcharts.chart('anualTodos', {
  title: {
    text: 'Resultado anual de EDATs'
  },
  xAxis: {
    categories: ['Contactos',
     'Entrevista',
      'Evaluación',
      'Venta de Carrera',
      'Inducción',
      'Conexión'
      ]
  },
  labels: {
    items: [{
      html: 'Resultados por año',
      style: {
        left: '50px',
        top: '10px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'Green'
      }
    }]
  },
  series: [{
    type: 'column',
    name: 'Resultados',
   data: [            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>,             <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>,            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE  fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>]
  }, {
    type: 'column',
    name: 'Meta',
    data: [            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>,            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>,            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>,            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>,            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>,            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>]
  }]
});



</script>



