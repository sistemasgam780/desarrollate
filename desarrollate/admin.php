<?php
 date_default_timezone_set('America/Mexico_City');
     $fecha=date("H:i");
 setcookie("tiempo", $fecha);

    error_reporting(0);
    
    require_once "php/conexion.php";
    $conexion = conexion();
    session_start();
    $edat = $_SESSION['user'];
    
    if($conexion->connect_error){
        die('Error de conexion: '.$conexion->connect_error);
    }
    
    date_default_timezone_set("America/Mexico_City");
    $time = time();
    $fechaactual = date("Y-m-d",$time);
    
    $fechareal = date("Y-m-d",strtotime($fechaactual."- 1 days"));
    
    
    
    
      if(!isset($_SESSION['tiempo'])){
      $_SESSION['tiempo'] = time();
  }
  else if(time() - $_SESSION['tiempo'] > 300){
  date_default_timezone_set('America/Mexico_City');
    $hoy = date("Y-m-d");
    $nomusuario = $_SESSION['user'];
    $fecha1 = $_COOKIE["tiempo"];
      $fecha2=date("H:i");
      $tiempo = abs(strtotime($fecha2) - strtotime($fecha1));
      $tiempoTotal = ( $tiempo / 60 ." Minutos");
  
  
       $ti = "insert into tiemposesion(Consultor, HoraInicio, HoraFin, tiempoTotal, fecha)
              values ('$nomusuario','$fecha1','$fecha2', '$tiempoTotal', '$hoy')";
                $inserT = mysqli_query($conexion,$ti);
      session_destroy();
      session_unset();
      header('location: index.php');
      die();
  }
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--ESTILOS PARA LOS GRAFICOS-->
              <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <link rel="stylesheet" type="text/css" href="graficos.css">
      
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
      <link rel="stylesheet" href="stylesheet.css">
      
