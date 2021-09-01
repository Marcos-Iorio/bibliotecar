<!DOCTYPE html>

<html lang="en">
<?php 
  include "php/islogin.php";
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <section id="page">
        <?php 
          include "panel.php";

         ?>
        <main id="main">
          <?php 
               if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                  echo '<h1 style="margin-left: 8%;font-size: 40px; color:white; text-shadow: 0 0 30px black;" >Bienvenido '. $user . '!</h1>';
               }else{
                  echo '<h1 style="margin-left: 8%;font-size: 40px; color:white; text-shadow: 0 0 30px black;" >BibliotecAr</h1>';

               } 

           ?>
           <br>
           <hr style="border: solid #383838">
            <p>
            </p>
<br>
<br>
<br>
<br>

<h1 style="text-align: center; margin-left: 8%;font-size: 32px; color:black;" >Acceso rapido</h1>;
<div class="container">
       
        <div class="card">
            <!--<img src="assets/img1.jpg">-->
            <br>
            <br>
            <h4 style="color: white;">Portal de libros</h4>
            <br>
            <br>
            <p>Ingresa al portal de libros para ver nuestro catalogo.</p>
            <br>
            <br>
            <a href="interfaces/libros.php">Ver más</a>
        </div>
        
        <div class="card">
            <br>
            <br>
            <h4 style="color: white;">Tus libros</h4>
            <br>
            <br>
            <p>Accede a tus libros recientemente descargados y reservados.</p>
            <br>
            <br>
            <a href="#">Ver más</a>
        </div>
      
              <div class="card">
            <br>
            <br>
            <h4 style="color: white;">Iniciar sesion</h4>
            <br>
            <br>
            <p>Logueate o registrate para poder acceder a otras funcionalidades.</p>
            <br>
            <br>
            <a href="interfaces/login.php">Ver más</a>
        </div>
      
        
    </div>
<br>
<div class="container">
       
                <div class="card">
            <br>
            <br>
            <h4 style="color: white;">Portal de gestion</h4>
            <br>
            <br>
            <p>Accede a la seccion de administracion del portal (solo perfiles autorizados).</p>
            <br>
            <br>
            <a href="interfaces/admin-libros.php">Ver más</a>
        </div>
        
        <div class="card">
            <br>
            <br>
            <h4 style="color: white;">Sugerencias</h4>
            <br>
            <br>
            <p>Nos interesa tu opinion. Por favor ingresa aca si queres realizar algun comentario del sistema.</p>
            <br>
            <br>
            <a href="#">Ver más</a>
        </div>
      
              <div class="card">
            <br>
            <br>
            <h4 style="color: white;">Conoce mas</h4>
            <br>
            <br>
            <p>Conoce mas informacion acerca de quienes somos y como contactarnos.</p>
            <br>
            <br>
            <a href="#">Ver más</a>
        </div>
        </div>
      
        

            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>

  <script src="js/navbarToggle.js"></script>

</html>
