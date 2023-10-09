<?php
    error_reporting(0);
    include 'conexion.php';
    $conexion = conexion();
    session_start();
    $edat = $_SESSION['user'];
        //Comprobamos existencia de sesion
    if(!isset($_SESSION['user'])) {
        header('location: ../index.php');
    }
    mysqli_set_charset($conexion,'utf8');
    if($conexion->connect_error){
        die('Error de conexion: ' . $conexion->connect_error);
    }
    //********** Trae la fecha de inicio, la fecha final y el edat que se quiere consultar**********
    $fecha_in = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $opcion = $_POST['edat_option'];
  //**********Grafica anual primero se definen los 12 meses del año en variables para utilizarlos en las consultas*********
$eneroi = date('Y').("-01-01");
$enerof = date('Y').("-01-31");

$febreroi = date('Y').("-02-01");
$febrerof = date('Y').("-02-31");

$marzoi = date('Y').("-03-01");
$marzof = date('Y').("-03-31");

$abrili = date('Y').("-04-01");
$abrilf = date('Y').("-04-31");

$mayoi = date('Y').("-05-01");
$mayof = date('Y').("-05-31");

$junioi = date('Y').("-06-01");
$juniof = date('Y').("-06-31");

$julioi = date('Y').("-07-01");
$juliof = date('Y').("-07-31");

$agostoi = date('Y').("-08-01");
$agostof = date('Y').("-08-31");

$septiembrei = date('Y').("-09-01");
$septiembref = date('Y').("-09-31");

$octubrei = date('Y').("-10-01");
$octubref = date('Y').("-10-31");

$noviembrei = date('Y').("-11-01");
$noviembref = date('Y').("-11-31");

