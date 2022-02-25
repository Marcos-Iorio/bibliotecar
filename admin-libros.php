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

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || !isset($_SESSION['rol']) || $_SESSION['rol'] == '1') {
    header("Location: php/unauthorized.php");
}

?>

<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/mensajes.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="css/inicio.css">
  <link rel="stylesheet" href="css/libros.css">
  <link rel="stylesheet" href="css/datatable.css">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">

  <!-- ESTE GENERA EL PROBLEMA CON EL DATATABLES -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Document</title>
</head>

<body>
  <section id="page">
    <?php 
          include "php/panel.php";
         ?>
    <main id="main">
      <h1 class="titulo-pagina">Gestión de libros</h1>
      <div class="subtitulo-pagina">Podes ver, editar y añadir nuevas editoriales, libros, autores y categorias.</div>



      <!--<li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Administrar libros </span></a>
            <ul class="collapse list-unstyled" id="reservas">-->


      <div class="contenido wrapper" id="seccion-libros">
        <!--Seccion de los libros-->
        <div class="container main-libros">

          <div>
            <!-- <form method="POST" action="#" name="busqueda">
              <div>

                <h6 >Buscar por:</h6>
                <select class="form-control" name="txtCriterio" style="width: 200px; margin-right: 200px;">
                  <option value="" disabled selected>Seleccionar</option>
                  <option value="mail">Titulo</option>
                  <option value="idRol">Autor</option>
                  <option value="check_mail">Categoria</option>
                </select>

                <input style="background-color: white; width: 200px; height: 40px; color:black;" type="text"
                  name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control">
                <div style="text-align: right;">
                  <input type="submit" value="Buscar" href="#?page=1" name="btnBuscar"
                    class="btn btn-outline-dark my-2 my-sm-0" /><a href="admin-usuarios.php?page=1"></a>
                  <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0" />
                </div>
              </div>
              <hr>
            </form> -->
            <h3 style="color:white;">Libros</h3>


            <div class="tabla-libros">
              <table id="tablaLibros" class="table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>ID Libro</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Stock disponible</th>
                    <th>Fecha de Alta</th>
                    <th>Editar</th>
                    <th>Ejemplares</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include "php/gestion-libros.php";

                    gestionLibros();

                    if(isset($_POST['btnCrearLibro'])){
                      $_SESSION['btnCrearLibro']=$_POST['btnCrearLibro'];

                      //llenarTabla ($_POST['titulo'],$_POST['autor'],$_POST['desc'] ,$_POST['categoria'],$_POST['editorial'],
                      //$_POST['stock'],$_POST['fechaAlta'], $_FILES['pdf']);
                      llenarTabla ($_POST['titulo'],$_POST['selectAutor'],$_POST['desc'] ,$_POST['selectCategoria'],$_POST['selectEditorial'],
                      $_POST['stock'], $_FILES['pdf'], $_FILES['tapa'], $_FILES['contratapa']);

                      //llenarImagen($_FILES['tapa'], $_FILES['contratapa']);
            //echo "<script>swal({title:'Error',text:'la tapa es $tmpTapa,$destinoTapa y la contratapa $contratapa',type:'error'});</script>";
                      
                    }
                    //unset($_POST['cargar-libro']);
                      

                      if(isset($_POST['btnEditarLibro'])){
                        $_SESSION["btnEditarLibro"] = $_POST['btnEditarLibro'];
                      editarLibro($_POST['idLibro'],$_POST['titulo'],$_POST['selectAutor'],$_POST['desc'] ,$_POST['selectCategoria'],$_POST['selectEditorial'],
                      $_POST['stock'], $_FILES['pdf'], $_FILES['tapa'], $_FILES['contratapa']);

                    }

                     
                      //if(!isset($_POST['btnEditarLibro']) || !isset($_POST['btnCrearLibro'])){
                      /* Llena el tabla con todos los libros de la base de datos */
                     // }
                      ?>

                </tbody>
              </table>
              <?php 
            // $paginas = getPages2();

            //  for($page = 1; $page<= $paginas; $page++) {  
            //   echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            // }  
               echo "</div>";

               ?>
            </div>
            <button onclick="modalLibros()" class="boton-agregar-libro"><a href="#modal-libros"></a><i
                class="fas fa-add">Agregar Libro</i></button>
          </div>

          <div id="modal-libros">
            <span id="close">&times;</span>
            <h3 id="titulo-libro">Modificar libro:</h3>
            <div class="subir-libro">
              <form name="formLibros" action="" id="form-libros" method="POST" class="form-libro"
                enctype="multipart/form-data">

                <div class="wrapper-libros">
                  <div class="secciones-form" style="display:flex; justify-content: space-around;">
                    <label for="">Titulo:</label>
                    <input style="background-color: white; color: black;" class="input-libro" type="text" name="titulo"
                      id="titulo" patern="[a-zA-Z0-9]+"
                      onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250) || (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      required placeholder="Titulo">
                    <label for="">Autor:</label>

                    <select required id="select-autor" style="background-color: white; color: black; width: 20%;"
                      class="form-control" name="selectAutor">
                      <option value="0" disabled selected>Seleccionar autor</option>
                      <?php 
                            getAutores();
                            ?>
                    </select>

                  </div>
                  <br><br>

                  <div class="secciones-form" style="display:flex; justify-content: space-around;">

                    <label for="">Descripcion: </label>
                    <textarea maxlength="1000"
                      style="background-color: white; color: black; width: 380px; height: 100px;" class="input-libro"
                      type="text" name="desc" id="desc" required placeholder="Maximo: 1000 caracteres"></textarea>

                    <input hidden type="text" name="idLibro" id="idLibro">
                    <br><br>

                    <label for="">Categoria:</label>
                    <select required id="select-categoria" style="background-color: white; color: black; width: 20%;"
                      class="form-control" name="selectCategoria">
                      <option value="0" disabled selected>Seleccionar categoria</option>
                      <?php 
                            getCategorias();
                            ?>
                    </select>

                  </div>

                  <br><br>
                  <div class="secciones-form" style="display:flex; justify-content: space-around;">
                    <label for="">Stock:</label>
                    <input style="background-color: white; color: black;" class="input-libro" type="number"  name="stock"
                      id="stock" patern=[0-9] maxlength="2"
                      oninput="javascript: if (this.value > this.maxLength) this.value = this.value.slice(0, this.maxLength)"
                      required placeholder="Máximo: 99">
                    <label for="">Editorial:</label>

                    <select required id="select-editorial" style="background-color: white; color: black; width: 20%;"
                      class="form-control" name="selectEditorial">
                      <option value="0" disabled selected>Seleccionar editoriales</option>
                      <?php 
                            getEditoriales();
                            ?>
                    </select>

                  </div>

                  <br><br>
                  <div class="secciones-form" style="display:flex;">

                    <!--<label for="">Fecha de alta</label>
                        <input style="background-color: white; color: black;"class="input-libro"  type="date" name="fechaAlta" id="fechaAlta"><br><br>-->

                    <label for="">Tapa:</label>
                    <input class="input-libro" type='file' name='tapa' id="tapa">

                    <label for="">ContraTapa (Opcional):</label>
                    <input class="input-libro" type='file' name='contratapa' id="contratapa">
                    <br><br>

                  </div>
                  <div class="secciones-form" style="display:flex;">
                    <label for="">Pdf de libro (Opcional):</label>
                    <input class="input-libro" type="file" name="pdf" id="pdf">
                  </div>
                </div>

                <div class="center">
                  <input value="Editar libro" style="width: 20%;" type="submit" class="btnEditarLibro" name="btnEditarLibro" id="editar-libro"
                    onclick="return ModificarLibro('editar')" />
                  <label for=""></label>

                  <input value="Crear libro" class="confirmarCreacionLibro" type="submit" name="btnCrearLibro" id="crear-libro"
                    onclick="return ModificarLibro('crear')" />

                  <input name="txtID" style="background-color: white; color: black; width: 20%;" type="hidden"
                    name="genero" id="genero" placeholder="Seleccionar">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Seccion Autores-->

      <div class="contenido wrapper" id="seccion-autor">
        <div class="container main-libros">

          <h3 style="color:white;">Autores</h3>
          <!-- <h3>Gestion de libros!</h3>
            <div class="tabla-libros">-->

          <br>
          <!--         <form method="POST" action="#" name="busqueda">
               <div>

                  <h6 >Buscar por:</h6>
                  <select class="form-control" name="txtCriterio" style="width: 200px; margin-right: 200px;">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="mail">Titulo</option>
                    <option value="idRol">Autor</option>
                    <option value="check_mail">Categoria</option>
                  </select>

                  <input style="background-color: white; width: 200px; height: 40px; color:black;" type="text"
                    name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control">
                  <div style="text-align: right;">
                    <input type="submit" value="Buscar" href="#?page=1" name="btnBuscar"
                      class="btn btn-outline-dark my-2 my-sm-0" /><a href="admin-usuarios.php?page=1"></a>
                    <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0" />
                  </div>
                </div>
                <hr> 
              </form>-->


          <div class="tabla-libros">
            <table id="tablaAutores" class="table-striped table-bordered" style="width:100%">
              <thead>
                <th>ID Autor</th>
                <th>Nombre Autor</th>
                <th>Editar</th>
              </thead>
              <tbody>
                <?php


                      
                      /* Llena el tabla con todos los libros de la base de datos */
                      
                      if (isset($_POST['btnCrearAutor'])) {

                        crearAutor($_POST['nuevoAutor']);
                      }

                      if (isset($_POST['btnEditarAutor'])) {

                        editarAutor($_POST['idAutor'], $_POST['editarAutor']);
                      }

                      //if(!isset($_POST['btnCrearAutor']) || !isset($_POST['btnEditarAutor'])){
                        gestionAutores();
                      //}

                      ?>
              </tbody>
            </table>
            <?php 

            // $paginas = getPages2();

            //  for($page = 1; $page<= $paginas; $page++) {  
            //   echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            // }  
               echo "</div>";
               
               ?>
          </div>
          <button onclick="modalAutores()" class="boton-agregar-libro"><a href="#modal-autor"></a><i
              class="fas fa-add">Agregar Autor</i></button>

          <div id="modal-autor">
            <span id="close-autor">&times;</span>
            <div class="subir-autor">
              <form name="formAutores" action="" id="formAutores" method="POST" class="form-autor"
                enctype="multipart/form-data">

                <div class="wrapper-libros">
                  <div id="autor-viejo">
                    <label for="">Autor:</label>
                    <input class="input-libro" type="text" name="editarAutor" id="autor" patern=[0-9a-zA-Z]
                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250) || (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      placeholder="Autor">
                    <input hidden type="text" name="idAutor" id="autor" placeholder="Autor">
                  </div>
                  <div id="autor-nuevo">
                    <label for="">Autor Nuevo:</label>
                    <input class="input-libro autor" type="text" name="nuevoAutor" patern=[0-9a-zA-Z]
                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250)|| (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      placeholder="Autor">
                  </div>
                </div>

                <div class="center">
                  <input value="Editar autor" style="width: 20%;" type="submit" name="btnEditarAutor" id="editar-autor" class="btnEditarAutor"
                    onclick="return ModificarLibro('editar')" />
                  <label for=""></label>

                  <input value="Crear autor" style="width: 20%; " type="submit" name="btnCrearAutor" id="crear-autor" class="btnCrearAutor"
                    onclick="return ModificarLibro('crear')" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Seccion Categorias-->

      <div class="contenido wrapper" id="seccion-categorias">
        <!--Seccion de los libros-->
        <div class="container main-libros">
          <h3 style="color:white;">Categorias</h3>
          <!-- <h3>Gestion de libros!</h3>
              <div class="tabla-libros">-->

          <br>
          <!-- <form method="POST" action="#" name="busqueda">
                <div>

                  <h6 style="width: 100px;">Buscar por:</h6>
                  <select class="form-control" name="txtCriterio" style="width: 200px; margin-right: 200px;">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="mail">Titulo</option>
                    <option value="idRol">Autor</option>
                    <option value="check_mail">Categoria</option>
                  </select>

                  <input style="background-color: white; width: 200px; height: 40px; color:black;" type="text"
                    name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control">
                  <div style="text-align: right;">
                    <input type="submit" value="Buscar" href="#?page=1" name="btnBuscar"
                      class="btn btn-outline-dark my-2 my-sm-0" /><a href="admin-usuarios.php?page=1"></a>
                    <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0" />
                  </div>
                </div>
                <hr>
              </form> -->


          <div class="tabla-libros">
            <table id="tablaCategorias" class="table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID Categoria</th>
                  <th>Nombre Categoria</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      gestionCategorias();

                      if (isset($_POST['btnCrearCategoria'])) {

                        crearCategoria($_POST['nuevaCategoria']);
                      }

                      if (isset($_POST['btnEditarCategoria'])) {

                        editarCategoria($_POST['idCategoria'], $_POST['editarCategoria']);
                      }

                      //if(!isset($_POST['btnCrearCategoria']) || !isset($_POST['btnEditarCategoria'])){
                      //}
                      
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>

              </tbody>
            </table>
            <?php 
            //  $paginas = getPages2();

            //   for($page = 1; $page<= $paginas; $page++) {  
            //    echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            //  }  
               echo "</div>";

               ?>
          </div>
          <button onclick="modalCategorias()" class="boton-agregar-libro"><a href="#modal-categoria"></a><i
              class="fas fa-add">Agregar Categoria</i></button>
          <div id="modal-categoria">
            <span id="close-categoria">&times;</span>
            <div class="subir-categoria">
              <form action="" name="formCategorias" id="formCategorias" method="POST" class="form-libro"
                enctype="multipart/form-data">

                <div class="wrapper-libros">
                  <div id="categoria-vieja">
                    <label for="">Categoria:</label>
                    <input class="input-libro" type="text" name="editarCategoria" id="categoria" patern=[0-9a-zA-Z]
                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250)|| (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      placeholder="Categoria">
                    <input hidden type="text" name="idCategoria" id="autor" placeholder="Categoria">
                  </div>

                  <div id="categoria-nueva">
                    <label for="">Categoria Nueva:</label>
                    <input class="input-libro categoria" type="text" patern=[0-9a-zA-Z]
                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250)|| (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      name="nuevaCategoria" placeholder="Categoria">
                  </div>


                </div>

                <div class="center">
                  <input value="Editar categoria" style="width: 20%;" type="submit" name="btnEditarCategoria" class="btnEditarCategoria"
                    id="editar-categoria" onclick="return ModificarLibro('editar')" />
                  <label for=""></label>

                  <input value="Crear categoria" style="width: 20%; " type="submit" name="btnCrearCategoria" class="btnCrearCategoria"
                    id="crear-categoria" onclick="return ModificarLibro('crear')" />

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!--Seccion Editoriales-->

      <div class="contenido wrapper" id="seccion-editorial">
        <!--Seccion de los libros-->
        <div class="container main-libros">
          <h3 style="color:white;">Editoriales</h3>

          <!-- <h3>Gestion de libros!</h3>
            <div class="tabla-libros">-->

          <br>
          <!-- <form method="POST" action="#" name="busqueda">
                <div>

                  <h6 >Buscar por:</h6>
                  <select class="form-control" name="txtCriterio" style="width: 200px; margin-right: 200px;">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="mail">Titulo</option>
                    <option value="idRol">Autor</option>
                    <option value="check_mail">Categoria</option>
                  </select>

                  <input style="background-color: white; width: 200px; height: 40px; color:black;" type="text"
                    name="txtBusqueda" value="" size="10" placeholder="Buscar...?" class="form-control">
                  <div style="text-align: right;">
                    <input type="submit" value="Buscar" href="#?page=1" name="btnBuscar"
                      class="btn btn-outline-dark my-2 my-sm-0" /><a href="admin-usuarios.php?page=1"></a>
                    <input type="submit" value="Limpiar" name="btnreset" class="btn btn-outline-dark my-2 my-sm-0" />
                  </div>
                </div>
                <hr>
              </form> 
 -->

          <div class="tabla-libros">
            <table id="tablaEditoriales" class="table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>ID Editorial</th>
                  <th>Nombre Editorial</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php


                      if (isset($_POST['btnCrearEditorial'])) {

                        crearEditorial($_POST['nuevaEditorial']);
                      }

                      if (isset($_POST['btnEditarEditorial'])) {

                        editarEditorial($_POST['idEditorial'], $_POST['editarEditorial']);
                      }

                      //if(!isset($_POST['btnCrearEditorial']) || !isset($_POST['btnEditarEditorial'])){
                        gestionEditoriales();
                      //}

                    
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
              </tbody>
            </table>
            <?php 
            //  $paginas = getPages2();

            //   for($page = 1; $page<= $paginas; $page++) {  
            //    echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            //  }  
               echo "</div>";

               ?>
          </div>
          <button onclick="modalEditoriales()" class="boton-agregar-libro"><a href="#modal-editorial"></a><i
              class="fas fa-add">Agregar Editorial</i></button>
          <div id="modal-editorial">
            <span id="close-editorial">&times;</span>
            <div class="subir-editorial">
              <form name="formEditoriales" action="" id="formEditorial" method="POST" class="form-libro"
                enctype="multipart/form-data">

                <div class="wrapper-libros">

                  <div id="editorial-vieja">
                    <label for="">Editorial:</label>
                    <input class="input-libro" style="color: black;" type="text" name="editarEditorial"
                      patern=[0-9a-zA-Z]
                      onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250)|| (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      id="editorial" placeholder="Editorial">
                    <input hidden type="text" name="idEditorial" id="autor" placeholder="Editorial">
                  </div>

                  <div id="editorial-nueva">
                    <label for="">Editorial Nueva:</label>
                    <input class="input-libro editorial" type="text" name="nuevaEditorial" patern=[0-9a-zA-Z]
                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 122) || (event.charCode >= 225 && event.charCode <= 250)|| (event.charCode == 32 && event.charCode !== 0) || (event.charCode > 47 && event.charCode < 58))"
                      placeholder="Editorial">
                  </div>


                </div>

                <div class="center">
                  <input value="Editar Editorial" style="width: 20%;" type="submit" name="btnEditarEditorial" class="btnEditarEditorial"
                    id="editar-editorial" onclick="return ModificarLibro('editar')" />
                  <label for=""></label>

                  <input value="Crear Editorial" style="width: 20%; " type="submit" name="btnCrearEditorial" class="btnCrearEditorial"
                    id="crear-editorial" onclick="return ModificarLibro('crear')" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!-- Modal ejemplares -->

      <div id="modal-ejemplares" class="tabla-libros">
        <form name="formEjemplares" action="#modal-ejemplares">
        <span id="close-ejemplares">&times;</span>

          <input hidden type="text" name="datoLibro">
          <br>
          <div style="text-align: center;" >
          <!-- <input type="text" style="height:100px; width: 1000px; border: 0; text-align: center; outline: none;  font-size: 40px;" name="tituloEjemplar" id="tituloEjemplar"> -->
        <h3 id="tituloEjemplar" name="tituloEjemplar"></h3>  
        </div>
        </form>

        <table id="tabla-ejemplar" class="table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>ID Ejemplar</th>
              <th>Estado</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
        </table>
      </div>
      </div>

      <!-- Botones a los menús -->
      <div id="circularMenu" class="circular-menu">

        <a class="floating-btn" onclick="document.getElementById('circularMenu').classList.toggle('active');">
          <i class="fa fa-plus"></i>
        </a>

        <menu class="items-wrapper">
          <button onclick="abrirSeccionLibro()" class="menu-item-botonera fas fa-book"><a href="#seccion-libros"><span
                style="top:-60px; left: -50px" class="tooltip-span-libros">Libros</span></a></button>
          <button onclick="abrirSeccionAutor()" class="menu-item-botonera fas fa-user-alt"><a
              href="#seccion-autor"><span style="top:-30px; left: -110px"
                class="tooltip-span">Autores</span></a></button>
          <button onclick="abrirSeccionCategoria()" class="menu-item-botonera fas fa-list-ul"><a
              href="#seccion-categorias"><span style="top:-20px; left: -110px"
                class="tooltip-span">Categorias</span></a></button>
          <button onclick="abrirSeccionEditorial()" class="menu-item-botonera far fa-newspaper"><a
              href="#seccion-editorial"><span style="top:-20px; left: -120px"
                class="tooltip-span">Editoriales</span></a></button>
        </menu>

      </div>

    </main>
  </section>
