<?php

  require_once "conexion.php";
    $conexion = conexion();
    $nombrem = $_POST['nombrem'];

    $dmmc = $_POST['dmmc'];
    $dmtc = $_POST['dmtc'];
    $dmac = $_POST['dmac'];

    $dmmci = $_POST['dmmci'];
    $dmtci = $_POST['dmtci'];
    $dmaci = $_POST['dmaci'];

    $dmmarra = $_POST['dmmarra'];
    $dmtarra = $_POST['dmtarra'];
    $dmaarra = $_POST['dmaarra'];

    $dmmco = $_POST['dmmco'];
    $dmtco = $_POST['dmtco'];
    $dmaco = $_POST['dmaco'];

    if($nombrem=="Todos"){
        $sql="UPDATE metas set 
    contactos_meta_mensual='$dmmc', 
    contactos_meta_trimestral='$dmtc',
    contactos_meta_anual='$dmac',
    citas_meta_mensual='$dmmci', 
    citas_meta_trimestral='$dmtci',
    citas_meta_anual='$dmaci',
    arranques_meta_mensual='$dmmarra',
    arranques_meta_trimestral='$dmtarra',
    arranques_meta_anual='$dmaarra',
    conexion_meta_mensual='$dmmco', 
    conexion_meta_trimestral='$dmtco',
    conexion_meta_anual='$dmaco'
    where nombre = 'Alan Soto' || nombre = 'Paloma Razo' || nombre = 'Omar Santos'";
    }else{
    $sql="UPDATE metas set 
    contactos_meta_mensual='$dmmc', 
    contactos_meta_trimestral='$dmtc',
    contactos_meta_anual='$dmac',
    citas_meta_mensual='$dmmci', 
    citas_meta_trimestral='$dmtci',
    citas_meta_anual='$dmaci',
    arranques_meta_mensual='$dmmarra',
    arranques_meta_trimestral='$dmtarra',
    arranques_meta_anual='$dmaarra',
    conexion_meta_mensual='$dmmco', 
    conexion_meta_trimestral='$dmtco',
    conexion_meta_anual='$dmaco'
    where nombre = '$nombrem'";
    }
    

    echo $result = mysqli_query($conexion,$sql);
?>