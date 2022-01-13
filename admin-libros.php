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
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <section id="page">
        <?php 
          include "php/panel.php";
         

         ?>
        <main id="main">
            <h1>Gestion de libros</h1>

            


    <!--<li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Administrar libros </span></a>
            <ul class="collapse list-unstyled" id="reservas">-->


            <section class="contenido wrapper">
                <div >
                  <div class="busqueda">
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
        <!--Seccion de los libros-->
  <div class="container main-libros">

     <!-- <h3>Gestion de libros!</h3>
      <div class="tabla-libros">-->

      <form method="POST" action="#" name="busqueda" >
        <div >

          <h6 style="width: 100px;">Buscar por:</h6>
          <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
            <option value="" disabled selected>Seleccionar</option>
              <option value="mail">Titulo</option> 
              <option value="idRol">Autor</option>
              <option value="check_mail">Categoria</option>
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
                            <th>ID Libro</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Fecha de Alta</th>
                            <th>Editar</th>
                          </tr>
                        </thead>
                                            
                    <?php

                    if(isset($_POST['btnCrearLibro'])){

                      //llenarTabla ($_POST['titulo'],$_POST['autor'],$_POST['desc'] ,$_POST['categoria'],$_POST['editorial'],
                      //$_POST['stock'],$_POST['fechaAlta'], $_FILES['pdf']);
                      llenarTabla ($_POST['titulo'],$_POST['selectAutor'],$_POST['desc'] ,$_POST['selectCategoria'],$_POST['selectEditorial'],
                      $_POST['stock'], $_FILES['pdf'], $_FILES['tapa'], $_FILES['contratapa']);

                      //llenarImagen($_FILES['tapa'], $_FILES['contratapa']);
    //echo "<script>swal({title:'Error',text:'la tapa es $tmpTapa,$destinoTapa y la contratapa $contratapa',type:'error'});</script>";
                      
                    }
                    //unset($_POST['cargar-libro']);
                      

                      if(isset($_POST['btnEditarLibro'])){

                      editarLibro($_POST['idLibro'],$_POST['titulo'],$_POST['selectAutor'],$_POST['desc'] ,$_POST['selectCategoria'],$_POST['selectEditorial'],
                      $_POST['stock'], $_FILES['pdf'], $_FILES['tapa'], $_FILES['contratapa']);

                    }

                     
                      if(!isset($_POST['btnEditarLibro']) || !isset($_POST['btnCrearLibro'])){
                      gestionLibros();
                      /* Llena el tabla con todos los libros de la base de datos */
                      }
                      ?>
                        
                
                      </table>
                      <br><br>
                      <?php 
            $paginas = getPages2();

             for($page = 1; $page<= $paginas; $page++) {  
              echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            }  
              echo "</div>";

               ?>
                    </div>
                </div>
            </section>
              <br><br>
              <hr>
                                              <br><br>

                                <h3>Modificar libros:</h3>
            <section class = "subir-libro">
                <form name="formLibros" action="" method = "POST" class= "form-libro" enctype="multipart/form-data" >
                
                <div class="wrapper-libros">
                  <div style="display:flex;">
                    <label for="">Titulo:</label>
                    <input style="background-color: white; color: black;"class="input-libro"  type="text" name="titulo" id="titulo" required placeholder="Titulo">
                      <label for="">Autor:</label>
                        <select required style="background-color: white; color: black; width: 20%;"class="form-control"name="selectAutor">
                          <option value="" disabled selected>Seleccionar autor</option>
                          <?php getAutores(); ?>    
                        </select>

                   </div>
                    <br><br>

                  <div style="display:flex;">

                    <label for="">Descripcion: </label>
                      <input maxlength = "1000" style="background-color: white; color: black;"class="input-libro"  type="text" name="desc" id="desc" required placeholder="Maximo: 1000 caracteres">

                      <input hidden  type="text" name="idLibro" id="idLibro">
                    <br><br>
                   
                      <label for="">Categoria:</label>
                      <select required style="background-color: white; color: black; width: 20%;"class="form-control"name="selectCategoria" >
                      <option value="" disabled selected>Seleccionar categoria</option>
                        <?php 
                        getCategorias();
                         ?>  
                    </select>
                   </div>


                    <br><br>
                                     <div style="display:flex;">

                      <label for="">Editorial:</label>
                      <select required style="background-color: white; color: black; width: 20%;"class="form-control"name="selectEditorial">
                      <option value="" disabled selected>Seleccionar editorial</option>

                      <?php 

                      getEditoriales();
                     
                      
                          
                          ?>
                                
                    </select>  


                    <label for="">Stock:</label>
                    <input style="background-color: white; color: black;" class="input-libro" oninput="javascript: if (this.value > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "2" name="stock" id="stock" required placeholder="Maximo: 99">
                    
                    </div>

                    <br><br>
                                     <div style="display:flex;">

                    <!--<label for="">Fecha de alta</label>
                    <input style="background-color: white; color: black;"class="input-libro"  type="date" name="fechaAlta" id="fechaAlta"><br><br>-->
                    



                    <label for="">Tapa:</label>
                    <input class="input-libro" type='file' name='tapa' id="tapa" required>

                                        <label for="">ContraTapa (Opcional):</label>
                    <input class="input-libro" type='file' name='contratapa' id="contratapa">
                    <br><br>

                                        </div>
                                     <div style="display:flex;">



                    <label for="">Pdf de libro (Opcional):</label>
                    <input class="input-libro"   type="file" name="pdf" id="pdf" >
                                                                                                   </div>

                  </div>
                   
                    <div class="center">
                      <input value="Editar libro" style="width: 20%;" type="submit" name="btnEditarLibro" id="editarUsuario"onclick="return ModificarLibro('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                        <input value="Crear libro" style="width: 20%; " type="submit" name="btnCrearLibro" id="cargar-imagenes"onclick="return ModificarLibro('crear')"/>

                        <input name="txtID" style="background-color: white; color: black; width: 20%;"type="hidden" name ="genero" id="genero"  placeholder="Seleccionar">
                    </div>


            </section>

        

        <!--      </ul>

            </li>-->
        <br>
        <br><br>
 




        <!--Seccion Autores-->


  <li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas2" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Administrar autores </span></a>
            <ul class="collapse list-unstyled" id="reservas2">

                    <section class="contenido wrapper">
                <div >
                  <div class="busqueda">
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
  <div class="container main-libros">

     <!-- <h3>Gestion de libros!</h3>
      <div class="tabla-libros">-->

            <br>
      <form method="POST" action="#" name="busqueda" >
        <div >

          <h6 style="width: 100px;">Buscar por:</h6>
          <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
            <option value="" disabled selected>Seleccionar</option>
              <option value="mail">Titulo</option> 
              <option value="idRol">Autor</option>
              <option value="check_mail">Categoria</option>
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
                            <th>ID Autor</th>
                            <th>Nombre Autor</th>
                            <th>Editar</th>
                          </tr>
                        </thead>
                      <?php


                      
                      /* Llena el tabla con todos los libros de la base de datos */
                      
                      if (isset($_POST['btnCrearAutor'])) {

                        crearAutor($_POST['nuevoAutor']);
                      }

                      if (isset($_POST['btnEditarAutor'])) {

                        editarAutor($_POST['idAutor'], $_POST['editarAutor']);
                      }

                      if(!isset($_POST['btnCrearAutor']) || !isset($_POST['btnEditarAutor'])){
                        gestionAutores();
                      }

                      ?>
                        
                      </table>
                      <br><br>
            <?php 

            $paginas = getPages2();

             for($page = 1; $page<= $paginas; $page++) {  
              echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            }  
              echo "</div>";

               ?>
                    </div>
                </div>
            </section>

            <section class = "subir-libro">
                <form name="formAutores" action="" method = "POST" class= "form-autor" enctype="multipart/form-data" >
                
                <div class="wrapper-libros">

                      <label for="">Autor:</label>
                        <input class="input-libro" type="text" name="editarAutor" id="autor"  placeholder="Autor">
                        <input hidden type="text" name="idAutor" id="autor"  placeholder="Autor">

                      <label for="">Autor Nuevo:</label>
                        <input class="input-libro" type="text" name="nuevoAutor" id="autor"  placeholder="Autor">
                   

                  </div>
                   
                    <div class="center">
                      <input value="Editar autor" style="width: 20%;" type="submit" name="btnEditarAutor" id="editarUsuario"onclick="return ModificarLibro('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                        <input value="Crear autor" style="width: 20%; " type="submit" name="btnCrearAutor" id="cargar-imagenes"onclick="return ModificarLibro('crear')"/>

                       
                    </div>

                </form>

            </section>
              </ul>

            </li>

        <br>





        <!--Seccion Categorias-->

  <li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas3" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Administrar categorias </span></a>
            <ul class="collapse list-unstyled" id="reservas3">

                    <section class="contenido wrapper">
                <div >
                  <div class="busqueda">
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
        <!--Seccion de los libros-->
  <div class="container main-libros">

     <!-- <h3>Gestion de libros!</h3>
      <div class="tabla-libros">-->

            <br>
      <form method="POST" action="#" name="busqueda" >
        <div >

          <h6 style="width: 100px;">Buscar por:</h6>
          <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
            <option value="" disabled selected>Seleccionar</option>
              <option value="mail">Titulo</option> 
              <option value="idRol">Autor</option>
              <option value="check_mail">Categoria</option>
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
                            <th>ID Categoria</th>
                            <th>Nombre Categoria</th>
                            <th>Editar</th>
                          </tr>
                        </thead>
                      <?php
                      
                      if (isset($_POST['btnCrearCategoria'])) {

                        crearCategoria($_POST['nuevaCategoria']);
                      }

                      if (isset($_POST['btnEditarCategoria'])) {

                        editarCategoria($_POST['idCategoria'], $_POST['editarCategoria']);
                      }

                      if(!isset($_POST['btnCrearCategoria']) || !isset($_POST['btnEditarCategoria'])){
                        gestionCategorias();
                      }
                      
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                        
                  <?php  ?>
                      </table>
                      <br><br>
                      <?php 
            $paginas = getPages2();

             for($page = 1; $page<= $paginas; $page++) {  
              echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            }  
              echo "</div>";

               ?>
                    </div>
                </div>
            </section>

            <section class = "subir-libro">
                <form action="" name= "formCategorias" method = "POST" class= "form-libro" enctype="multipart/form-data" >
                
                <div class="wrapper-libros">

                      <label for="">Categoria:</label>
                      <input class="input-libro" type="text" name="editarCategoria" id="autor"  placeholder="Categoria">
                      <input hidden type="text" name="idCategoria" id="autor"  placeholder="Categoria">
                    <label for="">Categoria Nueva:</label>
                      <input class="input-libro"  type="text" name ="nuevaCategoria" id="categoria"  placeholder="Categoria">
                   

                  </div>
                   
                    <div class="center">
                      <input value="Editar categoria" style="width: 20%;" type="submit" name="btnEditarCategoria" id="editarUsuario"onclick="return ModificarLibro('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                        <input value="Crear categoria" style="width: 20%; " type="submit" name="btnCrearCategoria" id="cargar-imagenes"onclick="return ModificarLibro('crear')"/>

                    </div>
                    

                </form>

            </section>
              </ul>

            </li>



        <br>







        <!--Seccion Editoriales-->


  <li>
            <i id="flecha-reserva" class="fas fa-chevron-right"></i><a href="#reservas4" class="scroll-link" onclick="moveArrowReservas()" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" id="dropdown-toggle" role="button" aria-controls="otherSections"><span class="cuenta-item">Administrar editoriales </span></a>
            <ul class="collapse list-unstyled" id="reservas4">

                    <section class="contenido wrapper">
                <div >
                  <div class="busqueda">
                  </div>
                  <div class = "filtros">
                  </div>
                </div>
        <!--Seccion de los libros-->
  <div class="container main-libros">

     <!-- <h3>Gestion de libros!</h3>
      <div class="tabla-libros">-->

            <br>
      <form method="POST" action="#" name="busqueda" >
        <div >

          <h6 style="width: 100px;">Buscar por:</h6>
          <select class="form-control"name="txtCriterio" style="width: 200px; margin-right: 200px;">
            <option value="" disabled selected>Seleccionar</option>
              <option value="mail">Titulo</option> 
              <option value="idRol">Autor</option>
              <option value="check_mail">Categoria</option>
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
                            <th>ID Editorial</th>
                            <th>Nombre Editorial</th>
                            <th>Editar</th>
                          </tr>
                        </thead>
                      <?php


                      if (isset($_POST['btnCrearEditorial'])) {

                        crearEditorial($_POST['nuevaEditorial']);
                      }

                      if (isset($_POST['btnEditarEditorial'])) {

                        editarEditorial($_POST['idEditorial'], $_POST['editarEditorial']);
                      }

                      if(!isset($_POST['btnCrearEditorial']) || !isset($_POST['btnEditarEditorial'])){
                        gestionEditoriales();
                      }

                    
                      /* Llena el tabla con todos los libros de la base de datos */
                      ?>
                        
                  <?php  ?>
                      </table>
                      <br><br>
                      <?php 
            $paginas = getPages2();

             for($page = 1; $page<= $paginas; $page++) {  
              echo '<a style="margin-left:20px; text-align: center;"  class="btn btn-dark" href = "admin-libros.php?page=' . $page . '">' . $page . ' </a>';  
            }  
              echo "</div>";

               ?>
                    </div>
                </div>
            </section>

            <section class = "subir-libro">
                <form name="formEditoriales" action="" method = "POST" class= "form-libro" enctype="multipart/form-data" >
                
                <div class="wrapper-libros">

                      <label for="">Editorial:</label>
                      <input class="input-libro" type="text" name="editarEditorial" id="autor"  placeholder="Editorial">
                      <input hidden type="text" name="idEditorial" id="autor"  placeholder="Editorial">

                <label for="">Editorial Nueva:</label>
                    <input class="input-libro"  type="text" name ="nuevaEditorial" id="editorial"  placeholder="Editorial">
                   

                  </div>
                   
                    <div class="center">
                      <input value="Editar Editorial" style="width: 20%;" type="submit" name="btnEditarEditorial" id="editarUsuario"onclick="return ModificarLibro('editar')"/>
                                        <label for=""style="width: 100px;"></label>

                        <input value="Crear Editorial" style="width: 20%; " type="submit" name="btnCrearEditorial" id="cargar-imagenes"onclick="return ModificarLibro('crear')"/>

                    </div>
                    

                </form>

            </section>
              </ul>

            </li>


        </main>
      </section>
