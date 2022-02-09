<!DOCTYPE html>
<?php
session_start();

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

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || !isset($_SESSION['rol']) || $_SESSION['rol'] != '2') {
    header("Location: php/unauthorized.php");
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
    <link rel="stylesheet" href="css/reservas.css">
    <link rel="stylesheet" href="css/datatable.css">

    <link rel="stylesheet" href="css/jquery.dataTables.min.css">

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
                <!-- <div class = " filtros-busqueda ">
                  <div class="busqueda">
                    <i class="fas fa-search"></i>
                  </div>
                  <div class = "filtros">
                    <i class="fas fa-filter"></i>
                  </div>
                </div> -->
        <!--Seccion de los libros-->
                <div class="container main-libros">
                    <h3 class="titulo-pagina">Gestion de reservas!</h3>

                   <form method="POST" id="form-reservas" action="#" name="busqueda" >


                    <label for="" style="width: 210px; text-align: left;">Ingresar reserva:</label>
                    <input type="text" style="background-color: white; color: black; width: 40%;" name="ingresarReserva" id="titulo"  placeholder="Ingrese ID de reserva">
                    <input type="submit" name="btnReserva" id="subir-libro" value="Cargar" />
                    <br><br>
                    
                    <label for="" style="width: 210px; text-align: left;">Ingresar devolucion: </label>
                    <input type="text" style="background-color: white; color: black; width: 40%;"name="ingresarDevolucion" id="autor"  placeholder="Ingrese ID de libro">
                    <input type="submit" name="btnDevolucion" id="subir-libro" value="Cargar"/>
                    <br>

                    <!-- <div style="display: flex;justify-content: space-between;align-items: center;">

                    <h6 style="width: 100px;">Buscar por:</h6>
                    <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
                      <option value="" disabled selected>Seleccionar</option>
                        <option value="mail">Nro Reserva</option> 
                        <option value="idRol">ID Libro</option>
                        <option value="check_mail">Usuario</option>
                        <option value="idEstado">Estado </option>    
                    </select>

                    <input style="background-color: white; width: 200px; height: 40px; color:black;"type="text" name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control" >
                    <div style="text-align: right; height: 150px">
                    <input style="margin-bottom: 10px !important;" type="submit"  value="Buscar" href="#?page=1" name="btnBuscar" class="btn btn-outline-dark my-2 my-sm-0"/><a href="admin-reservas.php?page=1"></a>
                    <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0"/>
                    </div>
                    </div> -->

                    <hr>
                </form>
                <div class="tabla-libros">
                <table id="tablaReservas" class="table-striped table-bordered" style="width:100%">

                      <thead>
                  <th>Reserva Nº</th>
                  <th>ID Libro</th>
                  <th>Titulo</th>
                  <th>Estado</th>
                  <th>Usuario</th>
                  <th>Fecha solicitud</th>
                  <th>Fecha devolucion</th>
                  <th>Editar</th>
                  
                        </thead>
                        <tbody>
                      <?php
                      include "php/gestion-reservas.php";

                       //if (!isset($_POST['btnReserva']) && !isset($_POST['btnDevolucion'])  && !isset($_POST['btnEditar'])) {
                      gestionReservas();
                        //}
                      /* Llena el tabla con todos los libros de la base de datos */
   

                      if (isset($_POST['btnReserva'])) {
                        ingresarReserva($_POST['ingresarReserva']);
                      }

                      if (isset($_POST['btnDevolucion'])) {
                        ingresarDevolucion($_POST['ingresarDevolucion']);
                      }

                      if (isset($_POST['btnEditar'])) {
                        editarReserva($_POST['txtReserva'], $_POST['selectEstado'], $_POST['txtIDEjemplar']);
                      }

                      ?>
                        
                        
                      <?php  ?>
                      </tbody>
                      </table>
                      <br>
                      <?php 
            // $paginas = getPages();

            //  for($page = 1; $page<= $paginas; $page++) {  
            //   echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-reservas.php?page=' . $page . '">' . $page . ' </a>';  
            // }  
              echo "</div>";

               ?>
                    </div>
                </div>
            </section>

            <section class = "subir-libro" style="margin-left: 100px">
              <div class="container-form" id="container-form">
              <span id="close">&times;</span>
                <form name="formReservas" id="formReserva" action="" method = "POST" class= "form-libro">

                  <div class="wrapper-reserva">
                    <label class="modal-reserva" for="" >Reserva:</label>
                    <input name="txtReserva" class="reserva-libro" type="text" name="titulo" id="titulo" readonly>
                    <label hidden class="modal-reserva" for="" >idLibro:</label>
                    <input hidden name="txtIDEjemplar" class="reserva-libro" type="text" >
                    <label class="modal-reserva" for="">Usuario: </label>
                    <input name="txtUsuario" class="reserva-libro" type="text" name="autor" id="autor" readonly>
                    <label class="modal-reserva" for="">Estado: </label>
                    <select name="selectEstado" id="selectEstado" class="form-control">
                    <option name="txtEstado" value="" class="reserva-libro" disabled selected >Seleccionar</option>
                    <?php getEstadoReservas(); ?>
                     </select>
                    <!--<input name="txtEstado" style="background-color: white; color: black; width: 20%;"type="text" name="desc" id="desc"  placeholder="Seleccionar">   -->
                    <br style="width: 50px;">

                  </div>
        <br>
        <br>
                  <div class="centrar-boton">
                    <input type="submit" name="btnEditar" id="subir-libro" value="Confirmar" />
                  </div>
                    <br><br>

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
<script>
/* Abre el modal */

var modal = document.getElementById("container-form");

// Get the button that opens the modal
var btn = document.querySelectorAll("#modal-reservas");

for(var i = 0; i < btn.length ; i++) {
  btn[i].onclick = function() {
    modal.style.display = "block";
  }
};

// Get the <span> element that closes the modal
var span = document.getElementById("close");

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
      

function cargarReserva(idReserva, usuario, estadoReserva, idEjemplar){

  document.formReservas.txtReserva.value = idReserva;
  
  document.formReservas.txtIDEjemplar.value = idEjemplar;

  document.formReservas.txtUsuario.value = usuario;

    let estado = document.getElementById('selectEstado');
    estado.value=estadoReserva;

    /* formReserva.document.getElementsByName('selectEstado')[0].options[0].innerHTML = estadoReserva; */

    //window.location = 'vistaProducto.php#gestionProducto';
}
  
          
</script>
<script src="js/navbarToggle.js"></script>
 <!-- jQuery CDN - Slim version =without AJAX -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
      
<!--    Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
      
      
    <script>
      $(document).ready(function(){
         $('#tablaReservas').DataTable({
          "lengthMenu": [[5, 10, 20, 30], [5, 10, 20, 30]],
        "responsive": true,
        "pagingType": "simple",
    });  
         
      });
    </script>
    
    <script src="js/Spanish.js"></script>
    </html>
   
 