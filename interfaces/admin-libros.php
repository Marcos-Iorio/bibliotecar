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
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/libros.css">
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
                    <h3>Gestion de libros!</h3>
                    <div class="grid-libros">

                    <?php
                    include_once('../php/llenarLibros.php');
                    /* Llena el tabla con todos los libros de la base de datos */
                    
                    foreach($resultado as $fila):?>
                    
                    <?php endforeach ?>

                    </div>
                </div>
            </section>
            <section class = "subir-libro">
                <form action="gestion-libros.php" method = "POST" class= "form-libro">

                    <label for="">Titulo:</label>
                    <input type="text" name="titulo" id="titulo" required placeholder="Titulo">
                    <br><br>
                    
                    <label for="">Autor: </label>
                    <input type="text" name="autor" id="autor" required placeholder="Autor">
                    <br><br>

                    <label for="">Descripcion: </label>
                    <input type="text" name="desc" id="desc" required placeholder="Descripcion del libro">
                    <br><br>

                    <label for="">Genero:</label>
                    <input type="text" name ="genero" id="genero" required placeholder="Género">
                    <br><br>

                    <label for="">Stock:</label>
                    <input type="number" name="stock" id="stock" required placeholder="Stock">
                    <br><br>

                    <label for="">Pdf de libro(Opcional):</label>
                    <input class="portada-libro" type="file" name="pdf" id="pdf" multiple>
                    <br><br>

                    <label for="">Imagenes, Portada(250x150):</label>
                    <input class="portada-libro" type="file" name="portada" id="portada" multiple>
                    <br><br><br><br>

                    <div class="center">
                        <input type="submit" name="subir-libro" id="subir-libro" value="Subir">
                    </div>
                    </form>

            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>
<script src="../js/navbarToggle.js"></script>
</html>
   
 