$diciembrei = date('Y').("-12-01");
$diciembref = date('Y').("-12-31");
    //*******Consulta especifica en caso de que la opcion sea "todos" contactos
    if($opcion=="Todos"){
    $todos = "select * from llenado_formulario where fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $todos_result = mysqli_query($conexion,$todos);
    $todos1 = mysqli_num_rows($todos_result);
    $res = $todos1;

    //*******Consulta especifica en caso de que la opcion sea "todos" citas
    $todosc = "select * from llenado_formulario where acudio_entrevista = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $todosc_result = mysqli_query($conexion,$todosc);
    $todosr = mysqli_num_rows($todosc_result);
    $res2 = $todosr;

    //*******Consulta especifica en caso de que la opcion sea "todos" citas
    $todosarra = "select * from llenado_formulario where arranque = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $todosarra_result = mysqli_query($conexion,$todosarra);
    $todoarrar = mysqli_num_rows($todosarra_result);
    $res4 = $todoarrar;

    //*******Consulta especifica en caso de que la opcion sea "todos" conexion
    $todoscon = "select * from llenado_formulario where conexion = 'Provisional' or 'Definitiva' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $todoscon_result = mysqli_query($conexion,$todoscon);
    $todosconr = mysqli_num_rows($todoscon_result);
    $res3 = $todosconr;

    //****consulta de metas todos contactos
    $todoscmm = "select * from metas where nombre = 'Todos'";
    $todos_m_er = mysqli_query($conexion,$todoscmm);
    $filacmm1= mysqli_fetch_array ($todos_m_er);


    //Comienza la consulta para saber en que meses hay tal resultado, vamos a poner los cuatro principales contactos, citas, arranques y conexiones.
//Enero
 //contactos
  $eneroci = "select * from llenado_formulario where fechareg >= '".$eneroi."' and fechareg <= '".$enerof."'";
  $enero_result_ci = $conexion->query($eneroci);
  $enero_ci = mysqli_num_rows($enero_result_ci);
 //Citas
  $enerocit = "select * from llenado_formulario where fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and acudio_entrevista = 'Si'";
  $enero_result_cit = $conexion->query($enerocit);
  $enero_cit = mysqli_num_rows($enero_result_cit);
 //arranque
  $eneroarra = "select * from llenado_formulario where fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and arranque = 'Si'";
  $enero_result_arra = $conexion->query($eneroarra);
  $enero_arra = mysqli_num_rows($enero_result_arra);
 //Conexion
  $enerocon = "select * from llenado_formulario where fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $enero_result_con = $conexion->query($enerocon);
  $enero_con = mysqli_num_rows($enero_result_con);

//Febrero
 //contactos
 $febreroci = "select * from llenado_formulario where fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."'";
  $febrero_result_ci = $conexion->query($febreroci);
  $febrero_ci = mysqli_num_rows($febrero_result_ci);
//citas
 $febrerocit = "select * from llenado_formulario where fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and acudio_entrevista = 'Si'";
  $febrero_result_cit = $conexion->query($febrerocit);
  $febrero_cit = mysqli_num_rows($febrero_result_cit);
//arranque
 $febreroarra = "select * from llenado_formulario where fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and arranque = 'Si'";
  $febrero_result_arra = $conexion->query($febreroarra);
  $febrero_arra = mysqli_num_rows($febrero_result_arra);
//conexion
 $febrerocon = "select * from llenado_formulario where fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $febrero_result_con = $conexion->query($febrerocon);
  $febrero_con = mysqli_num_rows($febrero_result_con);

//Marzo
 //contactos
  $marzoci = "select * from llenado_formulario where fechareg >= '".$marzoi."' and fechareg <= '".$marzof."'";
  $marzo_result_ci = $conexion->query($marzoci);
  $marzo_ci = mysqli_num_rows($marzo_result_ci);
  //citas
  $marzocit = "select * from llenado_formulario where fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and acudio_entrevista = 'Si'";
  $marzo_result_cit = $conexion->query($marzocit);
  $marzo_cit = mysqli_num_rows($marzo_result_cit);
 //arranque
  $marzoarra = "select * from llenado_formulario where fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and arranque = 'Si'";
  $marzo_result_arra = $conexion->query($marzoarra);
  $marzo_arra = mysqli_num_rows($marzo_result_arra);
 //conexion
  $marzocon = "select * from llenado_formulario where fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and  conexion = ('Provisional' or 'Definitiva')";
  $marzo_result_con = $conexion->query($marzocon);
  $marzo_con = mysqli_num_rows($marzo_result_con);

//Abril
 //contactos
  $abrilci = "select * from llenado_formulario where fechareg >= '".$abrili."' and fechareg <= '".$abrilf."'";
  $abril_result_ci = $conexion->query($abrilci);
  $abril_ci = mysqli_num_rows($abril_result_ci);
 //citas
  $abrilcit = "select * from llenado_formulario where fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and acudio_entrevista = 'Si'";
  $abril_result_cit = $conexion->query($abrilcit);
  $abril_cit = mysqli_num_rows($abril_result_cit);
 //arranques
  $abrilarra = "select * from llenado_formulario where fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and arranque = 'Si'";
  $abril_result_arra = $conexion->query($abrilarra);
  $abril_arra = mysqli_num_rows($abril_result_arra);
 //conexiones
  $abrilcon = "select * from llenado_formulario where fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and  conexion = ('Provisional' or 'Definitiva')";
  $abril_result_con = $conexion->query($abrilcon);
  $abril_con = mysqli_num_rows($abril_result_con);

//Mayo
 //contactos
  $mayoci = "select * from llenado_formulario where fechareg >= '".$mayoi."' and fechareg <= '".$mayof."'";
  $mayo_result_ci = $conexion->query($mayoci);
  $mayo_ci = mysqli_num_rows($mayo_result_ci);
 //citas
  $mayocit = "select * from llenado_formulario where fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and acudio_entrevista = 'Si'";
  $mayo_result_cit = $conexion->query($mayocit);
  $mayo_cit = mysqli_num_rows($mayo_result_cit);
 //arranque
  $mayoarra = "select * from llenado_formulario where fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and arranque = 'Si'";
  $mayo_result_arra = $conexion->query($mayoarra);
  $mayo_arra = mysqli_num_rows($mayo_result_arra);
 //conexiones
  $mayocon = "select * from llenado_formulario where fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and  conexion = ('Provisional' or 'Definitiva')";
  $mayo_result_con = $conexion->query($mayocon);
  $mayo_con = mysqli_num_rows($mayo_result_con);

//Junio
 //contactos
  $junioci = "select * from llenado_formulario where fechareg >= '".$junioi."' and fechareg <= '".$juniof."'";
  $junio_result_ci = $conexion->query($junioci);
  $junio_ci = mysqli_num_rows($junio_result_ci);
 //citas
  $juniocit = "select * from llenado_formulario where fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and acudio_entrevista = 'Si'";
  $junio_result_cit = $conexion->query($juniocit);
  $junio_cit = mysqli_num_rows($junio_result_cit);
 //arranques
  $junioarra = "select * from llenado_formulario where fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and arranque = 'Si'";
  $junio_result_arra = $conexion->query($junioarra);
  $junio_arra = mysqli_num_rows($junio_result_arra);
 //conexiones
  $juniocon = "select * from llenado_formulario where fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and  conexion = ('Provisional' or 'Definitiva')";
  $junio_result_con = $conexion->query($juniocon);
  $junio_con = mysqli_num_rows($junio_result_con);

//Julio
 //contactos
  $julioci = "select * from llenado_formulario where fechareg >= '".$julioi."' and fechareg <= '".$juliof."'";
  $julio_result_ci = $conexion->query($julioci);
  $julio_ci = mysqli_num_rows($julio_result_ci);
 //citas
  $juliocit = "select * from llenado_formulario where fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and acudio_entrevista = 'Si'";
  $julio_result_cit = $conexion->query($juliocit);
  $julio_cit = mysqli_num_rows($julio_result_cit);
 //arranques
  $julioarra = "select * from llenado_formulario where fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and arranque = 'Si'";
  $julio_result_arra = $conexion->query($julioarra);
  $julio_arra = mysqli_num_rows($julio_result_arra);
 //conexion
  $juliocon = "select * from llenado_formulario where fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and  conexion = ('Provisional' or 'Definitiva')";
  $julio_result_con = $conexion->query($juliocon);
  $julio_con = mysqli_num_rows($julio_result_con);

//Agosto
 //contactos
  $agostoci = "select * from llenado_formulario where fechareg >= '".$agostoi."' and fechareg <= '".$agostof."'";
  $agosto_result_ci = $conexion->query($agostoci);
  $agosto_ci = mysqli_num_rows($agosto_result_ci);
 //citas
  $agostocit = "select * from llenado_formulario where fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and acudio_entrevista = 'Si'";
  $agosto_result_cit = $conexion->query($agostocit);
  $agosto_cit = mysqli_num_rows($agosto_result_cit);
 //arranque
  $agostoarra = "select * from llenado_formulario where fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and arranque = 'Si'";
  $agosto_result_arra = $conexion->query($agostoarra);
  $agosto_arra = mysqli_num_rows($agosto_result_arra);
 //conexion
  $agostocon = "select * from llenado_formulario where fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and  conexion = ('Provisional' or 'Definitiva')";
  $agosto_result_con = $conexion->query($agostocon);
  $agosto_con = mysqli_num_rows($agosto_result_con);

//Septiembre
 //contactos
  $septiembreci = "select * from llenado_formulario where fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."'";
  $septiembre_result_ci = $conexion->query($septiembreci);
  $septiembre_ci = mysqli_num_rows($septiembre_result_ci);
//citas
  $septiembrecit = "select * from llenado_formulario where fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and acudio_entrevista = 'Si'";
  $septiembre_result_cit = $conexion->query($septiembrecit);
  $septiembre_cit = mysqli_num_rows($septiembre_result_cit);
//arranque
  $septiembrearra = "select * from llenado_formulario where fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and arranque = 'Si'";
  $septiembre_result_arra = $conexion->query($septiembrearra);
  $septiembre_arra = mysqli_num_rows($septiembre_result_arra);
//conexion
  $septiembrecon = "select * from llenado_formulario where fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $septiembre_result_con = $conexion->query($septiembrecon);
  $septiembre_con = mysqli_num_rows($septiembre_result_con);

//octubre
 //contactos
  $octubreci = "select * from llenado_formulario where fechareg >= '".$octubrei."' and fechareg <= '".$octubref."'";
  $octubre_result_ci = $conexion->query($octubreci);
  $octubre_ci = mysqli_num_rows($octubre_result_ci);
 //citas
  $octubrecit = "select * from llenado_formulario where fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and acudio_entrevista = 'Si'";
  $octubre_result_cit = $conexion->query($octubrecit);
  $octubre_cit = mysqli_num_rows($octubre_result_cit);
 //arranque
  $octubrearra = "select * from llenado_formulario where fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and arranque = 'Si'";
  $octubre_result_arra = $conexion->query($octubrearra);
  $octubre_arra = mysqli_num_rows($octubre_result_arra);
 //conexion
  $octubrecon = "select * from llenado_formulario where fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and  conexion = ('Provisional' or 'Definitiva')";
  $octubre_result_con = $conexion->query($octubrecon);
  $octubre_con = mysqli_num_rows($octubre_result_con);

//Noviembre
 //contactos
  $noviembreci = "select * from llenado_formulario where fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."'";
  $noviembre_result_ci = $conexion->query($noviembreci);
  $noviembre_ci = mysqli_num_rows($noviembre_result_ci);
 //citas
  $noviembrecit = "select * from llenado_formulario where fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and acudio_entrevista = 'Si'";
  $noviembre_result_cit = $conexion->query($noviembrecit);
  $noviembre_cit = mysqli_num_rows($noviembre_result_cit);
 //arranques
  $noviembrearra = "select * from llenado_formulario where fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and arranque = 'Si'";
  $noviembre_result_arra = $conexion->query($noviembrearra);
  $noviembre_arra = mysqli_num_rows($noviembre_result_arra);
 //conexiones
  $noviembrecon = "select * from llenado_formulario where fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $noviembre_result_con = $conexion->query($noviembrecon);
  $noviembre_con = mysqli_num_rows($noviembre_result_con);

//Diciembre
 //contactos
  $diciembreci = "select * from llenado_formulario where fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."'";
  $diciembre_result_ci = $conexion->query($diciembreci);
  $diciembre_ci = mysqli_num_rows($diciembre_result_ci);
 //citas
  $diciembrecit = "select * from llenado_formulario where fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and acudio_entrevista = 'Si'";
  $diciembre_result_cit = $conexion->query($diciembrecit);
  $diciembre_cit = mysqli_num_rows($diciembre_result_cit);
 //arranque
  $diciembrearra = "select * from llenado_formulario where fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and arranque = 'Si'";
  $diciembre_result_arra = $conexion->query($diciembrearra);
  $diciembre_arra = mysqli_num_rows($diciembre_result_arra);
 //conexiones
  $diciembrecon = "select * from llenado_formulario where fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $diciembre_result_con = $conexion->query($diciembrecon);
  $diciembre_con = mysqli_num_rows($diciembre_result_con);

    }

    //*******Consulta especifica en caso de que la opcion sea "alan soto"
    if($opcion=="Alan Soto"){
    $alan = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $alan_result = mysqli_query($conexion,$alan);
    $alan1 = mysqli_num_rows($alan_result);
    $res = $alan1;

    //*******Consulta especifica en caso de que la opcion sea "alan" citas
    $alanc = "select * from llenado_formulario where edat = 'Alan Soto' and acudio_entrevista = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $alanc_result = mysqli_query($conexion,$alanc);
    $alanr = mysqli_num_rows($alanc_result);
    $res2 = $alanr;

    //*******Consulta especifica en caso de que la opcion sea "alan" arranques
    $alanarra = "select * from llenado_formulario where edat = 'Alan Soto' and arranque = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $alanarra_result = mysqli_query($conexion,$alanarra);
    $alanarrar = mysqli_num_rows($alanarra_result);
    $res4 = $alanarrar;

    //*******Consulta especifica en caso de que la opcion sea "alan" conexion
    $alancon = "select * from llenado_formulario where edat = 'Alan Soto' and conexion = 'Provisional' or 'Definitiva' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $alancon_result = mysqli_query($conexion,$alancon);
    $alanconr = mysqli_num_rows($alancon_result);
    $res3 = $alanconr;

        //****consulta de metas contactos de alan
    $todoscmm = "select * from metas where nombre = 'Alan Soto'";
    $todos_m_er = mysqli_query($conexion,$todoscmm);
    $filacmm1= mysqli_fetch_array ($todos_m_er);

        //Comienza la consulta para saber en que meses hay tal resultado, vamos a poner los cuatro principales contactos, citas, arranques y conexiones.
//Enero
 //contactos
  $eneroci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."'";
  $enero_result_ci = $conexion->query($eneroci);
  $enero_ci = mysqli_num_rows($enero_result_ci);
        echo $enero_ci;
 //Citas
  $enerocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and resul_llamada = 'CITA'";
  $enero_result_cit = $conexion->query($enerocit);
  $enero_cit = mysqli_num_rows($enero_result_cit);
 //arranque
  $eneroarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and arranque = 'Si'";
  $enero_result_arra = $conexion->query($eneroarra);
  $enero_arra = mysqli_num_rows($enero_result_arra);
 //Conexion
  $enerocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $enero_result_con = $conexion->query($enerocon);
  $enero_con = mysqli_num_rows($enero_result_con);

//Febrero
 //contactos
 $febreroci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."'";
  $febrero_result_ci = $conexion->query($febreroci);
  $febrero_ci = mysqli_num_rows($febrero_result_ci);
//citas
 $febrerocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and resul_llamada = 'CITA'";
  $febrero_result_cit = $conexion->query($febrerocit);
  $febrero_cit = mysqli_num_rows($febrero_result_cit);
//arranque
 $febreroarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and arranque = 'Si'";
  $febrero_result_arra = $conexion->query($febreroarra);
  $febrero_arra = mysqli_num_rows($febrero_result_arra);
//conexion
 $febrerocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $febrero_result_con = $conexion->query($febrerocon);
  $febrero_con = mysqli_num_rows($febrero_result_con);

//Marzo
 //contactos
  $marzoci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."'";
  $marzo_result_ci = $conexion->query($marzoci);
  $marzo_ci = mysqli_num_rows($marzo_result_ci);
  //citas
  $marzocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and resul_llamada = 'CITA'";
  $marzo_result_cit = $conexion->query($marzocit);
  $marzo_cit = mysqli_num_rows($marzo_result_cit);
 //arranque
  $marzoarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and arranque = 'Si'";
  $marzo_result_arra = $conexion->query($marzoarra);
  $marzo_arra = mysqli_num_rows($marzo_result_arra);
 //conexion
  $marzocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and  conexion = ('Provisional' or 'Definitiva')";
  $marzo_result_con = $conexion->query($marzocon);
  $marzo_con = mysqli_num_rows($marzo_result_con);

//Abril
 //contactos
  $abrilci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."'";
  $abril_result_ci = $conexion->query($abrilci);
  $abril_ci = mysqli_num_rows($abril_result_ci);
 //citas
  $abrilcit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and acudio_entrevista = 'Si'";
  $abril_result_cit = $conexion->query($abrilcit);
  $abril_cit = mysqli_num_rows($abril_result_cit);
 //arranques
  $abrilarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and arranque = 'Si'";
  $abril_result_arra = $conexion->query($abrilarra);
  $abril_arra = mysqli_num_rows($abril_result_arra);
 //conexiones
  $abrilcon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and  conexion = ('Provisional' or 'Definitiva')";
  $abril_result_con = $conexion->query($abrilcon);
  $abril_con = mysqli_num_rows($abril_result_con);

//Mayo
 //contactos
  $mayoci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."'";
  $mayo_result_ci = $conexion->query($mayoci);
  $mayo_ci = mysqli_num_rows($mayo_result_ci);
 //citas
  $mayocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and acudio_entrevista = 'Si'";
  $mayo_result_cit = $conexion->query($mayocit);
  $mayo_cit = mysqli_num_rows($mayo_result_cit);
 //arranque
  $mayoarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and arranque = 'Si'";
  $mayo_result_arra = $conexion->query($mayoarra);
  $mayo_arra = mysqli_num_rows($mayo_result_arra);
 //conexiones
  $mayocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and  conexion = ('Provisional' or 'Definitiva')";
  $mayo_result_con = $conexion->query($mayocon);
  $mayo_con = mysqli_num_rows($mayo_result_con);

//Junio
 //contactos
  $junioci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."'";
  $junio_result_ci = $conexion->query($junioci);
  $junio_ci = mysqli_num_rows($junio_result_ci);
 //citas
  $juniocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and acudio_entrevista = 'Si'";
  $junio_result_cit = $conexion->query($juniocit);
  $junio_cit = mysqli_num_rows($junio_result_cit);
 //arranques
  $junioarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and arranque = 'Si'";
  $junio_result_arra = $conexion->query($junioarra);
  $junio_arra = mysqli_num_rows($junio_result_arra);
 //conexiones
  $juniocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and  conexion = ('Provisional' or 'Definitiva')";
  $junio_result_con = $conexion->query($juniocon);
  $junio_con = mysqli_num_rows($junio_result_con);

//Julio
 //contactos
  $julioci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."'";
  $julio_result_ci = $conexion->query($julioci);
  $julio_ci = mysqli_num_rows($julio_result_ci);
 //citas
  $juliocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and acudio_entrevista = 'Si'";
  $julio_result_cit = $conexion->query($juliocit);
  $julio_cit = mysqli_num_rows($julio_result_cit);
 //arranques
  $julioarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and arranque = 'Si'";
  $julio_result_arra = $conexion->query($julioarra);
  $julio_arra = mysqli_num_rows($julio_result_arra);
 //conexion
  $juliocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and  conexion = ('Provisional' or 'Definitiva')";
  $julio_result_con = $conexion->query($juliocon);
  $julio_con = mysqli_num_rows($julio_result_con);

//Agosto
 //contactos
  $agostoci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."'";
  $agosto_result_ci = $conexion->query($agostoci);
  $agosto_ci = mysqli_num_rows($agosto_result_ci);
 //citas
  $agostocit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and acudio_entrevista = 'Si'";
  $agosto_result_cit = $conexion->query($agostocit);
  $agosto_cit = mysqli_num_rows($agosto_result_cit);
 //arranque
  $agostoarra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and arranque = 'Si'";
  $agosto_result_arra = $conexion->query($agostoarra);
  $agosto_arra = mysqli_num_rows($agosto_result_arra);
 //conexion
  $agostocon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and  conexion = ('Provisional' or 'Definitiva')";
  $agosto_result_con = $conexion->query($agostocon);
  $agosto_con = mysqli_num_rows($agosto_result_con);

//Septiembre
 //contactos
  $septiembreci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."'";
  $septiembre_result_ci = $conexion->query($septiembreci);
  $septiembre_ci = mysqli_num_rows($septiembre_result_ci);
//citas
  $septiembrecit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and acudio_entrevista = 'Si'";
  $septiembre_result_cit = $conexion->query($septiembrecit);
  $septiembre_cit = mysqli_num_rows($septiembre_result_cit);
//arranque
  $septiembrearra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and arranque = 'Si'";
  $septiembre_result_arra = $conexion->query($septiembrearra);
  $septiembre_arra = mysqli_num_rows($septiembre_result_arra);
//conexion
  $septiembrecon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $septiembre_result_con = $conexion->query($septiembrecon);
  $septiembre_con = mysqli_num_rows($septiembre_result_con);

//octubre
 //contactos
  $octubreci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."'";
  $octubre_result_ci = $conexion->query($octubreci);
  $octubre_ci = mysqli_num_rows($octubre_result_ci);
 //citas
  $octubrecit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and acudio_entrevista = 'Si'";
  $octubre_result_cit = $conexion->query($octubrecit);
  $octubre_cit = mysqli_num_rows($octubre_result_cit);
 //arranque
  $octubrearra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and arranque = 'Si'";
  $octubre_result_arra = $conexion->query($octubrearra);
  $octubre_arra = mysqli_num_rows($octubre_result_arra);
 //conexion
  $octubrecon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and  conexion = ('Provisional' or 'Definitiva')";
  $octubre_result_con = $conexion->query($octubrecon);
  $octubre_con = mysqli_num_rows($octubre_result_con);

//Noviembre
 //contactos
  $noviembreci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."'";
  $noviembre_result_ci = $conexion->query($noviembreci);
  $noviembre_ci = mysqli_num_rows($noviembre_result_ci);
 //citas
  $noviembrecit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and acudio_entrevista = 'Si'";
  $noviembre_result_cit = $conexion->query($noviembrecit);
  $noviembre_cit = mysqli_num_rows($noviembre_result_cit);
 //arranques
  $noviembrearra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and arranque = 'Si'";
  $noviembre_result_arra = $conexion->query($noviembrearra);
  $noviembre_arra = mysqli_num_rows($noviembre_result_arra);
 //conexiones
  $noviembrecon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $noviembre_result_con = $conexion->query($noviembrecon);
  $noviembre_con = mysqli_num_rows($noviembre_result_con);

//Diciembre
 //contactos
  $diciembreci = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."'";
  $diciembre_result_ci = $conexion->query($diciembreci);
  $diciembre_ci = mysqli_num_rows($diciembre_result_ci);
 //citas
  $diciembrecit = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and acudio_entrevista = 'Si'";
  $diciembre_result_cit = $conexion->query($diciembrecit);
  $diciembre_cit = mysqli_num_rows($diciembre_result_cit);
 //arranque
  $diciembrearra = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and arranque = 'Si'";
  $diciembre_result_arra = $conexion->query($diciembrearra);
  $diciembre_arra = mysqli_num_rows($diciembre_result_arra);
 //conexiones
  $diciembrecon = "select * from llenado_formulario where edat = 'Alan Soto' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $diciembre_result_con = $conexion->query($diciembrecon);
  $diciembre_con = mysqli_num_rows($diciembre_result_con);
    }

    //*******Consulta especifica en caso de que la opcion sea "Paloma razo"
    if($opcion=="Paloma Razo"){
    $paloma = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $paloma_result = mysqli_query($conexion,$paloma);
    $paloma1 = mysqli_num_rows($paloma_result);
    $res = $paloma1;

    //*******Consulta especifica en caso de que la opcion sea "paloma" citas
    $palomac = "select * from llenado_formulario where edat = 'Paloma Razo' and acudio_entrevista = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $palomac_result = mysqli_query($conexion,$palomac);
    $palomar = mysqli_num_rows($palomac_result);
    $res2 = $palomar;

    //*******Consulta especifica en caso de que la opcion sea "paloma" citas
    $palomaarra = "select * from llenado_formulario where edat = 'Paloma Razo' and arranque = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $palomaarra_result = mysqli_query($conexion,$palomaarra);
    $palomaarrar = mysqli_num_rows($palomaarra_result);
    $res4 = $palomaarrar;

    //*******Consulta especifica en caso de que la opcion sea "paloma" conexion
    $palomacon = "select * from llenado_formulario where edat = 'Paloma Razo' and conexion = 'Provisional' or 'Definitiva' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $palomacon_result = mysqli_query($conexion,$palomacon);
    $palomaconr = mysqli_num_rows($palomacon_result);
    $res3 = $palomaconr;

    //****consulta de metas contactos de paloma
    $todoscmm = "select * from metas where nombre = 'Paloma Razo'";
    $todos_m_er = mysqli_query($conexion,$todoscmm);
    $filacmm1= mysqli_fetch_array ($todos_m_er);

        //Comienza la consulta para saber en que meses hay tal resultado, vamos a poner los cuatro principales contactos, citas, arranques y conexiones.
//Enero
 //contactos
  $eneroci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."'";
  $enero_result_ci = $conexion->query($eneroci);
  $enero_ci = mysqli_num_rows($enero_result_ci);
 //Citas
  $enerocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and acudio_entrevista = 'Si'";
  $enero_result_cit = $conexion->query($enerocit);
  $enero_cit = mysqli_num_rows($enero_result_cit);
 //arranque
  $eneroarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and arranque = 'Si'";
  $enero_result_arra = $conexion->query($eneroarra);
  $enero_arra = mysqli_num_rows($enero_result_arra);
 //Conexion
  $enerocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $enero_result_con = $conexion->query($enerocon);
  $enero_con = mysqli_num_rows($enero_result_con);

//Febrero
 //contactos
 $febreroci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."'";
  $febrero_result_ci = $conexion->query($febreroci);
  $febrero_ci = mysqli_num_rows($febrero_result_ci);
//citas
 $febrerocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and acudio_entrevista = 'Si'";
  $febrero_result_cit = $conexion->query($febrerocit);
  $febrero_cit = mysqli_num_rows($febrero_result_cit);
//arranque
 $febreroarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and arranque = 'Si'";
  $febrero_result_arra = $conexion->query($febreroarra);
  $febrero_arra = mysqli_num_rows($febrero_result_arra);
//conexion
 $febrerocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $febrero_result_con = $conexion->query($febrerocon);
  $febrero_con = mysqli_num_rows($febrero_result_con);

//Marzo
 //contactos
  $marzoci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."'";
  $marzo_result_ci = $conexion->query($marzoci);
  $marzo_ci = mysqli_num_rows($marzo_result_ci);
  //citas
  $marzocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and acudio_entrevista = 'Si'";
  $marzo_result_cit = $conexion->query($marzocit);
  $marzo_cit = mysqli_num_rows($marzo_result_cit);
 //arranque
  $marzoarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and arranque = 'Si'";
  $marzo_result_arra = $conexion->query($marzoarra);
  $marzo_arra = mysqli_num_rows($marzo_result_arra);
 //conexion
  $marzocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and  conexion = ('Provisional' or 'Definitiva')";
  $marzo_result_con = $conexion->query($marzocon);
  $marzo_con = mysqli_num_rows($marzo_result_con);

//Abril
 //contactos
  $abrilci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."'";
  $abril_result_ci = $conexion->query($abrilci);
  $abril_ci = mysqli_num_rows($abril_result_ci);
 //citas
  $abrilcit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and acudio_entrevista = 'Si'";
  $abril_result_cit = $conexion->query($abrilcit);
  $abril_cit = mysqli_num_rows($abril_result_cit);
 //arranques
  $abrilarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and arranque = 'Si'";
  $abril_result_arra = $conexion->query($abrilarra);
  $abril_arra = mysqli_num_rows($abril_result_arra);
 //conexiones
  $abrilcon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and  conexion = ('Provisional' or 'Definitiva')";
  $abril_result_con = $conexion->query($abrilcon);
  $abril_con = mysqli_num_rows($abril_result_con);

//Mayo
 //contactos
  $mayoci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."'";
  $mayo_result_ci = $conexion->query($mayoci);
  $mayo_ci = mysqli_num_rows($mayo_result_ci);
 //citas
  $mayocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and acudio_entrevista = 'Si'";
  $mayo_result_cit = $conexion->query($mayocit);
  $mayo_cit = mysqli_num_rows($mayo_result_cit);
 //arranque
  $mayoarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and arranque = 'Si'";
  $mayo_result_arra = $conexion->query($mayoarra);
  $mayo_arra = mysqli_num_rows($mayo_result_arra);
 //conexiones
  $mayocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and  conexion = ('Provisional' or 'Definitiva')";
  $mayo_result_con = $conexion->query($mayocon);
  $mayo_con = mysqli_num_rows($mayo_result_con);

//Junio
 //contactos
  $junioci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."'";
  $junio_result_ci = $conexion->query($junioci);
  $junio_ci = mysqli_num_rows($junio_result_ci);
 //citas
  $juniocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and acudio_entrevista = 'Si'";
  $junio_result_cit = $conexion->query($juniocit);
  $junio_cit = mysqli_num_rows($junio_result_cit);
 //arranques
  $junioarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and arranque = 'Si'";
  $junio_result_arra = $conexion->query($junioarra);
  $junio_arra = mysqli_num_rows($junio_result_arra);
 //conexiones
  $juniocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and  conexion = ('Provisional' or 'Definitiva')";
  $junio_result_con = $conexion->query($juniocon);
  $junio_con = mysqli_num_rows($junio_result_con);

//Julio
 //contactos
  $julioci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."'";
  $julio_result_ci = $conexion->query($julioci);
  $julio_ci = mysqli_num_rows($julio_result_ci);
 //citas
  $juliocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and acudio_entrevista = 'Si'";
  $julio_result_cit = $conexion->query($juliocit);
  $julio_cit = mysqli_num_rows($julio_result_cit);
 //arranques
  $julioarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and arranque = 'Si'";
  $julio_result_arra = $conexion->query($julioarra);
  $julio_arra = mysqli_num_rows($julio_result_arra);
 //conexion
  $juliocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and  conexion = ('Provisional' or 'Definitiva')";
  $julio_result_con = $conexion->query($juliocon);
  $julio_con = mysqli_num_rows($julio_result_con);

//Agosto
 //contactos
  $agostoci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."'";
  $agosto_result_ci = $conexion->query($agostoci);
  $agosto_ci = mysqli_num_rows($agosto_result_ci);
 //citas
  $agostocit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and acudio_entrevista = 'Si'";
  $agosto_result_cit = $conexion->query($agostocit);
  $agosto_cit = mysqli_num_rows($agosto_result_cit);
 //arranque
  $agostoarra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and arranque = 'Si'";
  $agosto_result_arra = $conexion->query($agostoarra);
  $agosto_arra = mysqli_num_rows($agosto_result_arra);
 //conexion
  $agostocon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and  conexion = ('Provisional' or 'Definitiva')";
  $agosto_result_con = $conexion->query($agostocon);
  $agosto_con = mysqli_num_rows($agosto_result_con);

//Septiembre
 //contactos
  $septiembreci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."'";
  $septiembre_result_ci = $conexion->query($septiembreci);
  $septiembre_ci = mysqli_num_rows($septiembre_result_ci);
//citas
  $septiembrecit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and acudio_entrevista = 'Si'";
  $septiembre_result_cit = $conexion->query($septiembrecit);
  $septiembre_cit = mysqli_num_rows($septiembre_result_cit);
//arranque
  $septiembrearra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and arranque = 'Si'";
  $septiembre_result_arra = $conexion->query($septiembrearra);
  $septiembre_arra = mysqli_num_rows($septiembre_result_arra);
//conexion
  $septiembrecon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $septiembre_result_con = $conexion->query($septiembrecon);
  $septiembre_con = mysqli_num_rows($septiembre_result_con);

//octubre
 //contactos
  $octubreci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."'";
  $octubre_result_ci = $conexion->query($octubreci);
  $octubre_ci = mysqli_num_rows($octubre_result_ci);
 //citas
  $octubrecit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and acudio_entrevista = 'Si'";
  $octubre_result_cit = $conexion->query($octubrecit);
  $octubre_cit = mysqli_num_rows($octubre_result_cit);
 //arranque
  $octubrearra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and arranque = 'Si'";
  $octubre_result_arra = $conexion->query($octubrearra);
  $octubre_arra = mysqli_num_rows($octubre_result_arra);
 //conexion
  $octubrecon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and  conexion = ('Provisional' or 'Definitiva')";
  $octubre_result_con = $conexion->query($octubrecon);
  $octubre_con = mysqli_num_rows($octubre_result_con);

//Noviembre
 //contactos
  $noviembreci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."'";
  $noviembre_result_ci = $conexion->query($noviembreci);
  $noviembre_ci = mysqli_num_rows($noviembre_result_ci);
 //citas
  $noviembrecit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and acudio_entrevista = 'Si'";
  $noviembre_result_cit = $conexion->query($noviembrecit);
  $noviembre_cit = mysqli_num_rows($noviembre_result_cit);
 //arranques
  $noviembrearra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and arranque = 'Si'";
  $noviembre_result_arra = $conexion->query($noviembrearra);
  $noviembre_arra = mysqli_num_rows($noviembre_result_arra);
 //conexiones
  $noviembrecon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $noviembre_result_con = $conexion->query($noviembrecon);
  $noviembre_con = mysqli_num_rows($noviembre_result_con);

//Diciembre
 //contactos
  $diciembreci = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."'";
  $diciembre_result_ci = $conexion->query($diciembreci);
  $diciembre_ci = mysqli_num_rows($diciembre_result_ci);
 //citas
  $diciembrecit = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and acudio_entrevista = 'Si'";
  $diciembre_result_cit = $conexion->query($diciembrecit);
  $diciembre_cit = mysqli_num_rows($diciembre_result_cit);
 //arranque
  $diciembrearra = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and arranque = 'Si'";
  $diciembre_result_arra = $conexion->query($diciembrearra);
  $diciembre_arra = mysqli_num_rows($diciembre_result_arra);
 //conexiones
  $diciembrecon = "select * from llenado_formulario where edat = 'Paloma Razo' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $diciembre_result_con = $conexion->query($diciembrecon);
  $diciembre_con = mysqli_num_rows($diciembre_result_con);
    }

    //*******Consulta especifica en caso de que la opcion sea "alan soto"
    if($opcion=="Omar Santos"){
    $omar = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $omar_result = mysqli_query($conexion,$omar);
    $omar1 = mysqli_num_rows($omar_result);
    $res = $omar1;

    //*******Consulta especifica en caso de que la opcion sea "alan" citas
    $omarc = "select * from llenado_formulario where edat = 'Omar Santos' and acudio_entrevista = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $omarc_result = mysqli_query($conexion,$omarc);
    $omarr = mysqli_num_rows($omarc_result);
    $res2 = $omarr;

    //*******Consulta especifica en caso de que la opcion sea "alan" arranques
    $omararra = "select * from llenado_formulario where edat = 'Omar Santos' and arranque = 'Si' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $omararra_result = mysqli_query($conexion,$omararra);
    $omararrar = mysqli_num_rows($omararra_result);
    $res4 = $omararrar;

    //*******Consulta especifica en caso de que la opcion sea "alan" conexion
    $omarcon = "select * from llenado_formulario where edat = 'Omar Santos' and conexion = 'Provisional' or 'Definitiva' and fechareg >= '".$fecha_in."' and fechareg <= '".$fecha_fin."'";
    $omarcon_result = mysqli_query($conexion,$omarcon);
    $omarconr = mysqli_num_rows($omarcon_result);
    $res3 = $omarconr;

        //****consulta de metas contactos de alan
    $todoscmm = "select * from metas where nombre = 'Omar Santos'";
    $todos_m_er = mysqli_query($conexion,$todoscmm);
    $filacmm1= mysqli_fetch_array ($todos_m_er);

        //Comienza la consulta para saber en que meses hay tal resultado, vamos a poner los cuatro principales contactos, citas, arranques y conexiones.
  //Enero
  //contactos
  $eneroci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."'";
  $enero_result_ci = $conexion->query($eneroci);
  $enero_ci = mysqli_num_rows($enero_result_ci);
        echo $enero_ci;
  //Citas
  $enerocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and resul_llamada = 'CITA'";
  $enero_result_cit = $conexion->query($enerocit);
  $enero_cit = mysqli_num_rows($enero_result_cit);
  //arranque
  $eneroarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and arranque = 'Si'";
  $enero_result_arra = $conexion->query($eneroarra);
  $enero_arra = mysqli_num_rows($enero_result_arra);
  //Conexion
  $enerocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$eneroi."' and fechareg <= '".$enerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $enero_result_con = $conexion->query($enerocon);
  $enero_con = mysqli_num_rows($enero_result_con);

  //Febrero
  //contactos
  $febreroci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."'";
  $febrero_result_ci = $conexion->query($febreroci);
  $febrero_ci = mysqli_num_rows($febrero_result_ci);
  //citas
  $febrerocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and resul_llamada = 'CITA'";
  $febrero_result_cit = $conexion->query($febrerocit);
  $febrero_cit = mysqli_num_rows($febrero_result_cit);
  //arranque
  $febreroarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and arranque = 'Si'";
  $febrero_result_arra = $conexion->query($febreroarra);
  $febrero_arra = mysqli_num_rows($febrero_result_arra);
  //conexion
  $febrerocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$febreroi."' and fechareg <= '".$febrerof."' and  conexion = ('Provisional' or 'Definitiva')";
  $febrero_result_con = $conexion->query($febrerocon);
  $febrero_con = mysqli_num_rows($febrero_result_con);

  //Marzo
  //contactos
  $marzoci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."'";
  $marzo_result_ci = $conexion->query($marzoci);
  $marzo_ci = mysqli_num_rows($marzo_result_ci);
  //citas
  $marzocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and resul_llamada = 'CITA'";
  $marzo_result_cit = $conexion->query($marzocit);
  $marzo_cit = mysqli_num_rows($marzo_result_cit);
  //arranque
  $marzoarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and arranque = 'Si'";
  $marzo_result_arra = $conexion->query($marzoarra);
  $marzo_arra = mysqli_num_rows($marzo_result_arra);
  //conexion
  $marzocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$marzoi."' and fechareg <= '".$marzof."' and  conexion = ('Provisional' or 'Definitiva')";
  $marzo_result_con = $conexion->query($marzocon);
  $marzo_con = mysqli_num_rows($marzo_result_con);

  //Abril
  //contactos
  $abrilci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."'";
  $abril_result_ci = $conexion->query($abrilci);
  $abril_ci = mysqli_num_rows($abril_result_ci);
  //citas
  $abrilcit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and acudio_entrevista = 'Si'";
  $abril_result_cit = $conexion->query($abrilcit);
  $abril_cit = mysqli_num_rows($abril_result_cit);
  //arranques
  $abrilarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and arranque = 'Si'";
  $abril_result_arra = $conexion->query($abrilarra);
  $abril_arra = mysqli_num_rows($abril_result_arra);
  //conexiones
  $abrilcon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$abrili."' and fechareg <= '".$abrilf."' and  conexion = ('Provisional' or 'Definitiva')";
  $abril_result_con = $conexion->query($abrilcon);
  $abril_con = mysqli_num_rows($abril_result_con);

  //Mayo
  //contactos
  $mayoci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."'";
  $mayo_result_ci = $conexion->query($mayoci);
  $mayo_ci = mysqli_num_rows($mayo_result_ci);
  //citas
  $mayocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and acudio_entrevista = 'Si'";
  $mayo_result_cit = $conexion->query($mayocit);
  $mayo_cit = mysqli_num_rows($mayo_result_cit);
  //arranque
  $mayoarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and arranque = 'Si'";
  $mayo_result_arra = $conexion->query($mayoarra);
  $mayo_arra = mysqli_num_rows($mayo_result_arra);
  //conexiones
  $mayocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$mayoi."' and fechareg <= '".$mayof."' and  conexion = ('Provisional' or 'Definitiva')";
  $mayo_result_con = $conexion->query($mayocon);
  $mayo_con = mysqli_num_rows($mayo_result_con);

  //Junio
  //contactos
  $junioci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."'";
  $junio_result_ci = $conexion->query($junioci);
  $junio_ci = mysqli_num_rows($junio_result_ci);
  //citas
  $juniocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and acudio_entrevista = 'Si'";
  $junio_result_cit = $conexion->query($juniocit);
  $junio_cit = mysqli_num_rows($junio_result_cit);
  //arranques
  $junioarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and arranque = 'Si'";
  $junio_result_arra = $conexion->query($junioarra);
  $junio_arra = mysqli_num_rows($junio_result_arra);
  //conexiones
  $juniocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$junioi."' and fechareg <= '".$juniof."' and  conexion = ('Provisional' or 'Definitiva')";
  $junio_result_con = $conexion->query($juniocon);
  $junio_con = mysqli_num_rows($junio_result_con);

  //Julio
  //contactos
  $julioci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."'";
  $julio_result_ci = $conexion->query($julioci);
  $julio_ci = mysqli_num_rows($julio_result_ci);
  //citas
  $juliocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and acudio_entrevista = 'Si'";
  $julio_result_cit = $conexion->query($juliocit);
  $julio_cit = mysqli_num_rows($julio_result_cit);
  //arranques
  $julioarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and arranque = 'Si'";
  $julio_result_arra = $conexion->query($julioarra);
  $julio_arra = mysqli_num_rows($julio_result_arra);
  //conexion
  $juliocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$julioi."' and fechareg <= '".$juliof."' and  conexion = ('Provisional' or 'Definitiva')";
  $julio_result_con = $conexion->query($juliocon);
  $julio_con = mysqli_num_rows($julio_result_con);

  //Agosto
  //contactos
  $agostoci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."'";
  $agosto_result_ci = $conexion->query($agostoci);
  $agosto_ci = mysqli_num_rows($agosto_result_ci);
  //citas
  $agostocit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and acudio_entrevista = 'Si'";
  $agosto_result_cit = $conexion->query($agostocit);
  $agosto_cit = mysqli_num_rows($agosto_result_cit);
  //arranque
  $agostoarra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and arranque = 'Si'";
  $agosto_result_arra = $conexion->query($agostoarra);
  $agosto_arra = mysqli_num_rows($agosto_result_arra);
  //conexion
  $agostocon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$agostoi."' and fechareg <= '".$agostof."' and  conexion = ('Provisional' or 'Definitiva')";
  $agosto_result_con = $conexion->query($agostocon);
  $agosto_con = mysqli_num_rows($agosto_result_con);

  //Septiembre
  //contactos
  $septiembreci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."'";
  $septiembre_result_ci = $conexion->query($septiembreci);
  $septiembre_ci = mysqli_num_rows($septiembre_result_ci);
  //citas
  $septiembrecit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and acudio_entrevista = 'Si'";
  $septiembre_result_cit = $conexion->query($septiembrecit);
  $septiembre_cit = mysqli_num_rows($septiembre_result_cit);
  //arranque
  $septiembrearra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and arranque = 'Si'";
  $septiembre_result_arra = $conexion->query($septiembrearra);
  $septiembre_arra = mysqli_num_rows($septiembre_result_arra);
  //conexion
  $septiembrecon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$septiembrei."' and fechareg <= '".$septiembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $septiembre_result_con = $conexion->query($septiembrecon);
  $septiembre_con = mysqli_num_rows($septiembre_result_con);

  //octubre
  //contactos
  $octubreci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."'";
  $octubre_result_ci = $conexion->query($octubreci);
  $octubre_ci = mysqli_num_rows($octubre_result_ci);
  //citas
  $octubrecit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and acudio_entrevista = 'Si'";
  $octubre_result_cit = $conexion->query($octubrecit);
  $octubre_cit = mysqli_num_rows($octubre_result_cit);
  //arranque
  $octubrearra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and arranque = 'Si'";
  $octubre_result_arra = $conexion->query($octubrearra);
  $octubre_arra = mysqli_num_rows($octubre_result_arra);
  //conexion
  $octubrecon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$octubrei."' and fechareg <= '".$octubref."' and  conexion = ('Provisional' or 'Definitiva')";
  $octubre_result_con = $conexion->query($octubrecon);
  $octubre_con = mysqli_num_rows($octubre_result_con);

  //Noviembre
  //contactos
  $noviembreci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."'";
  $noviembre_result_ci = $conexion->query($noviembreci);
  $noviembre_ci = mysqli_num_rows($noviembre_result_ci);
  //citas
  $noviembrecit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and acudio_entrevista = 'Si'";
  $noviembre_result_cit = $conexion->query($noviembrecit);
  $noviembre_cit = mysqli_num_rows($noviembre_result_cit);
  //arranques
  $noviembrearra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and arranque = 'Si'";
  $noviembre_result_arra = $conexion->query($noviembrearra);
  $noviembre_arra = mysqli_num_rows($noviembre_result_arra);
  //conexiones
  $noviembrecon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$noviembrei."' and fechareg <= '".$noviembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $noviembre_result_con = $conexion->query($noviembrecon);
  $noviembre_con = mysqli_num_rows($noviembre_result_con);

  //Diciembre
  //contactos
  $diciembreci = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."'";
  $diciembre_result_ci = $conexion->query($diciembreci);
  $diciembre_ci = mysqli_num_rows($diciembre_result_ci);
  //citas
  $diciembrecit = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and acudio_entrevista = 'Si'";
  $diciembre_result_cit = $conexion->query($diciembrecit);
  $diciembre_cit = mysqli_num_rows($diciembre_result_cit);
  //arranque
  $diciembrearra = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and arranque = 'Si'";
  $diciembre_result_arra = $conexion->query($diciembrearra);
  $diciembre_arra = mysqli_num_rows($diciembre_result_arra);
  //conexiones
  $diciembrecon = "select * from llenado_formulario where edat = 'Omar Santos' and fechareg >= '".$diciembrei."' and fechareg <= '".$diciembref."' and  conexion = ('Provisional' or 'Definitiva')";
  $diciembre_result_con = $conexion->query($diciembrecon);
  $diciembre_con = mysqli_num_rows($diciembre_result_con);
    }
