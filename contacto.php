<!DOCTYPE html>
<?php
    
  include "php/islogin.php";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/contacto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <section id="page">
        <?php 
          include "php/panel.php";
         ?>
        <main id="main">
            <section class="contenido wrapper">
        <!--formulario-->
                <div class="container">
                    <?php 
                    include "php/sendmail.php";
                     ?>
                    <div class="row">
                    <div class="column">
                    <h3>Comunicate con nosotros</h3>
                      <br>  <br> 
                        <form method="POST" name="contact_form" id="contact-form">
                          <label for="first_name">Nombre</label>
                          <input name="name" type="text" required placeholder="Nombre.."/>
                          <br>
                          <label for="last_name">Apellido</label>
                          <input name="last_name" type="text" required placeholder="Apellido.."/>
                          <br>
                          <label for="email">Email</label>
                          <input name="email" id="email" type="email" required placeholder="you@dominio.com.."/>
                          <br>
                          <label for="message">Mensaje</label><br>
                          <textarea style= "color: black; height: 150px;" maxlength="1000" name="body" cols="30" rows="10" type="text" placeholder="Ingresá tu mensaje ..." required></textarea>
                          <div class="center">
                          <div name="btncaptcha" class="g-recaptcha brochure__form__captcha" data-sitekey="6LcArdAdAAAAAOUQbgqIYOPr5M0v2EAYx6A70DUn" data-callback="checked" required></div>
                          <input type="submit" id="btn-enviar-consulta" name="contactophp" disabled value="Enviar">
                          <div id="error"></div>
                              <?php 
                                if (isset($_POST['contactophp'])) {
                                  enviarMail();
                                }

                                // if(isset($_POST['g-recaptcha-response'])) {
                                //   // RECAPTCHA SETTINGS
                                //   $captcha = $_POST['g-recaptcha-response'];
                                //   $ip = $_SERVER['REMOTE_ADDR'];
                                //   $key = 'INSERT SECRET KEY HERE';
                                //   $url = 'https://www.google.com/recaptcha/api/siteverify';
                               
                                //   // RECAPTCH RESPONSE
                                //   $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
                                //   $data = json_decode($recaptcha_response);
                               
                                //   if(isset($data->success) &&  $data->success === true) {
                                //   }
                                //   else {
                                //      die('Your account has been logged as a spammer, you cannot continue!');
                                //   }
                                // }
                              ?>
                          </div>
                        </form>	
                      </div>
                      <div class="column">
                          <div class="info-contacto">
                            <h3>Información de contacto.</h3>
                            <br><br>
                            <p style="text-align: center;"><strong> Ubicación: </strong>
                              Para venir a retirar y devolver los libros vení a <strong> <br> Av. Belgrano 1191, Avellaneda.</strong>
                            </p>
                            <p style="text-align: center;">Recordá que la biblioteca está abierta de <strong>9:00 a 19:00hrs</strong></p>
                            <br>
                            <div class="mapa">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d689.8273218947161!2d-58.36305764054799!3d-34.67009924330167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a33348525b8105%3A0x688c2224c9769fa1!2sInstituto%20Tecnol%C3%B3gico%20Beltr%C3%A1n!5e0!3m2!1ses-419!2sar!4v1644444787915!5m2!1ses-419!2sar" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <br><br>
                            <p style="text-align: center;">Seguinos en nuestras redes sociales:</p>
                            
                            <div class="social-media">
                            <a href="https://www.instagram.com/instbeltran/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.facebook.com/institutobeltran" target="_blank"><i class="fa-brands fa-facebook-f"></i></a> 
                            </div>
                          </div>
                            
                      </div>

                    </div>
                    
                </div>
            </section>
        </main>
      </section>

</body>
<script>
  if(document.querySelector('#btn-enviar-consulta').disabled == true){
    document.querySelector('#error').textContent = "Falta validación recaptcha"
    document.querySelector('#error').style.color = "red";
  }
  
  function checked(){
    document.querySelector('#btn-enviar-consulta').disabled = false;
    document.querySelector('#error').remove();
  }
</script>

  <script src="js/navbarToggle.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
   <!-- jQuery CDN - Slim version =without AJAX -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</html>
   
 