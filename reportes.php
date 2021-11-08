<!DOCTYPE html>

<html lang="es">
<?php 
  include "php/islogin.php";
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/tablas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/reportes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
    <style>

        rect.bar {
            fill: navy;
        }

        .bar:hover{
            fill: blue;
        }

        g.tick {
            font-size: 13px;
        }
    </style>
</head>
<body onload="diasReserva(), historialReserva()">
    <section id="page">
        <?php 
          include "php/panel.php";
         ?>
        <main id="main">
            <div id="breadcrumbs"></div>
            <div id="treinta-dias-reservas">
                <svg width=1500 height=600 id="dias-reserva"></svg>
            </div>
            <div id="todo-eltiempo-reserva">
                <svg width=1500 height=600 id="historial-reserva"></svg>
            </div>
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
<script src="js/breadCrumbs.js"></script>
<script src="https://d3js.org/d3.v7.min.js"></script>
</html>