</head> <!-- LIBRERIAS-->
<body>
  <!--Barra de navegacion -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li><a><span class="label label-primary">Bienvenido:  <?php echo $_SESSION['user'];?></span></a></li>
          <input hidden id="edat" value="<?php echo $edat ?>">
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#modalcrearuser">Crear Usuario</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modalMetas">Definir Metas</a></li>
            <li><a href="conexiones.php">Conexiones</a></li>
          <li><a href="php/logout.php">Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <div class="container">
    <label>Selecciona el usuario a consultar: </label>
    <select type="text" name="select" id="select" onChange="mostrarCombo();" class="form-control input-sm" style="width:250px">
        <option value="Seleccionar">Seleccionar:</option>
        <option value="Paloma">Paloma Razo</option>
        <option value="Nallely">Nallely Quintana</option>
        <option value="Alan">Alan Soto</option>
        <option value="Yazmin">Yazmin Albarran</option>
        <option value="Todos">Todos</option>
    </select>
  </div>
  
  <br>
  <script>
    function mostrarCombo(){
        var opcion = document.getElementById("select").value;
        if(opcion=="Paloma"){
            document.getElementById('Paloma').style.display = 'block';
            document.getElementById('Nallely').style.display = 'none';
            document.getElementById('Alan').style.display = 'none';
            document.getElementById('Yazmin').style.display = 'none';
            document.getElementById('Todos').style.display = 'none';        
        }else if(opcion=="Nallely"){
            document.getElementById('Paloma').style.display = 'none';
            document.getElementById('Nallely').style.display = 'block';
            document.getElementById('Alan').style.display = 'none';
            document.getElementById('Yazmin').style.display = 'none';
            document.getElementById('Todos').style.display = 'none';
        }else if(opcion=="Alan"){
            document.getElementById('Paloma').style.display = 'none';
            document.getElementById('Nallely').style.display = 'none';
            document.getElementById('Alan').style.display = 'block';
            document.getElementById('Yazmin').style.display = 'none';
            document.getElementById('Todos').style.display = 'none';
        }else if(opcion=="Yazmin"){
            document.getElementById('Paloma').style.display = 'none';
            document.getElementById('Nallely').style.display = 'none';
            document.getElementById('Alan').style.display = 'none';
            document.getElementById('Yazmin').style.display = 'block';
            document.getElementById('Todos').style.display = 'none';
        }else if(opcion=="Todos"){
            document.getElementById('Paloma').style.display = 'none';
            document.getElementById('Nallely').style.display = 'none';
            document.getElementById('Alan').style.display = 'none';
            document.getElementById('Yazmin').style.display = 'none';
            document.getElementById('Todos').style.display = 'block';
        }else{
            document.getElementById('Paloma').style.display = 'none';
            document.getElementById('Nallely').style.display = 'none';
            document.getElementById('Alan').style.display = 'none';
            document.getElementById('Yazmin').style.display = 'none';
            document.getElementById('Todos').style.display = 'none';
        }
    }
  </script>
  
  <div class="container" id="Paloma" name="Paloma" style="display:none;">
      <label>Selecciona el trimestre a consultar:</label>
      <select type="text" name="select1" id="select1" onChange="mostrarCMes();" class="form-control input-sm" style="width:250px">
          <option value="Seleccionar">Seleccionar:</option>
          <option value="fdate">Por Fecha</option>
          <option value="trimestre1">Primer trimestre</option>
          <option value="trimestre2">Segundo trimestre</option>
          <option value="trimestre3">Tercer trimestre</option>
          <option value="trimestre4">Cuarto trimestre</option>
          <option value="anual1">Anual</option>
      </select>
      <br>
      <script>
        function mostrarCMes(){
            var opcion1 = document.getElementById("select1").value;
            if(opcion1=="fdate"){
                document.getElementById('fdate').style.display = 'block';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'none';

            }else if(opcion1=="trimestre1"){
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'block';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'none';
            }else if(opcion1=="trimestre2"){
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'block';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'none';
            }else if(opcion1=="trimestre3"){
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'block';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'none';
            }else if(opcion1=="trimestre4"){
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'block';
                document.getElementById('anual').style.display = 'none';
            }else if(opcion1=="anual1"){
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'block';
            }else{
                document.getElementById('fdate').style.display = 'none';
                document.getElementById('trimestre1').style.display = 'none';
                document.getElementById('trimestre2').style.display = 'none';
                document.getElementById('trimestre3').style.display = 'none';
                document.getElementById('trimestre4').style.display = 'none';
                document.getElementById('anual1').style.display = 'none';
            }
        }
      </script>

      <script>
        function enviar(){
          var date1 = document.getElementById('date1').value;
          var date2 = document.getElementById('date2').value;

          var dataen = 'date1=' + date1 + '&date2=' + date2;

          $.ajax({
            type:'POST',
            url:'send.php',
            data: dataen,
            success:function(resp){
              $('#respa').html(resp);
            }
          });
          return false;   
        }
      </script>
      <div class="container" id="fdate" name="fdate" style="display:none;">
        <form method="POST" onsubmit="return enviar();">
          <fieldset>
            <label>Desde:</label>
            <input type="date" id="date1" name="date1"/>
            <label>Hasta:</label>
            <input type="date" id="date2" name="date2"/>
            <button type="submit" value="Enviar">Buscar</button>
          </fieldset>
        </form>
            <br><br>
        <p id="respa"></p>
      </div>

      <div class="container" id="trimestre1" name="trimestre1" style="display:none;">
          <div  id="1t"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>1 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ENERO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>FEBRERO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>MARZO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre2" name="trimestre2" style="display:none;">
          <div  id="2t"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>2 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ABRIL</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>MAYO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>JUNIO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre3" name="trimestre3" style="display:none;">
          <div  id="3t"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>3 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>JULIO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>AGOSTO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>SEPTIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre4" name="trimestre4" style="display:none;">
          <div  id="4t"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>4 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>OCTUBRE</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>NOVIEMBRE</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>DICIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="anual1" name="anual1" style="display:none;">
          <div  id="anualPaloma"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center"><!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Paloma Razo' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>
          </small></td>
        </tr>
        <tr align="center"><!--PORCENTAJES-->
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos1;
              $n2 = $datosa1;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos2;
              $n2 = $datosa2;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos3;
              $n2 = $datosa3;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos4;
              $n2 = $datosa4;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos5;
              $n2 = $datosa5;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos6;
              $n2 = $datosa6;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
        </tr>
        <tr align="center"><!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
      </div>
  </div>
  
  <div class="container" id="Nallely" name="Nallely" style="display:none;">
    <label>Selecciona el mes a consultar:</label>
      <select type="text" name="select2" id="select2" onChange="mostrarNallely();" class="form-control input-sm" style="width:250px">
          <option value="Seleccionar">Seleccionar:</option>
          <option value="fdateo">Por Fecha</option>
          <option value="trimestre1o">Primer trimestre</option>
          <option value="trimestre2o">Segundo trimestre</option>
          <option value="trimestre3o">Tercer trimestre</option>
          <option value="trimestre4o">Cuarto trimestre</option>
          <option value="anual1o">Anual</option>
      </select>
      <br>
      <script>
        function mostrarNallely(){
            var opcion0 = document.getElementById("select2").value;
            if (opcion0=="fdateo") {
                document.getElementById('fdateo').style.display = 'block';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'none';
            }else if(opcion0=="trimestre1o"){
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'block';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'none';
            }else if(opcion0=="trimestre2o"){
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'block';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'none';
            }else if(opcion0=="trimestre3o"){
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'block';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'none';
            }else if(opcion0=="trimestre4o"){
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'block';
                document.getElementById('anualo').style.display = 'none';
            }else if(opcion0=="anual1o"){
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'block';
            }else{
                document.getElementById('fdateo').style.display = 'none';
                document.getElementById('trimestre1o').style.display = 'none';
                document.getElementById('trimestre2o').style.display = 'none';
                document.getElementById('trimestre3o').style.display = 'none';
                document.getElementById('trimestre4o').style.display = 'none';
                document.getElementById('anual1o').style.display = 'none';
            }
        }
      </script>
      <script>
        function enviarn(){
          var dateo1 = document.getElementById('dateo1').value;
          var dateo2 = document.getElementById('dateo2').value;

          var dataen = 'dateo1=' + dateo1 + '&dateo2=' + dateo2;

          $.ajax({
            type:'POST',
            url:'sendn.php',
            data: dataen,
            success:function(resp){
              $('#respao').html(resp);
            }
          });
          return false;   
        }
      </script>
      <div class="container" id="fdateo" name="fdateo" style="display:none;">
        <form method="POST" onsubmit="return enviarn();">
          <fieldset>
            <label>Desde:</label>
            <input type="date" id="dateo1" name="dateo1"/>
            <label>Hasta:</label>
            <input type="date" id="dateo2" name="dateo2"/>
            <button type="submit" value="Enviar">Buscar</button>
          </fieldset>
        </form>
            <br><br>
        <p id="respao"></p>
      </div>
      <div class="container" id="trimestre1o" name="trimestre1o" style="display:none;">
          <div  id="1n"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>1 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ENERO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>FEBRERO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>MARZO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre2o" name="trimestre2o" style="display:none;">
          <div  id="2n"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>2 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ABRIL</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>MAYO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>JUNIO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre3o" name="trimestre3o" style="display:none;">
          <div  id="3n"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>3 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>JULIO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>AGOSTO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>SEPTIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre4o" name="trimestre4o" style="display:none;">
          <div  id="4n"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>4 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>OCTUBRE</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>NOVIEMBRE</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>DICIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="anual1o" name="anual1o" style="display:none;">
          <div  id="anualNallely"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center"><!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Nallely Quintana' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>
          </small></td>
        </tr>
        <tr align="center"><!--PORCENTAJES-->
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos1;
              $n2 = $datosa1;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos2;
              $n2 = $datosa2;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos3;
              $n2 = $datosa3;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos4;
              $n2 = $datosa4;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos5;
              $n2 = $datosa5;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos6;
              $n2 = $datosa6;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
        </tr>
        <tr align="center"><!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
      </div>    
  </div>
  
  <div class="container" id="Alan" name="Alan" style="display:none;">
    <label>Selecciona el mes a consultar:</label>
      <select type="text" name="select3" id="select3" onChange="mostrarAlan();" class="form-control input-sm" style="width:250px">
          <option value="Seleccionar">Seleccionar:</option>
          <option value="fdatea">Por Fecha</option>
          <option value="trimestre1a">Primer trimestre</option>
          <option value="trimestre2a">Segundo trimestre</option>
          <option value="trimestre3a">Tercer trimestre</option>
          <option value="trimestre4a">Cuarto trimestre</option>
          <option value="anual1a">Anual</option>
      </select>
      <br>
      <script>
        function mostrarAlan(){
            var opcion0 = document.getElementById("select3").value;
            if (opcion0=="fdatea") {
              document.getElementById('fdatea').style.display = 'block';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'none';
            }else if(opcion0=="trimestre1a"){
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'block';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'none';
            }else if(opcion0=="trimestre2a"){
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'block';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'none';
            }else if(opcion0=="trimestre3a"){
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'block';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'none';
            }else if(opcion0=="trimestre4a"){
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'block';
                document.getElementById('anuala').style.display = 'none';
            }else if(opcion0=="anual1a"){
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'block';
            }else{
                document.getElementById('fdatea').style.display = 'none';
                document.getElementById('trimestre1a').style.display = 'none';
                document.getElementById('trimestre2a').style.display = 'none';
                document.getElementById('trimestre3a').style.display = 'none';
                document.getElementById('trimestre4a').style.display = 'none';
                document.getElementById('anual1a').style.display = 'none';
            }
        }
      </script>
      <script>
        function enviara(){
          var datea1 = document.getElementById('datea1').value;
          var datea2 = document.getElementById('datea2').value;

          var dataen = 'datea1=' + datea1 + '&datea2=' + datea2;

          $.ajax({
            type:'POST',
            url:'senda.php',
            data: dataen,
            success:function(resp){
              $('#respaa').html(resp);
            }
          });
          return false;   
        }
      </script>
      <div class="container" id="fdatea" name="fdatea" style="display:none;">
        <form method="POST" onsubmit="return enviara();">
          <fieldset>
            <label>Desde:</label>
            <input type="date" id="datea1" name="datea1"/>
            <label>Hasta:</label>
            <input type="date" id="datea2" name="datea2"/>
            <button type="submit" value="Enviar">Buscar</button>
          </fieldset>
        </form>
            <br><br>
        <p id="respaa"></p>
      </div>
      <div class="container" id="trimestre1a" name="trimestre1a" style="display:none;">
          <div  id="1a"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>1 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ENERO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>FEBRERO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>MARZO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;//***********************************************************************************************************************************************
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre2a" name="trimestre2a" style="display:none;">
          <div  id="2a"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>2 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ABRIL</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>MAYO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>JUNIO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre3a" name="trimestre3a" style="display:none;">
          <div  id="3a"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>3 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>JULIO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>AGOSTO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>SEPTIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre4a" name="trimestre4a" style="display:none;">
          <div  id="4a"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>4 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>OCTUBRE</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>NOVIEMBRE</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>DICIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="anual1a" name="anual1a" style="display:none;">
          <div  id="anualAlan"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center"><!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Alan Soto' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>
          </small></td>
        </tr>
        <tr align="center"><!--PORCENTAJES-->
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos1;
              $n2 = $datosa1;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos2;
              $n2 = $datosa2;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos3;
              $n2 = $datosa3;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos4;
              $n2 = $datosa4;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos5;
              $n2 = $datosa5;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos6;
              $n2 = $datosa6;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
        </tr>
        <tr align="center"><!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
      </div>    
  </div>
    
  <div class="container" id="Yazmin" name="Yazmin" style="display:none;">
    <label>Selecciona el mes a consultar:</label>
      <select type="text" name="selecty" id="selecty" onChange="mostrarYazmin();" class="form-control input-sm" style="width:250px">
          <option value="Seleccionar">Seleccionar:</option>
          <option value="fdatey">Por Fecha</option>
          <option value="trimestre1y">Primer trimestre</option>
          <option value="trimestre2y">Segundo trimestre</option>
          <option value="trimestre3y">Tercer trimestre</option>
          <option value="trimestre4y">Cuarto trimestre</option>
          <option value="anual1y">Anual</option>
      </select>
      <br>
      <script>
        function mostrarYazmin(){
            var opcion0 = document.getElementById("selecty").value;
            if (opcion0=="fdatey"){
              document.getElementById('fdatey').style.display = 'block';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'none';
            }else if(opcion0=="trimestre1y"){
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'block';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'none';
            }else if(opcion0=="trimestre2y"){
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'block';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'none';
            }else if(opcion0=="trimestre3y"){
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'block';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'none';
            }else if(opcion0=="trimestre4y"){
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'block';
                document.getElementById('anualy').style.display = 'none';
            }else if(opcion0=="anual1y"){
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'block';
            }else{
              document.getElementById('fdatey').style.display = 'none';
                document.getElementById('trimestre1y').style.display = 'none';
                document.getElementById('trimestre2y').style.display = 'none';
                document.getElementById('trimestre3y').style.display = 'none';
                document.getElementById('trimestre4y').style.display = 'none';
                document.getElementById('anual1y').style.display = 'none';
            }
        }
      </script>
      <script>
        function enviary(){
          var datey1 = document.getElementById('datey1').value;
          var datey2 = document.getElementById('datey2').value;

          var dataen = 'datey1=' + datey1 + '&datey2=' + datey2;

          $.ajax({
            type:'POST',
            url:'sendy.php',
            data: dataen,
            success:function(resp){
              $('#respay').html(resp);
            }
          });
          return false;   
        }
      </script>
      <div class="container" id="fdatey" name="fdatey" style="display:none;">
        <form method="POST" onsubmit="return enviary();">
          <fieldset>
            <label>Desde:</label>
            <input type="date" id="datey1" name="datey1"/>
            <label>Hasta:</label>
            <input type="date" id="datey2" name="datey2"/>
            <button type="submit" value="Enviar">Buscar</button>
          </fieldset>
        </form>
            <br><br>
        <p id="respay"></p>
      </div>
      <div class="container" id="trimestre1y" name="trimestre1y" style="display:none;">
          <div  id="1y"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>1 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ENERO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>FEBRERO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>MARZO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;//***********************************************************************************************************************************************
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre2y" name="trimestre2y" style="display:none;">
          <div  id="2y"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>2 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ABRIL</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>MAYO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>JUNIO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre3y" name="trimestre3y" style="display:none;">
          <div  id="3y"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>3 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>JULIO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>AGOSTO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>SEPTIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre4y" name="trimestre4y" style="display:none;">
          <div  id="4y"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>4 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>OCTUBRE</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0];
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0];
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0];
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0];
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0];
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0];
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>NOVIEMBRE</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0];
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0];
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0];
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0];
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0];
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0];
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>DICIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0];
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0];
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0];
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0];
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0];
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0];
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="anual1y" name="anual1y" style="display:none;">
          <div  id="anualYazmin"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center"><!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 12;
              echo $datosa1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 12;
              echo $datosa2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 12;
              echo $datosa3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 12;
              echo $datosa4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 12;
              echo $datosa5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE edat='Yazmin Albarran' AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 12;
              echo $datosa6;
            ?>
          </small></td>
        </tr>
        <tr align="center"><!--PORCENTAJES-->
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos1;
              $n2 = $datosa1;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos2;
              $n2 = $datosa2;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos3;
              $n2 = $datosa3;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos4;
              $n2 = $datosa4;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos5;
              $n2 = $datosa5;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos6;
              $n2 = $datosa6;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
        </tr>
        <tr align="center"><!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
      </div>    
  </div>

  <div class="container" id="Todos" name="Todos" style="display:none;">
      <label>Selecciona el trimestre a consultar:</label>
      <select type="text" name="select4" id="select4" onChange="mostrarTodos();" class="form-control input-sm" style="width:250px">
          <option value="Seleccionar">Seleccionar:</option>
          <option value="fdatet">Por Fecha</option>
          <option value="trimestre1t">Primer trimestre</option>
          <option value="trimestre2t">Segundo trimestre</option>
          <option value="trimestre3t">Tercer trimestre</option>
          <option value="trimestre4t">Cuarto trimestre</option>
          <option value="anual1t">Anual</option>
      </select>
      <br>
      <script>
        function mostrarTodos(){
            var opcion1 = document.getElementById("select4").value;
            if (opcion1=="fdatet") {
              document.getElementById('fdatet').style.display = 'block';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'none';
            }else if(opcion1=="trimestre1t"){
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'block';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'none';
            }else if(opcion1=="trimestre2t"){
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'block';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'none';
            }else if(opcion1=="trimestre3t"){
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'block';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'none';
            }else if(opcion1=="trimestre4t"){
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'block';
                document.getElementById('anual1t').style.display = 'none';
            }else if(opcion1=="anual1t"){
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'block';
            }else{
              document.getElementById('fdatet').style.display = 'none';
                document.getElementById('trimestre1t').style.display = 'none';
                document.getElementById('trimestre2t').style.display = 'none';
                document.getElementById('trimestre3t').style.display = 'none';
                document.getElementById('trimestre4t').style.display = 'none';
                document.getElementById('anual1t').style.display = 'none';
            }
        }
      </script>
       <script>
        function enviart(){
          var datet1 = document.getElementById('datet1').value;
          var datet2 = document.getElementById('datet2').value;

          var dataen = 'datet1=' + datet1 + '&datet2=' + datet2;

          $.ajax({
            type:'POST',
            url:'sendt.php',
            data: dataen,
            success:function(resp){
              $('#respat').html(resp);
            }
          })
          return false;   
        }
      </script>
      <div class="container" id="fdatet" name="fdatet" style="display:none;">
        <form method="POST" onsubmit="return enviart();">
          <fieldset>
            <label>Desde:</label>
            <input type="date" id="datet1" name="datet1"/>
            <label>Hasta:</label>
            <input type="date" id="datet2" name="datet2"/>
            <button type="submit" value="Enviar">Buscar</button>
          </fieldset>
        </form>
            <br><br>
        <p id="respat"></p>
      </div>
      <div class="container" id="trimestre1t" name="trimestre1t" style="display:none;">
          <div  id="1todos"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>1 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ENERO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN '2020-01-01' AND '2020-01-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0] * 3;
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0] * 3;
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0] * 3;
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-01-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0] * 3;
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0] * 3;
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-01-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0] * 3;
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>FEBRERO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0] * 3;
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0] * 3;
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0] * 3;
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-02-01' AND '2020-02-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0] * 3;
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0] * 3;
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-02-01' AND '2020-02-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0] * 3;
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>MARZO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0] * 3;
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0] * 3;
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0] * 3;
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-03-01' AND '2020-03-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0] * 3;
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0] * 3;
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-03-01' AND '2020-03-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0] * 3;
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre2t" name="trimestre2t" style="display:none;">
          <div  id="2todos"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>2 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>ABRIL</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN '2020-04-01' AND '2020-04-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0] * 3;
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0] * 3;
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0] * 3;
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-04-01' AND '2020-04-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0] * 3;
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0] * 3;
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-04-01' AND '2020-04-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0] * 3;
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>MAYO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0] * 3;
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0] * 3;
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0] * 3;
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-05-01' AND '2020-05-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0] * 3;
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0] * 3;
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-05-01' AND '2020-05-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0] * 3;
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>JUNIO</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0] * 3;
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0] * 3;
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0] * 3;
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-06-01' AND '2020-06-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0] * 3;
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0] * 3;
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-06-01' AND '2020-06-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0] * 3;
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre3t" name="trimestre3t" style="display:none;">
          <div  id="3todos"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>3 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>JULIO</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN '2020-07-01' AND '2020-07-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0] * 3;
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0] * 3;
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0] * 3;
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-07-01' AND '2020-07-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0] * 3;
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0] * 3;
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-07-01' AND '2020-07-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0] * 3;
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>AGOSTO</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0] * 3;
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0] * 3;
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0] * 3;
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-08-01' AND '2020-08-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0] * 3;
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0] * 3;
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-08-01' AND '2020-08-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0] * 3;
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>SEPTIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0] * 3;
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0] * 3;
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0] * 3;
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-09-01' AND '2020-09-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0] * 3;
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0] * 3;
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-09-01' AND '2020-09-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0] * 3;
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="trimestre4t" name="trimestre4t" style="display:none;">
          <div  id="4todos"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
              <thead>
                  <tr align="center">
                      <td rowspan="2" style="vertical-align:middle;"><b><small>4 TRIMESTRE</small></td>
                      <td colspan="2"><b><small>Contactos</small></b></td>
                      <td colspan="2"><b><small>Entrevista</small></b></td>
                      <td colspan="2"><b><small>Evaluación</small></b></td>
                      <td colspan="2"><b><small>Venta de Carrera</small></b></td>
                      <td colspan="2"><b><small>Inducción</small></b></td>
                      <td colspan="2"><b><small>Conexión</small></b></td>
                  </tr>
                  <tr align="center">
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                      <td><b><small>RESULT</small></b></td>
                      <td><b><small>META</small></b></td>
                  </tr>
              </thead>
              <tbody>
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>OCTUBRE</small></b></td>
                      <td><small>
                          <?php
                            $sql1 = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN '2020-10-01' AND '2020-10-31'";
                            $res1 = mysqli_query($conexion,$sql1);
                            while($ver1=mysqli_fetch_row($res1)){
                                $datos1e = $ver1[0];
                            }
                            echo $datos1e;
                          ?>
                      </small></td>
                      <td><small>
                          <?php
                            $sql = "SELECT contacto FROM metaa WHERE id='1'";
                            $res = mysqli_query($conexion,$sql);
                            while($ver=mysqli_fetch_row($res)){
                                $datos11e = $ver[0] * 3;
                            }
                            echo $datos11e;
                          ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2e = $ver[0];
                          }
                          echo $datos2e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22e = $ver[0] * 3;
                          }
                          echo $datos22e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3e = $ver[0];
                        }
                        echo $datos3e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33e = $ver[0] * 3;
                          }
                          echo $datos33e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-10-01' AND '2020-10-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4e = $ver[0];
                          }
                          echo $datos4e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44e = $ver[0] * 3;
                          }
                          echo $datos44e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5e = $ver[0];
                          }
                          echo $datos5e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55e = $ver[0] * 3;
                          }
                          echo $datos55e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-10-01' AND '2020-10-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6e = $ver[0];
                          }
                          echo $datos6e;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66e = $ver[0] * 3;
                          }
                          echo $datos66e;
                        ?>
                      </small></td>
                  </tr>
                  
                  <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                  </tr>
                  
                  <tr align="center">
                      <td style="vertical-align:middle;"><b><small>NOVIEMBRE</small></b></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1f = $ver[0];
                          }
                          echo $datos1f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11f = $ver[0] * 3;
                          }
                          echo $datos11f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2f = $ver[0];
                          }
                          echo $datos2f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22f = $ver[0] * 3;
                          }
                          echo $datos22f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3f = $ver[0];
                        }
                        echo $datos3f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33f = $ver[0] * 3;
                          }
                          echo $datos33f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-11-01' AND '2020-11-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4f = $ver[0];
                          }
                          echo $datos4f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44f = $ver[0] * 3;
                          }
                          echo $datos44f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5f = $ver[0];
                          }
                          echo $datos5f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55f = $ver[0] * 3;
                          }
                          echo $datos55f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-11-01' AND '2020-11-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6f = $ver[0];
                          }
                          echo $datos6f;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66f = $ver[0] * 3;
                          }
                          echo $datos66f;
                        ?>
                      </small></td>
                    </tr>
                    
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    
                    <tr align="center">
                        <td style="vertical-align:middle;"><b><small>DICIEMBRE</small></b></td>
                        <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos1m = $ver[0];
                          }
                          echo $datos1m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT contacto FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos11m = $ver[0] * 3;
                          }
                          echo $datos11m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND acudio_entrevista='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos2m = $ver[0];
                          }
                          echo $datos2m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT entrevista FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos22m = $ver[0] * 3;
                          }
                          echo $datos22m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                        $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND puntos > 0";
                        $res = mysqli_query($conexion,$sql);
                        while($ver=mysqli_fetch_row($res)){
                          $datos3m = $ver[0];
                        }
                        echo $datos3m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos33m = $ver[0] * 3;
                          }
                          echo $datos33m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-12-01' AND '2020-12-31'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos4m = $ver[0];
                          }
                          echo $datos4m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT venta FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos44m = $ver[0] * 3;
                          }
                          echo $datos44m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND arranque='Si'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos5m = $ver[0];
                          }
                          echo $datos5m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT induccion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos55m = $ver[0] * 3;
                          }
                          echo $datos55m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-12-01' AND '2020-12-31' AND conexion LIKE '%i%'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos6m = $ver[0];
                          }
                          echo $datos6m;
                        ?>
                      </small></td>
                      <td rowspan="1"><small>
                        <?php
                          $sql = "SELECT conexion FROM metaa WHERE id='1'";
                          $res = mysqli_query($conexion,$sql);
                          while($ver=mysqli_fetch_row($res)){
                            $datos66m = $ver[0] * 3;
                          }
                          echo $datos66m;
                        ?>
                      </small></td>
                    </tr>
                    <tr align="center"><!--TD LIMPIO-->
                      <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
                    </tr>
                    <tr align="center">
                        <td rowspan="2" style="vertical-align:middle;"><b><small>TOTAL</small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos1e;
                                $n2 = $datos1f;
                                $n3 = $datos1m;
                                
                                $sum1 = $n1 + $n2 + $n3;
                            
                                echo round($sum1);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4a = $datos11e * 3;
                                
                                echo round($n4a);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos2e;
                                $n2 = $datos2f;
                                $n3 = $datos2m;
                                
                                $sum2 = $n1 + $n2 + $n3;
                            
                                echo round($sum2);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4b = $datos22e * 3;
                                
                                echo round($n4b);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos3e;
                                $n2 = $datos3f;
                                $n3 = $datos3m;
                                
                                $sum3 = $n1 + $n2 + $n3;
                            
                                echo round($sum3);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4c = $datos33e * 3;
                                
                                echo round($n4c);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos4e;
                                $n2 = $datos4f;
                                $n3 = $datos4m;
                                
                                $sum4 = $n1 + $n2 + $n3;
                            
                                echo round($sum4);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4d = $datos44e * 3;
                                
                                echo round($n4d);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos5e;
                                $n2 = $datos5f;
                                $n3 = $datos5m;
                                
                                $sum5 = $n1 + $n2 + $n3;
                            
                                echo round($sum5);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4e = $datos55e * 3;
                                
                                echo round($n4e);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n1 = $datos6e;
                                $n2 = $datos6f;
                                $n3 = $datos6m;
                                
                                $sum6 = $n1 + $n2 + $n3;
                            
                                echo round($sum6);
                            ?>
                        </small></b></td>
                        <td><b><small>
                            <?php
                                $n4f = $datos66e * 3;
                                
                                echo round($n4f);
                            ?>
                        </small></b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum1;
                                $v2 = $n4a;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum2;
                                $v2 = $n4b;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum3;
                                $v2 = $n4c;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum4;
                                $v2 = $n4d;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum5;
                                $v2 = $n4e;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                        <td colspan="2"><b><small>
                            <?php
                                $v1 = $sum6;
                                $v2 = $n4f;
                                $total = $v1 * 100 / $v2;
                                echo round($total);
                            ?>
                            %
                        </small></b></td>
                    </tr>
              </tbody>
          </table>
      </div>
      <div class="container" id="anual1t" name="anual1t" style="display:none;">
          <div  id="anualTodos"></div>
          <table class="table table-hove table-condensed table-bordered" id="tabladinamicaload">
      <thead>

        <tr align="center">
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></td>
          <td colspan="2"><b><small>Contactos</small></b></td>
          <td colspan="2"><b><small>Entrevista</small></b></td>
          <td colspan="2"><b><small>Evaluación</small></b></td>
          <td colspan="2"><b><small>Venta de Carrera</small></b></td>
          <td colspan="2"><b><small>Inducción</small></b></td>
          <td colspan="2"><b><small>Conexión</small></b></td>
        </tr>
        <tr align="center">
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
          <td><b><small>RESULT</small></b></td>
          <td><b><small>META</small></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center"><!--RESULTADOS VS METAS-->
          <td rowspan="2" style="vertical-align:middle;"><b><small>Anual</small></b></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fechareg BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos1 = $ver[0];
              }
              echo $datos1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT contacto FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos11 = $ver[0];
              }
              $datosa1 = $datos11 * 36;
              echo $datosa1;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND acudio_entrevista='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos2 = $ver[0];
              }
              echo $datos2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT entrevista FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos22 = $ver[0];
              }
              $datosa2 = $datos22 * 36;
              echo $datosa2;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
            $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND puntos > 0";
            $res = mysqli_query($conexion,$sql);
            while($ver=mysqli_fetch_row($res)){
              $datos3 = $ver[0];
            }
            echo $datos3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT evaluacion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos33 = $ver[0];
              }
              $datosa3 = $datos33 * 36;
              echo $datosa3;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE gerente LIKE '%r%'  AND fecha_cita BETWEEN'2020-01-01' AND '2020-12-31'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos4 = $ver[0];
              }
              echo $datos4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT venta FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos44 = $ver[0];
              }
              $datosa4 = $datos44 * 36;
              echo $datosa4;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND arranque='Si'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos5 = $ver[0];
              }
              echo $datos5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT induccion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos55 = $ver[0];
              }
              $datosa5 = $datos55 * 36;
              echo $datosa5;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT COUNT(id) FROM llenado_formulario WHERE fecha_cita BETWEEN'2020-01-01' AND '2020-12-31' AND conexion LIKE '%i%'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos6 = $ver[0];
              }
              echo $datos6;
            ?>
          </small></td>
          <td rowspan="1"><small>
            <?php
              $sql = "SELECT conexion FROM metaa WHERE id='1'";
              $res = mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($res)){
                $datos66 = $ver[0];
              }
              $datosa6= $datos66 * 36;
              echo $datosa6;
            ?>
          </small></td>
        </tr>
        <tr align="center"><!--PORCENTAJES-->
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos1;
              $n2 = $datosa1;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos2;
              $n2 = $datosa2;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos3;
              $n2 = $datosa3;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos4;
              $n2 = $datosa4;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos5;
              $n2 = $datosa5;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
          <td colspan="2"><b><small>
            <?php
              $n1 = $datos6;
              $n2 = $datosa6;
              $total = $n1 *100 / $n2;
              echo round($total);
            ?> %
          </small></b></td>
        </tr>
        <tr align="center"><!--TD LIMPIO-->
          <td colspan="13" bgcolor="#F3F3F3"><b><small></small></b></td>
        </tr>
      </tbody>
    </table>
      </div>
  </div>

   <?php include('graficas.php'); ?>
</body>
</html>

