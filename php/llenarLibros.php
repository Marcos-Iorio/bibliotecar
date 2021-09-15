<?php

  function todosLosLibros(){
    include_once 'db.php';
    $stmt = $dbh->prepare('SELECT * FROM libros l, autores a, categorias c');
    $stmt->execute();
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
   
  }

function singleBook($idLibro){

    include_once 'db.php';
    $stmt = $dbh->prepare('SELECT * FROM libros l, autores a, categorias c where l.idLibro =  "'. $idLibro .'"');
    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<div id="imagenes-libros" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img id="img-libro" class="d-block w-100" src=' . $arr['imagen_libro'] . ' alt="First slide">
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
        <span>' .  $arr['nombreAutor'] . '</span>
        <label for="editorial">Editorial:</label>
        <span><?php /* echo $arr[\'nombreEditorial\'] */?></span>
        <label for="stock">Stock:</label>
        <span id="stock">' . $arr['stock'] . '</span>
    </div>
    <button class="reservar" id="reservar">Reservar</button>
    <label for="pdf">PDF:</label>
    <span><a href=""><i class="fas fa-cloud-download-alt"></i></a></span>
</div>
<div class = "descripcion">
    <h3 class= "titulo-desc">Descripcion</h3>
    <p class = "desc">' . $arr['descripcion'] . '</p>
</div>';


  }

  function gestionLibros(){

  
  include_once 'db.php';

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
?>

