<!DOCTYPE html>

<html lang="es" style="height:100%;">
  
<?php 
  include "php/islogin.php";
 ?>

<?php

/*  is_logged(); */
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user = $_SESSION['username'];
    $pid  = $_SESSION['rol'];

    $tiempo = time();

    if ($tiempo >= $_SESSION['expire']) {
        // session_destroy();
        echo '<script type="text/javascript">
              alert("Su sesion ha expirado, por favor vuelva iniciar sesion.");
              </script>';
        header("Refresh:0");

    }

}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: php/unauthorized.php");
}

?>
  
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="stylesheet" href="css/inicio.css">
    <title>Mi cuenta</title>
    <script src="js/pleaserotate.js"></script>
</head>
<style>
    html.pleaserotate-hiding {
        height: 100% !important;
    }
</style>

<body onload="startTime(), requerimientoPass()">
    <section id="page">
        <?php 
          include "php/panel.php";

         ?>
        <main id="main">
            <h1>Mi cuenta</h1>

            <br>
            <br>
            <br>
            <li>
                <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas" class="scroll-link"
                    onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Mis
                        libros </span></a>
                <ul class="collapse list-unstyled" id="reservas">
                    <br>
                    
                    <?php
                    include "php/datosCuenta.php";
                    $cantidad=getCantidadReservas($_SESSION['idUsuario']); ?>
                    <!-- TABLA DE RESERVAS -->
                    <h3>Tus reservas activas: <b><?php echo $cantidad; ?>  </b></h3>
                    <!--<div class="tabla-libros"> -->
                    
                    <div style="width:70%;">
                        <table id="tablaReservasActivas"  class="table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nº Reserva</th>
                                    <th>Libro</th>
                                    <th>Estado</th>
                                    <th>Fecha reserva</th>
                                    <th>Fecha devolución</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                        getReservas($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                         </tbody>
                        </table>
                    </div>

                    <br>
                    <br>

                    <h3>Historial de reservas:</h3>
                    <div style="width:70%;">
                        <table id="tablaHistorialReservas"  class="table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nº Reserva</th>
                                    <th>Libro</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                        getHistorial($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                         </tbody>
                        </table>
                    </div>
                    <!-- <br>
                    <h3>Tus descargas</h3>
                    <div style="width:70%;">
                    <table id="tablaDescargas"  class="table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Libro</th>
                                <th>Fecha de descarga</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        getDescargas($_SESSION['idUsuario']);
                        /*foreach($_POST as $campo => $valor){
  echo "- ". $campo ." = ". $valor;
}*/
                         ?>
                        </tbody>
                    </table>
                    </div> -->
                </ul>
                <br>

                <hr style="width: 80%;">

            </li>
            <li>
                <i id="flecha" class="fas fa-chevron-right"></i><a href="#configuracion" onclick="moveArrow()"
                    class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span
                        class="cuenta-item">Información de cuenta</span></a>

                <ul class="collapse list-unstyled" id="configuracion">
                    <br>
                    <h3>Datos personales</h3>
                    <br>
                    <?php 
                    datosUsuario($_SESSION['idUsuario']);
                     ?>
                </ul>
            </li>

            <!-- Modal datos personales -->
            <div id="modal-datos" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close-datos">&times;</span>
                        <h2>¿Querés modificar tus datos<?php /* echo $arr['titulo']; */?>?</h2>
                    </div>
                    <?php 
                    /*if (isset($codigo)) {
                        echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success'});</script> ";
                                  <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">

                    }*/
                     ?>
                    <div class="modal-body">
                        <form action="#" method="POST" name="formModificarDatos">
                            <input class="confirmar" id="confirmarDatos" name="confirmarDatos" value="Confirmar" type="submit">
                            <input hidden id="txtNombre" name="txtNombre" type="text">
                            <input hidden id="txtApellido" name="txtApellido" type="text">
                            <input hidden id="txtDNI" name="txtDNI" type="text">
                            <input hidden id="txtTelefono" name="txtTelefono" type="text">
                            <input hidden id="txtDireccion" name="txtDireccion" type="text">

                        </form>
                        <?php 
                        if (isset($_POST['confirmarDatos'])) {
                            $idUsuario = $_SESSION['idUsuario'];
                            $nombre = $_POST['txtNombre'];
                            $apellido = $_POST['txtApellido'];
                            $documento = $_POST['txtDNI'];
                            $telefono = $_POST['txtTelefono'];
                            $direccion = $_POST['txtDireccion'];
                            modificarDatos($idUsuario, $nombre, $apellido, $documento, $telefono, $direccion);
                        } 
                        ?>

                        <button id="cancelar-datos">Cancelar</button>

                    </div>
                </div>
            </div>

            <br>

            <hr style="width: 80%;">

            <li>
                <i id="flecha" class="fas fa-chevron-right"></i><a href="#avanzado" onclick="moveArrow()"
                    class="scroll-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Opciones
                        avanzadas</span></a>

                <ul class="collapse list-unstyled" id="avanzado">
                    <br>
                    <h3>Cambiar contraseña</h3>
                    <br>
                    <?php 
                    //datosUsuario('275');
                     ?>
                    <form method='POST' name='contact_form' id='contact-form'>
                        <label for='first_name' style="width: 20%;">Contraseña actual</label>
                        <input name='pwdActual' id='pwdActual'  type='password' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                        <br>
                        <label for='last_name' style="width: 20%;">Nueva contraseña:</label>
                        <input name='last_name' type='password' id="new-pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                        <br>
                        <label for='email' style="width: 20%;">Reingresar contraseña:</label>
                        <input name='email' type='password' id="repeat-pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                        <div id="error"></div>

                        <button disabled style="margin-left: 120px;" class='modificar-pass' id='modificar-pass'>Cambiar contraseña</button>

                    </form>

                    <!-- Modal contraseña -->
                    <div id="modal-contrasenia" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close-contrasenia">&times;</span>
                                <h2>¿Querés modificar tu contraseña<?php /* echo $arr['titulo']; */?>?</h2>
                            </div>
                            <?php 
                            /*if (isset($codigo)) {
                                echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success'});</script> ";
                                        <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">

                            }*/
                            ?>
                            <div class="modal-body">
                                <form action="#" method="POST" name="modificarPwd">
                                    <input class="confirmarPass" id="confirmarPass" name="confirmarPass" value="Confirmar" type="submit">
                                    <input hidden id="txtPwd" name="txtPwd" type="text">
                                    <input hidden id="txtPwdNueva" name="txtPwdNueva" type="text">  
                                                    
                                </form>
                                <?php 
                                if (isset($_POST['confirmarPass'])) {
                                    $pwd=$_POST['txtPwd'];
                                    $pwdNueva=$_POST['txtPwdNueva'];

                                    modificarPwd($_SESSION['idUsuario'], $pwd, $pwdNueva);
                                } 
                                ?>

                                <button id="cancelar-contrasenia">Cancelar</button>

                            </div>
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>
                    <button style="margin-left: 120px;" style="width: 10%;" id="dar-de-baja" value='Dar de baja'>Dar de baja</button>
                    <?php 
                    //datosUsuario('275');
                     ?>

                </ul>

            </li>
            <!-- Modal dar de baja -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>¿Estás seguro que querés borrar tu cuenta? Este proceso no se puede revertir.</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input class="confirmar" id="confirmar" name="confirmar" value="Confirmar" type="submit">
                        </form>
                        <?php 
                        if (isset($_POST['confirmar'])) {
                            $id = $_SESSION['idUsuario'];
                            bajaUsuario($id);
                            
                        }

                        if (isset($_POST['modificarUsuario'])) {
                            $id = $_SESSION['idUsuario'];
                            modificarDatos($id,$_POST['name'],$_POST['last_name'],$_POST['numeroDocumento'],$_POST['telefono'],$_POST['direccion']);
                        }
                        ?>

                        <button id="cancelar">Cancelar</button>

                    </div>
                </div>
        </main>
    </section>
    <div class="pass__require" id ="passRequire" style="z-index: 50;">
        <h3>La contraseña debe contener:</h3>
        <p id="letter" class="require invalid">Una <b>letra</b> Minúscula</p>
        <p id="capital" class="require invalid">Una <b>letra</b> Mayúscula</p>
        <p id="number" class="require invalid">Un <b>numero</b></p>
        <p id="length" class="require invalid">Mínimo <b>8 carácteres</b></p>
    </div>
      <!--    Datatables-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

<!-- 
<script>
  $(document).ready(function () {
    $('#tablaReservasActivas').DataTable();
  });

  $(document).ready(function () {
    $('#tablaHistorialReservas').DataTable();
  });

  $(document).ready(function () {
    $('#tablaDescargas').DataTable();
  });
</script> -->
</body>
<script>
    const btnBaja = document.querySelector('#dar-de-baja');
    const modal = document.querySelector('#myModal');

    btnBaja.addEventListener('click', (e) => {
        e.preventDefault();
        modal.style.display = "block";
    });

    var span = document.querySelector('.close');

    var cancelar = document.querySelector('#cancelar');

    cancelar.onclick = function () {
        modal.style.display = "none";
    }
    span.onclick = function () {
        modal.style.display = "none";
    }
</script>
<script>

    const modalDatos = document.querySelector('#modal-datos');
    const botonModal = document.querySelector('#modificar');
   
    // document.getElementById("nombreUsuario").onkeyup=function(){
    //Set nombre
    document.getElementById("nombreUsuario").onchange=function(){
    var txtNombre = document.getElementById("nombreUsuario").value;
    document.formModificarDatos.txtNombre.value = txtNombre;
    }
    if (document.getElementById("txtNombre").value == "") {
        var txtNombre = document.getElementById("nombreUsuario").value;
        document.formModificarDatos.txtNombre.value = txtNombre;
    }

    //Set apellido
    document.getElementById("apellidoUsuario").onchange=function(){
    var txtApellido = document.getElementById("apellidoUsuario").value;
    document.formModificarDatos.txtApellido.value = txtApellido;
    }
    if (document.getElementById("txtApellido").value == "") {
        var txtApellido = document.getElementById("apellidoUsuario").value;
        document.formModificarDatos.txtApellido.value = txtApellido;
    }

    //Set dni
    document.getElementById("dniUsuario").onchange=function(){
    var txtDNI = document.getElementById("dniUsuario").value;
    document.formModificarDatos.txtDNI.value = txtDNI;
    }
    if (document.getElementById("txtDNI").value == "") {
        var txtDNI = document.getElementById("dniUsuario").value;
        document.formModificarDatos.txtDNI.value = txtDNI;
    }

    //set telefono
    document.getElementById("telefonoUsuario").onchange=function(){
    var txtTelefono = document.getElementById("telefonoUsuario").value;
    document.formModificarDatos.txtTelefono.value = txtTelefono;
    }
    if (document.getElementById("txtTelefono").value == "") {
        var txtTelefono = document.getElementById("telefonoUsuario").value;
        document.formModificarDatos.txtTelefono.value = txtTelefono;
    }

    //set direccion
    document.getElementById("direccionUsuario").onchange=function(){
    var txtDireccion = document.getElementById("direccionUsuario").value;
    document.formModificarDatos.txtDireccion.value = txtDireccion;
    }
    if (document.getElementById("txtDireccion").value == "") {
        var txtDireccion = document.getElementById("direccionUsuario").value;
        document.formModificarDatos.txtDireccion.value = txtDireccion;
    }

    botonModal.addEventListener('click', (e) => {
        e.preventDefault();
        modalDatos.style.display = 'block';
    })

    var spanDatos = document.querySelector('.close-datos');

    var cancelarDatos = document.querySelector('#cancelar-datos');

    cancelarDatos.onclick = function () {
        modalDatos.style.display = "none";
    }
    spanDatos.onclick = function () {
        modalDatos.style.display = "none";
    }


</script>
<script>
    const modalPass = document.querySelector('#modal-contrasenia');
    const botonModalPass = document.querySelector('#modificar-pass');

    //Set pwd
    document.getElementById("pwdActual").onchange=function(){
    var txtPwd = document.getElementById("pwdActual").value;
    document.modificarPwd.txtPwd.value = txtPwd;
    }
    if (document.getElementById("txtPwd").value == "") {
        var txtPwd = document.getElementById("pwdActual").value;
        document.modificarPwd.txtPwd.value = txtPwd;
    }

    //Set pwd nueva
    document.getElementById("new-pass").onchange=function(){
    var txtPwdNueva = document.getElementById("new-pass").value;
    document.modificarPwd.txtPwdNueva.value = txtPwdNueva;
    }
    if (document.getElementById("txtApellido").value == "") {
        var txtPwdNueva = document.getElementById("new-pass").value;
        document.modificarPwd.txtPwdNueva.value = txtPwdNueva;
    }

    botonModalPass.addEventListener('click', (e) => {
        e.preventDefault();
        modalPass.style.display = 'block';
    })

    var spanDatosPass = document.querySelector('.close-contrasenia');

    var cancelarDatosPass = document.querySelector('#cancelar-contrasenia');

    cancelarDatosPass.onclick = function () {
        modalPass.style.display = "none";
    }
    spanDatosPass.onclick = function () {
        modalPass.style.display = "none";
    }


</script>

<script src="js/navbarToggle.js"></script>
<script>

    var myPwd = document.querySelector("#pwdActual");
    var myInput = document.querySelector("#new-pass");
    myInput.onfocus = function(){
        document.querySelector("#passRequire").style.display = "block";
    }
    myInput.onblur = function(){
        document.querySelector("#passRequire").style.display = "none";
    }

    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {
          letter.classList.remove("invalid");
          letter.classList.add("valid");
        } else {
          letter.classList.remove("valid");
          letter.classList.add("invalid");
      }
      
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
        } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
        }
      
        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {
          number.classList.remove("invalid");
          number.classList.add("valid");
        } else {
          number.classList.remove("valid");
          number.classList.add("invalid");
        }
      
        // Validate length
        if(myInput.value.length >= 8) {
          length.classList.remove("invalid");
          length.classList.add("valid");
        } else {
          length.classList.remove("valid");
          length.classList.add("invalid");
        }
        
        
        
        if(myInput.value.match(numbers) && myInput.value.length >= 8 && myInput.value.match(upperCaseLetters) && (myInput.value.match(lowerCaseLetters)) && document.querySelector('#repeat-pass').value != ''){
            document.querySelector('#modificar-pass').disabled = false;
        }else{
            document.querySelector('#error').textContent = "Por favor completá los campos";
            document.querySelector('#error').style.color = "red";
            setTimeout(function(){
                document.querySelector('#error').textContent = '';
            },3000)
            document.querySelector('#modificar-pass').disabled = true
        }
      }

      const confirmPass = document.querySelector('#repeat-pass')
      confirmPass.onkeyup = function(){
          if(confirmPass.value === myInput.value && myInput.value != ''){
            document.querySelector('#modificar-pass').disabled = false
            document.querySelector('#error').textContent = "";
          }else{
            document.querySelector('#error').textContent = "Las contraseñas no coinciden";
            document.querySelector('#error').style.color = "red";
            document.querySelector('#modificar-pass').disabled = true
          }
      }