</body>
<script src="js/gestion-libro.js"></script>
<script type="text/javascript">
  function cargarEjemplares(idLibro, titulo) {
    document.formEjemplares.datoLibro.value = idLibro;
    // document.formEjemplares.tituloEjemplar.value = titulo;

    var h = document.getElementById("tituloEjemplar");
    h.textContent = titulo;

    
    const data = {
      'idLibro': Number(idLibro)
    };
    $.ajax({
      type: "POST",
      url: "php/gestion-libros.php",
      dataType: "json",
      data: data,
      success: function (data) {
        limpiarHTML()
        $(data).each(
          function () {
            this.idEjemplarEstado = this.idEjemplarEstado == 1 ? 'Reservado' : this.idEjemplarEstado == 2 ?
              'Inhabilitado' : 'Disponible';
            this.ejemplarEstado = this.idEjemplarEstado == 'Reservado' ?
              `<button><i title="Reserva activa" class="fas fa-minus"></i></button>` : this.idEjemplarEstado ==
              'Inhabilitado' ?
              `<button onclick="activarEjemplar('${this.idEjemplar}')"><i title="Habilitar" class="fas fa-plus-circle"></i></button>` :
              `<button onclick="borrarEjemplar('${this.idEjemplar}')"><i title="Deshabilitar" class="fas fa-minus-circle"></i></button>`;
            $('#tbody').append(
              '<tr><td>' + this.idEjemplar +
              '</td><td>' +
              this.idEjemplarEstado +
              '</td><td>' +
              this.ejemplarEstado +
              '</td></tr>')

            $(document).ready(function () {
              $('#tabla-ejemplar').DataTable({
                "lengthMenu": [
                  [5, 10, 20, 30],
                  [5, 10, 20, 30]
                ],
                "responsive": true,
                "pagingType": "simple",
                "retrieve": true,
                "language": {
                  "emptyTable": "No se encontraron ejemplares",
                   },
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel'
                // ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: '<i class="fas fa-download" title="Exportar" id="exportar"></i>',
                    className: 'btn btn-light'
                  }


                ],
                "oLanguage": {
                  "sInfo": "Total de ejemplares: _TOTAL_"
                },
              });
            });
          })

      }

    });


    function limpiarHTML() {
      const tbody = document.querySelector('#tbody');
      while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
        $("#tabla-ejemplar").dataTable().fnDestroy();

      }

    }
  }

  function borrarEjemplar(idEjemplar) {
    var estado = "Desactivar";
    Swal.fire({
      title: "¿Deseas deshabilitar este ejemplar?",
      text: "",
      showCancelButton: true,
      confirmButtonColor: "#333",
      confirmButtonText: "Confirmar",
      cancelButtonText: "Cancelar",
      buttonsStyling: true
    }).then((result) => {
      if (result.value === true) {
        $.ajax({
          type: "POST",
          url: "php/gestion-libros.php",
          data: {
            'idEjemplar': idEjemplar,
            'estado': estado
          },
          cache: false,
          success: function (response) {
            swal({
              title: 'Éxito',
              text: 'Ejemplar desactivado correctamente.',
              type: 'success',
              showConfirmButton: false,
              html: '<h5>Ejemplar desactivado correctamente.</h5><br><a  style=\"background-color: #343A40; color:white;" href="admin-libros.php"><button type="submit" style="background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;" >OK</button></a>'
            });
          },
          failure: function (response) {
            Swal.fire(
              "Error",
              "No se pudo deshabilitar el ejemplar.", // had a missing comma
              "error"
            )
          }
        })
        // setTimeout(() => {
        //  window.location.reload();
        //}, 2000)

      }
    })
  }



  function activarEjemplar(idEjemplar) {
    var estado = "Activar";
    Swal.fire({
      title: "¿Deseas habilitar este ejemplar?",
      text: "",
      showCancelButton: true,
      confirmButtonColor: "#333",
      confirmButtonText: "Confirmar",
      cancelButtonText: "Cancelar",
      buttonsStyling: true
    }).then((result) => {
      if (result.value === true) {
        $.ajax({
          type: "POST",
          url: "php/gestion-libros.php",
          data: {
            'idEjemplar': idEjemplar,
            'estado': estado
          },
          cache: false,
          success: function (response) {
            swal({
              title: 'Exito',
              text: 'Ejemplar activado correctamente.',
              type: 'success',
              showConfirmButton: false,
              html: '<h5>Ejemplar activado correctamente.</h5><br><button type="submit" style="background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;" ><a  style=\"background-color: #343A40; color:white;" href="admin-libros.php">OK</a></button>'
            });
          },
          failure: function (response) {
            Swal.fire(
              "Error",
              "No se pudo habilitar el ejemplar.", // had a missing comma
              "error"
            )
          }
        })
        //setTimeout(() => {
        //window.location.reload();
        //}, 2000)

      }
    })
  }


  function ModificarLibro(tipo) {

    if (tipo == 'editar') {
      msg = "¿Desea modificar este registro?";

    } else {
      msg = "¿Confirma que desea crear este registro?";

    }
    var usr = confirm(msg);
    if (usr == true) {
      return true;
    }
    return false;


  }
