<?php

  require_once "conexion.php";
    $conexion = conexion();
    $id = $_POST['id'];
    $fr = $_POST['fec_real'];
    $fc = $_POST['fech_con'];
    $es = $_POST['esta'];

    //print_r($id);

    $sql="UPDATE llenado_formulario set fec_real='$fr',
                                        fech_con='$fc',
                                        esta='$es'
               where id='$id'";
    echo $result = mysqli_query($conexion,$sql);

    echo $fc
?>



