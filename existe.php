<?php

session_start();

error_reporting(E_ALL);
include 'php/conexion.php';
$conexion = conexion();

$edat = $_SESSION['user'];
$pros = $_SESSION['prospecto'];
$a = $_SESSION['apellido'];
$am = $_SESSION['amaterno'];
$telefono = $_SESSION['celular'];
$correo =  $_SESSION['correo'];

$fec1 = date("Y-m-d h:i:s");

$fuente = $_SESSION['fuente']; 
$referido = $_SESSION['referido']; 
$resultado_llamada = $_SESSION['resultado_llamada']; 
$fecha_cita = $_SESSION['fecha_cita']; 
$hora_cita = $_SESSION['hora_cita']; 
$fecha_contacto = $_SESSION['fecha_contacto'];



$e= $edat;
$n= $pros;
/*echo $e;*/



/*echo $pros. "$a" . "$am";*/
/*echo $telefono;
echo $correo;*/





                $sqld = "SELECT * FROM llenado_formulario WHERE nombre ='$pros' || celular = '$telefono' || correo = '$correo'";
		            $resd = mysqli_query($conexion, $sqld);
		            while ($ver = mysqli_fetch_row($resd)) {
		            	$exisnombre = $ver[4];
                  $exisa = $ver[5];
                  $exisam = $ver[6];
		              $exisedat= $ver[3];
		              $existelefono= $ver[13];
		              $exiscorreo= $ver[14];

		            }
                /*echo $existelefono;
                echo $exiscorreo;*/
                $_SESSION['pertenece'] = $exisedat;
?>

<!DOCTYPE html>
<html>
<head>

<title>E D A T</title>
  <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- HOJAS DE ESTILO -->



  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


  <!-- JS -->
  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
    <script src="js/funciones.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>




    <link href="style/style_edats.css" rel="stylesheet" type="text/css">
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
        <input hidden id="edat" value="<?php echo "$edat" ?>">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="resultados_conectados.php"><span class="glyphicon glyphicon-search"></span> Seguimiento</a></li> -->
        <li><a href="metas.php"><span class="glyphicon glyphicon-file"></span> Metas y resultados</a></li>
        <li><a href="php/logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<body >
  <div class="container">
    <div id="tabla"></div>
  </div>



</body>
</html>





<script type="text/javascript">
	

	$( document ).ready(function() {


 				
 				swal({
                    title: "¡El prospecto ya existe!",
                    text: "<?php if ($existelefono == $telefono) {

                    	echo "El número ".$telefono. " ya ha sido registrado por ". $exisedat . " para el prospecto ". "$exisnombre ". " $exisa ". " $exisam " . ", ¿Desea continuar conel registro?" ;
                    }

                    elseif ($exiscorreo == $correo) {
                    	echo "El correo ". $correo ." ya ha sido registrado por ". $exisedat . " para el prospecto ". "$exisnombre ". " $exisa ". " $exisam " ;
                    }

                    else { 


                    echo $pros . " $a" . " $am". " ya ha sido registrado por ". $exisedat . " ¿Desea continuar?";

                	} ?> ",

                  
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Si, registrar",
                    cancelButtonText: "No, cancelar",
                    closeOnConfirm: true,
                    customClass: "alerta",

                  },
                  function(isConfirm) {
                    if (isConfirm) {

                        window.location.href = "confirmacion.php";

                    }else{

                      window.location.href = "edat.php";
                    }
                
                   
                  });
});
</script>


<style type="text/css">


.sweet-alert.alerta {  }

</style>
