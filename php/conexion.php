<?php
function conexion()
// 
{
  $servidor = "localhost";
  $usuario = "root";
  $bd = "gamse627_edats";
  $password = "";

  $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

  return $conexion;
}


class Database
{
    private $hostname = "localhost";
    private $database = "gamse627_edats";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    /**
     * Se conecta a la base de datos y devuelve un objeto PDO.
     * 
     * @return La conexión a la base de datos.
     */
    function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}



?>