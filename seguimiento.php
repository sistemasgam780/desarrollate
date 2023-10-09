<?php
include 'php/conexion.php';
$conexion = conexion();
session_start();
if(!isset($_SESSION['tiempo'])){
    $_SESSION['tiempo'] = time();
}
else if(time() - $_SESSION['tiempo'] > 300){
    session_destroy();
    session_unset();
    header('location: index.php');
    die();
}

$_SESSION['tiempo'] = time();

$edat = $_SESSION['user'];


//Comprobamos existencia de sesión
if (!isset($_SESSION['user'])) {
  header('location: index.php');
}


mysqli_set_charset($conexion,'utf8'); //Esta linea arregla que los acentos combobits
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

//desde aqui se hace lo de fecha fin


$fecha_actual = date('Y-m-d');

$fecha_desde = date('Y-m')."-01";


    //comprobacion de contactos de parte de edat
  $contacto_edat = "select * from llenado_formulario where edat = '".$edat."' and fechareg >= '".$fecha_desde."' and fechareg <= '".$fecha_actual."'";
  $edat_result = $conexion->query($contacto_edat);
  $contactos = mysqli_num_rows($edat_result);

    //comprobacion de citas de parte de edat
  $citas_edat = "select * from llenado_formulario where resul_llamada = 'CITA' and edat = '".$edat."' and fechareg >= '".$fecha_desde."' and fechareg <= '".$fecha_actual."'";
  $citas_result = $conexion->query($citas_edat);
  $citas = mysqli_num_rows($citas_result);

//comprobacion de conexion de parte de edat

  $conexion_edat = "select * from llenado_formulario where edat = '".$edat."' and fechareg >= '".$fecha_desde."' and fechareg <= '".$fecha_actual."' and  conexion = ('Provisional' or 'Definitiva')";
  $conexion_result = $conexion->query($conexion_edat);
  $conexionr = mysqli_num_rows($conexion_result);
 
 //***termina

//consulta para primer combo de fuente
$sql="SELECT * from fuente";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

//consulta para segundo combo si o no decision
$sql2="select resultado from resul_llamada where resultado !='CITA'";
$result2 = $conexion->query($sql2);

//consulta .ficha identidad / edo civil
$sql3="select * from edo_civil";
$result3 = $conexion->query($sql3);

//consulta .ficha identidad / direccion
$sql4="select * from direccion";
$result4 = $conexion->query($sql4);

//consulta .ficha identidad / escolaridad
$sql5="select * from escolaridad";
$result5 = $conexion->query($sql5);

//consulta .ficha identidad / imagen
$sql6="select * from puntuacion";
$result6 = $conexion->query($sql6);

//consulta .evaluacion / factores know-out
$sql7="select * from knowout";
$result7 = $conexion->query($sql7);

//comprobacion de resultados 1
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit="";
  while ($row = $result->fetch_array(MYSQLI_ASSOC))
  {
    $combobit .=" <option value='".$row['resultado']."'>".$row['resultado']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 2
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit2="";
  while ($row = $result2->fetch_array(MYSQLI_ASSOC))
  {
    $combobit2 .=" <option value='".$row['resultado']."'>".$row['resultado']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 3
if ($result3->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit3="";
  while ($row = $result3->fetch_array(MYSQLI_ASSOC))
  {
    $combobit3 .=" <option value='".$row['resultado']."'>".$row['resultado']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 4
if ($result4->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit4="";
  while ($row = $result4->fetch_array(MYSQLI_ASSOC))
  {
    $combobit4 .=" <option value='".$row['resultado']."'>".$row['resultado']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 5
if ($result5->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit5="";
  while ($row = $result5->fetch_array(MYSQLI_ASSOC))
  {
    $combobit5 .=" <option value='".$row['resultado']."'>".$row['resultado']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 6
if ($result6->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit6="";
  while ($row = $result6->fetch_array(MYSQLI_ASSOC))
  {
    $combobit6 .=" <option value='".$row['puntuacion']."'>".$row['puntuacion']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
//comprobacion de resultados 7
if ($result7->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit7="";
  while ($row = $result7->fetch_array(MYSQLI_ASSOC))
  {
    $combobit7 .=" <option value='".$row['factor']."'>".$row['factor']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
}
else
{
  echo "No hubo resultados";
}
$conexion->close(); //cerramos la conexión

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
 

  <title></title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <!--<script src="js/funciones2.js"></script>-->
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     
    <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
   </head>


<body onload="mostrarcarrera(); contarcheckbox(); res_gdd(); res_pp200(); fc21();">

  <!--Barra de navegacion -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li><a><span class="label label-primary">Bienvenido:  <?php echo $edat ?></span></a></li>
          <input hidden id="edat" value="<?php echo $edat ?>">
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index1.php">Regresar</a></li>
            <li><a href="metas.php">Metas y resultados</a></li> 
          <li><a href="php/logout.php">Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <!--Termina barra de navegacion-->
  <div class="container">
    <div id="tabla"></div>
  </div>

  <div class="modal fade" id="modalReagendar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Agendar Cita</h4>
        </div>
        <div class="modal-body">
          <label>¿Agendar Cita?</label>
          <select id="reagendar" class="form-control input-sm" onChange="mostrarCita();">
            <option value="0">Seleccione:</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>
          <script>
            function mostrarCita(){
              var opcion = document.getElementById("reagendar").value;
              if (opcion=="Si") {
                document.getElementById('reagendar1').style.display = 'block';
                document.getElementById('motivo').style.display = 'none';
              }else if (opcion=="No") {
                document.getElementById('reagendar1').style.display = 'none';
                document.getElementById('motivo').style.display = 'block';
              }else{
                document.getElementById('reagendar1').style.display = 'none';
                document.getElementById('motivo').style.display = 'none';
              }
            }
          </script>
          <div id="reagendar1" name="reagendar1" style="display:none;">
            <label>Fecha Cita</label>
            <input type="date" name="" value="" id="fecha_citar" class="form-control input-sm">
            <label>Hora Cita</label>
            <input type="time" name="" value="" id="hora_citar" class="form-control input-sm">           
          </div>
          <div id="motivo" name="motivo" style="display:none;">
            <label>Motivo</label>
            <select id="motivo1" name="motivo1" class="form-control input-sm">
              <option value="0">Seleccione:</option>
              <?php echo $combobit2; ?>
            </select>          
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="reagendar2">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabla').load('componentes/tablas.php');
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#reagendar2').click(function(){
      reagendarcita();
    });
  });
</script>

