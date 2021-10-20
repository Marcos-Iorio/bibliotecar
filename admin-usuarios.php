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


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || !isset($_SESSION['rol']) || $_SESSION['rol'] != '3' ) {
  header("Location: php/identidad.php");
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
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
        <!--Seccion de los libros-->
                <div class="container main-libros">
                    <h3>Gestion de usuarios!</h3>
                                    <form method="POST" action="#" name="busqueda" >
                    <div style="display: flex;justify-content: space-between;align-items: center;">

                    <h6 style="width: 100px;">Buscar por:</h6>
                    <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
                      <option value="" disabled selected>Seleccionar</option>
                        <option value="mail">Mail</option> 
                        <option value="idRol">Rol</option>
                        <option value="check_mail">Estado mail</option>
                        <option value="idEstado">Estado cuenta </option>    
                    </select>

                    <input style="background-color: white; width: 200px; height: 40px; color:black;"type="text" name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control" >
                    <div style="text-align: right;">
                    <input type="submit"  value="Buscar" href="#?page=1" name="btnBuscar" class="btn btn-outline-dark my-2 my-sm-0"/><a href="admin-usuarios.php?page=1"></a>
                    <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0"/>
                    </div>
                    </div>

                    <hr>
                </form>


                    <div class="tabla-libros">
                      <table class = "bordered">
                      <thead>
                          <tr>
                  <th>ID</th>
                  <th>Rol</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>DNI</th>
                  <th>Mail</th>
                  <th>Verificado</th>
                  <th>Estado cuenta</th>                  
                  <th>Editar</th>
                          </tr>
                        </thead>
                      <?php
                      include "php/gestion-usuarios.php";
                      if (!isset($_POST["editarUsuario"]) && !isset($_POST["crearUsuario"]) && !isset($_POST["btnBuscar"]) && !isset($_SESSION['pages']) && !isset($_SESSION['busqueda']) && !isset($_SESSION['criterio'])) {
                        # code...
                     
                      gestionUsuarios();
 }

  if (isset($_POST['btnreset'])) {
                unset($_SESSION['pages']);
                unset($_SESSION['criterio']);
                unset($_SESSION['busqueda']);
                gestionUsuarios();
              }
             

                    if (isset($_POST["editarUsuario"])) {
                    //include "php/gestion-usuarios.php";
                    $nombre=$_REQUEST["txtNombre"];
                    $apellido=$_REQUEST["txtApellido"];
                    $rol=$_REQUEST["selecRol"];
                    $dni=$_REQUEST["txtDNI"];
                    $mail=$_REQUEST["txtMail"];
                    $alta=$_REQUEST["selecEstadoMail"];
                    $estado=$_REQUEST["selecEstadoUsuario"];
                    $idUsuario=$_REQUEST["txtID"];


                   /* echo '
                <script>swal({
                title:"Editar usuario",
                text:"",
                type: "question",
                html:\'<form method="POST" action="" style="height:50%;"><br><h5>Confirma que desea editar este usuario?</h5><br><br> <div> <input type="submit" style="background-color: #495F91; color:white; width: 150px; margin-right:15px;"  name="confirmarEdicion" value="Confirmar"><input type="submit" style="background-color: gray; color:white; width: 150px;margin-left:15px;" name="cancelarEdicion" value="Cancelar"></div><br><br></form>\',
                showCancelButton: false,
                showConfirmButton: false,

                cancelButtonColor: "gray",
                confirmButtonColor: "#495F91",

                width: 500,
                padding: "3em"

                });</script>';*/

modificar($idUsuario,$nombre,$apellido,$rol,$dni,$mail,$alta,$estado);
 
                    //
              }
                    if (isset($_POST["crearUsuario"])) {
                    //include "php/gestion-usuarios.php";
                    $nombre=$_REQUEST["txtNombre"];
                    $apellido=$_REQUEST["txtApellido"];
                    $rol=$_REQUEST["selecRol"];
                    $dni=$_REQUEST["txtDNI"];
                    $mail=$_REQUEST["txtMail"];
                    $alta=$_REQUEST["selecEstadoMail"];
                    $estado=$_REQUEST["selecEstadoUsuario"];
                    


insertarUsuario($nombre,$apellido,$rol,$dni,$mail,$alta,$estado);
 
                    //
              }
if (isset($_POST["btnEstado"])) {

  $idEstado=$_REQUEST["selecEstadoUsuario"];
  $mail=$_REQUEST["txtMailUsuario"];

  //editarEstado($idEstado, $mail);



}

if(isset($_REQUEST["btnBuscar"])){ 
                  unset($_SESSION['pages']);
                unset($_SESSION['criterio']);
                unset($_SESSION['busqueda']);
        getFiltro($_REQUEST["txtBusqueda"],$_REQUEST["txtCriterio"]);

    }

if (isset($_SESSION['pages']) && isset($_SESSION['busqueda']) && isset($_SESSION['criterio'])) {
        getFiltro($_SESSION['busqueda'],$_SESSION['criterio']);
    }
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
                      <?php 

                       //$_GLOBALS[$page_filtro] < $_GLOBALS[$page_total]
                      $page_filtro = 0;
                      $page_total = 0;
                      if (isset($_REQUEST["btnBuscar"]) ) {
                        //$_GET["page"] = 1;
                        $page_filtro = getPages($_REQUEST["txtBusqueda"], $_REQUEST["txtCriterio"]);
                        unset($_SESSION['pages']);
                        unset($_SESSION['criterio']);
                        unset($_SESSION['busqueda']);
                        $_SESSION['pages'] = $page_filtro;
                        $_SESSION['criterio'] = $_REQUEST["txtCriterio"];
                        $_SESSION['busqueda'] = $_REQUEST["txtBusqueda"];
                        //header("Location: admin-usuarios.php?page=1");
                      } else {

                        if (isset($_SESSION['pages']) && isset($_SESSION['busqueda']) && isset($_SESSION['criterio'])) {

                         $_SESSION['pages'] = getPages($_SESSION['busqueda'], $_SESSION['criterio']);

                        } else {
                         
                      $page_total = getPages2();
                      }
                      }
                      
                      //$paginas = getPages();
              echo "<div style='text-align: center; margin-top:50px;'>";
          //include 'php/pages.php';


              
              if (isset($_SESSION['pages']) && isset($_SESSION['busqueda']) && isset($_SESSION['criterio'])) {
                $paginas = $_SESSION['pages'];
              } else {
                
                $paginas = $page_total;

              }

            for($page = 1; $page<= $paginas; $page++) {  
              echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-usuarios.php?page=' . $page . '">' . $page . ' </a>';  
            }  
              echo "</div>";
          ?>
                    </div></div>
                </div>
            </section>
                          
          <hr>
                                <h3>Modificar usuarios:</h3>

            <section class = "subir-libro" style="text-align: center; margin-right: 150px;">
              <div class="container-form">
                <form name="formUsuarios" action="" method = "POST" class= "form-libro">
<div>
                    <label for="" style="width: 100px;">Nombre:</label>
                    <input name="txtNombre" style="background-color: white; color: black; width: 20%;"type="text" name="titulo" id="titulo"  placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">Apellido: </label>
                    <input name="txtApellido" style="background-color: white; color: black; width: 20%;"type="text" name="autor" id="autor"  placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">Rol: </label>
                    <select style="background-color: white; color: black; width: 20%;" name="selecRol" class="form-control" style="width: 200px; margin-right: 200px;">
                    <option name="txtRol" value="" disabled selected >Seleccionar rol</option>
                    <?php getRoles(); ?>
                     </select>
                    <!--<input name="txtRol" style="background-color: white; color: black; width: 20%;"type="text" name="desc" id="desc"  placeholder="Seleccionar">  --> 
                    <br style="width: 50px;">

                  </div><div>


                    <label for=""style="width: 100px;">DNI: </label>
                    <input name="txtDNI" style="background-color: white; color: black; width: 20%;"type="text" name="desc" id="desc"  placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">Mail:</label>
                    <input name="txtMail" style="background-color: white; color: black; width: 20%;"type="text" name ="genero" id="genero"  placeholder="Ingresar dato">
                    <label for=""style="width: 100px;">Alta mail:</label>
                    <select style="background-color: white; color: black; width: 20%;" name="selecEstadoMail" class="form-control" style="width: 200px; margin-right: 200px;">
                    <option name="txtAlta" value="" disabled selected >Seleccionar estado</option>
                    <?php getEstadoMail(); ?>
                     </select>
                    <!--<input name="txtAlta" style="background-color: white; color: black; width: 20%;"type="text" name="stock" id="stock"  placeholder="Seleccionar">-->
                    <br style="width: 50px;">
</div><div >
                  
                  
                  
                     <label for=""style="width: 100px;">Estado:</label>
                     <select style="background-color: white; color: black; width: 20%;" name="selecEstadoUsuario" class="form-control" style="width: 200px; margin-right: 200px;">
                    <option  value="" disabled selected name="txtEstadoUsuario">Seleccionar estado</option>
                    <?php getEstadoUsuario(); ?>
                     </select>
                    <!--<input  name="txtEstadoUsuario" style="background-color: white; color: black; width: 20%;"type="text" name ="genero" id="genero"  placeholder="Seleccionar">
                                        <label for=""style="width: 100px;"></label>-->

                    <input value="Editar usuario" style="width: 20%;" type="submit" name="editarUsuario" id="editarUsuario"onclick="return ModificarUsuario('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                  <input value="Crear usuario" style="width: 20%; " type="submit" name="crearUsuario" id="subir-libro"onclick="return ModificarUsuario('crear')"/>

                  <input name="txtID" style="background-color: white; color: black; width: 20%;"type="hidden" name ="genero" id="genero"  placeholder="Seleccionar">

</div><div>
                    

</div>

                                

                    </form>

              </div>         
            </section>

            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>

                  <br>
      <hr>
                        <br>
                  <br>
                  <br>

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
    <script>
    function cargarUsuario(id, nombre,apellido,rol,dni,mail,alta, estado){
        document.formUsuarios.txtNombre.value=nombre;
        document.formUsuarios.txtApellido.value=apellido;
        //document.formUsuarios.txtRol.value=rol;
         document.formUsuarios.txtDNI.value=dni;
          document.formUsuarios.txtMail.value=mail;
          //document.formUsuarios.txtAlta.value=alta;
          //document.formUsuarios.txtEstadoUsuario.value=estado;
          document.formUsuarios.txtID.value=id;
          document.getElementsByName('selecEstadoUsuario')[0].options[0].innerHTML = alta;
          document.getElementsByName('selecRol')[0].options[0].innerHTML = rol;
          document.getElementsByName('selecEstadoMail')[0].options[0].innerHTML = estado;




          //window.location = 'vistaProducto.php#gestionProducto';
    }

        function cargarEstado(mail,estado){


          //window.location = 'vistaProducto.php#gestionProducto';
    }
    
    

    </script>

    <script>
      
      function ModificarUsuario(tipo) {

if (tipo == 'editar') {
    msg="Confirma que desea modificar este usuario?";

} else {
    msg="Confirma que desea crear este usuario?";

}
    var usr = confirm(msg);
    if (usr == true) {
        return true;
    }
    return false;


}

      function ModificarEstado(mail,estado) {
        document.formUsuarios.txtMailUsuario.value=mail;
        document.formUsuarios.txtEstadoUsuario.value=estado;



      if (estado==2) {
    var usr = confirm("Confirma que desea habilitar este usuario?");

      } else {
    var usr = confirm("Confirma que desea deshabilitar este usuario?");

      }
    if (usr == true) {
//var result ="<?php //editarEstado($estado,$mail); ?>"
//document.write(result);
        return true;
    }
    return false;
}
    </script>
        

        
</html>
   
 