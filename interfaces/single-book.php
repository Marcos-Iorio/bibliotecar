<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include('../php/db.php');
    $idLibro = $_GET['sku'];

    $stmt = $dbh->prepare('SELECT * FROM libros where idLibro =  "'. $idLibro .'"');

    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>

<html lang="es">
<?php 
  include "../php/islogin.php";
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/single-book.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <section id="page">
        <?php 
          include "panel.php";
         ?>
        <main id="main">
            <section class = "libro">
                    <div id="imagenes-libros" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img id="img-libro" class="d-block w-100" src=<?php echo $arr['imagen_libro'] ?> alt="First slide">
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
                            <label for="titulo"><?php echo $arr['titulo']?></label>
                        </div>
                        <div class = "body-info">
                            <label for="autor">Autor:</label>
                            <span><?php echo $arr['autor']?></span>
                            <label for="editorial">Editorial:</label>
                            <span><?php echo $arr['editorial']?></span>
                            <label for="stock">Stock:</label>
                            <span><?php echo $arr['stock']?></span>
                        </div>
                        <button class="reservar">Reservar</button>
                        <label for="pdf">PDF:</label>
                        <span><a href=""><i class="fas fa-cloud-download-alt"></i></a></span>
                    </div>
                    <div class = "descripcion">
                        <h3 class= "titulo-desc">Descripcion</h3>
                        <p class = "desc"><?php echo $arr['descripcion'] ?></p>
                    </div>
            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/navbarToggle.js"></script>

</html>
