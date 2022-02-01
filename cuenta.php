<!DOCTYPE html>

<html lang="es">
  
<?php 
  include "php/islogin.php";
 ?>

<?php

/*  is_logged(); */
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user = $_SESSION['username'];
    $pid  = $_SESSION['rol'];

    $tiempo = time();

    if ($tiempo >= $_SESSION['expire']) {
        session_destroy();
        echo '<script type="text/javascript">
              alert("Su sesion ha expirado, por favor vuelva iniciar sesion.");
              </script>';
        header("Refresh:0");

    }

}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: php/unauthorized.php");
}

?>
  
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="stylesheet" href="css/inicio.css">
    <title>Mi cuenta</title>
    <script src="js/pleaserotate.js"></script>
</head>

<body onload="startTime()">
    <section id="page">
        <?php 
          include "php/panel.php";

         ?>
        <main id="main">
            <h1>Mi cuenta</h1>

            <br>
            <br>
            <br>
            <li>
                <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas" class="scroll-link"
                    onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Mis
                        libros </span></a>
                <ul class="collapse list-unstyled" id="reservas">
                    <br>
                    <!-- TABLA DE RESERVAS -->
                    <h3>Tus reservas activas</h3>
                    <!--<div class="tabla-libros"> -->

                    <div>
                        <table class="table-cuenta" class="bordered">
                            <thead>
                                <tr>
                                    <th>Nº Reserva</th>
                                    <th>Libro</th>
                                    <th>Estado</th>
                                    <th>Fecha reserva</th>
                                    <th>Fecha devolucion</th>
                                </tr>
                            </thead>

                            <?php 
                        include "php/datosCuenta.php";
                        getReservas($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                        </table>
                    </div>

                    <br>
                    <br>

                    <h3>Historial de reservas</h3>
                    <table class="bordered">
                        <thead>
                            <tr>
                                <th>Nº Reserva</th>
                                <th>Libro</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <?php 
                        getHistorial($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                    </table>
                    <br>

                    <br>
                    <h3>Tus descargas</h3>
                    <table class="bordered">
                        <thead>
                            <tr>
                                <th>Libro</th>
                                <th>Fecha de descarga</th>
                            </tr>
                        </thead>

                        <?php 
                        getDescargas($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                    </table>

                </ul>
                <br>

                <hr style="width: 80%;">

            </li>
            <li>
                <i id="flecha" class="fas fa-chevron-right"></i><a href="#configuracion" onclick="moveArrow()"
                    class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span
                        class="cuenta-item">Informacion de cuenta</span></a>

                <ul class="collapse list-unstyled" id="configuracion">
                    <br>
                    <h3>Datos personales</h3>
                    <br>
                    <?php 
                    datosUsuario($_SESSION['idUsuario']);
                     ?>
                </ul>
            </li>

            <br>

            <hr style="width: 80%;">

            <li>
                <i id="flecha" class="fas fa-chevron-right"></i><a href="#avanzado" onclick="moveArrow()"
                    class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Opciones
                        avanzadas</span></a>

                <ul class="collapse list-unstyled" id="avanzado">
                    <br>
                    <h3>Cambiar contraseña</h3>
                    <br>
                    <?php 
                    //datosUsuario('275');
                     ?>
                    <form method='POST' name='contact_form' id='contact-form'>
                        <label for='first_name' style="width: 20%;">Contraseña actual</label>
                        <input name='name' type='text' value='' />
                        <br>
                        <label for='last_name' style="width: 20%;">Nueva contraseña:</label>
                        <input name='last_name' type='text' value='' />
                        <br>
                        <label for='email' style="width: 20%;">Reingresar contraseña:</label>
                        <input name='email' type='text' value='' />
                        <br>
                        <br>
                        <div class='center'>
                            <input style="width: 200px; margin-left: 200px;" type='submit' value='Cambiar'>
                    </form>

                    <br>
                    <br>
                    <br>
                    <button style="width: 10%;" id="dar-de-baja" value='Dar de baja'>Dar de baja</button>
                    <?php 
                    //datosUsuario('275');
                     ?>

                </ul>

            </li>
            <!-- Modal dar de baja -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>¿Estás seguro que querés borrar tu cuenta? Este proceso no se puede revertir.</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input class="confirmar" id="confirmar" name="confirmar" value="Confirmar" type="submit">
                        </form>
                        <?php 
                        if (isset($_POST['confirmar'])) {
                            $id = $_SESSION['idUsuario'];
                            bajaUsuario($id);
                        }
                        ?>

                        <button id="cancelar">Cancelar</button>

                    </div>
                </div>


        </main>
    </section>
</body>
<script>
    const btnBaja = document.querySelector('#dar-de-baja');
    const modal = document.querySelector('#myModal');

    btnBaja.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = "block";
    });

    var span = document.querySelector('.close');

    var cancelar = document.querySelector('#cancelar');

    cancelar.onclick = function () {
        modal.style.display = "none";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }
</script>

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