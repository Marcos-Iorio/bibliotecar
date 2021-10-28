<!DOCTYPE html>
<?php
    session_start();
     //include 'php/cargarDatos.php';

                       include "php/gestion-libros.php";

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

<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html"charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/mensajes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
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
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
        <!--Seccion de los libros-->
  <div class="container main-libros">
      <h3>Gestion de libros!</h3>
      <!--<div class="tabla-libros">-->
      <form method="POST" action="#" name="busqueda" >
        <div >

          <h6 style="width: 100px;">Buscar por:</h6>
          <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
            <option value="" disabled selected>Seleccionar</option>
              <option value="mail">Titulo</option> 
              <option value="idRol">Autor</option>
              <option value="check_mail">Genero</option>
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
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Género</th>
                            <th>Stock</th>
                            <th>Fecha de Alta</th>
                            <th>Editar</th>
                          </tr>
                        </thead>
                      <?php

                      gestionLibros();
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                        
                  <?php  ?>
                      </table>
                    </div>
                </div>
            </section>
              <br><br>
              <hr>
                                              <br><br>

                                <h3>Modificar libros:</h3>
            <section class = "subir-libro">
                <form action="" method = "POST" class= "form-libro" enctype="multipart/form-data" >
                
                <div class="wrapper-libros">
                    <label for="">Titulo:</label>
                    <input class="input-libro"  type="text" name="titulo" id="titulo" required placeholder="Titulo">
                    <br>    
                      <label for="">Autor:</label>
                        <select class="form-control"name="selectAutor">
                          <option value="" disabled selected>Seleccionar autor</option>
                          <?php getAutores(); ?>    
                        </select>
                      <label for="">Autor Nuevo:</label>
                        <input class="input-libro" type="text" name="autor" id="autor" required placeholder="Autor">
                   
                    <br><br>


                    <label for="">Descripcion: </label>
                      <input class="input-libro"  type="text" name="desc" id="desc" required placeholder="Descripcion del libro">
                    <br><br>
                   
                      <label for="">Categoria:</label>
                      <select class="form-control"name="selectCategoria" >
                      <option value="" disabled selected>Seleccionar categoria</option>
                        <?php 
                        getCategorias();
                         ?>  
                    </select>

                    <label for="">Categoria Nueva:</label>
                      <input class="input-libro"  type="text" name ="categoria" id="categoria" required placeholder="Categoria">
                    <br><br>
                   
                      <label for="">Editorial:</label>
                      <select class="form-control"name="selectEditorial">
                      <option value="" disabled selected>Seleccionar editorial</option>

                      <?php 

                      getEditoriales();
                     
                      
                          
                          ?>
                                
                    </select>  
                    <label for="">Editorial Nueva:</label>
                    <input class="input-libro" type="text" name ="editorial" id="editorial" required placeholder="Editorial">
                    <br><br>

                    <label for="">Stock:</label>
                    <input class="input-libro"  type="number" name="stock" id="stock" required placeholder="Stock">
                    <br><br>

                    <label for="">Fecha de alta</label>
                    <input class="input-libro"  type="date" name="fechaAlta" id="fechaAlta"><br><br>
                    

                    <label for="">Pdf de libro(Opcional):</label>
                    <input class="input-libro"   type="file" name="pdf" id="pdf" >
                    <br><br>

                    <label for="">Imagenes, tapa:</label>
                    <input class="input-libro" type="file" name="tapa" id="tapa" >
                    <br><br><br><br>

                    
                    <label for="">Imagenes, ContraTapa:</label>
                    <input class="input-libro" type="file" name="contratapa" id="contratapa">

                  </div>
                   
                    <div class="center">
                        <br><br>
                      <input value="Editar libro" style="width: 20%;" type="submit" name="editarUsuario" id="editarUsuario"onclick="return ModificarLibro('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                        <input value="Crear libro" style="width: 20%; " type="submit" name="cargar-libro" id="cargar-imagenes"onclick="return ModificarLibro('crear')"/>

                        <input name="txtID" style="background-color: white; color: black; width: 20%;"type="hidden" name ="genero" id="genero"  placeholder="Seleccionar">
                    </div>
                    
                    <?php

                    if(isset($_POST['cargar-libro'])){

                      llenarTabla ($_POST['titulo'],$_POST['autor'],$_POST['desc'] ,$_POST['categoria'],$_POST['editorial'],
                      $_POST['stock'],$_POST['fechaAlta'], $_FILES['pdf']);

                      llenarImagen($_FILES['tapa'], $_FILES['contratapa']);
                     

                      
                    }
                    //unset($_POST['cargar-libro']);
                  
                    ?>
                </form>

            </section>
            <button onclick="contacto()" class="buttonInfo tooltip">
                <i class="fas fa-question"></i>
                <span class="tooltiptext">¿Tenes dudas? ¡Mandanos un mail!</span>
            </button>
        </main>
      </section>
</body>
<script src="js/navbarToggle.js"></script>
<<<<<<< HEAD
 <!-- jQuery CDN - Slim version =without AJAX -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>
   
 
=======
<script type="text/javascript">
        function ModificarLibro(tipo) {

if (tipo == 'editar') {
    msg="Confirma que desea modificar este libro?";

} else {
    msg="Confirma que desea crear este libro?";

}
    var usr = confirm(msg);
    if (usr == true) {
        return true;
    }
    return false;


}

</script>
</html>
   
>>>>>>> Jeremias