</script>

<!-- jQuery CDN - Slim version =without AJAX -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>
<script src="js/breadCrumbs.js"></script>

<!--    Datatables-->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>


 
 
      
    <script>
      $(document).ready(function(){
        $('#tablaReservasActivas').DataTable({
          "lengthMenu": [[3, 5, 10], [3, 5, 10]],
          "responsive": true,
          "pagingType": "simple",
          "deferRender": true,
          dom: 'rtip',
          "oLanguage": {
          "sInfo": "",
          },

        });  

      });

      $(document).ready(function(){
        $('#tablaHistorialReservas').DataTable({
          "lengthMenu": [[3, 5, 10], [3, 5, 10]],
          "responsive": true,
          "pagingType": "simple",
          "deferRender": true,
          dom: 'rtip',
          "oLanguage": {
          "sInfo": "",
          },

        });  

      });

    //   $(document).ready(function(){
    //     $('#tablaDescargas').DataTable({
    //       "lengthMenu": [[3, 5, 10], [3, 5, 10]],
    //       "responsive": true,
    //       "pagingType": "simple",
    //       "deferRender": true,
    //       dom: 'rtip',
    //       "oLanguage": {
    //       "sInfo": "",
    //       },

    //     });  

    //   });
    </script>

<script src="js/Spanish.js"></script>

</html>