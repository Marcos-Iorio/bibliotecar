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

                      /* Llena el tabla con todos los libros de la base de datos */
                      foreach($resultado as $fila):?>
                        
                        <tbody>
                          <tr>
                            <td><?php echo $fila['titulo'];?></td>
                            <td><?php echo $fila['nombreAutor'];?></td>
                            <td><?php echo $fila['nombreCategoria'];?></td>
                            <td><?php echo $fila['stock'];?></td>
                            <td><?php echo $fila['fechaAlta'];?></td>
                            <td><button><i class="fas fa-pencil-alt tbody-icon"></i></button></td>
                            <td><button><i class="far fa-trash-alt tbody-icon"></i></button></td>
                          </tr>
                        </tbody>
                      <?php endforeach; ?>
                      </table>
					          </div>
                </div>
            </section>
            <section class = "subir-libro">
              <div class="container-form">
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
                    <div class="separador"></div>
                    <label for="">Portada:</label>
                    <input class="portada-libro" type="file" name="portada" id="portada" multiple>
                    <br><br>
                    <label for="">Contra-tapa:</label>
                    <input class="portada-libro" type="file" name="imagenes-libro" id="imagenes-libro" multiple>
                    <br><br><br><br>

                    <div class="center">
                        <input type="submit" name="subir-libro" id="subir-libro" value="Subir">
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
</html>
   
 