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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/usuarios.css">
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
                    <h3>Gestion de usuarios!</h3>
                    <div class="tabla-libros">
                      <table class = "bordered" id="usuarios">
                      <thead>
                          <tr>
                  <th>ID</th>
                  <th>Rol</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>DNI</th>
                  <th>Mail</th>
                  <th>Alta</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                          </tr>
                        </thead>
                      <?php
                      include "php/gestion-usuarios.php";
                      gestionUsuarios();
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                        
                        
                                    <?php 
          //include 'php/pages.php';
          /* $paginas= new ;
            for($page = 1; $page<= $paginas->getPages(); $page++) {  
              echo '<a style="margin-left:20px"  class="btn btn-dark" href = "vistaProducto.php?page=' . $page . '">' . $page . ' </a>';  
            }*/  

          ?>
                      </table>
                    </div>
                </div>
            </section>
                                <h3>Modificar usuarios:</h3>

            <section class = "subir-libro" style="text-align: center; margin-right: 150px;">
              <div class="container-form">
                <form action="php/gestion-usuarios.php" method = "POST" class= "form-libro">
<div>
                    <label for="" style="width: 100px;">Nombre:</label>
                    <input style="background-color: white; color: black; width: 30%;"type="text" name="titulo" id="titulo" required placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">Apellido: </label>
                    <input style="background-color: white; color: black; width: 30%;"type="text" name="autor" id="autor" required placeholder="Ingresar dato">
                    <br style="width: 50px;">
                    
                  </div><div>

                    <label for=""style="width: 100px;">Rol: </label>
                    <input style="background-color: white; color: black; width: 30%;"type="text" name="desc" id="desc" required placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">DNI: </label>
                    <input style="background-color: white; color: black; width: 30%;"type="text" name="desc" id="desc" required placeholder="Ingresar dato">
                    <br style="width: 50px;">
</div><div>
                    <label for=""style="width: 100px;">Mail:</label>
                    <input style="background-color: white; color: black; width: 30%;"type="text" name ="genero" id="genero" required placeholder="Ingresar dato">

                    <label for=""style="width: 100px;">Alta:</label>
                    <input style="background-color: white; color: black; width: 30%;"type="number" name="stock" id="stock" required placeholder="Ingresar dato">
                    <br><br>
</div>
                    </form>
              </div>         
            </section>
                                <input style="width: 30%; margin-left: 360px;" type="submit" name="subir-libro" id="subir-libro"/>

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
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1..2/js/dataTables.bootstrap4.min.js"></script>
    </head>
    <script>
      $(document).ready(function() {
      $('#usuarios').DataTable();
} );
    </script>
    </html>
   
 