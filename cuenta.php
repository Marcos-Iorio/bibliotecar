<!DOCTYPE html>

<html lang="es">
<?php 
  include "php/islogin.php";
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body onload="startTime()">
    <section id="page">
        <?php 
          include "php/panel.php";

         ?>
        <main id="main">
            <h1 class="titulo-cuenta">Mi cuenta</h1>
            <h4 class ="titulo-cuenta">Pagina en construccion</h4>
            <div class="volver"><a href="./"><i class="fas fa-arrow-circle-left"></i></a></div>
            <div id="breadcrumbs"></div>
            
            <li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Mis resevas. </span></a>
                <ul class="collapse list-unstyled" id="reservas">
                    <!-- TABLA DE RESERVAS -->
                    <table>
                        asdasdaad
                    </table>
                
                </ul>
      
            </li>
            <li>
                <i id="flecha" class="fas fa-chevron-right"></i><a href="#configuracion" onclick="moveArrow()" class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Configuracion de la cuenta.</span></a>
                    <ul class="collapse list-unstyled" id="configuracion">
                    <form method="POST" name="contact_form" id="contact-form">
                        <label for="first_name">Nombre</label>
                        <input name="name" type="text"  placeholder="Nombre.."/>
                        <br>
                        <label for="last_name">Apellido:</label>
                        <input name="last_name" type="text"  placeholder="Apellido.."/>
                        <br>
                        <label for="email">Email:</label>
                        <input name="email" type="email"  placeholder="you@dominio.com.."/>
                        <br>
                        <label for="message">Contraseña:</label>
                        <input type="text">
                        <div class="center">
                        <input type="submit">
                        </div>
                    </ul>
            </li>
        
        

            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>

<script src="js/navbarToggle.js"></script>
<script src="js/breadCrumbs.js"></script>
   <!-- jQuery CDN - Slim version =without AJAX -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>
