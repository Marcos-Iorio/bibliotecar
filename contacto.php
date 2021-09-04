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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                    <h3>Contactanos!</h3>
                    <?php 
                    include "php/sendmail.php";
                     ?>
                    <form method="POST" name="contact_form" id="contact-form">
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
                            <?php 
                              if (isset($_POST['contactophp'])) {
                                enviarMail();
                              }
                             ?>
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

  <script src="js/navbarToggle.js"></script>
   <!-- jQuery CDN - Slim version =without AJAX -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <!-- <script>swal({
    title:'Exito',
    text:'',
    type: 'success',
    html:'<br><h5>Te enviamos un codigo a tu correo electrónico. Ingresalo debajo para confirmar tu usuario.</h5><br><input style="width: 150px; font-size: 36px; color: black; font-weight: bold; text-align: center;" type="text" required; maxlength = "6";"/><br><br> <div ><input type="submit" style="background-color: #495F91; color:white; margin-right: 5%;" name="confirmarCodigo" value="Confirmar"><input type="submit" style="background-color: gray; color:white;margin-left: 5%;" name="reenviarCodigo" value="Reenviar"></div>',
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
});</script>

               <script type="text/javascript">

                    swal({
    title:"Exito",
    text:"Te enviamos un codigo a tu correo electrónico. Ingresalo debajo para confirmar tu usuario.",
    input: "text",

   showCancelButton: true,
    cancelButtonColor: "gray",
    confirmButtonColor: "#495F91",
    confirmButtonText: "Confirmar",
    cancelButtonText: "Reenviar",
    width: 500,
    padding: "3em"

}).then((result) => {
  if (result.isConfirmed) {
    Swal(
      "Deleted!",
      "Your file has been deleted.",
      "success"
    )
  }
}); 
            
               
                </script>-->

                
</html>
   
 