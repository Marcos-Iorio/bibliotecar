<!DOCTYPE html>

<html lang="es">
<?php 
  include "php/islogin.php";
  include "php/reservar.php";

 ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/single-book.css">
    <title>Document</title>
</head>

<body onload="esconderBoton(), traducirPicker()">

    <section id="page">
        <?php 
          include "php/panel.php";
         ?>
        <main id="main">
            <div class="volver"><a href="./libros.php"><i class="fas fa-arrow-circle-left"></i></a></div>
            <div id="breadcrumbs"></div>
            <section class="libro">
                <?php
                //if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    include "php/llenarLibros.php";
                    $GLOBALS['idLibro'] = $_GET['sku'];
                    if (isset($_SESSION['idUsuario'])) {
                        $idUsuario = $_SESSION['idUsuario'];

                    }
                    
                    singleBook($idLibro);

                //}
            ?>
            </section>
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
                                  <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">

                    }*/
                     ?>
                    <div class="modal-body">
                        <form action="" method="POST" target="#">
                            <input type="hidden" name="start-date" id="start-date" value="">
                            <input type="hidden" name="end-date" id="end-date" value="">
                            <input class="confirmar" id="confirmar" name="confirmar" value="Confirmar" type="submit">
                        </form>
                        <?php 
                        if (isset($_POST['confirmar'])) {
                            include 'php/db.php';
                            
                            $query = "SELECT * FROM reservas
                                    INNER JOIN ejemplares ON ejemplares.idEjemplar = reservas.idEjemplar
                                    WHERE ejemplares.idLibro = $idLibro AND reservas.idUsuario = $idUsuario";

                            $stmt = $dbh->prepare($query);

                            $stmt->execute();
                            $libroReservado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if(empty($libroReservado)){
                                if (isset($mail)) {
                                    if(isset($_POST['start-date']) && isset($_POST['end-date'])){
                                        $startDate = $_POST['start-date'];
                                        $endDate = $_POST['end-date'];
                                    }
                                    
                                    mainReservar($mail, $_GET['sku'], $startDate, $endDate);
                                } else {
                                    echo "<script>swal({title:'Error',text:'Por favor ingrese con su cuenta de usuario para poder realizar una reserva.',type:'info'});</script> ";
                                }
                            }else{
                                echo "<script>swal({title:'Error',text:'Ya tenés una reserva activa de este libro, anda a MI CUENTA o devolvelo para poder reservarlo de nuevo.',type:'info'});</script> ";
                            }
                            
                        } 
                        ?>

                        <button id="cancelar">Cancelar</button>

                    </div>
                </div>
            </div>
        </main>
    </section>
</body>
<?php 

 ?>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>
<script src="js/breadCrumbs.js"></script>
<script src="js/sweetalert2.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="js/navbarToggle.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  
<script>
    /* Idenfitica si no tiene stock y deshabilita el boton */
    function esconderBoton() {
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
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    cancelar.onclick = function () {
        modal.style.display = "none";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script>
    $(function() { 
        moment.lang('es', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
        }
);
        $('input[name="dates"]').daterangepicker({
            opens: 'left',
            minDate: new Date()
        }, function(start, end, label) {
            console.log("Se ha seleccionado una nueva fecha: " + start.format('DD-MM-YYYY') + ' a ' + end.format('DD-MM-YYYY'));
            
            const startDate = start.format('YYYY-MM-DD');
            const endDate = end.format('YYYY-MM-DD');


            $('#start-date').val(startDate)
            $('#end-date').val(endDate)

        });

        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

    });


    function traducirPicker(){
        document.querySelector('button.applyBtn').innerText = "Aplicar";
        document.querySelector('button.cancelBtn').innerText = "Cancelar";
    }


</script>

</html>