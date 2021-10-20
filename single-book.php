

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
    <link rel="stylesheet" href="css/sweetalert2.css">
    <script src="js/sweetalert2.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/single-book.css">
    <title>Document</title>
</head>
<body onload="esconderBoton()">
    <section id="page">
        <?php 
          include "php/panel.php";
         ?>
        <main id="main">
            <div class="volver"><a href="./libros.php"><i class="fas fa-arrow-circle-left"></i></a></div>
            <div id="breadcrumbs"></div>
            <section class = "libro">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    include "php/llenarLibros.php";
                    $GLOBALS['idLibro'] = $_GET['sku'];
                    
                    
                    singleBook($idLibro);
                    
                }
            ?>
                   <!--  <div id="imagenes-libros" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img id="img-libro" class="d-block w-100" src=<?php //echo $arr['imagen_libro'] ?> alt="First slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                   
                    
                    <div class="libro-info">
                        <div class = "titulo-info">
                            <label for="titulo"><?php //echo $arr['titulo']?></label>
                        </div>
                        <div class = "body-info">
                            <label for="autor">Autor:</label>
                            <span><?php //echo $arr['nombreAutor']?></span>
                            <label for="editorial">Editorial:</label>
                            <span><?php /* echo $arr['nombreEditorial'] */?></span>
                            <label for="stock">Stock:</label>
                            <span id="stock"><?php //echo $arr['stock']?></span>
                        </div>
                        <button class="reservar" id="reservar">Reservar</button>
                        <label for="pdf">PDF:</label>
                        <span><a href=""><i class="fas fa-cloud-download-alt"></i></a></span>
                    </div>
                    <div class = "descripcion">
                        <h3 class= "titulo-desc">Descripcion</h3>
                        <p class = "desc"><?php //echo $arr['descripcion'] ?></p>
                    </div> -->
            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
            <!-- Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>¿Querés reservar el libro<?php /* echo $arr['titulo']; */?>?</h2>
                    </div>
                    <?php 
                    /*if (isset($codigo)) {
                        echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success'});</script> ";
                    }*/
                     ?>
                    <div class="modal-body">
                        <form action="" method="POST" target="_self">
                        <a class="confirmar" id="confirmar" name="confirmar" href="php/reservar.php?sku=<?php echo $GLOBALS['idLibro'];?>">Confirmar</a>
                        </form>
                        <button id="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </main>
      </section>
</body>

     <!-- jQuery CDN - Slim version =without AJAX -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="js/navbarToggle.js"></script>
    <script src="js/breadCrumbs.js"></script>
    <script>
        /* Idenfitica si no tiene stock y deshabilita el boton */
            function esconderBoton(){
                let span = document.querySelector("#stock");;
                let button = document.getElementById('reservar');
                button.style.display = "none";
                button.addEventListener("change", stateHandle());
                function stateHandle() {
                    if (document.querySelector("#stock").innerHTML == 0) {
                        console.log("dentro del if")
                        button.style.display = "none"; 
                    } else {
                        button.style.display = "block"; 
                    }
                }
            }

            /* Abre y cierra el modal */
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("reservar");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            var cancelar = document.getElementById("cancelar");

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            cancelar.onclick = function(){
                modal.style.display = "none";
            }
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
    </script>

</html>
