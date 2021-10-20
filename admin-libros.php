<!DOCTYPE html>
<?php
    session_start();
     /* include '../php/cargarDatos.php'; */

 
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
    <script src="js/mensajes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/libros.css">
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
                    <h3>Gestion de libros!</h3>
                    <div class="tabla-libros">
                      <table class = "bordered">
                      <thead>
                          <tr>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Género</th>
                            <th>Stock</th>
                            <th>Fecha de Alta</th>
                            <th><i class="fas fa-pencil-alt"></i></th>
                            <th><i class="far fa-trash-alt"></i></th>
                          </tr>
                        </thead>
                      <?php
                      include_once('php/llenarLibros.php');
                      gestionLibros();
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                      </table>
					          </div>
                </div>
            </section>
            <section class = "subir-libro">
                <form action="" method = "POST" class= "form-libro" enctype="multipart/form-data" >
                

                    <label for="">Titulo:</label>
                      <input type="text" name="titulo" id="titulo" required placeholder="Titulo">
                    <br><br>
                    
                                     
                    <br><br>
                    <label for="">Autor Nuevo:</label>
                      <input type="text" name="autor" id="autor" required placeholder="Autor">
                    <br><br>


                    <label for="">Descripcion: </label>
                     <input type="text" name="desc" id="desc" required placeholder="Descripcion del libro">
                    <br><br>
 
                    <label for="">Categoria Nueva:</label>
                      <input type="text" name ="categoria" id="categoria" required placeholder="Categoria">
                    <br><br>

                  
                      
                    <label for="">Editorial Nueva:</label>
                      <input type="text" name ="editorial" id="editorial" required placeholder="Editorial">
                    <br><br>

                    <label for="">Stock:</label>
                      <input type="number" name="stock" id="stock" required placeholder="Stock">
                    <br><br>

                    <label for="">Fecha de alta</label>
                      <input type="date" name="fechaAlta" id="fechaAlta"><br><br>
                    

                    <label for="">Pdf de libro(Opcional):</label>
                      <input class="portada-libro" type="file" name="pdf" id="pdf" >
                    <br><br>

                    <label for="">Imagenes, tapa:</label>
                      <input class="portada-libro" type="file" name="tapa" id="tapa" >
                    <br><br><br><br>

                    
                    <label for="">Imagenes, ContraTapa:</label>
                      <input class="portada-libro" type="file" name="contratapa" id="contratapa">
                   
                    <div class="center">
                        <input type="submit" name="cargar-libro" id="cargar-imagenes" value="cargar">
                    </div>
                    
                    <?php

                    if(isset($_POST['cargar-libro'])){
                      include 'php/gestion-libros.php';

                      llenarTabla ($_POST['titulo'],$_POST['autor'],$_POST['desc'] ,$_POST['categoria'],$_POST['editorial'],
                      $_POST['stock'],$_POST['fechaAlta'], $_FILES['pdf']);

                      llenarImagen($_FILES['tapa'], $_FILES['contratapa']);
                    }
                  
                    ?>
                    </form>

            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>
<script src="js/navbarToggle.js"></script>
</html>
   
