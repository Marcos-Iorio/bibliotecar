<!DOCTYPE html>
<?php
    

    session_start();

   /*  is_logged(); */
   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user=$_SESSION['username'];
    $pid=$_SESSION['rol'];

    $tiempo = time();

    if ($tiempo >= $_SESSION['expire']) {
      session_destroy();
       echo'<script type="text/javascript">
              alert("Su sesion ha expirado, por favor vuelva iniciar sesion.");
              </script>';
      header("Refresh:0");
    
    }
    
  }

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/mensajes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/contacto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <section id="page">
        <?php 
          include "panel.php";
         ?>
        <main id="main">
            <section class="contenido wrapper">
        <!--formulario-->
                <div class="container">
                    <h3>Contactanos!</h3>
                    <form action="../php/sendmail.php" method="POST" name="contact_form" id="contact-form">
                        <label for="first_name">Nombre</label>
                        <input name="name" type="text" required placeholder="Nombre.."/>
                        <br>
                        <label for="last_name">Apellido</label>
                        <input name="last_name" type="text" required placeholder="Apellido.."/>
                        <br>
                        <label for="email">Email</label>
                        <input name="email" type="email" required placeholder="you@dominio.com.."/>
                        <br>
                        <label for="message">Mensaje</label><br>
                        <textarea name="body" cols="30" rows="10" type="text" placeholder="Ingresá tu mensaje ..." required> </textarea>
                        <div class="center">
                            <input type="submit" name="contactophp" value="Enviar">
                        </div>
                    </form>	
                </div>
            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>

  <script src="../js/navbarToggle.js"></script>
 <!-- <script>swal({title:'Exito',text:'El registro fue insetado satisfactoriamente',type:'success'});</script>-->

</html>
   
 