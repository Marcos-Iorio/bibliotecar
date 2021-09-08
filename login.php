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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>

    <script type="text/javascript" src="js/login.js"></script>
    <link rel="stylesheet"  href="css/login.css">
        <script src="js/sweetalert2.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.css">
    
</head>
<body onload="movimientoLogin(), mouseMove(), requerimientoPass(), swal()">
    <img id="libroIcon" src="assets/libro-magico.svg" alt="" data-toggle="popover" title="¡CLICKEAME!" data-placement="bottom">
    <p class="pass__require hidden" id ="passRequire">La contraseña debe tener: 6 caracteres, 1 numero y 1 mayúscula</p>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <?php 
            include "php/registro.php"
             ?>
            <form method="POST">
                <h1>Crear cuenta</h1>
                <input type="text" placeholder="Nombre" name="username" id="username"  required/>
                <input type="email" placeholder="Email" name="mail" id="mail" required />
                <input type="password" placeholder="Contraseña" name="passwordRe" id="passwordRe" required />
                <button name="registrophp">Registrarse</button>
                <span id="resultado"></span>
                <?php 
    if(isset($_POST['registrophp'])){
        
        registrarUsuario();
    //<?php if(isset($_POST[\'confirmarMail\'])){ registrarUsuario();} 
    }

                 ?>
                <!--<h6>Volver a pagina principal</h6>-->

            </form>
        </div>
        
        <div class="form-container sign-in-container">
            <form action="php/login-back.php" method="POST">
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
                    <a href="../"><img class="logo" src="assets/Logo sin fondo.png" alt=""></a>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Bienvenido!</h1>
                    <p>Registrate para aprovechar todas las funciones de la biblioteca</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                    <a href="../"><img class="logo" src="assets/Logo sin fondo.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>

</body>
<!--<script>swal({
    title:'Registro exitoso',
    text:'',
    type: 'success',
    html:'<br><h5>Te enviamos un codigo a tu mail. Ingresalo debajo para confirmar tu usuario.</h5><br><input style="width: 180px; font-size: 36px; color: black; font-weight: bold; text-align: center;" type="text" required; maxlength = "6";"/><br><br> <div ><input type="submit" style="background-color: #495F91; color:white; margin-right: 5%; width: 150px;" name="confirmarCodigo" value="Confirmar"><input type="submit" style="background-color: gray; color:white;margin-left: 5%; width: 150px;" name="reenviarCodigo" value="Reenviar"></div>',
   showCancelButton: false,
      showConfirmButton: false,

    cancelButtonColor: 'gray',
    confirmButtonColor: '#495F91',
    confirmButtonText: 'Confirmar <i name="confirmarCodigo"></i>',
    cancelButtonText: 'Reenviar <i name="reenviarCodigo></i>',
    width: 500,
    padding: '3em'

}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
});</script>-->
<footer>


	
</footer>
