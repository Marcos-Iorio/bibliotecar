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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/reservas.css">
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
                <div class = " filtros-busqueda ">
                  <div class="busqueda">
                    <i class="fas fa-search"></i>
                  </div>
                  <div class = "filtros">
                    <i class="fas fa-filter"></i>
                  </div>
                </div>
        <!--Seccion de los libros-->
                <div class="container main-libros">
                    <h3>Gestion de reservas!</h3>
                    <div class="tabla-libros">
                      <table class = "bordered">
                      <thead>
                          <tr>
                  <th>Reserva Nº</th>
                  <th>ID Libro</th>
                  <th>Estado</th>
                  <th>Usuario</th>
                  <th>Fecha solicitud</th>
                  <th>Fecha devolucion</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                          </tr>
                        </thead>
                      <?php
                      include "php/gestion-reservas.php";
                      gestionReservas();
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                        
                        
                      <?php  ?>
                      </table>
                    </div>
                </div>
            </section>
            <section class = "subir-libro" style="margin-left: 100px">
              <div class="container-form">
                <form action="php/gestion-reservas.php" method = "POST" class= "form-libro">

                    <label for="" style="width: 210px; text-align: left;">Confirmar reserva:</label>
                    <input type="text" style="background-color: white; color: black; width: 40%;" name="titulo" id="titulo" required placeholder="Ingrese ID de libro">
                    <input type="submit" name="subir-libro" id="subir-libro"/>
                    <br><br>
                    
                    <label for="" style="width: 210px; text-align: left;">Confirmar devolucion: </label>
                    <input type="text" style="background-color: white; color: black; width: 40%;"name="autor" id="autor" required placeholder="Ingrese ID de libro">
                    <input type="submit" name="subir-libro" id="subir-libro"/>
                    <br><br>

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
</html>
   
 