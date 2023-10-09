<?php
    include 'php/conexion.php';
    $conexion = conexion();
    error_reporting(0);
    session_start();
    $user = htmlentities(addslashes($_POST['userlogin']));
    $pass = htmlentities(addslashes($_POST['passlogin']));

    if(isset($_POST['iniciarsesion']))
    {
        if(isset($_POST['userlogin']) && !empty($_POST['userlogin']) &&
           isset($_POST['passlogin']) && !empty($_POST['passlogin']))
        {
                
                $sqldos = "SELECT * FROM login WHERE user='$user' or correo='$user'";
                $recdos = mysqli_query($conexion,$sqldos);
                $sesion = mysqli_fetch_array($recdos);

                if(password_verify($pass, $sesion['password']))
                {
                    $_SESSION['user'] = $sesion['user'];
                    if($sesion['tipo'] == 1) {
                    header('location: admin.php');
                    }elseif ($sesion['tipo'] == 2) {
                      header("location: index1.php");
                    }else{
                        header("location: capacitacion1.php");
                    }

                }else{
                    echo "Combinacion erronea.";
                }

        }else{
            echo "<br/>";
            echo "Debes llenar ambos campos.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
  <title>Desarrolla-T</title>
  
</head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<body>    

<div class="col-md-12" class="center-block">
  
    <div class="modal-dialog" style="margin-bottom:0" class="center-block">
         <img class="center-block" src="imagenes/imagen.png" width="500" height="250"> 
        <br>
        <div class="modal-content" class="center-block">
            
                    <div class="panel-heading" class="center-block">
                        <h3 class="panel-title">Conectarse al portal Desarrolla-T</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="userlogin" type="text" autofocus="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="passlogin" type="password" value="">
                                </div>
                                <input type="submit"  name="iniciarsesion" value="INGRESAR">
                            </fieldset>
                        </form>
                    </div>
                </div>
    </div>
  </div>
</body>
</html>

