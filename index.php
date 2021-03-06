<!DOCTYPE html>

<html lang="es">
<?php 
  include "php/islogin.php";
 ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo sin fondo.PNG">
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
        <main id="main" style="overflow-y: hidden">
            
            <div style="text-align:center;" >
                <img src="assets/newlogo.png" alt="" style="width:180px;">
                <?php 
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                        if($pid == 1){
                            $pid = "Usuario";
                        }elseif($pid == 2){
                                $pid = "Colaborador";
                        }else{
                                $pid = "Administrador";
                        }
                        
                        echo '<h1 class="titulo-pagina"  style="margin-left: 50px;">Hola '. $pid . '!</h1>';
                    }else{
                        // echo '<div class="logo-inicio" ><img class="logo-inicio" src="assets/logo sin fondo.png" alt=""></div>'
                        echo '<h1 class="titulo-pagina"  style="margin-left: 50px;" >BibliotecAr</h1>';
                    } 
                ?>
            </div>
            <div class="container-paneles">
                <?php include "php/paneles.php"; ?>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Portal</h4>
                        </div>
                        <p>Ingres?? al portal para ver todo el cat??logo de libros disponible.</p>
                        <a class="ver-mas" href="libros.php">Ver m??s</a>
                    </div>
                </div>
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Mis libros</h4>
                        </div>
                        <div class="info-reserva" >
                            <p class="texto-panel">
                            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($user) ) {
                              panelReserva($_SESSION['mailL']);
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
                        <p>Acced?? a tu cuenta para m??s detalles.</p>
                        <a class="ver-mas" href="cuenta.php">Ver m??s</a>
                    </div>
                </div>

                <?php } else {  ?>
                
                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Contactanos</h4>
                        </div>
                        <p>Conoce m??s informaci??n acerca de nuestro portal.</p>
                        <a class="ver-mas" href="contacto.php">Ver m??s</a>
                    </div>
                </div>

                <?php } ?>
    
                <?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == '2') {
    ?> 

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gesti??n de libros</h4>
                        </div>
                        <p>Administrar libros, editoriales, categorias, y autores (solo perfiles autorizados).</p>
                        <a class="ver-mas" href="admin-libros.php">Ver m??s</a>
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
                            <h4>Gesti??n de reservas</h4>
                        </div>
                        <p>Administrar las reservas pendientes y activas (solo perfiles autorizados).</p>
                        <a class="ver-mas" href="admin-reservas.php">Ver m??s</a>
                    </div>
                </div>

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Contacto</h4>
                        </div>
                        <p>Contact?? al soporte t??cnico de BibliotecAr.</p>
                        <a class="ver-mas" href="contacto.php">Ver m??s</a>
                    </div>
                </div>
                <?php } ?>

                <?php
if (isset($_SESSION['rol']) && $_SESSION['rol'] == '3') {
    ?> 

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Gesti??n de libros</h4>
                        </div>
                        <p>Administrar libros, editoriales, categorias, y autores (solo perfiles autorizados).</p>
                        <a class="ver-mas" href="admin-libros.php">Ver m??s</a>
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
                            <h4>Gesti??n de usuarios</h4>
                        </div>
                        <p>Administrar los usuarios del sistema (solo perfiles autorizados).</p>
                        <a class="ver-mas" href="admin-usuarios.php">Ver m??s</a>
                    </div>
                </div>

                <div class="card">
                    <div class="info-paneles">
                        <div class="titulo-panel">
                            <h4>Reportes</h4>
                        </div>
                        <p>Acced?? a las distintas estadisticas del sistema (solo perfiles autorizados).</p>
                        <a class="ver-mas" href="reportes.php">Ver m??s</a>
                    </div>
                </div>
                <?php } ?>
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