</body>
<script type="text/javascript">
        function ModificarLibro(tipo) {

if (tipo == 'editar') {
    msg="Confirma que desea modificar este registro?";

} else {
    msg="Confirma que desea crear este registro?";

}
    var usr = confirm(msg);
    if (usr == true) {
        return true;
    }
    return false;


}

</script>


<script>
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
    document.getElementsByName('selectAutor')[0].options[0].innerHTML = nombreAutor;
    document.getElementsByName('selectEditorial')[0].options[0].innerHTML = nombreEditorial;
    document.getElementsByName('selectCategoria')[0].options[0].innerHTML = nombreCategoria;




    //window.location = 'vistaProducto.php#gestionProducto';
  }

  function cargarPropiedades(tipo, id, nombre) {

    if (tipo == 'Autor') {
    document.formAutores.idAutor.value = id;
    document.formAutores.editarAutor.value = nombre;
}


    if (tipo == 'Editorial') {
    document.formEditoriales.idEditorial.value = id;
    document.formEditoriales.editarEditorial.value = nombre;
}


    if (tipo == 'Categoria') {
    document.formCategorias.idCategoria.value = id;
    document.formCategorias.editarCategoria.value = nombre;
}

  }



</script>


<script src="js/navbarToggle.js"></script>

<!-- jQuery CDN - Slim version =without AJAX -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</html>
   
