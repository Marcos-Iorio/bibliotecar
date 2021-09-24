<?php



  function todosLosLibros(){
    include 'db.php';
    $stmt = $dbh->prepare('SELECT * FROM libros l, autores a, categorias c, editoriales e ORDER BY l.stock DESC');
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
                  echo 'Categoria: ' . $fila['nombreCategoria'] . ' <br>';
                  echo 'Editorial: ' . $fila['nombreEditorial'] . '
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
    include 'db.php';
    $stmt = $dbh->prepare('SELECT * FROM libros l, autores a, categorias c, editoriales e where l.idLibro =  "'. $idLibro .'"');
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
        <span>' . $arr['nombreEditorial']. '</span>
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
        echo '<li><a href="librosFiltrados.php?categoria=' . $fila['nombreCategoria'] . '"><span></span> ' . $fila['nombreCategoria'] . ' </a></li>';

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
       echo '<li><a href="librosFiltrados.php?autor=' . $fila['nombreAutor'] . '"><span></span> ' . $fila['nombreAutor'] . ' </a></li>';

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
       echo '<li><a href="librosFiltrados.php?editorial=' . $fila['nombreEditorial'] . '"><span></span> ' . $fila['nombreEditorial'] . ' </a></li>';

   endforeach;
}

function librosFiltrados(){
    include('db.php');

    if(isset($_GET['categoria'])){
        $filtro = $_GET['categoria'];
    }
    if(isset($_GET['autor'])){
        $filtro = $_GET['autor'];
    }
    if(isset($_GET['editorial'])){
        $filtro = $_GET['editorial'];
    }

    $stmt = $dbh->prepare('SELECT * FROM libros l, autores a, categorias c, editoriales e where c.nombreCategoria = "' . $filtro . '" or a.nombreAutor = "' . $filtro . '" or e.nombreEditorial = "' . $filtro . '"  ORDER BY l.stock DESC');
    $stmt->execute();
    $resultado = $stmt->fetchAll();

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
?>

