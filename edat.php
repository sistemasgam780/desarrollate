<?php
error_reporting(E_ALL);
include 'php/conexion.php';
$conexion = conexion();
session_start();

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
  
  
  $edat = $_SESSION['user'];

mysqli_set_charset($conexion, 'utf8'); //Esta linea arregla que los acentos combobits
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
}

//desde aqui se hace lo de fecha fin
$fecha_actual = date('Y-m-d');
$fecha_desde = date('Y-m') . "-01";

//comprobacion de contactos de parte de edat
$contacto_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
$edat_result = $conexion->query($contacto_edat);
$contactos = mysqli_num_rows($edat_result);

//comprobacion de citas de parte de edat
$citas_edat = "select * from llenado_formulario where resul_llamada = 'CITA' and edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
$citas_result = $conexion->query($citas_edat);
$citas = mysqli_num_rows($citas_result);

//comprobacion de conexion de parte de edat

$conexion_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "' and  conexion = ('Provisional' or 'Definitiva')";
$conexion_result = $conexion->query($conexion_edat);
$conexionr = mysqli_num_rows($conexion_result);

//***termina

//consulta para primer combo de fuente
$sql = "SELECT * from fuente ORDER BY resultado";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable

//consulta para segundo combo si o no decision
$sql2 = "SELECT * FROM resul_llamada ORDER BY resultado";
$result2 = $conexion->query($sql2);

//consulta .ficha identidad / edo civil
$sql3 = "SELECT * FROM edo_civil ORDER BY resultado";
$result3 = $conexion->query($sql3);

//consulta .ficha identidad / direccion
$sql4 = "SELECT * FROM direccion ORDER BY resultado";
$result4 = $conexion->query($sql4);

//consulta .ficha identidad / escolaridad
$sql5 = "SELECT * FROM escolaridad ORDER BY resultado";
$result5 = $conexion->query($sql5);

//consulta .ficha identidad / imagen
$sql6 = "SELECT * FROM puntuacion";
$result6 = $conexion->query($sql6);

//consulta .evaluacion / factores know-out
$sql7 = "SELECT * FROM knowout";
$result7 = $conexion->query($sql7);

