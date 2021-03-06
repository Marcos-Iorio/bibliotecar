<!DOCTYPE html>
<?php
    include('php/llenarLibros.php');
    

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

<html lang="en" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo sin fondo.PNG">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio.css" type="text/css">
    <link rel="stylesheet" href="css/libros.css" type="text/css">
    <script defer src="js/lazyLoad.js"></script>
    <title>Document</title>
</head>
<body>
    <section id="page">
        <?php 
          include "php/panel.php";
         ?>
        <main id="main">
        <div class="volver"><a href="./libros.php"><i class="fas fa-arrow-circle-left"></i></a></div>
        <div id="breadcrumbs"></div>
            <section class="contenido wrapper">
                <div class = " filtros-busqueda ">
                <form name="formUsuarios" action="" method = "POST" class= "form-libro">
                    <div class="busqueda">
                        <i class="fas fa-search" onclick="showSearch()"></i>
                        <input class="campo-busqueda" type="text" style="background-color: #f1f1f1; color: black; height: 80%; margin-top: 20px;" name="campo-busqueda" id="campo-busqueda">
                        <input id="buscar" name=txtBuscar type="submit" value="Buscar" style=" margin-top: 10px; height: 30px;">
                    </div>
                </form>
                  <div class = "filtros">
                    <button onclick="abrirFiltros()"><i class="fas fa-filter"></i></button>
                  </div>
                </div>
                <div class="menu-filtro" id="menu-filtro">
                    <h3>FILTROS</h3> 
                    <a href="libros.php"><i class="fas fa-times"></i></a>  
                    <h3>STOCK</h3>
                    <div class="checklist autores">
                        <ul>
                            <li><a href="librosFiltrados.php?stock=1">Disponible</a></li>
                            <li><a href="librosFiltrados.php?stock=0">No Disponible</a></li>
                        </ul>   
                    </div> 
                    <h3>PDF</h3>
                    <div class="checklist autores">
                        <ul>
                            <li><a href="librosFiltrados.php?pdf=0">Sin PDF</a></li>
                            <li><a href="librosFiltrados.php?pdf=1">Con PDF</a></li>
                        </ul>   
                    </div>  
                    <h3>CATEGORIAS</h3>
                    <div class="checklist categories">
                        <ul>
                            <?php
                                todasLasCategorias();
                            ?>
                        </ul>
                    </div>
                </div>
        <!--Seccion de los libros-->
                <div class="container main-libros">
                    <h3>Portal de libros!</h3>
                    <div id="breadcrumbs"></div>
                    <div class="grid-libros">

                    <?php 
                        librosFiltrados();
                    ?>

                    </div>
                </div>
            </section>
        </main>
      </section>
</body>

<script src="js/navbarToggle.js"></script>
<script src="js/libros.js"></script>
<script src="js/breadCrumbs.js"></script>

 <!-- jQuery CDN - Slim version =without AJAX -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>
   
 