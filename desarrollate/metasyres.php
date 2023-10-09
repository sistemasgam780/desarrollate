 <?php
  error_reporting(0);

  require_once "php/conexion.php";

  $conexion = conexion();

  session_start();
  $edat = $_SESSION['user'];

  if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
  {
    die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
  }
  //**********Grafica anual primero se definen los 12 meses del año en variables para utilizarlos en las consultas*********
  $eneroi = date('Y') . ("-01-01");
  $enerof = date('Y') . ("-01-31");

  $febreroi = date('Y') . ("-02-01");
  $febrerof = date('Y') . ("-02-31");

  $marzoi = date('Y') . ("-03-01");
  $marzof = date('Y') . ("-03-31");

  $abrili = date('Y') . ("-04-01");
  $abrilf = date('Y') . ("-04-31");

  $mayoi = date('Y') . ("-05-01");
  $mayof = date('Y') . ("-05-31");

  $junioi = date('Y') . ("-06-01");
  $juniof = date('Y') . ("-06-31");

  $julioi = date('Y') . ("-07-01");
  $juliof = date('Y') . ("-07-31");

  $agostoi = date('Y') . ("-08-01");
  $agostof = date('Y') . ("-08-31");

  $septiembrei = date('Y') . ("-09-01");
  $septiembref = date('Y') . ("-09-31");

  $octubrei = date('Y') . ("-10-01");
  $octubref = date('Y') . ("-10-31");

  $noviembrei = date('Y') . ("-11-01");
  $noviembref = date('Y') . ("-11-31");

  $diciembrei = date('Y') . ("-12-01");
  $diciembref = date('Y') . ("-12-31");

  //Comienza la consulta para saber en que meses hay tal resultado, vamos a poner los cuatro principales contactos, citas, arranques y conexiones.
  //Enero
  //contactos
  $eneroci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $eneroi . "' and fechareg <= '" . $enerof . "'";
  $enero_result_ci = $conexion->query($eneroci);
  $enero_ci = mysqli_num_rows($enero_result_ci);
  //Citas
  $enerocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $eneroi . "' and fechareg <= '" . $enerof . "' and acudio_entrevista = 'Si'";
  $enero_result_cit = $conexion->query($enerocit);
  $enero_cit = mysqli_num_rows($enero_result_cit);
  //arranque
  $eneroarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $eneroi . "' and fechareg <= '" . $enerof . "' and arranque = 'Si'";
  $enero_result_arra = $conexion->query($eneroarra);
  $enero_arra = mysqli_num_rows($enero_result_arra);
  //Conexion
  $enerocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $eneroi . "' and fechareg <= '" . $enerof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $enero_result_con = $conexion->query($enerocon);
  $enero_con = mysqli_num_rows($enero_result_con);

  //Febrero
  //contactos
  $febreroci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $febreroi . "' and fechareg <= '" . $febrerof . "'";
  $febrero_result_ci = $conexion->query($febreroci);
  $febrero_ci = mysqli_num_rows($febrero_result_ci);
  //citas
  $febrerocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $febreroi . "' and fechareg <= '" . $febrerof . "' and acudio_entrevista = 'Si'";
  $febrero_result_cit = $conexion->query($febrerocit);
  $febrero_cit = mysqli_num_rows($febrero_result_cit);
  //arranque
  $febreroarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $febreroi . "' and fechareg <= '" . $febrerof . "' and arranque = 'Si'";
  $febrero_result_arra = $conexion->query($febreroarra);
  $febrero_arra = mysqli_num_rows($febrero_result_arra);
  //conexion
  $febrerocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $febreroi . "' and fechareg <= '" . $febrerof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $febrero_result_con = $conexion->query($febrerocon);
  $febrero_con = mysqli_num_rows($febrero_result_con);

  //Marzo
  //contactos
  $marzoci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $marzoi . "' and fechareg <= '" . $marzof . "'";
  $marzo_result_ci = $conexion->query($marzoci);
  $marzo_ci = mysqli_num_rows($marzo_result_ci);
  //citas
  $marzocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $marzoi . "' and fechareg <= '" . $marzof . "' and acudio_entrevista = 'Si'";
  $marzo_result_cit = $conexion->query($marzocit);
  $marzo_cit = mysqli_num_rows($marzo_result_cit);
  //arranque
  $marzoarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $marzoi . "' and fechareg <= '" . $marzof . "' and arranque = 'Si'";
  $marzo_result_arra = $conexion->query($marzoarra);
  $marzo_arra = mysqli_num_rows($marzo_result_arra);
  //conexion
  $marzocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $marzoi . "' and fechareg <= '" . $marzof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $marzo_result_con = $conexion->query($marzocon);
  $marzo_con = mysqli_num_rows($marzo_result_con);

  //Abril
  //contactos
  $abrilci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $abrili . "' and fechareg <= '" . $abrilf . "'";
  $abril_result_ci = $conexion->query($abrilci);
  $abril_ci = mysqli_num_rows($abril_result_ci);
  //citas
  $abrilcit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $abrili . "' and fechareg <= '" . $abrilf . "' and acudio_entrevista = 'Si'";
  $abril_result_cit = $conexion->query($abrilcit);
  $abril_cit = mysqli_num_rows($abril_result_cit);
  //arranques
  $abrilarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $abrili . "' and fechareg <= '" . $abrilf . "' and arranque = 'Si'";
  $abril_result_arra = $conexion->query($abrilarra);
  $abril_arra = mysqli_num_rows($abril_result_arra);
  //conexiones
  $abrilcon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $abrili . "' and fechareg <= '" . $abrilf . "' and  conexion = ('Provisional' or 'Definitiva')";
  $abril_result_con = $conexion->query($abrilcon);
  $abril_con = mysqli_num_rows($abril_result_con);

  //Mayo
  //contactos
  $mayoci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $mayoi . "' and fechareg <= '" . $mayof . "'";
  $mayo_result_ci = $conexion->query($mayoci);
  $mayo_ci = mysqli_num_rows($mayo_result_ci);
  //citas
  $mayocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $mayoi . "' and fechareg <= '" . $mayof . "' and acudio_entrevista = 'Si'";
  $mayo_result_cit = $conexion->query($mayocit);
  $mayo_cit = mysqli_num_rows($mayo_result_cit);
  //arranque
  $mayoarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $mayoi . "' and fechareg <= '" . $mayof . "' and arranque = 'Si'";
  $mayo_result_arra = $conexion->query($mayoarra);
  $mayo_arra = mysqli_num_rows($mayo_result_arra);
  //conexiones
  $mayocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $mayoi . "' and fechareg <= '" . $mayof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $mayo_result_con = $conexion->query($mayocon);
  $mayo_con = mysqli_num_rows($mayo_result_con);

  //Junio
  //contactos
  $junioci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $junioi . "' and fechareg <= '" . $juniof . "'";
  $junio_result_ci = $conexion->query($junioci);
  $junio_ci = mysqli_num_rows($junio_result_ci);
  //citas
  $juniocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $junioi . "' and fechareg <= '" . $juniof . "' and acudio_entrevista = 'Si'";
  $junio_result_cit = $conexion->query($juniocit);
  $junio_cit = mysqli_num_rows($junio_result_cit);
  //arranques
  $junioarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $junioi . "' and fechareg <= '" . $juniof . "' and arranque = 'Si'";
  $junio_result_arra = $conexion->query($junioarra);
  $junio_arra = mysqli_num_rows($junio_result_arra);
  //conexiones
  $juniocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $junioi . "' and fechareg <= '" . $juniof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $junio_result_con = $conexion->query($juniocon);
  $junio_con = mysqli_num_rows($junio_result_con);

  //Julio
  //contactos
  $julioci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $julioi . "' and fechareg <= '" . $juliof . "'";
  $julio_result_ci = $conexion->query($julioci);
  $julio_ci = mysqli_num_rows($julio_result_ci);
  //citas
  $juliocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $julioi . "' and fechareg <= '" . $juliof . "' and acudio_entrevista = 'Si'";
  $julio_result_cit = $conexion->query($juliocit);
  $julio_cit = mysqli_num_rows($julio_result_cit);
  //arranques
  $julioarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $julioi . "' and fechareg <= '" . $juliof . "' and arranque = 'Si'";
  $julio_result_arra = $conexion->query($julioarra);
  $julio_arra = mysqli_num_rows($julio_result_arra);
  //conexion
  $juliocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $julioi . "' and fechareg <= '" . $juliof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $julio_result_con = $conexion->query($juliocon);
  $julio_con = mysqli_num_rows($julio_result_con);

  //Agosto
  //contactos
  $agostoci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $agostoi . "' and fechareg <= '" . $agostof . "'";
  $agosto_result_ci = $conexion->query($agostoci);
  $agosto_ci = mysqli_num_rows($agosto_result_ci);
  //citas
  $agostocit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $agostoi . "' and fechareg <= '" . $agostof . "' and acudio_entrevista = 'Si'";
  $agosto_result_cit = $conexion->query($agostocit);
  $agosto_cit = mysqli_num_rows($agosto_result_cit);
  //arranque
  $agostoarra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $agostoi . "' and fechareg <= '" . $agostof . "' and arranque = 'Si'";
  $agosto_result_arra = $conexion->query($agostoarra);
  $agosto_arra = mysqli_num_rows($agosto_result_arra);
  //conexion
  $agostocon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $agostoi . "' and fechareg <= '" . $agostof . "' and  conexion = ('Provisional' or 'Definitiva')";
  $agosto_result_con = $conexion->query($agostocon);
  $agosto_con = mysqli_num_rows($agosto_result_con);

  //Septiembre
  //contactos
  $septiembreci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $septiembrei . "' and fechareg <= '" . $septiembref . "'";
  $septiembre_result_ci = $conexion->query($septiembreci);
  $septiembre_ci = mysqli_num_rows($septiembre_result_ci);
  //citas
  $septiembrecit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $septiembrei . "' and fechareg <= '" . $septiembref . "' and acudio_entrevista = 'Si'";
  $septiembre_result_cit = $conexion->query($septiembrecit);
  $septiembre_cit = mysqli_num_rows($septiembre_result_cit);
  //arranque
  $septiembrearra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $septiembrei . "' and fechareg <= '" . $septiembref . "' and arranque = 'Si'";
  $septiembre_result_arra = $conexion->query($septiembrearra);
  $septiembre_arra = mysqli_num_rows($septiembre_result_arra);
  //conexion
  $septiembrecon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $septiembrei . "' and fechareg <= '" . $septiembref . "' and  conexion = ('Provisional' or 'Definitiva')";
  $septiembre_result_con = $conexion->query($septiembrecon);
  $septiembre_con = mysqli_num_rows($septiembre_result_con);

  //octubre
  //contactos
  $octubreci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $octubrei . "' and fechareg <= '" . $octubref . "'";
  $octubre_result_ci = $conexion->query($octubreci);
  $octubre_ci = mysqli_num_rows($octubre_result_ci);
  //citas
  $octubrecit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $octubrei . "' and fechareg <= '" . $octubref . "' and acudio_entrevista = 'Si'";
  $octubre_result_cit = $conexion->query($octubrecit);
  $octubre_cit = mysqli_num_rows($octubre_result_cit);
  //arranque
  $octubrearra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $octubrei . "' and fechareg <= '" . $octubref . "' and arranque = 'Si'";
  $octubre_result_arra = $conexion->query($octubrearra);
  $octubre_arra = mysqli_num_rows($octubre_result_arra);
  //conexion
  $octubrecon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $octubrei . "' and fechareg <= '" . $octubref . "' and  conexion = ('Provisional' or 'Definitiva')";
  $octubre_result_con = $conexion->query($octubrecon);
  $octubre_con = mysqli_num_rows($octubre_result_con);

  //Noviembre
  //contactos
  $noviembreci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $noviembrei . "' and fechareg <= '" . $noviembref . "'";
  $noviembre_result_ci = $conexion->query($noviembreci);
  $noviembre_ci = mysqli_num_rows($noviembre_result_ci);
  //citas
  $noviembrecit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $noviembrei . "' and fechareg <= '" . $noviembref . "' and acudio_entrevista = 'Si'";
  $noviembre_result_cit = $conexion->query($noviembrecit);
  $noviembre_cit = mysqli_num_rows($noviembre_result_cit);
  //arranques
  $noviembrearra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $noviembrei . "' and fechareg <= '" . $noviembref . "' and arranque = 'Si'";
  $noviembre_result_arra = $conexion->query($noviembrearra);
  $noviembre_arra = mysqli_num_rows($noviembre_result_arra);
  //conexiones
  $noviembrecon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $noviembrei . "' and fechareg <= '" . $noviembref . "' and  conexion = ('Provisional' or 'Definitiva')";
  $noviembre_result_con = $conexion->query($noviembrecon);
  $noviembre_con = mysqli_num_rows($noviembre_result_con);

  //Diciembre
  //contactos
  $diciembreci = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $diciembrei . "' and fechareg <= '" . $diciembref . "'";
  $diciembre_result_ci = $conexion->query($diciembreci);
  $diciembre_ci = mysqli_num_rows($diciembre_result_ci);
  //citas
  $diciembrecit = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $diciembrei . "' and fechareg <= '" . $diciembref . "' and acudio_entrevista = 'Si'";
  $diciembre_result_cit = $conexion->query($diciembrecit);
  $diciembre_cit = mysqli_num_rows($diciembre_result_cit);
  //arranque
  $diciembrearra = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $diciembrei . "' and fechareg <= '" . $diciembref . "' and arranque = 'Si'";
  $diciembre_result_arra = $conexion->query($diciembrearra);
  $diciembre_arra = mysqli_num_rows($diciembre_result_arra);
  //conexiones
  $diciembrecon = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $diciembrei . "' and fechareg <= '" . $diciembref . "' and  conexion = ('Provisional' or 'Definitiva')";
  $diciembre_result_con = $conexion->query($diciembrecon);
  $diciembre_con = mysqli_num_rows($diciembre_result_con);


  //******************Graficas********************
  $fecha_actual = date('Y-m-d');
  $fecha_desde =  date('Y-m') . "-01";
  //comprobacion de contactos de parte de edat
  $contacto_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
  $edat_result = $conexion->query($contacto_edat);
  $contactos = mysqli_num_rows($edat_result);



  //comprobacion de citas de parte de edat
  $citas_edat = "select * from llenado_formulario where acudio_entrevista = 'Si' and edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "'";
  $citas_result = $conexion->query($citas_edat);
  $citas = mysqli_num_rows($citas_result);

  //comprobacion de conexion de parte de edat

  $conexion_edat = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fecha_desde . "' and fechareg <= '" . $fecha_actual . "' and  conexion = ('Provisional' or 'Definitiva')";
  $conexion_result = $conexion->query($conexion_edat);
  $conexionr = mysqli_num_rows($conexion_result);

  //****************Consulta metas mensuales***********
  //****************contactos***********
  $meta_m_e = "select * from metas where nombre = '" . $edat . "'";
  $meta_m_er = $conexion->query($meta_m_e);
  $filam = mysqli_fetch_array($meta_m_er);
  //****************contactos***********
  $citas_m_e = "select * from metas where nombre = '" . $edat . "'";
  $citas_m_er = $conexion->query($citas_m_e);
  $filacm = mysqli_fetch_array($citas_m_er);
  //****************conexion***********
  $conexion_m_e = "select * from metas where nombre = '" . $edat . "'";
  $conexion_m_er = $conexion->query($conexion_m_e);
  $filacom = mysqli_fetch_array($conexion_m_er);
  ?>
 <html>

 <head>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title></title>
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
 </head>

 <body style="overflow-x:hidden; overflow-y:5px">
   <!--Barra de navegacion -->
   <nav class="navbar navbar-default" role="navigation">
     <div class="container-fluid">
       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-left">
           <li><a><span class="label label-primary">Bienvenido: <?php echo $edat ?></span></a></li>
           <input hidden id="edat" value="<?php echo $edat ?>">
         </ul>
         <ul class="nav navbar-nav navbar-right">
           <li><a href="index1.php">Ingresar Candidatos</a></li>
           <li><a href="php/logout.php">Salir</a></li>
         </ul>
       </div><!-- /.navbar-collapse -->
     </div><!-- /.container-fluid -->
   </nav>
   <!--Termina barra de navegacion-->
   <!-- metas mensuales -->
   <input hidden id="cmm" value="<?php echo $filam["contactos_meta_mensual"] ?>">
   <input hidden id="cimm" value="<?php echo $filacm["citas_meta_mensual"] ?>">
   <input hidden id="comm" value="<?php echo $filacm["conexion_meta_mensual"] ?>">
   <!-- metas trimestrales -->
   <input hidden id="cmt" value="<?php echo $filam["contactos_meta_trimestral"] ?>">
   <input hidden id="cimt" value="<?php echo $filacm["citas_meta_trimestral"] ?>">
   <input hidden id="comt" value="<?php echo $filacm["conexion_meta_trimestral"] ?>">
   <!-- metas anuales -->
   <input hidden id="cma" value="<?php echo $filam["contactos_meta_anual"] ?>">
   <input hidden id="cima" value="<?php echo $filacm["citas_meta_anual"] ?>">
   <input hidden id="coma" value="<?php echo $filacm["conexion_meta_anual"] ?>">
   <!--Meta mensual js-->
   <script type="text/javascript">
     google.charts.load('current', {
       'packages': ['bar']
     });
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var cmm = document.getElementById("cmm").value;
       var cimm = document.getElementById("cimm").value;
       var comm = document.getElementById("comm").value;
       cmm = eval(cmm);
       cimm = eval(cimm);
       comm = eval(comm);
       var data = google.visualization.arrayToDataTable([
         ['Concepto', 'Resultado', 'Meta Mensual'],
         ['Contactos', <?php echo $contactos ?>, cmm],
         ['Citas', <?php echo $citas ?>, cimm],
         ['Conexiones', <?php echo $conexionr ?>, comm]
       ]);
       var options = {
         chart: {
           title: 'Resultados y Metas Mensuales',
           subtitle: 'Correspondientes a la fecha de: <?php echo $fecha_desde ?> a: <?php echo $fecha_actual ?> ',
         },
         width: 750,
         height: 500,
         chartArea: {
           width: '100%',
           height: '100%'
         },

         colors: ['#F19D13', '#337ab7']
       };
       var chart = new google.charts.Bar(document.getElementById('1'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     }
   </script>

   <!--Meta semestral js-->

   <script type="text/javascript">
     google.charts.load('current', {
       'packages': ['bar']
     });
     google.charts.setOnLoadCallback(drawChart2);

     function drawChart2() {
       var cmt = document.getElementById("cmt").value;
       var cimt = document.getElementById("cimt").value;
       var comt = document.getElementById("comt").value;
       cmt = eval(cmt);
       cimt = eval(cimt);
       comt = eval(comt);
       <?php
        //trimestre
        $mes = date('m');
        //primer trimestre
        if ($mes >= "01" && $mes <= "03") {
          $mes = ("01");
          $fechaint = date('Y') . ("-01-01");
        }
        //segundo trimestre
        if ($mes >= "04" && $mes <= "06") {
          $mes = ("02");
          $fechaint = date('Y') . ("-04-01");
        }
        //tercer trimestre
        if ($mes >= "07" && $mes <= "09") {
          $mes = ("03");
          $fechaint = date('Y') . ("-07-01");
        }
        //cuarto trimestre
        if ($mes >= "10" && $mes <= "12") {
          $mes = ("04");
          $fechaint = date('Y') . ("-10-01");
        }

        //******************Graficas********************
        $fecha_actual = date('Y-m-d');
        //comprobacion de contactos de parte de edat
        $contacto_edatt = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fechaint . "' and fechareg <= '" . $fecha_actual . "'";
        $edat_resultt = $conexion->query($contacto_edatt);
        $contactost = mysqli_num_rows($edat_resultt);

        //comprobacion de citas de parte de edat
        $citas_edatt = "select * from llenado_formulario where acudio_entrevista = 'Si' and edat = '" . $edat . "' and fechareg >= '" . $fechaint . "' and fechareg <= '" . $fecha_actual . "'";
        $citas_resultt = $conexion->query($citas_edatt);
        $citast = mysqli_num_rows($citas_resultt);

        //comprobacion de conexion de parte de edat

        $conexion_edatt = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $fechaint . "' and fechareg <= '" . $fecha_actual . "' and  conexion = ('Provisional' or 'Definitiva')";
        $conexion_resultt = $conexion->query($conexion_edatt);
        $conexionrt = mysqli_num_rows($conexion_resultt);
        ?>

       var data = google.visualization.arrayToDataTable([
         ['Concepto', 'Resultado', 'Meta Trimestral'],
         ['Contactos', <?php echo $contactost ?>, cmt],
         ['Citas', <?php echo $citast ?>, cimt],
         ['Conexiones', <?php echo $conexionrt ?>, comt]
       ]);
       var options = {
         chart: {
           title: 'Resultados y Metas Trimestral',
           subtitle: 'Correspondientes al trimestre #<?php echo $mes ?> a la fecha de: <?php echo $fecha_desde ?> a: <?php echo $fecha_actual ?> ',
         },
         width: 750,
         height: 500,
         chartArea: {
           width: '100%',
           height: '100%'
         },

         colors: ['#F19D13', '#337ab7']
       };
       var chart = new google.charts.Bar(document.getElementById('2'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     }
   </script>

   <!--Meta anual js-->
   <script type="text/javascript">
     google.charts.load('current', {
       'packages': ['bar']
     });
     google.charts.setOnLoadCallback(drawChart3);

     function drawChart3() {
       var cma = document.getElementById("cmm").value;
       var cima = document.getElementById("cimm").value;
       var coma = document.getElementById("comm").value;
       cma = eval(cma);
       cima = eval(cima);
       coma = eval(coma);

       <?php
        $añoin = date('Y') . "-01-01";
        //comprobacion de contactos de parte de edat
        $contacto_edata = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $añoin . "' and fechareg <= '" . $fecha_actual . "'";
        $edat_resulta = $conexion->query($contacto_edata);
        $contactosa = mysqli_num_rows($edat_resulta);

        //comprobacion de citas de parte de edat
        $citas_edata = "select * from llenado_formulario where acudio_entrevista = 'Si' and edat = '" . $edat . "' and fechareg >= '" . $añoin . "' and fechareg <= '" . $fecha_actual . "'";
        $citas_resulta = $conexion->query($citas_edata);
        $citasa = mysqli_num_rows($citas_resulta);

        //comprobacion de conexion de parte de edat

        $conexion_edata = "select * from llenado_formulario where edat = '" . $edat . "' and fechareg >= '" . $añoin . "' and fechareg <= '" . $fecha_actual . "' and  conexion = ('Provisional' or 'Definitiva')";
        $conexion_resulta = $conexion->query($conexion_edata);
        $conexionra = mysqli_num_rows($conexion_resulta);
        ?>

       var data = google.visualization.arrayToDataTable([
         ['Concepto', 'Resultado', 'Meta anual'],
         ['Contactos', <?php echo $contactosa ?>, cma],
         ['Citas', <?php echo $citasa ?>, cima],
         ['Conexiones', <?php echo $conexionra ?>, coma]
       ]);
       var options = {
         chart: {
           title: 'Resultados y Metas Anuales',
           subtitle: 'Correspondientes a la fecha de: <?php echo date('Y') . "-01-01" ?> a: <?php echo $fecha_actual ?> ',
         },
         width: 750,
         height: 500,
         chartArea: {
           width: '100%',
           height: '100%'
         },

         colors: ['#F19D13', '#337ab7']
       };
       var chart = new google.charts.Bar(document.getElementById('3'));

       chart.draw(data, google.charts.Bar.convertOptions(options));
     }
   </script>

   <!--GRAFICA DE RESULTADOS ANUALES POR MES-->
   <script type="text/javascript">
     google.charts.load('current', {
       'packages': ['corechart']
     });
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {
       var data = google.visualization.arrayToDataTable([
         ['Mes', 'Contactos', 'Citas', 'Arranque', 'Conexión'],
         ['Enero', <?php echo $enero_ci ?>, <?php echo $enero_cit ?>, <?php echo $enero_arra ?>, <?php echo $enero_con ?>],
         ['Febrero', <?php echo $febrero_ci ?>, <?php echo $febrero_cit ?>, <?php echo $febrero_arra ?>, <?php echo $febrero_con ?>],
         ['Marzo', <?php echo $marzo_ci ?>, <?php echo $marzo_cit ?>, <?php echo $marzo_arra ?>, <?php echo $marzo_con ?>],
         ['Abril', <?php echo $abril_ci ?>, <?php echo $abril_cit ?>, <?php echo $abril_arra ?>, <?php echo $abril_con ?>],
         ['Mayo', <?php echo $mayo_ci ?>, <?php echo $mayo_cit ?>, <?php echo $mayo_arra ?>, <?php echo $mayo_con ?>],
         ['Junio', <?php echo $junio_ci ?>, <?php echo $junio_cit ?>, <?php echo $junio_arra ?>, <?php echo $junio_con ?>],
         ['Julio', <?php echo $julio_ci ?>, <?php echo $julio_cit ?>, <?php echo $julio_arra ?>, <?php echo $julio_con ?>],
         ['Agosto', <?php echo $agosto_ci ?>, <?php echo $agosto_cit ?>, <?php echo $agosto_arra ?>, <?php echo $agosto_con ?>],
         ['Septiembre', <?php echo $septiembre_ci ?>, <?php echo $septiembre_cit ?>, <?php echo $septiembre_arra ?>, <?php echo $septiembre_con ?>],
         ['Octubre', <?php echo $octubre_ci ?>, <?php echo $octubre_cit ?>, <?php echo $octubre_arra ?>, <?php echo $octubre_con ?>],
         ['Noviembre', <?php echo $noviembre_ci ?>, <?php echo $noviembre_cit ?>, <?php echo $noviembre_arra ?>, <?php echo $noviembre_con ?>],
         ['Diciembre', <?php echo $diciembre_ci ?>, <?php echo $diciembre_cit ?>, <?php echo $diciembre_arra ?>, <?php echo $diciembre_con ?>]
       ]);

       var options = {
         title: 'Resultados correspondientes al año <?php echo date('Y'); ?>',
         hAxis: {
           title: 'Mes',
           titleTextStyle: {
             color: '#333'
           }
         },
         vAxis: {
           minValue: 0
         }
       };

       var chart = new google.visualization.AreaChart(document.getElementById('4'));
       chart.draw(data, options);
     }
   </script>
   <!-- Botones para cambiar el rango de meta, mensual, semestral y anual-->
   <center>
     <button type="button" id="btnmensual" class="btn btn-primary">Mensual</button>
     <button type="button" id="btntrimestral" class="btn btn-primary">Trimestral</button>
     <button type="button" id="btnanual" class="btn btn-primary">Anual</button>
     <button type="button" id="btnres_anual" class="btn btn-primary">Resultados anuales por mes</button>
     <br>
   </center>
   <div id="content" class="content">
     <!--Grafica metas y resultados mensuales-->
     <center>
       <div class="grafica" id="1"></div>
     </center>
     <br>
     <!--Grafica metas y resultados semestrales-->
     <center>
       <div class="grafica" id="2"></div>
     </center>

     <!--Grafica metas y resultados anuales-->
     <center>
       <div class="grafica" id="3"></div>
     </center>
     <!--Grafica metas y resultados anuales por mes-->
     <center>
       <div class="grafica" id="4" style="width: 100%; height: 500px;"></div>
     </center>
   </div>
 </body>

 </html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
   $(document).ready(function() {
     $("#1").show();


     $("#btnmensual").click(function() {
       $("#1").show();
       $("#2").hide();
       $("#3").hide();
       $("#4").hide();
     })
     $("#btntrimestral").click(function() {
       $("#1").hide();
       $("#2").show();
       $("#3").hide();
       $("#4").hide();
     })
     $("#btnanual").click(function() {
       $("#1").hide();
       $("#2").hide();
       $("#3").show();
       $("#4").hide();
     })
     $("#btnres_anual").click(function() {
       $("#1").hide();
       $("#2").hide();
       $("#3").hide();
       $("#4").show();
     })
   });
 </script>