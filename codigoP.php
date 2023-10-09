<?php 
session_start();

error_reporting(E_ALL);
include 'php/conexion.php';
$conexion = conexion();


$cp = $_GET['cp']; 


// Consulta SQL para obtener las opciones
$sql = "SELECT codigo, municipio, estado, colonia FROM postal WHERE codigo = '$cp'";
$result = $conexion->query($sql);

$options = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
}

// Devolver los datos como JSON
echo json_encode($options);



?>
