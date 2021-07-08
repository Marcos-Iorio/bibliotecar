<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      header("Location: ../");
exit;
}
?>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
    <link rel="stylesheet"  href="../css/login.css">
    
</head>
<body onload="movimientoLogin(), mouseMove(), requerimientoPass()">
    <img id="libroIcon" src="../assets/libro-magico.svg" alt="" data-toggle="popover" title="¡CLICKEAME!" data-placement="bottom">
    <p class="pass__require hidden" id ="passRequire">La contraseña debe tener: 6 caracteres, 1 numero y 1 mayúscula</p>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../php/registro.php" method="POST">
                <h1>Crear cuenta</h1>
                <input type="text" placeholder="Nombre" name="username" id="username"  required/>
                <input type="email" placeholder="Email" name="mail" id="mail" required />
                <input type="password" placeholder="Contraseña" name="passwordRe" id="passwordRe" required />
                <button>Registrarse</button>
                <span id="resultado"></span>
                <!--<h6>Volver a pagina principal</h6>-->

            </form>
        </div>
        
        <div class="form-container sign-in-container">
            <form action="../php/login.php" method="POST">
                <h1>Iniciar sesión</h1>
                <input type="email" placeholder="Email" name="mailL" id="mailL" required />
                <input type="password" placeholder="Contraseña" name="passL" id="passL" required />
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button>Iniciar sesión</button>
                <span id="resultadoL"></span>
                <!--<h6>Volver a pagina principal</h6>-->
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de vuelta!</h1>
                    <p>Ingresa tus datos y seguí reservando libros</p>
                    <button class="ghost" id="signIn">Iniciar sesión</button>
                    <img class="logo" src="../assets/Logo sin fondo.png" alt="">
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Hola, amigo!</h1>
                    <p>Registrate para aprovechar todas las funciones de la biblioteca</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                    <img class="logo" src="../assets/Logo sin fondo.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
	
</footer>