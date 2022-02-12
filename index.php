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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <?php 
               if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                  echo '<h1 class="titulo-pagina"  style="margin-left: 50px;">Hola '. $user . '!</h1>';
               }else{
                  echo '<h1 style="margin-left: 50px;" >BibliotecAr</h1>';

               } 

           ?>
            <div class="container-paneles">
                <?php include "php/paneles.php"; ?>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <div class="info-reserva">
                            <p class="texto-panel">
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                              panelReserva($_SESSION['username']);
                            }else{
                                panelReserva(null);
                            }
                            ?>
                            </p>
                            <?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ){ ?>
                                    <a class="ver-mas-paneles" href="cuenta.php">Ver más</a>
                            <?php
                                }else{ ?>
                                    <a class="ver-mas-paneles" href="login.php">Crear cuenta</a>
                                <?php } ?>
                            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <p>Accede a tus libros recientemente descargados y reservados.</p>
                        <a href="cuenta.php">Ver más</a>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <p>Conoce mas informacion acerca de quienes somos y como contactarnos.</p>
                        <a href="#">Ver más</a>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <p>Accede a la seccion de administracion del portal (solo perfiles autorizados).</p>
                        <a href="admin-libros.php">Ver más</a>
                    </div>
                </div>
                <div id="clockdate">
                    <div id="wrapper" class="clockdate-wrapper">
                        <div id="clock" class="clock"></div>
                        <div id="date" class="date"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <p>Nos interesa tu opinion. Por favor ingresa aca si queres realizar algun comentario del
                            sistema.</p>
                        <a href="sugerencias.php">Ver más</a>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

<script src="js/navbarToggle.js"></script>
<!-- jQuery CDN - Slim version =without AJAX -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>
<script src="js/breadCrumbs.js"></script>

</html>