//comprobacion de resultados 1
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit = "";
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $combobit .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 2
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit2 = "";
  while ($row = $result2->fetch_array(MYSQLI_ASSOC)) {
    $combobit2 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 3
if ($result3->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit3 = "";
  while ($row = $result3->fetch_array(MYSQLI_ASSOC)) {
    $combobit3 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 4
if ($result4->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit4 = "";
  while ($row = $result4->fetch_array(MYSQLI_ASSOC)) {
    $combobit4 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 5
if ($result5->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit5 = "";
  while ($row = $result5->fetch_array(MYSQLI_ASSOC)) {
    $combobit5 .= " <option value='" . $row['resultado'] . "'>" . $row['resultado'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 6
if ($result6->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit6 = "";
  while ($row = $result6->fetch_array(MYSQLI_ASSOC)) {
    $combobit6 .= " <option value='" . $row['puntuacion'] . "'>" . $row['puntuacion'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
//comprobacion de resultados 7
if ($result7->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
  $combobit7 = "";
  while ($row = $result7->fetch_array(MYSQLI_ASSOC)) {
    $combobit7 .= " <option value='" . $row['factor'] . "'>" . $row['factor'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
  }
} else {
  echo "No hubo resultados";
}
$conexion->close(); //cerramos la conexión
?>

<!DOCTYPE html>
<html>

<head>
  <title>E D A T</title>
  <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- HOJAS DE ESTILO -->
  <link href="style/style_edats.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertify/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <!-- JS -->
  <script src="librerias/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertify/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


</head>

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
        <!-- <li><a href="resultados_conectados.php"><span class="glyphicon glyphicon-search"></span> Seguimiento</a></li> -->
        <li><a href="metas.php"><span class="glyphicon glyphicon-file"></span> Metas y resultados</a></li>
        <li><a href="php/logout.php" id="salir"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<body onload="mostrarcarrera(); contarcheckbox(); res_pp200();">
  <div class="container">
    <div id="tabla"></div>
  </div>

  <!-- Modal para registros nuevos -->
  <form role="form" id="newModalForm" method="post" action="agregardatos.php">
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><b>Nuevo Prospecto</b></h4>
          </div>
          <div class="modal-body">
            <label>Fecha de contacto:</label>
            <input type="date" name="fecha_contacto" value="" id="fecha_contacto" class="form-control input-sm">


            <label>Nombre:</label>
            <input type="text" name="" onkeypress="return check(event)" value="" required id="nombre" class="form-control input-sm" placeholder="Nombre " onKeyUp="this.value=this.value.toUpperCase();">
            

            <label>Apellido Paterno:</label>
            <input type="text" name="" onkeypress="return check(event)" value="" required id="apellido" class="form-control input-sm" placeholder=" A.Paterno"  onKeyUp="this.value=this.value.toUpperCase();">


            <label>Apellido Materno:</label>
            <input type="text" name=" " onkeypress="return check(event)" value="" id="amaterno" class="form-control input-sm" placeholder=" A.Materno"  onKeyUp="this.value=this.value.toUpperCase();">

            <label>Teléfono:</label>
            <input type="text" name="" value="" id="telefono" class="form-control input-sm" placeholder="5525693325">

            <label>Correo:</label>
            <input type="email" name="" value="" id="correo" class="form-control input-sm" placeholder="correo@dominio.com">
            <span id="emailOK"></span>

            <label>Fuente:</label>
            <select id="fuente2" name="fuente" onchange="copiar();" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit; ?>
            </select>
            <input hidden type="text" id="fuente" name="fuente">

            <label>¿Es referido?</label> <input type="checkbox" id="checkbox" name="checkbox"><br>
            <input hidden placeholder="fecharegistro" type="text" name="" id="fechareg" value="<?php echo date('Y-m-d') ?>">
            <input id="referido" name="referido" type="text" placeholder="Nombre del referido" style="display:none" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <!--Fecha de registro invisible para los edat´s se usa php y muestra la fecha actual -->

            <label>Resultado de llamada: </label>
            <select id="resultado_llamada" name="resultado_llamada" onChange="mostrar();" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit2; ?>
            </select>

            <div id="res_cita" name="res_cita" style="display:none;">
              <label>Fecha Cita:</label>
              <input type="date" name="" value="" id="fecha_cita" class="form-control input-sm">

              <label>Hora Cita:</label>
              <input type="time" name="" value="" id="hora_cita" class="form-control input-sm">
              <input type="text" name="" value="<?php echo "$edat"; ?>" id="edat" class="form-control input-sm" style="visibility:hidden" disabled>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="guardarnuevo">Agregar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="contenido"></div>
  </form>

  <!-- Modal para edicion de datos -->
  <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Actualizar Datos</b></h4>
        </div>
        <div class="modal-body">
          <label>Fecha de contacto:</label>
          <input type="date" name="" value="" id="fecha_contactou" class="form-control input-sm" disabled>

          <input type="text" hidden="" id="idpersona" name="">
          <label>Nombre Completo:</label>
          <input type="text" name="" value="" id="nombreu" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
          <input type="text" name="" value="" id="apellidou" hidden>
          <label>Teléfono:</label>
          <input type="text" name="" value="" id="telefonou" class="form-control input-sm">
          <label>Correo:</label>
          <input type="text" name="" value="" id="correou" class="form-control input-sm">
          <label>Fuente:</label>
          <select onClick="mostrarOcultar(this)" id="fuenteu" class="form-control input-sm">
            <option selected disabled hidden value="">Seleccione:</option>
            <?php echo $combobit; ?>
          </select>
          <label>Lo refiere:</label>
          <input type="text" name="" value="" id="referidou" placeholder="Nombre del referido" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
          <label>Resultado de Llamada:</label>
          <select id="resultado_llamadau" name="resultado_llamadau" onChange="mostrar();" class="form-control input-sm">
            <option selected disabled hidden value="">Seleccione:</option>
            <?php echo $combobit2; ?>
          </select>
          <label>Fecha Cita:</label>
          <input type="date" name="" value="" id="fecha_citau" class="form-control input-sm">

          <label>Hora Cita:</label>
          <input type="time" name="" value="" id="hora_citau" class="form-control input-sm">
          <label>Fecha Registro:</label>
          <input disabled type="datetime" name="" value="" id="fecharegu" class="form-control input-sm">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizadatos">Actualizar</button>
          <button type="button" class="btn btn-danger glyphicon glyphicon-trash" id="eliminar" data-dismiss="modal"></button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para ficha identidad -->
  <div class="modal fade" id="modalFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="limpiarcolonia();" class="close" data-dismiss="modal"  aria-label="Close"><span onclick="limpiarcolonia();" aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Ficha Identidad</b></h4>
        </div>
        <div class="modal-body">

          <label>Fecha Cita:</label>
          <input type="date" name="" value="" id="fecha_citaIdentidad" class="form-control input-sm" disabled>

          <label>¿Acudió a la Entrevista?</label>
          <select type="text" name="acudio" value="" id="acudio" onChange="mostrar1();" class="form-control input-sm">
            <option selected disabled hidden value="">Seleccione:</option>
            <option value="Si">SÍ</option>
            <option value="No">NO</option>
            <option value="Si/No">SÍ, NO LE INTERESO</option>>
          </select>

          <div id="t_entrevista" name="t_entrevista" style="display:none;">
          <label>Fecha de nacimiento:</label>
            <input type="date" name="" value="" id="fechaNacimiento" class="form-control input-sm" placeholder="Ingrese su fecha de nacimiento">
            <label>Edad:</label>
            <input type="number" name="" value="" id="edad" class="form-control input-sm" placeholder="Ingrese su edad">
            <label>Estado Civil:</label>
            <select type="text" name="" value="" id="edo_civil" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit3; ?>
            </select>



            <label>Código Postal:</label>
           <input type="number" name="cp" value="" id="cp"  class="form-control input-sm" placeholder="Ingrese su CP" onchange ="buscar_datos();">


            <label>Estado:</label>
           <input type="text" name="" value="" id="estado" class="form-control input-sm" readonly placeholder="Estado">
  
            <label>Municipio/Delegación:</label>
           <input type="text" name="" value="" id="municipio" class="form-control input-sm" readonly  placeholder="Municipio">
                       
          <label>Colonia:</label>
            <select type="text" name="" value="" id="colonia" class="form-control input-sm">
              
            </select>

            <label>Género:</label>
            <select type="text" name="" value="" id="genero" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit8; ?>
            </select>
            <label>Nacionalidad:</label>
            <select type="text" name="" value="" id="nacionalidad" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit9; ?>
            </select>
            
            <label>No. Dependientes Económicos:</label>
            <input type="number" name="" value="" id="dependientes" class="form-control input-sm" placeholder="Ingrese el número de dependientes">
            <label>Ocupación Actual:</label>
            <input type="text" name="" value="" id="ocupacion" class="form-control input-sm" placeholder="Ingrese su ocupación" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <label>Escolaridad:</label>
            <select type="text" name="" value="" id="escolaridad" onchange="mostrarcarrera();" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php echo $combobit5; ?>
            </select>
            <label id="label_carrera" style="display:none;">Carrera:</label>
            <input type="text" name="" value="" id="carrera" class="form-control input-sm" style="display:none;" placeholder="Ingrese su carrera" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <label>Institución:</label>
            <input type="text" name="" value="" id="institucion" class="form-control input-sm" placeholder="UNAM, UAM, IPN, ETC." pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <label>Ingreso Actual o Anterior:</label>
            <input type="text" name="" value="" id="ingreso" class="number form-control input-sm" placeholder="Ingrese el ingreso correspondiente" maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <label>Transporte:</label>
            <select type="text" name="" value="" id="trans" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <option value="Auto">AUTOMÓVIL</option>
              <option value="Moto">MOTOCICLETA</option>
              <option value="Ninguno">NINGUNO</option>
            </select>
            <label>Tiempo Disponible para Actividad:</label>
            <select type="text" name="" value="" id="tiempo" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <option value="Mas de 6 horas">MÁS DE 6 HORAS</option>
              <option value="Menos de 6 horas">MENOS DE 6 HORAS</option>
            </select>
            <label>Imagen:</label>
            <select type="text" name="" value="" id="imagen" class="form-control input-sm">
              <option selected disabled hidden value="">Seleccione:</option>
              <?php
              echo $combobit6; ?>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="actualizaficha" data-dismiss="modal">Actualizar</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal para Evaluacion -->
  <div class="modal fade" id="modalEvaluacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <input hidden type="text" value="" id="idpersona" name="">
          <label class="factEv">Factores Vitales</label>

          <div class="container">
            <div class="contEvaluacion">
              <table class="tablaEvaluacion">

                <label class="tdEvaluacion">FECHA DE EVALUACIÓN:</label>
                <input type="date" name="" value="" id="fecha_evaluacion" class="form-control input-sm">

                <tr>
                  <td class="tdEvaluacion">Carácter e Integridad</td>
                  <td>
                    <select type="text" name="" value="" id="caracter" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Sentido Común</td>
                  <td>
                    <select type="text" name="" value="" id="sentido" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Orientación al Logro</td>
                  <td>
                    <select type="text" name="" value="" id="orientacion" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Alto Nivel de Energía</td>
                  <td>
                    <select type="text" name="" value="" id="energia" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Motivación por el Dinero</td>
                  <td>
                    <select type="text" name="" value="" id="motivacion" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Perseverancia</td>
                  <td><select type="text" name="" value="" id="perseverancia" class="form-control input-sm" onchange="suma_vitales();">
                      <?php echo $combobit6; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="tdEvaluacion">Suma</td>
                  <td><input type="text" disabled name="" value="" id="suma_vitales" class="form-control input-sm"></td>
                </tr>
              </table>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <label class="msjEv">Recuerda que el mínimo sugerido es de 42 puntos (sin ningún 5)</label>
          <button type="button" class="btn btn-warning" id="factores_vitales">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para Factores know-out-->
  <div class="modal fade" id="modalknowout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="factKnow-Out">Factores Know-Out</label>
          <table class="table table-striped table-bordered" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
            <thead>
              <tr>
                <th class="encabezadoKO">CONCEPTO</th>
                <th class="encabezadoKO">CHECKBOX</th>
                <th class="encabezadoKO">CONCEPTO</th>
                <th class="encabezadoKO">CHECKBOX</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="knowOut"><label>Falta de patrón de éxito </label></td>
                <td> <input type="checkbox" value="Patron exito" id="kopatron" class="get_value" onchange="contarcheckbox();"></td>
                <td><label>No posee seguros</label></td>
                <td> <input type="checkbox" value="Seguros" id="koseguros" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Bajo nivel de energía</label></td>
                <td><input type="checkbox" value="Energia" id="koenergia" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>Recientemente divorciado</label></td>
                <td> <input type="checkbox" value="Divorciado" id="kodivorciado" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Malos hábitos de vida</label></td>
                <td><input type="checkbox" value="Habitos" id="kohabitos" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>Cambia de trabajo con frecuencia (inestable)</label></td>
                <td> <input type="checkbox" value="Inestable" id="koinestable" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Mercado natural débil - falta de contactos</label></td>
                <td><input type="checkbox" value="Mercado" id="komercado" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>Considera las ventas como un retroceso</label></td>
                <td> <input type="checkbox" value="Retroceso" id="koretroceso" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Falta de movilidad social</label></td>
                <td><input type="checkbox" value="Movilidad" id="komovilidad" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>En zona de confort</label></td>
                <td> <input type="checkbox" value="Confort" id="koconfort" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Muchas deudas / quiebra reciente</label></td>
                <td><input type="checkbox" value="Deudas" id="kodeudas" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>Necesita trabajo desesperada e inmediatamente</label></td>
                <td><input type="checkbox" value="Desesperado" id="kodesesperado" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
              <tr>
                <td class="knowOut"><label>Culpa a los demás por su falta de éxito</label></td>
                <td><input type="checkbox" value="Culpa" id="koculpa" class="get_value" onchange="contarcheckbox();"></td>
                <td class="knowOut"><label>No tiene colchón económico</label></td>
                <td><input type="checkbox" value="Colchon" id="kocolchon" class="get_value" onchange="contarcheckbox();"></td>
              </tr>
            </tbody>
          </table>
          <center><label>Resultados Factores Know-Out</label>
            <input disabled placeholder="Aceptable" type="text" id="koresultado" style="height:50px" class="form-control input-sm">
          </center>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="knowout" data-dismiss="modal" data-toggle="modal" data-target="#modalprevisibilidad">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Modal para Previsibilidad de exito-->
  <div class="modal fade" id="modalprevisibilidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="previsibilidadE">Previsibilidad de Éxito</label>
          <table class="table table-striped table-bordered" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;" id="tablaPrevis">
            <thead>
              <tr>
                <th class="encabezadoPrev">CRITERIO</th>
                <th class="encabezadoPrev">MENOS</th>
                <th colspan="2" class="encabezadoPrev">PUNTUACIÓN</th>
                <th class="encabezadoPrev">MÁS</th>
              </tr>
            </thead>
            <tbody>
              <form id="form1" name="form1" method="post" action="">
                <tr>
                  <th rowspan="2" class="txtPrev">Presentado/recomendado por un colega exprimentado.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" value="0" id="reco_0" name="inlineDefaultRadiosExample">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" value="20" id="reco_20" name="inlineDefaultRadiosExample">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th>*</th>
                  <th>*</th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Ha demostrado orientación hacia el logro durante el proceso de selección.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_0" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_10" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_15" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="orientacion_20" name="inlineDefaultRadiosExample2">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene alto potencial de arranque rápido y un mercado sólido.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_0" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_10" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_15" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="potencial_20" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene una actitud optimista.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_0" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_10" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_15" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="actitud_20" name="inlineDefaultRadiosExample4">
                    </div>
                  </th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th><label>15</label></th>
                  <th><label>20</label></th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Ha tenido éxito como vendedor a comisión, entrenador o empresario independiente.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="exito_0" name="inlineDefaultRadiosExample5">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="exito_10" name="inlineDefaultRadiosExample5">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene/tuvo un ingreso entre $30,000 y $50,000.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="ingreso_0" name="inlineDefaultRadiosExample6">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="ingreso_10" name="inlineDefaultRadiosExample6">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene título universitario.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="titulo_0" name="inlineDefaultRadiosExample7">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="titulo_10" name="inlineDefaultRadiosExample7">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>10</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Posee un seguro de vida permanente.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_5" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_7" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="seguro_10" name="inlineDefaultRadiosExample8">
                    </div>
                  </th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>5</label></th>
                  <th><label>7</label></th>
                  <th><label>10</label></th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">No ha estado desempleado durante los últimos 18 meses.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="desempleado_0" name="inlineDefaultRadiosExample9">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="desempleado_5" name="inlineDefaultRadiosExample9">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene estabilidad económica.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_0" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_5" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="estabilidad_10" name="inlineDefaultRadiosExample10">
                    </div>
                  </th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th><label>10</label></th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Ha demostrado superación personal en los últimos 12 meses.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="superacion_0" name="inlineDefaultRadiosExample11">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="superacion_5" name="inlineDefaultRadiosExample11">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0</label></th>
                  <th><label>5</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th rowspan="2" class="txtPrev">Tiene dependientes económicos.</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="dependientes_0" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input onclick="sumadecheckbox(); sumaexito();" type="radio" class="custom-control-input" id="dependientes_5" name="inlineDefaultRadiosExample3">
                    </div>
                  </th>
                  <th>*</th>
                  <th>*</th>
                </tr>
                <tr>
                  <th><label>0 (1)</label></th>
                  <th><label>5 (+2)</label></th>
                  <th>*</th>
                  <th>*</th>
                </tr>

                <tr>
                  <input hidden value="0" onkeypress="sumaexito();" id="uno" type="text" name="uno">
                  <input hidden value="0" onchange="sumaexito();" id="dos" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="tres" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="cuatro" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="cinco" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="seis" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="siete" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="ocho" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="nueve" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="diez" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="once" type="text">
                  <input hidden value="0" onchange="sumaexito();" id="doce" type="text">
                </tr>
                <th colspan="5">

                  <label class="sumaPot">Suma de puntos potencial de éxito</label>
                  <input disabled type="text" id="sumaexito1" style="height:50px" class="form-control input-sm">
                  </center>
                </th>
                <input hidden id="sumapotencial" name="sumapotencial" value="">
                <input hidden id="mensajepotencial" name="mensajepotencial" value="">
              </form>
            </tbody>
          </table>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" id="potencial" data-dismiss="modal" data-toggle="modal" data-target="#modalPotencial_a">Actualizar y pasar a Evaluación PSP</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Modal para Potencial de agente-->
  <div class="modal fade" id="modalPotencial_a" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="potencialA">Potencial Agente</label>
          <table class="table table-striped table-bordered" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;" id="tablaPotencial_a">
            <thead>
              <tr>
                <th class="encabezadoPot_a">CRITERIO</th>
                <th class="encabezadoPot_a">SÍ</th>
                <th colspan="2" class="encabezadoPot_a">NO</th>
              </tr>
            </thead>
            <tbody>
              <form id="form_potA" name="form_potA" method="POST">
                <!-- Pregunta 1 -->
                <tr>
                  <th colspan="1" class="txtPot_a">1. ¿Qué facilidad tiene para conectar con las personas?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p1_potencialAgente" id="p1A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p1_potencialAgente" id="p1A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <!-- Pregunta 2 -->
                <tr>
                  <th colspan="1" class="txtPot_a">2. ¿Sus contactos consideran que tienes buena credibilidad profesional?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p2_potencialAgente" id="p2A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p2_potencialAgente" id="p2A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <!-- Pregunta 3 -->
                <tr>
                  <th colspan="1" class="txtPot_a">3. ¿Su experiencia en ventas es nula, empírica, básica, intermia o avanzada?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p3_potencialAgente" id="p3A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p3_potencialAgente" id="p3A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <!-- Pregunta 4 -->
                <tr>
                  <th colspan="1" class="txtPot_a">4. ¿El total de contactos son personas de redes sociales o por conocidos cercanos?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p4_potencialAgente" id="p4A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p4_potencialAgente" id="p4A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <!-- Pregunta 5 -->
                <tr>
                  <th colspan="1" class="txtPot_a">5. ¿El volumen de clientes fue por atención directa o por asignación de base de prospectos?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p5_potencialAgente" id="p5A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p5_potencialAgente" id="p5A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <thead>
                  <tr>
                    <th class="encabezadoPot_a">COMPROBACIÓN ECONÓMICA DE LA RED DE CONTACTOS</th>
                    <th class="encabezadoPot_a">+ 50%</th>
                    <th colspan="2" class="encabezadoPot_a">- 50%</th>
                  </tr>
                </thead>

                <!-- Pregunta 6 -->
                <tr>
                  <th colspan="1" class="txtPot_a">6. ¿Qué porcentaje consideras que gana más de $20,000.00 al mes?</th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p6_potencialAgente" id="p6A_1" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                  <th>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input" name="p6_potencialAgente" id="p6A_0" onclick="sumaRadio_a(); sumaexitoP_a();">
                    </div>
                  </th>
                </tr>

                <input hidden value="0" onkeypress="sumaexitoA();" id="uno_p1" type="text">
                <input hidden value="0" onkeypress="sumaexitoA();" id="dos_p2" type="text">
                <input hidden value="0" onkeypress="sumaexitoA();" id="tres_p3" type="text">
                <input hidden value="0" onkeypress="sumaexitoA();" id="cuatro_p4" type="text">
                <input hidden value="0" onkeypress="sumaexitoA();" id="cinco_p5" type="text">
                <input hidden value="0" onkeypress="sumaexitoA();" id="seis_p6" type="text">

                <th colspan="5">
                  <label class="sumaPot">Puntos potencial de agente</label>
                  <input disabled type="text" id="sumaexitoA" style="height:50px" class="form-control input-sm">
                </th>

                <input hidden id="sumapotencial_a" name="sumapotencial_a" value="">
              </form>
            </tbody>
          </table>
          <div class="modal-footer">
            <button type="button" value="" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#modalPSP">Pasar a Evaluación PSP</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Indicadores del psp -->
  <div class="modal fade" id="modalPSP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Indicadores PSP</b></h4>
        </div>
        <div class="modal-body">

          <label class="indicadoresPsp">Indicadores PSP</label>

          <label>Rendimiento de venta:</label>
          <select value="" id="rendimiento" name="rendimiento" class="form-control input-sm">
            <option selected disabled hidden value="">Selecciona:</option>
            <option value="Inferior al Promedio">INFERIOR AL PROMEDIO</option>
            <option value="Promedio">PROMEDIO</option>
            <option value="Superior al Promedio">SUPERIOR AL PROMEDIO</option>
          </select>
          <label>Precisión de evaluación:</label>
          <select id="precision" name="precision" value="" class="form-control input-sm">
            <option selected disabled hidden value="">Selecciona:</option>
            <option value="Exagerado">EXAGERADO</option>
            <option value="Precaucion">PRECAUCIÓN</option>
            <option value="Seguridad">SEGURIDAD</option>
          </select>
          <label>Estilo de ventas:</label>
          <select id="estilo" name="estilo" value="" class="form-control input-sm">
            <option selected disabled hidden value="">Selecciona:</option>
            <option value="Analitico">ANALÍTICO</option>
            <option value="Analitico/Dinamico">ANALÍTICO/DINÁMICO</option>
            <option value="Analitico/Interpersonal">ANALÍTICO/INTERPERSONAL </option>
            <option value="Dinamico">DINÁMICO</option>
            <option value="Dinamico/Analitico">DINÁMICO/ANALÍTICO</option>
            <option value="Dinamico/Interpersonal">DINÁMICO/INTERPERSONAL</option>
            <option value="Interpersonal">INTERPERSONAL</option>
            <option value="Interpersonal/Analitico">INTERPERSONAL/ANALÍTICO </option>
            <option value="Interpersonal/Dinamico">INTERPERSONAL/DINÁMICO</option>
            <option value="Interpersonal/Dinamico">NO SE PUEDE DETERMINAR</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" value="" class="btn btn-warning" id="psp" data-dismiss="modal">Actualizar PSP</button>
        </div>
      </div>
    </div>
  </div>

  <!--Entrevista GDD Modal -->
  <div class="modal fade" id="modalGDD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="afinidadEv">Intuitivo / Afinidad con Gerente</label>

          <label>Fecha Venta de Carrera:</label>
          <input type="date" name="" value="" id="fecha_ventaCarrera" class="form-control input-sm">


          <label>Gerente asignado:</label>
          <select id="gerente" class="form-control input-sm">
            <option selected disabled hidden value="">Selecciona:</option>
            <option value="Danielan">DANIELA</option>
            <!--<option value="Martin">MARTÍN</option>-->
            <option value="Nancyn">NANCY</option>
            <option value="Omarn">OMAR</option>
            <option value="Susanan">SUSANA</option>
          </select>
          <label>¿Llego a venta de carrera?</label>
          <select id="venta" class="form-control input-sm" onChange="mostrar2();">
            <option selected disabled hidden value="">Seleccione:</option>
            <option value="Si">SÍ</option>
            <option value="No">NO</option>
          </select>
          <div id="t_venta" name="t_venta" style="display:none;">
            <label>Resultado Entrevista Gerente:</label>
            <select id="res_gdd" class="form-control input-sm" onkeyup="res_gdd();">
              <option selected disabled hidden value="">Seleccione:</option>
              <option value="Si">SÍ</option>
              <option value="No">NO</option>
            </select>
            <label>Razones:</label>
            <input id="razon" placeholder="Ingrese las razones" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <label>PP200:</label>
            <select id="pp200" class="form-control input-sm" onchange="res_pp200();">
              <option selected disabled hidden value="">Seleccione:</option>
              <option value="Si">SÍ</option>
              <option value="No">NO</option>
            </select>
            <input id="pp200_observaciones" placeholder="Observaciones de PP200" style="display: none" class="form-control input-sm" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
            <label>Comentarios u observaciones GDD:</label>
            <textarea id="comentarios_gdd" rows="4" cols="38" placeholder="Escribe los comentarios" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" id="GDD">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!--Resultados -->
  <div class="modal fade" id="modalResultados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="estatusEv">Resultados</label>
          <label>Estatus de prospecto:</label>
          <select id="estatus" onChange="mostrarr();" class="form-control input-sm">
            <option selected disabled hidden value="">Seleccione:</option>
            <option value="Arranque">ARRANQUE</option>
            <option value="Declinó">DECLINÓ</option>
            <option value="Documentos incompletos">DOCUMENTOS INCOMPLETOS</option>
            <option value="Pendiente">PENDIENTE</option>
          </select>

          <div id="t_arranque" name="t_arranque" style="display:none;">
            <label>Arranque:</label>
            <select id="arranque" class="form-control input-sm">
              <option selected disabled hidden value="">Selecciona:</option>
              <option value="Si">SÍ</option>
              <option value="No">NO</option>
            </select>
            <label>Fecha de Inducción:</label>
            <input type="date" id="fecha_induccion" class="form-control input-sm">
            <label>Comentarios:</label>
            <textarea id="documentacion" rows="4" cols="38" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" onKeyUp="this.value=this.value.toUpperCase();">
          </textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" value="" class="btn btn-warning" id="resultados">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!--Conexion -->
  <div class="modal fade" id="modalConexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><b>Evaluación</b></h4>
        </div>
        <div class="modal-body">
          <label class="conexionEv">Conexión</label>

          <label>Conexión:</label>
          <select id="conexion" class="form-control input-sm">
            <option selected disabled hidden value="">Selecciona:</option>
            <option value="Provisional">PROVISIONAL</option>
            <option value="Definitiva">DEFINITIVA</option>
          </select>
           <label>CUA:</label>
                <input type="text" class="form-control input-sm" id="cua" name="" value="">
          <label>Fecha de Conexión:</label>
          <input type="date" class="form-control input-sm" id="fecha_conexion1" onchange="fc()">
          <input type="text" hidden id="fecha_conexion" name="" value="">
        </div>
        <div class="modal-footer">
          <button type="button" value="" class="btn btn-warning" id="cnx">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  <!--DETALLES / SIN USO-->
  <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalles</h4>
        </div>

        <center><label><strong><u>Linea del tiempo del folio</u></strong></label></center>
        <table class="table table-hover table-condensed table-bordered" id="tabladinamicaload">
          <thead>
            <td align="center"><small><b>Contacto</small></b></td>
            <td align="center"><small><b>Entrevista</small></b></td>
            <td align="center"><small><b>Inducción</small></b></td>
            <td align="center"><small><b>Conexión</small></b></td>
          </thead>
          <tbody>
            <tr align="center">
              <td align="center"><small><b>
                    <input type="text" value="" id="f_contacto" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_entrevista" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_induccion" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
              <td align="center"><small><b>
                    <input type="text" value="" id="f_conexion" class="form-control" style="border:none; width:65px; height:15px" disabled>
                    </input>
                </small></b></td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
    <script src="js/funciones1.js"></script>
  </div>

</body>

</html>


<script type="text/javascript">
  // Se manda a refrescar la tabla

function limpiarcolonia(){
   $("#cp").val("");
   $("#municipio").val("");
   $("#estado").val("");
    $("#colonia").empty();
}



function buscar_datos(){

  cp = $("#cp").val();
    
    var parametros = 
    {
      "buscar": "1",
      "cp" : cp
    };
    $.ajax(
    {
      data:  parametros,
      dataType: 'json',
      url:   'codigoP.php',
      type:  'GET',
      success:  function (data) 
      {
         /*

   cambio de texto   Variable para ver los datos traidos por json
         console.log(data)*/

/*         Se limpia el select por si se cambia el codigo postal
*/
        $("#colonia").empty();
 
/*   Este for es para poner las colonias en el select de colonia
*/
         for (var i = 0; i < data.length; i++) {
               $('#colonia').append($('<option>', {
                                     value: data[i].colonia,
                                     text: data[i].colonia
                                 }));

                      $("#estado").val(data[i].estado);
                       $("#municipio").val(data[i].municipio);

                    }
/*                    Cierre for 
*/       
      } /*  cierre success*/

    }) /*  cierre ajax*/

}     /*  cierre funcion buscar_datos*/





  $(document).ready(function() {
    $('#tabla').load('componentes/tabla.php');
  });

  // Muestra el Input en el modal de Nuevo Prospecto/Referido
  $(document).ready(function() {
    $('#checkbox').on('change', function() {
      if (this.checked) {
        $("#referido").show();
      } else {
        $("#referido").hide();
      }
    })
  });

  $(document).ready(function() {
    $('#modalNuevo').on('hidden.bs.modal', function() {
      $(this).find("input,textarea,select,checkbox").val('').end();
    });
  });

  // Actualización de los datos
  $(document).ready(function() {

    //Agregar nuevo
    $('#guardarnuevo').click(function() {
      edat = $('#edat').val();
      fecha_contacto = $('#fecha_contacto').val();
      nombre = $('#nombre').val();
      apellido = $('#apellido').val();
      amaterno = $('#amaterno').val();
      fechareg = $('#fechareg').val();
      telefono = $('#telefono').val();
      correo = $('#correo').val();
      fuente = $('#fuente').val();
      referido = $('#referido').val();
      resultado_llamada = $('#resultado_llamada').val();
      fecha_cita = $('#fecha_cita').val();
      hora_cita = $('#hora_cita').val();

      // Alerta para confirmar si la fecha de contacto en el modal nuevo prospecto es la correcta
      if (fecha_contacto == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese una Fecha de Contacto para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;
      } 

               // Alerta para confirmar si la fecha de contacto en el modal nuevo prospecto es la correcta
      else if (nombre == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese un Nombre para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;

        }      // Alerta para confirmar si la fecha de contacto en el modal nuevo prospecto es la correcta
      else if (apellido == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese un Apellido para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
      return false;

     }   else if (fecha_contacto) {
        swal({
            title: "¡Verifica!",
            text: "La Fecha de Contacto registrada es: " + fecha_contacto,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Corregir",
            confirmButtonColor: "#449d44",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            customClass: "Custom_Cancel"
          },
          function(isConfirm) {
            if (isConfirm) {
              if (resultado_llamada !== 'CITA') {
                agregardatos(edat, fecha_contacto, nombre, apellido, amaterno, fechareg, telefono, correo, fuente, referido, resultado_llamada, fecha_cita, hora_cita);
                reload();
              } else if (resultado_llamada == 'CITA' && fecha_cita == '') {
                swal({
                  title: "¡Error!",
                  text: "Ingrese una Fecha de Cita para continuar",
                  type: "error",
                  customClass: 'swal-wide',
                  allowOutsideClick: false
                });
                return false;
              } else if (fecha_cita) {
                swal({
                    title: "¡Verifica!",
                    text: "La Fecha Cita registrada es: " + fecha_cita,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Corregir",
                    confirmButtonColor: "#449d44",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                    customClass: "Custom_Cancel"
                  },
                  function() {
                    agregardatos(edat, fecha_contacto, nombre, apellido, amaterno, fechareg, telefono, correo, fuente, referido, resultado_llamada, fecha_cita, hora_cita);
                    reload();
                  });
              }
            }

          });
      }
    });

    // Actualiza los datos del nuevo prospecto ingresado
    $('#actualizadatos').click(function() {
      fecha_cita = $('#fecha_citau').val();
      // Alerta para confirmar si la fecha registrada en la cita es la correcta
      if (fecha_cita == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese una Fecha Cita para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;
      } else if (fecha_cita) {
        swal({
            title: "¡Verifica!",
            text: "La Fecha Cita registrada es: " + fecha_cita,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Corregir",
            confirmButtonColor: "#449d44",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            customClass: "Custom_Cancel"
          },
          function() {
            actualizadatos();
            reload();
          });
      }
    });

    // Elimina registro
    $('#eliminar').click(function() {
      eliminar();
    });

    // Evaluacion
    $('#factores_vitales').click(function() {
      fecha_evaluacion = $('#fecha_evaluacion').val();
      // Alerta para confirmar si la fecha de evaluación es la correcta
      if (fecha_evaluacion == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese una Fecha de Evaluación para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;
      } else if (fecha_evaluacion) {
        swal({
            title: "¡Verifica!",
            text: "La Fecha de Evaluación registrada es: " + fecha_evaluacion,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Corregir",
            confirmButtonColor: "#449d44",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            customClass: "Custom_Cancel"
          },
          function(isConfirm) {
            if (isConfirm) {
              $('#modalEvaluacion').modal('hide');
              swal.close();
              $('#modalknowout').modal('show');
              actualizafactores();
            }
          });
      }
    });

    $('#actualizaficha').click(function() {
      actualizaficha();
    });

    $('#knowout').click(function() {
      actualizako();
    });

    $('#potencial').click(function() {
      actualizapotencial();
    });

    $('#psp').click(function() {
      actualizapsp();
    });

    // Entrevista GDD/Venta de carrera 
    $('#GDD').click(function() {
      fecha_ventaCarrera = $('#fecha_ventaCarrera').val();
      // Alerta para confirmar si la fecha registrada en la venta de carrera es la correcta
      if (fecha_ventaCarrera == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese una Fecha Venta de Carrera para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;
      } else if (fecha_ventaCarrera) {
        swal({
            title: "¡Verifica!",
            text: "La Fecha Venta de Carrera registrada es: " + fecha_ventaCarrera,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Corregir",
            confirmButtonColor: "#449d44",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            customClass: "Custom_Cancel"
          },
          function() {
            actualizagdd();
            reload();
          });
      }
    });

    // Resultados/Inducción-Varios modales
    $('#resultados').click(function() {
      estatus = $('#estatus').val();
      fecha_induccion = $('#fecha_induccion').val();
      // Alerta para confirmar si la fecha de evaluación es la correcta
      if (estatus == 'Arranque') {
        if (fecha_induccion == '') {
          swal({
            title: "¡Error!",
            text: "Ingrese una Fecha de Inducción para continuar",
            type: "error",
            customClass: 'swal-wide',
            allowOutsideClick: false
          });
          return false;
        } else if (fecha_induccion) {
          swal({
              title: "¡Verifica!",
              text: "La Fecha de Inducción registrada es: " + fecha_induccion,
              type: "warning",
              showCancelButton: true,
              cancelButtonText: "Corregir",
              confirmButtonColor: "#449d44",
              confirmButtonText: "Ok",
              closeOnConfirm: false,
              customClass: "Custom_Cancel"
            },
            function() {
              actualizaresultado();
              reload();
            });
        }
      } else {
        actualizaresultado();
        reload();
      }

    });

    // Conexion
    $('#cnx').click(function() {
      fecha_conexion1 = $('#fecha_conexion1').val();
      // Alerta para confirmar si la fecha registrada en la venta de carrera es la correcta
      if (fecha_conexion1 == '') {
        swal({
          title: "¡Error!",
          text: "Ingrese una Fecha de Conexión para continuar",
          type: "error",
          customClass: 'swal-wide',
          allowOutsideClick: false
        });
        return false;
      } else if (fecha_conexion1) {
        swal({
            title: "¡Verifica!",
            text: "La Fecha Conexión registrada es: " + fecha_conexion1,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Corregir",
            confirmButtonColor: "#449d44",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            customClass: "Custom_Cancel"
          },
          function() {
            actualizacnx();
            reload();
          });
      }
    });

  });

  // Inicializa la funcion cuando el query este listo para los eventos
  jQuery(document).ready(function() {
    // Escuchando el evento de entrada
    jQuery("#telefono").on('input', function(evt) {
      // Permite solo numeros
      jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
  });

  // Solo se ingresan números
  jQuery(document).ready(function() {
    // Escuchando el evento de entrada
    jQuery("#telefonou").on('input', function(evt) {
      // Permite solo numeros
      jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
  });

  // Validación del campo E-mail
  document.getElementById('correo').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK');

    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
      valido.innerText = "";
    } else {
      valido.innerText = "Incorrecto, debe tener el formato correo@dominio.com\n" + "";
    }
  });

  function copiar() {
    document.getElementById("fuente").value = document.getElementById("fuente2").value;
  }

  // Funcion para mostrar si hay cita con el prospecto/agendarla
  function mostrar() {
    var opcion = document.getElementById("resultado_llamada").value;
    // alert(opcion);
    if (opcion == "CITA") {
      document.getElementById('res_cita').style.display = 'block';
    } else {
      document.getElementById('res_cita').style.display = 'none';
    }
  }

  // Función para ficha de identidad
  function mostrar1() {
    var opcion = document.getElementById("acudio").value;

    if (opcion == "Si") {
      document.getElementById('t_entrevista').style.display = 'block';
    } else {
      document.getElementById('t_entrevista').style.display = 'none';
    }
  }

  function mostrarcarrera() {
    //  PAra aparecer o desaparecer
    var opcion = document.getElementById("escolaridad").value;
    //alert(opcion);
    if (opcion == "BACHILLERATO CONCLUIDO" || "0") {
      document.getElementById('label_carrera').style.display = 'none';
      document.getElementById('carrera').style.display = 'none';
    }
    if (opcion != "BACHILLERATO CONCLUIDO") {
      document.getElementById('label_carrera').style.display = 'block';
      document.getElementById('carrera').style.display = 'block';
    }
  }

  function suma_vitales() {
    //Script para suma de datos al cargar la pagina suma automaticamente y cuando se cambia o se toca algun boton igual se actualiza automaticamente
    var caracter = document.getElementById("caracter").value;
    var sentido = document.getElementById("sentido").value;
    var orientacion = document.getElementById("orientacion").value;
    var energia = document.getElementById("energia").value;
    var motivacion = document.getElementById("motivacion").value;
    var perseverancia = document.getElementById("perseverancia").value;

    document.getElementById("suma_vitales").value = parseFloat(caracter) + parseFloat(sentido) + parseFloat(orientacion) + parseFloat(energia) + parseFloat(motivacion) + parseFloat(perseverancia);
  }

  function contarcheckbox() {
    var cant = 0;
    if (document.getElementById('kopatron').checked) {
      cant++;
    }
    if (document.getElementById('koenergia').checked) {
      cant++;
    }
    if (document.getElementById('kohabitos').checked) {
      cant++;
    }
    if (document.getElementById('komercado').checked) {
      cant++;
    }
    if (document.getElementById('komovilidad').checked) {
      cant++;
    }
    if (document.getElementById('kodeudas').checked) {
      cant++;
    }
    if (document.getElementById('koculpa').checked) {
      cant++;
    }
    if (document.getElementById('koseguros').checked) {
      cant++;
    }
    if (document.getElementById('kodivorciado').checked) {
      cant++;
    }
    if (document.getElementById('koinestable').checked) {
      cant++;
    }
    if (document.getElementById('koretroceso').checked) {
      cant++;
    }
    if (document.getElementById('koconfort').checked) {
      cant++;
    }
    if (document.getElementById('kodesesperado').checked) {
      cant++;
    }
    if (document.getElementById('kocolchon').checked) {
      cant++;
    }
    if (cant == 0) {
      document.getElementById("koresultado").value = "Aceptable.";
    }
    if (cant == 1) {
      document.getElementById("koresultado").value = "1 Factor = Preocupante.";
    }
    if (cant == 2) {
      document.getElementById("koresultado").value = ("2 Factores = Menos del 50% de \n probabilidad de éxito.");
    }
    if (cant >= 3) {
      document.getElementById("koresultado").value = "3 Factores = No continuar.";
    }
  }

  //funciones primera linea recomendado
  function sumadecheckbox() {
    //primer linea
    var reco_0 = document.getElementById("reco_0").checked;
    var reco_20 = document.getElementById("reco_20").checked;
    if (reco_0 == true) {
      document.getElementById("uno").value = "0";
    }
    if (reco_20 == true) {
      document.getElementById("uno").value = "20";
    }
    //segunda linea
    var orientacion_0 = document.getElementById("orientacion_0").checked;
    var orientacion_10 = document.getElementById("orientacion_10").checked;
    var orientacion_15 = document.getElementById("orientacion_15").checked;
    var orientacion_20 = document.getElementById("orientacion_20").checked;
    if (orientacion_0 == true) {
      document.getElementById("dos").value = "0";
    }
    if (orientacion_10 == true) {
      document.getElementById("dos").value = "10";
    }
    if (orientacion_15 == true) {
      document.getElementById("dos").value = "15";
    }
    if (orientacion_20 == true) {
      document.getElementById("dos").value = "20";
    }
    //tercera linea
    var potencial_0 = document.getElementById("potencial_0").checked;
    var potencial_10 = document.getElementById("potencial_10").checked;
    var potencial_15 = document.getElementById("potencial_15").checked;
    var potencial_20 = document.getElementById("potencial_20").checked;
    if (potencial_0 == true) {
      document.getElementById("tres").value = "0";
    }
    if (potencial_10 == true) {
      document.getElementById("tres").value = "10";
    }
    if (potencial_15 == true) {
      document.getElementById("tres").value = "15";
    }
    if (potencial_20 == true) {
      document.getElementById("tres").value = "20";
    }
    //cuarta linea
    var actitud_0 = document.getElementById("actitud_0").checked;
    var actitud_10 = document.getElementById("actitud_10").checked;
    var actitud_15 = document.getElementById("actitud_15").checked;
    var actitud_20 = document.getElementById("actitud_20").checked;
    if (actitud_0 == true) {
      document.getElementById("cuatro").value = "0";
    }
    if (actitud_10 == true) {
      document.getElementById("cuatro").value = "10";
    }
    if (actitud_15 == true) {
      document.getElementById("cuatro").value = "15";
    }
    if (actitud_20 == true) {
      document.getElementById("cuatro").value = "20";
    }
    //quinta linea
    var exito_0 = document.getElementById("exito_0").checked;
    var exito_10 = document.getElementById("exito_10").checked;
    if (exito_0 == true) {
      document.getElementById("cinco").value = "0";
    }
    if (exito_10 == true) {
      document.getElementById("cinco").value = "10";
    }
    //sexta linea
    var ingreso_0 = document.getElementById("ingreso_0").checked;
    var ingreso_10 = document.getElementById("ingreso_10").checked;
    if (ingreso_0 == true) {
      document.getElementById("seis").value = "0";
    }
    if (ingreso_10 == true) {
      document.getElementById("seis").value = "10";
    }
    //septima linea
    var titulo_0 = document.getElementById("titulo_0").checked;
    var titulo_10 = document.getElementById("titulo_10").checked;
    if (titulo_0 == true) {
      document.getElementById("siete").value = "0";
    }
    if (titulo_10 == true) {
      document.getElementById("siete").value = "10";
    }
    //octava linea
    var seguro_5 = document.getElementById("seguro_5").checked;
    var seguro_7 = document.getElementById("seguro_7").checked;
    var seguro_10 = document.getElementById("seguro_10").checked;
    if (seguro_5 == true) {
      document.getElementById("ocho").value = "0";
    }
    if (seguro_7 == true) {
      document.getElementById("ocho").value = "7";
    }
    if (seguro_10 == true) {
      document.getElementById("ocho").value = "10";
    }
    //novena linea
    var desempleado_0 = document.getElementById("desempleado_0").checked;
    var desempleado_5 = document.getElementById("desempleado_5").checked;
    if (desempleado_0 == true) {
      document.getElementById("nueve").value = "0";
    }
    if (desempleado_5 == true) {
      document.getElementById("nueve").value = "5";
    }
    //decima linea
    var estabilidad_0 = document.getElementById("estabilidad_0").checked;
    var estabilidad_5 = document.getElementById("estabilidad_5").checked;
    var estabilidad_10 = document.getElementById("estabilidad_10").checked;
    if (estabilidad_0 == true) {
      document.getElementById("diez").value = "0";
    }
    if (estabilidad_5 == true) {
      document.getElementById("diez").value = "5";
    }
    if (estabilidad_10 == true) {
      document.getElementById("diez").value = "10";
    }
    //undecimo linea
    var superacion_0 = document.getElementById("superacion_0").checked;
    var superacion_5 = document.getElementById("superacion_5").checked;
    if (superacion_0 == true) {
      document.getElementById("once").value = "0";
    }
    if (superacion_5 == true) {
      document.getElementById("once").value = "5";
    }
    //duodecimo linea
    var dependientes_0 = document.getElementById("dependientes_0").checked;
    var dependientes_5 = document.getElementById("dependientes_5").checked;
    if (dependientes_0 == true) {
      document.getElementById("doce").value = "0";
    }
    if (dependientes_5 == true) {
      document.getElementById("doce").value = "5";
    }
  };

  function sumaexito() {

    var uno = document.getElementById("uno").value;
    var dos = document.getElementById("dos").value;
    var tres = document.getElementById("tres").value;
    var cuatro = document.getElementById("cuatro").value;
    var cinco = document.getElementById("cinco").value;
    var seis = document.getElementById("seis").value;
    var siete = document.getElementById("siete").value;
    var ocho = document.getElementById("ocho").value;
    var nueve = document.getElementById("nueve").value;
    var diez = document.getElementById("diez").value;
    var once = document.getElementById("once").value;
    var doce = document.getElementById("doce").value;

    var suma = parseInt(uno) + parseInt(dos) + parseInt(tres) + parseInt(cuatro) + parseInt(cinco) + parseInt(seis) + parseInt(siete) + parseInt(ocho) + parseInt(nueve) + parseInt(diez) + parseInt(once) + parseInt(doce);

    if (suma <= "65") {
      document.getElementById("sumaexito1").value = "La suma es: " + suma + " No Califica.";
      document.getElementById("sumapotencial").value = suma;
      document.getElementById("mensajepotencial").value = "No Califica";
    }
    if (suma >= "66" && suma <= "79") {
      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Dudoso.";
      document.getElementById("sumapotencial").value = suma;
      document.getElementById("mensajepotencial").value = "Dudoso";
    }
    if (suma >= "80" && suma <= "99") {
      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Aceptable.";
      document.getElementById("sumapotencial").value = suma;
      document.getElementById("mensajepotencial").value = "Aceptable";
    }
    if (suma >= "99") {
      document.getElementById("sumaexito1").value = "La suma es: " + suma + " Superior.";
      document.getElementById("sumapotencial").value = suma;
      document.getElementById("mensajepotencial").value = "Superior";
    }
  }

  function mostrar2() {
    var opcion = document.getElementById("venta").value;

    if (opcion == "Si") {
      document.getElementById('t_venta').style.display = 'block';
    } else {
      document.getElementById('t_venta').style.display = 'none';
    }
  }

  function res_pp200() {
    var res = document.getElementById("pp200").value;
    if (res == "Si") {
      document.getElementById("pp200_observaciones").style.display = 'block';
    }
    if (res != "Si") {
      document.getElementById("pp200_observaciones").style.display = 'none';
    }
  }

  function mostrarr() {
    var opcion = document.getElementById("estatus").value;

    if (opcion == "Arranque") {
      document.getElementById('t_arranque').style.display = 'block';
    } else {
      document.getElementById('t_arranque').style.display = 'none';
    }
  }

  // Formato para decimales
  $('input.number').keyup(function(event) {
    // skip for arrow keys
    if (event.which >= 37 && event.which <= 40) {
      event.preventDefault();
    }

    $(this).val(function(index, value) {
      return value
        .replace(/\D/g, "")
        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  });

  function fc() {
    var fc1 = document.getElementById("fecha_conexion1").value;
    document.getElementById("fecha_conexion").value = fc1;

  };

  function fc2() {
    var fc21 = document.getElementById("fecha_conexion").value;
    document.getElementById("fecha_conexion1").value = fc21;
  }

  //FUNCIONES PARA EL MODAL DE POTENCIAL DE AGENTE
  function sumaRadio_a() {
    // Pregunta 1
    var p1A_1 = document.getElementById("p1A_1").checked;
    var p1A_0 = document.getElementById("p1A_0").checked;
    if (p1A_1 == true) {
      document.getElementById("uno_p1").value = "1";
    }
    if (p1A_0 == true) {
      document.getElementById("uno_p1").value = "0";
    }

    // Pregunta 2
    var p2A_1 = document.getElementById("p2A_1").checked;
    var p2A_0 = document.getElementById("p2A_0").checked;
    if (p2A_1 == true) {
      document.getElementById("dos_p2").value = "1";
    }
    if (p2A_0 == true) {
      document.getElementById("dos_p2").value = "0";
    }

    // Pregunta 3
    var p3A_1 = document.getElementById("p3A_1").checked;
    var p3A_0 = document.getElementById("p3A_0").checked;
    if (p3A_1 == true) {
      document.getElementById("tres_p3").value = "1";
    }
    if (p3A_0 == true) {
      document.getElementById("tres_p3").value = "0";
    }

    // Pregunta 4
    var p4A_1 = document.getElementById("p4A_1").checked;
    var p4A_0 = document.getElementById("p4A_0").checked;
    if (p4A_1 == true) {
      document.getElementById("cuatro_p4").value = "1";
    }
    if (p4A_0 == true) {
      document.getElementById("cuatro_p4").value = "0";
    }

    // Pregunta 5
    var p5A_1 = document.getElementById("p5A_1").checked;
    var p5A_0 = document.getElementById("p5A_0").checked;
    if (p5A_1 == true) {
      document.getElementById("cinco_p5").value = "1";
    }
    if (p5A_0 == true) {
      document.getElementById("cinco_p5").value = "0";
    }

    // Pregunta 6
    var p6A_1 = document.getElementById("p6A_1").checked;
    var p6A_0 = document.getElementById("p6A_0").checked;
    if (p6A_1 == true) {
      document.getElementById("seis_p6").value = "1";
    }
    if (p6A_0 == true) {
      document.getElementById("seis_p6").value = "0";
    }

  }

  function sumaexitoP_a() {
    var uno_p1 = document.getElementById("uno_p1").value;
    var dos_p2 = document.getElementById("dos_p2").value;
    var tres_p3 = document.getElementById("tres_p3").value;
    var cuatro_p4 = document.getElementById("cuatro_p4").value;
    var cinco_p5 = document.getElementById("cinco_p5").value;
    var seis_p6 = document.getElementById("seis_p6").value;

    var sumaAgente = parseInt(uno_p1) + parseInt(dos_p2) + parseInt(tres_p3) + parseInt(cuatro_p4) + parseInt(cinco_p5) + parseInt(seis_p6);

    if (sumaAgente <= "2") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " Bajo.";
    }

    if (sumaAgente >= "3") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " Medio.";
    }

    if (sumaAgente >= "5") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " Alto.";
    }

    if ($('#p6A_1').prop('checked') && sumaAgente >= "2") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " tendencia a ser medio.";
    }

    if ($('#p6A_1').prop('checked') && sumaAgente >= "4") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " tendencia a ser alto.";
    }

    if ($('#p6A_1').prop('checked') && sumaAgente >= "6") {
      document.getElementById("sumaexitoA").value = "La suma es: " + sumaAgente + " Perfil Alto.";
    }

  }
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