</script>


<script>
  const menuCircular = document.querySelector('#circularMenu')

  menuCircular.addEventListener('click', () => {
    if (menuCircular.classList.contains('active')) {
      document.querySelector('span.label').style.display = "inline-block";
      document.querySelectorAll('span.label')[1].style.display = "inline-block";
      document.querySelector('span.label-left').style.display = "inline-block";
      document.querySelector('span.label-left-2').style.display = "inline-block";
    } else {
      document.querySelector('span.label').style.display = "none";
      document.querySelectorAll('span.label')[1].style.display = "none";
      document.querySelector('span.label-left').style.display = "none";
      document.querySelector('span.label-left-2').style.display = "none";
    }
  });



  /* Obtiene el modal */
  var modalLibro = document.getElementById('modal-libros')

  /* Obtiene el botón que abre el modal */
  var btn = document.querySelectorAll("#abrir-modal-libros");

  for (var i = 0; i < btn.length; i++) {
    btn[i].onclick = function () {
      modalLibro.style.display = "block";
    }
  };

  var span = document.getElementById("close");

  span.onclick = function () {
    modalLibro.style.display = "none";
  }

  function cargarLibros(titulo, nombreAutor, nombreCategoria, stock, descripcion, nombreEditorial, idLibro) {
    document.formLibros.titulo.value = titulo;
    document.formLibros.stock.value = stock;
    //document.formUsuarios.txtRol.value=rol;
    document.formLibros.desc.value = descripcion;
    document.formLibros.idLibro.value = idLibro;
    //document.formUsuarios.fechaAlta.value = fechaAlta;
    //document.formUsuarios.txtAlta.value=alta;
    //document.formUsuarios.txtEstadoUsuario.value=estado;
    //document.formUsuarios.txtID.value = id;
    //document.getElementsByName('selectAutor')[0].options[0].innerHTML = nombreAutor;
    //document.getElementsByName('selectEditorial')[0].options[0].innerHTML = nombreEditorial;
    //document.getElementsByName('selectCategoria')[0].options[0].innerHTML = nombreCategoria;
    let elementAutor = document.getElementById('select-autor');
    elementAutor.value = nombreAutor;
    let elementEditorial = document.getElementById('select-editorial');
    elementEditorial.value = nombreEditorial;
    let elementCategoria = document.getElementById('select-categoria');
    elementCategoria.value = nombreCategoria;

    document.getElementById('crear-libro').style.display = "none";

    document.getElementById('editar-libro').style.display = "block";

    let tituloLibro = document.getElementById('titulo-libro').innerHTML = "Modificar Libro"

    //window.location = 'vistaProducto.php#gestionProducto';
  }

  /* Autores */
  /* Obtiene el modal */
  var modalAutor = document.getElementById('modal-autor')

  /* Obtiene el botón que abre el modal */
  var btnAutor = document.querySelectorAll("#abrir-modal-autor");

  for (var i = 0; i < btnAutor.length; i++) {
    btnAutor[i].onclick = function () {
      modalAutor.style.display = "block";
    }
  };

  var span = document.getElementById("close-autor");

  span.onclick = function () {
    modalAutor.style.display = "none";
  }


  /* Categorias */

  /* Obtiene el modal */
  var modalCategoria = document.getElementById('modal-categoria')

  /* Obtiene el botón que abre el modal */
  var btnCategoria = document.querySelectorAll("#abrir-modal-categoria");

  for (var i = 0; i < btnCategoria.length; i++) {
    btnCategoria[i].onclick = function () {
      modalCategoria.style.display = "block";
    }
  };

  var spanCat = document.getElementById("close-categoria");

  spanCat.onclick = function () {
    modalCategoria.style.display = "none";
  }


  /* Editorial */

  /* Obtiene el modal */
  var modalEditorial = document.getElementById('modal-editorial')

  /* Obtiene el botón que abre el modal */
  var btnEditorial = document.querySelectorAll("#abrir-modal-editorial");

  for (var i = 0; i < btnEditorial.length; i++) {
    btnEditorial[i].onclick = function () {
      modalEditorial.style.display = "block";
    }
  };

  var spanEdit = document.getElementById("close-editorial");

  spanEdit.onclick = function () {
    modalEditorial.style.display = "none";
  }

  function cargarPropiedades(tipo, id, nombre) {

    if (tipo == 'Autor') {
      document.formAutores.idAutor.value = id;
      document.formAutores.editarAutor.value = nombre;

      document.getElementById('crear-autor').style.display = "none";
      document.querySelector('#autor-nuevo').style.display = "none";
      document.getElementById('editar-autor').style.display = "block";
      document.querySelector('#autor-viejo').style.display = "block";
    }


    if (tipo == 'Editorial') {
      document.formEditoriales.idEditorial.value = id;
      document.formEditoriales.editarEditorial.value = nombre;
      document.getElementById('crear-editorial').style.display = "none";
      document.querySelector('#editorial-vieja').style.display = "block";
      document.querySelector('#editorial-nueva').style.display = "none";
      document.getElementById('editar-editorial').style.display = "block";
    }


    if (tipo == 'Categoria') {
      document.formCategorias.idCategoria.value = id;
      document.formCategorias.editarCategoria.value = nombre;
      document.getElementById('crear-categoria').style.display = "none";
      document.getElementById('editar-categoria').style.display = "block";
      document.querySelector('#categoria-nueva').style.display = "none";
      document.querySelector('#categoria-vieja').style.display = "block";
    }

  }

  /* Ejemplares */
  const botonEjemplar = document.querySelectorAll('#abrir-ejemplares');

  const modalEjemplar = document.querySelector('#modal-ejemplares');

  for (var i = 0; i < botonEjemplar.length; i++) {
    botonEjemplar[i].onclick = function () {
      modalEjemplar.style.display = "block";
    }
  };

  var span = document.getElementById("close-ejemplares");

  span.onclick = function () {
    modalEjemplar.style.display = "none";
  }
