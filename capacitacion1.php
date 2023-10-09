<?php
error_reporting(2);
include 'php/conexion.php';
$conexion = conexion();
session_start();
$edat = $_SESSION['user'];
//Comprobamos existencia de sesi車n
if (!isset($_SESSION['user'])) {
  header('location: index.php');
}
mysqli_set_charset($conexion,'utf8'); //Esta linea arregla que los acentos combobits
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexi車n: ' . $conexion->connect_error); //si hay un error termina la aplicaci車n y mostramos el error
}

echo $nombre;

$sql1 = "SELECT * FROM estat";
$result1 = $conexion->query($sql1); 

if($result1->num_rows > 0){
    $combobit1 = "";
    while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
        $combobit1.="<option value='".$row['tipo']."'>".$row['tipo']."</option>";
    }
}else{
    echo "No hubo resultados";
}


?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones1.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
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
            <li><a href="#">Conexiones</a></li>
          <li><a href="php/logout.php">Salir</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <div class="container">
    <div id="tablacon"></div>
  </div>
  
  
  <!-- Modal para edicion de datos -->
  <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
        </div>
        <div class="modal-body">
          <input type="text" hidden="" id="idpersona" name="">
          <label>EDAT</label>
          <input type="text" name="" value="" id="edatu" class="form-control input-sm" disabled>
          <label>CANDIDATO</label>
          <input type="text" name="" value="" id="nombreu" class="form-control input-sm" disabled>
          <label>GERENTE</label>
          <input type="text" name="" value="" id="gerenteu" class="form-control input-sm" disabled>
          <label>FECHA INDUCCION</label>
          <input type="text" name="" value="" id="fecha_induccionu" class="form-control input-sm" disabled>
          <label>REAL</label>
          <input type="date" name="" value="" id="fec_real" class="form-control input-sm">
          <label>FECHA CONEXION</label>
          <input type="text" name="" value="" id="fecha_conexionu" class="form-control input-sm" disabled>
          <label>REAL</label>
          <input type="date" name="" value="" id="fech_con" class="form-control input-sm">
          <label>ESTATUS</label>
          <select type="text" name="" value="" id="esta" class="form-control input-sm">
            <option  value="Seleccionar:">Seleccione:</option>
            <option  value="Baja">Baja</option>
            <option  value="Proceso de Conexion">Proceso de Conexion</option>
            <option  value="Cambio de Esquema">Cambio de Esquema</option>
          </select>
          <label>FUENTE</label>
          <input type="text" name="" value="" id="fuenteu" class="form-control input-sm" disabled>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizafcon" data-dismiss="modal">Actualizar</button>
        </div>
        
      </div>
    </div>
  </div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
  $('#tablacon').load('componentes/tablacap.php');
});
</script>

<script type="text/javascript">
$(document).ready(function(){

$('#actualizafcon').click(function(){

    actualizafcon();
    reload();
  });

  });
</script>