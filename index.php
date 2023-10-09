<?php
include 'php/conexion.php';
$conexion = conexion();
error_reporting(0);
session_start();
$user = htmlentities(addslashes($_POST['userlogin']));
$pass = htmlentities(addslashes($_POST['passlogin']));

if (isset($_POST['iniciarsesion'])) {
    if (
        isset($_POST['userlogin']) && !empty($_POST['userlogin']) &&
        isset($_POST['passlogin']) && !empty($_POST['passlogin'])
    ) {

        $sqldos = "SELECT * FROM login WHERE user='$user'";
        $recdos = mysqli_query($conexion, $sqldos);
        $sesion = mysqli_fetch_array($recdos);

        if (password_verify($pass, $sesion['password'])) {
            $_SESSION['user'] = $user;
            if ($sesion['tipo'] == 1) {
                header('location: admin.php');
            } elseif ($sesion['tipo'] == 2) {
                header("location: edat.php");
            } else {
                header("location: capacitacion1.php");
            }
        } else {
            echo "<link rel='icon' type='image/x-icon' href='imagenes/gam.ico'>
                  <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
                    <symbol id='exclamation-triangle-fill' fill='currentColor' viewBox='0 0 16 16'>
                    <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                    </symbol>
                  </svg>

                  <div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/>
                    <div class='textAlert'>
                        ¡Datos Incorrectos!
                    </div>
                    </svg>
                 </div>";
            session_destroy();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Desarrolla-T</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">

    <!-- Libraries for modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--Bootsrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style/style_index.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- LIBRERIAS DE ALERTAS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>

<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="imagenes/img-log.svg" alt="">
            </div>

            <div class="login__forms">
                <form method="POST" role="form" action="" class="login__registre" id="login-in">
                    <img class="login_logoGAM" src="imagenes/Logo_GAM2.png" alt="">
                    <div class="linea"></div>
                    <h1>
                        <p>Iniciar sesión</p>
                    </h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Usuario" class="login__input" style="background-color: #f2f2f2;" name="userlogin" required autocomplete="off">
                    </div>

                    <div class="login__box">
                        <i type="submit" class='bx bx-lock-alt login__icon'></i>
                        <input type="password" id="password" placeholder="Contraseña" class="login__input" style="background-color: #f2f2f2;" name="passlogin" required autocomplete="off">
                    </div>

                    <button type="submit" name="iniciarsesion" class="login__button">Ingresar</button>
            </div>
        </div>
    </div>

    <footer align="center">
        <div class="container text-center" align="center">
            <span>&#9400 2022 Grupo Administrativo Mexicano S.A de C.V | Todos los derechos reservados</span>
        </div>
    </footer>

</body>

</html>


<script>
    //Tiempo de visualizacion en alerta
    window.setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(300, function() {
                $(this).remove();
            });
        },
        3000);

    // Muestra la contraseña
    window.addEventListener("load", function() {
        // icono para mostrar contraseña
        showPassword = document.querySelector('.bx-lock-alt');
        showPassword.addEventListener('click', () => {
            // elementos input de tipo clave
            password1 = document.querySelector('#password');
            if (password.type === "text") {
                password.type = "password"
                showPassword.classList.toggle('bx-lock-open');
            } else {
                password.type = "text"
                showPassword.classList.toggle('bx-lock-open');
            }

        })

    });
</script>