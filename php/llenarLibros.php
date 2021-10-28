<?php
  function todosLosLibros(){
    include 'db.php';


        $stmt = $dbh->prepare('SELECT l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores');
    $stmt->execute();
    $resultado=$stmt->fetchAll();

    foreach($resultado as $fila):
      echo '<div class="libro-prueba" id="libro-prueba">
          <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">
              <div class="imagen-libro">
                  <img class="imagen-libro" data-lazy="' . $fila['ruta'] . ' " alt="">
              </div>
              <div class="informacion" id="informacion">
                  <p class="libro-info">';
                  echo 'Titulo: ' . $fila['titulo'] . '  <br>';
                  echo 'Autor: ' . $fila['nombreAutor']. '  <br>';
                  echo 'Categoria: ' . $fila['nombreCategoria'] . '
                  </p>
              </div>
              <div class="etiqueta">
                  <p class="etiqueta-info" id="etiqueta-info">';
                      if($fila['stock'] > 0 ){
                          echo "Disponible";
                      }else{
                          echo "No disponible";
                      } 
             echo ' </div>
          </a>
      </div>';
  endforeach;
  }


function busquedaLibros($criterio){
    include 'db.php';
    $stmt = $dbh->prepare("SELECT * FROM libros l, autores a, categorias c, editoriales e where l.titulo like '%$criterio%' 
or l.descripcion like '%$criterio%'
or a.nombreAutor like '%$criterio%'
or c.nombreCategoria like '%$criterio%'
or e.nombreEditorial like '%$criterio%' ORDER BY l.stock DESC");

if ($stmt->execute()) {
      # code...
    
    $resultado=$stmt->fetchAll();

    foreach($resultado as $fila):
      echo '<div class="libro-prueba" id="libro-prueba">
          <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">
              <div class="imagen-libro">
                  <img class="imagen-libro" data-lazy="' . $fila['imagen_libro'] . ' " alt="">
              </div>
              <div class="informacion">
                  <p class="libro-info">';
                  echo 'Titulo: ' . $fila['titulo'] . '  <br>';
                  echo 'Autor: ' . $fila['nombreAutor']. '  <br>';
                  echo 'Categoria: ' . $fila['nombreCategoria'] . '
                  </p>
              </div>
              <div class="etiqueta">
                  <p class="etiqueta-info" id="etiqueta-info">';
                      if($fila['stock'] > 0 ){
                          echo "Disponible";
                      }else{
                          echo "No disponible";
                      } 
             echo ' </div>
          </a>
      </div>';
  endforeach;
  
if ($stmt->rowCount() == '') {
        echo "<h6>No se han encontrado resultados</h6>";
}


  }
}

function singleBook($idLibro){
    include 'db.php';
    $stmt = $dbh->prepare("SELECT * FROM libros l, autores a, categorias c, imagen_libros i where l.idLibro =  '$idLibro' and i.idLibro=l.idLibro");
    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<div id="imagenes-libros" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img id="img-libro" class="d-block w-100" src=' . $arr['ruta'] . ' alt="First slide">
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
        <label for="titulo">' . $arr['titulo'] . '</label>
    </div>
    <div class = "body-info">
        <label for="autor">Autor:</label>
        <span>' .  $arr['nombreAutor'] . '</span><br>
        <label for="editorial">Editorial:</label>
        <span><?php /* echo $arr[\'nombreEditorial\'] */?></span><br>
        <label for="stock">Stock:</label>
        <span id="stock">' . $arr['stock'] . '</span><br>
        <label for="pdf">PDF:</label>
    <span><a href=""><i class="fas fa-cloud-download-alt"></i></a></span>
    </div>
    <div class="boton-reservar">
        <button class="reservar" id="reservar">Reservar</button>
        <p class="alerta-reserva">*Todas las reservas son por 2 semanas</p>
    </div>
</div>
<div class = "descripcion">
    <h3 class= "titulo-desc">Descripcion</h3>
    <p class = "desc">' . $arr['descripcion'] . '</p>
</div>';


  }

  function gestionLibros(){
    include 'db.php';
  $stmt = $dbh->prepare('SELECT * FROM libros, categorias, autores');
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "<tbody>
                          <tr>
                            <td>".  $fila['titulo']."</td>
                            <td>". $fila['nombreAutor']."</td>
                            <td>". $fila['nombreCategoria']."</td>
                            <td>". $fila['stock']. "</td>
                            <td>" . $fila['fechaAlta']. "</td>
                            <td><button><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></td>
                            <td><button><i class=\"far fa-trash-alt tbody-icon\"></i></button></td>
                          </tr>
                        </tbody>";

  endforeach;
}
  }

  function todasLasCategorias(){
     include 'db.php'; 
    $stmt = $dbh->prepare('SELECT * from categorias');
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila):
        echo '<li><a href=""><span></span> ' . $fila['nombreCategoria'] . ' </a></li>';

    endforeach;
}

function todosLosAutores(){
    include 'db.php'; 
   $stmt = $dbh->prepare('SELECT * from autores');
   // Ejecutamos
   $stmt->execute();
   // Mostramos los resultados
   $resultado = $stmt->fetchAll();
   foreach($resultado as $fila):
       echo '<li><a href=""><span></span> ' . $fila['nombreAutor'] . ' </a></li>';

   endforeach;
}

function todasLasEditoriales(){
    include 'db.php'; 
   $stmt = $dbh->prepare('SELECT * from editoriales');
   // Ejecutamos
   $stmt->execute();
   // Mostramos los resultados
   $resultado = $stmt->fetchAll();
   foreach($resultado as $fila):
       echo '<li><a href=""><span></span> ' . $fila['nombreEditorial'] . ' </a></li>';

   endforeach;
}
?>

