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
                            <h4>Portal</h4>
                        </div>
                        <p>Ingresa al portal para ver todo el catalogo de libros disponible.</p>
                        <a href="libros.php">Ver más</a>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis reservas</h4>
                        </div>
                        <div class="info-reserva" >
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
                            <?php
                                }else{ ?>
                                    <a class="ver-mas-paneles" href="login.php">Ingresar</a>
                                <?php } ?>
                            
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                ?> 
                
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mi cuenta</h4>
                        </div>
                        <p>Accede a tu cuenta para mas detalles.</p>
                        <a href="cuenta.php">Ver más</a>
                    </div>
                </div>

                <?php } else {  ?>
                
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Contactanos</h4>
                        </div>
                        <p>Conoce mas informacion acerca de nuestro portal.</p>
                        <a href="contacto.php">Ver más</a>
                    </div>
                </div>

                <?php } ?>
    
                <?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == '2') {
    ?> 

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gestion de libros</h4>
                        </div>
                        <p>Administrar libros, editoriales, categorias, y autores (solo perfiles autorizados).</p>
                        <a href="admin-libros.php">Ver más</a>
                    </div>
                </div>
                <!-- <div id="clockdate">
                    <div id="wrapper" class="clockdate-wrapper">
                        <div id="clock" class="clock"></div>
                        <div id="date" class="date"></div>
                    </div>
                </div> -->

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gestion de reservas</h4>
                        </div>
                        <p>Administrar las reservas pendientes y activas (solo perfiles autorizados).</p>
                        <a href="admin-reservas.php">Ver más</a>
                    </div>
                </div>

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Contacto</h4>
                        </div>
                        <p>Contacta al soporte tecnico de BibliotecAr.</p>
                        <a href="contacto.php">Ver más</a>
                    </div>
                </div>
                <?php } ?>

                <?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == '3') {
    ?> 

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gestion de libros</h4>
                        </div>
                        <p>Administrar libros, editoriales, categorias, y autores (solo perfiles autorizados).</p>
                        <a href="admin-libros.php">Ver más</a>
                    </div>
                </div>
                <!-- <div id="clockdate">
                    <div id="wrapper" class="clockdate-wrapper">
                        <div id="clock" class="clock"></div>
                        <div id="date" class="date"></div>
                    </div>
                </div> -->

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gestion de usuarios</h4>
                        </div>
                        <p>Administrar los usuarios del sistema (solo perfiles autorizados).</p>
                        <a href="admin-usuarios.php">Ver más</a>
                    </div>
                </div>

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Reportes</h4>
                        </div>
                        <p>Accede a las distintas estadisticas del sistema (solo perfiles autorizados).</p>
                        <a href="reportes.php">Ver más</a>
                    </div>
                </div>
                <?php } ?>
            </div>

            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
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