?>
<!DOCTYPE html>
<html>
     <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
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
         <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  </head>
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
        <li><a href="../admin.php">Consulta General</a></li>
        <li><a href="logout.php">Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <body>
        <!-- Botones para cambiar el rango de meta, mensual, semestral y anual-->
        <center>
        <button type="button" id="btnmensual" class="btn btn-primary">Mensual</button>
        <button type="button" id="btntrimestral" class="btn btn-primary">Trimestral</button>
        <button type="button" id="btnanual" class="btn btn-primary">Anual</button>
        <button type="button" id="btnres_anual" class="btn btn-primary">Resultados anuales por mes</button>
            <br>
        </center>

        <!--Grafica metas y resultados mensuales-->
             <center>
                 <div class="container" >
    <center>
        <br>
            <div class="grafica" id="1" style="width: 900px; height: 500px;" ></div>
           </center>
                     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['<?php echo $opcion ?>', 'Resultado', 'Meta Mensual'],
          ['Contactos', <?php echo $res ?>, <?php echo $filacmm1["contactos_meta_mensual"] ?>],
          ['Citas', <?php echo $res2 ?>, <?php echo $filacmm1["citas_meta_mensual"] ?>],
          ['Arranques', <?php echo $res4 ?>, <?php echo $filacmm1["arranques_meta_mensual"] ?>],
          ['Conexiones', <?php echo $res3 ?>, <?php echo $filacmm1["conexion_meta_mensual"] ?>]
        ]);
        var options = {'title':'Resultados de consulta especifica de "<?php echo $opcion ?>" Semanal',
                       'subtitle': 'Correspondientes a las fechas de "<?php echo $fecha_in ?>" a "<?php echo $fecha_fin ?>"'
        };
        var chart = new google.charts.Bar(document.getElementById('1'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
        <br>
        <!--Grafica metas y resultados semestrales-->
            <center>
            <div class="grafica" id="2" style="width: 900px; height: 500px;"></div></center>
                     <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['<?php echo $opcion ?>', 'Resultado', 'Meta Trimestral'],
          ['Contactos', <?php echo $res ?>, <?php echo $filacmm1["contactos_meta_trimestral"] ?>],
          ['Citas', <?php echo $res2 ?>, <?php echo $filacmm1["citas_meta_trimestral"] ?>],
          ['Arranques', <?php echo $res4 ?>, <?php echo $filacmm1["arranques_meta_trimestral"] ?>],
          ['Conexiones', <?php echo $res3 ?>, <?php echo $filacmm1["conexion_meta_trimestral"] ?>]
        ]);
        var options = {'title':'Resultados de consulta especifica de "<?php echo $opcion ?>" Trimestral',
                       'subtitle': 'Correspondientes a las fechas de "<?php echo $fecha_in ?>" a "<?php echo $fecha_fin ?>"'
        };
        var chart = new google.charts.Bar(document.getElementById('2'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
        <!--Grafica metas y resultados anuales-->
           <center>
            <div class="grafica" id="3" style="width: 900px; height: 500px;"></div></center>
                     <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['<?php echo $opcion ?>', 'Resultado', 'Meta Anual'],
          ['Contactos', <?php echo $res ?>, <?php echo $filacmm1["contactos_meta_anual"] ?>],
          ['Citas', <?php echo $res2 ?>, <?php echo $filacmm1["citas_meta_anual"] ?>],
          ['Arranques', <?php echo $res4 ?>, <?php echo $filacmm1["arranques_meta_anual"] ?>],
          ['Conexiones', <?php echo $res3 ?>, <?php echo $filacmm1["conexion_meta_anual"] ?>]
        ]);
        var options = {'title':'Resultados de consulta especifica de "<?php echo $opcion ?>" Anual',
                       'subtitle': 'Correspondientes a las fechas de "<?php echo $fecha_in ?>" a "<?php echo $fecha_fin ?>"'
        };
        var chart = new google.charts.Bar(document.getElementById('3'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
        <!--Grafica metas y resultados anuales por mes-->
           <center>
            <div class="grafica" id="4" style="width: 1100px; height: 500px;"></div></center>
                    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Contactos', 'Citas', 'Arranque', 'Conexión'],
          ['Enero',  <?php echo $enero_ci ?>, <?php echo $enero_cit ?>, <?php echo $enero_arra ?>, <?php echo $enero_con ?>],
          ['Febrero',  <?php echo $febrero_ci ?>, <?php echo $febrero_cit ?>, <?php echo $febrero_arra ?>, <?php echo $febrero_con ?>],
          ['Marzo',  <?php echo $marzo_ci ?>, <?php echo $marzo_cit ?>, <?php echo $marzo_arra ?>, <?php echo $marzo_con ?>],
          ['Abril',  <?php echo $abril_ci ?>, <?php echo $abril_cit ?>, <?php echo $abril_arra ?>, <?php echo $abril_con ?>],
          ['Mayo',  <?php echo $mayo_ci ?>, <?php echo $mayo_cit ?>, <?php echo $mayo_arra ?>, <?php echo $mayo_con ?>],
          ['Junio',  <?php echo $junio_ci ?>, <?php echo $junio_cit ?>, <?php echo $junio_arra ?>, <?php echo $junio_con ?>],
          ['Julio',  <?php echo $julio_ci ?>, <?php echo $julio_cit ?>, <?php echo $julio_arra ?>, <?php echo $julio_con ?>],
          ['Agosto',  <?php echo $agosto_ci ?>, <?php echo $agosto_cit ?>, <?php echo $agosto_arra ?>, <?php echo $agosto_con ?>],
          ['Septiembre',  <?php echo $septiembre_ci ?>, <?php echo $septiembre_cit ?>, <?php echo $septiembre_arra ?>, <?php echo $septiembre_con ?>],
          ['Octubre',  <?php echo $octubre_ci ?>, <?php echo $octubre_cit ?>, <?php echo $octubre_arra ?>, <?php echo $octubre_con ?>],
          ['Noviembre',  <?php echo $noviembre_ci ?>, <?php echo $noviembre_cit ?>, <?php echo $noviembre_arra ?>, <?php echo $noviembre_con ?>],
          ['Diciembre',  <?php echo $diciembre_ci ?>, <?php echo $diciembre_cit ?>, <?php echo $diciembre_arra ?>, <?php echo $diciembre_con ?>]
        ]);

        var options = {
          title: 'Resultados correspondientes al año <?php echo date('Y'); ?>',
          hAxis: {title: 'Mes',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('4'));
        chart.draw(data, options);
      }
    </script>
        </div>
    <div class="container" >
    <center>
    <h2></h2>
      <div id="content" class="content">
        <!-- resultados reales-->
        <input hidden value="<?php echo $res ?>">
        <input hidden value="<?php echo $res2 ?>">
        <input hidden value="<?php echo $res3 ?>">


        <!--Metas contactos-->
        <input hidden type="text" value="<?php echo $filacmm1["contactos_meta_mensual"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["contactos_meta_trimestral"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["contactos_meta_anual"] ?>">


        <!--Metas citas-->
        <input hidden type="text" value="<?php echo $filacmm1["citas_meta_mensual"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["citas_meta_trimestral"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["citas_meta_anual"] ?>">

        <!--Metas arranques-->
        <input hidden type="text" value="<?php echo $filacmm1["arranques_meta_mensual"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["arranques_meta_trimestral"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["arranques_meta_anual"] ?>">


        <!--Metas conexiones-->
        <input hidden  type="text" value="<?php echo $filacmm1["conexion_meta_mensual"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["conexion_meta_trimestral"] ?>">
        <input hidden type="text" value="<?php echo $filacmm1["conexion_meta_anual"] ?>">
                 </div>
            </center>
        </div>
        </center>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {
           $("#1").show();



        $("#btnmensual").click(function(){
           $("#1").show();

           $("#2").hide();
           $("#3").hide();
           $("#4").hide();
        })
        $("#btntrimestral").click(function(){
            $("#1").hide();

            $("#2").show();
            $("#3").hide();
            $("#4").hide();
        })
        $("#btnanual").click(function(){
            $("#1").hide();

            $("#2").hide();
            $("#3").show();
            $("#4").hide();
        })
        $("#btnres_anual").click(function(){
            $("#1").hide();

            $("#2").hide();
            $("#3").hide();
            $("#4").show();
        })
       });
</script>