</script>


<script src="js/navbarToggle.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
  integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
  integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


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
  $(document).ready(function () {
    $('#tablaLibros').DataTable({
      "lengthMenu": [
        [5, 10, 20, 30],
        [5, 10, 20, 30]
      ],
      "responsive": true,
      "pagingType": "simple",
      // dom: 'Bfrtip',
      // buttons: [
      //     'excel'
      // ],
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',
          text: '<i class="fas fa-download" title="Exportar" id="exportar"></i>',
          className: 'btn btn-light'
        }


      ],
      "oLanguage": {
        "sInfo": "Mostrando registros _START_-_END_ de _TOTAL_"
      },
    });
  });



  $(document).ready(function () {
    $('#tablaAutores').DataTable({
      "lengthMenu": [
        [5, 10, 20, 30],
        [5, 10, 20, 30]
      ],
      "responsive": true,
      "pagingType": "simple",
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',
          text: '<i class="fas fa-download" title="Exportar" id="exportar"></i>',
          className: 'btn btn-light'
        }


      ],
      "oLanguage": {
        "sInfo": "Mostrando registros _START_-_END_ de _TOTAL_"
      },
    });
  });
  $(document).ready(function () {
    $('#tablaCategorias').DataTable({
      "lengthMenu": [
        [5, 10, 20, 30],
        [5, 10, 20, 30]
      ],
      "responsive": true,
      "pagingType": "simple",
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',
          text: '<i class="fas fa-download" title="Exportar" id="exportar"></i>',
          className: 'btn btn-light'
        }


      ],
      "oLanguage": {
        "sInfo": "Mostrando registros _START_-_END_ de _TOTAL_"
      },
    });
  });
  $(document).ready(function () {
    $('#tablaEditoriales').DataTable({
      "lengthMenu": [
        [5, 10, 20, 30],
        [5, 10, 20, 30]
      ],
      "responsive": true,
      "pagingType": "simple",
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',
          text: '<i class="fas fa-download" title="Exportar" id="exportar"></i>',
          className: 'btn btn-light'
        }
      ],
      "oLanguage": {
        "sInfo": "Mostrando registros _START_-_END_ de _TOTAL_"
      },
    });
  });
</script>

<script src="js/Spanish.js"></script>

</html>