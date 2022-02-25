
<?php



  function todosLosLibros(){
    include 'db.php';


        $stmt = $dbh->prepare('SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores ORDER BY l.stock DESC');
    $stmt->execute();
    $resultado=$stmt->fetchAll();

    foreach($resultado as $fila):
      echo '<div class="libro-prueba" id="libro-prueba">
          <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">
              <div class="imagen-libro">
                  <img class="imagen-libro" data-lazy="' . $fila['ruta'] . ' " alt="">
              </div>
              <div id="informacion" class="informacion">
	              <div class="custom-shape-divider-bottom-1635630968">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>															  
                  <p class="libro-info">';
                  echo 'Titulo:<span class="portal-info"> ' . $fila['titulo'] . '</span>  <br>';
                  echo 'Autor:<span class="portal-info"> ' . $fila['nombreAutor']. '</span>  <br>';
                  echo 'Categoria:<span class="portal-info"> ' . $fila['nombreCategoria'] . '</span>
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
    $stmt = $dbh->prepare("SELECT l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores
            where l.titulo like '%$criterio%' 
            or l.descripcion like '%$criterio%'
            or a.nombreAutor like '%$criterio%'
            or c.nombreCategoria like '%$criterio%'
            or e.nombreEditorial like '%$criterio%' ORDER BY l.stock DESC");


if ($stmt->execute()) {
      # code...
    
    $resultado=$stmt->fetchAll();

    if(!empty($resultado)){
    
        foreach($resultado as $fila):
            echo '<div class="libro-prueba" id="libro-prueba">
                <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">
                    <div class="imagen-libro">
                        <img class="imagen-libro" data-lazy="' . $fila['ruta'] . ' " alt="">
                    </div>
                    <div class="informacion">
                    <div class="custom-shape-divider-bottom-1635630968">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                        </svg>
                    </div>
                        <p class="libro-info">';
                        echo 'Titulo:<span class="portal-info"> ' . $fila['titulo'] . '</span>  <br>';
                        echo 'Autor:<span class="portal-info"> ' . $fila['nombreAutor']. '</span>  <br>';
                        echo 'Categoria:<span class="portal-info"> ' . $fila['nombreCategoria'] . '</span>
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
    
    }else {
        echo "<h3>No se han encontrado resultados</h3>";
    }


  }
}

function singleBook($idLibro){
    include 'db.php';
    $query = 'SELECT l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial, i.ruta, i.ruta_contratapa
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores
            WHERE l.idLibro = "'. $idLibro .'"';
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    //$arr=$stmt->fetchAll();
    // foreach($arr as $fila):

    // if ($arr['idCategoriaImg']=='2') {
    //         $contratapa= $arr['ruta_contratapa'];
    //        }  else {
    //          $contratapa= $arr['ruta'];
    //        }
           
    //     endforeach;
 
    if ($arr['pdf']=='' or $arr['pdf']==' ') {
            $pdf='';
          }  else {
            if (!isset($_SESSION['mailL'])) {
              $pdf='';
            } else {
            $pdf='<label for="pdf">PDF:</label>
    <span><a name="file_pdf" href="'. $arr['pdf'] .'" download="'. $arr['titulo'] .'"><i  class="fas fa-cloud-download-alt"></i></a></span>';
            }
          }
          
          if (!($arr['ruta_contratapa']=='')) {
            $contratapa=$arr['ruta_contratapa'];
        } else {
            $contratapa=$arr['ruta'];
        }

        if (isset($_SESSION['mailL'])) {
            $botonReservar= '<div class="boton-reservar">
                <button class="reservar" id="reservar">Reservar</button>
            </div>';
        } else {
            $botonReservar= '<h3 class="boton-reservar" style="text-align:center;">Iniciá sesión o registrate para acceder a las reservas.</h3>';
        
        }
    echo '
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div id="imagenes-libros" class="carousel slide" data-ride="carousel" >
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img id="img-libro" class="d-block w-100" src="' . $arr['ruta'] . '" alt="Tapa">
        </div>

        <div class="carousel-item">
            <img id="img-libro" class="d-block w-100" src="' . $contratapa . '" alt="Contra Tapa">
    
        </div>

    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</div>


<div class="libro-info">
    <div class = "titulo-info">
        <label for="titulo" id="titulo-libro">' . $arr['titulo'] . '</label>
    </div>
    <div class = "body-info">
        <label for="autor">Autor:</label>
        <span>' .  $arr['nombreAutor'] . '</span><br>
        <label for="editorial">Editorial:</label>
        <span>'. $arr['nombreEditorial'] . '</span><br>
        <label for="stock">Stock:</label>
        <span id="stock">' . $arr['stock'] . '</span><br>
		 <form action="" method="POST" target="#">
          '.$pdf.'						 
         </form>
    </div>
    <br><br>
    <form id="form-reserva">
        <div id = "dateFormat">Seleccioná las fechas:<br>
            <input type="name" name="dates" id="datePicker" value="00/00/0000 - 00/00/0000">
        </div>
    </form>   
    '.$botonReservar.'
    
</div>
<div class = "descripcion">
    <h3 class= "titulo-desc">Descripción</h3>
    <p class = "desc">' . $arr['descripcion'] . '</p>
</div>';

	                   /* if (isset($_POST['file_pdf']) && !isset($mail)) {

                        echo "<script>swal({title:'Error',text:'Por favor ingrese con su cuenta de usuario para poder realizar una descarga.',type:'info'});</script> ";
                    }		*/														
  }

  /* function gestionLibros(){
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
} */

  function todasLasCategorias(){
     include 'db.php'; 
    $stmt = $dbh->prepare('SELECT distinct nombreCategoria from categorias order by nombreCategoria asc');
    // Ejecutamos
    $stmt->execute();
    // Mostramos los resultados
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila):
        echo '<li><a href="librosFiltrados.php?categoria=' . $fila['nombreCategoria'] . '"><span></span> ' . $fila['nombreCategoria'] . ' </a></li>';

    endforeach;
    }

function librosFiltrados(){
    include('db.php');

    $query = "";

    if(isset($_GET['stock'])){
        $filtro = $_GET['stock'];
        if($filtro == 1){
            $query .="SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
                    FROM libros AS l 
                    INNER JOIN libro_autores la ON l.idLibro = la.idLibro
                    INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
                    INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
                    INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
                    INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
                    INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
                    INNER JOIN autores a ON la.idAutores = a.idAutores
                    WHERE l.stock > 0 ORDER BY l.stock DESC";
        }else{
            $query .="SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
                    FROM libros AS l 
                    INNER JOIN libro_autores la ON l.idLibro = la.idLibro
                    INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
                    INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
                    INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
                    INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
                    INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
                    INNER JOIN autores a ON la.idAutores = a.idAutores
                    WHERE l.stock <= 0 ORDER BY l.stock DESC";
        }
    }

    if(isset($_GET['categoria'])){
        $filtro = $_GET['categoria'];
        $query .= "SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
                    FROM libros AS l 
                    INNER JOIN libro_autores la ON l.idLibro = la.idLibro
                    INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
                    INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
                    INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
                    INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
                    INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
                    INNER JOIN autores a ON la.idAutores = a.idAutores
                    WHERE c.nombreCategoria = '" . $filtro ."' ORDER BY l.stock DESC";
    }

    if(isset($_GET['pdf'])){
        $filtro = $_GET['pdf'];
        if($filtro == 1){
            $query .= "SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
                    FROM libros AS l 
                    INNER JOIN libro_autores la ON l.idLibro = la.idLibro
                    INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
                    INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
                    INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
                    INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
                    INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
                    INNER JOIN autores a ON la.idAutores = a.idAutores
                    WHERE l.pdf IS NOT NULL AND l.pdf != '' ORDER BY l.stock DESC";
        }else{
            $query .= "SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
                    FROM libros AS l 
                    INNER JOIN libro_autores la ON l.idLibro = la.idLibro
                    INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
                    INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
                    INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
                    INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
                    INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
                    INNER JOIN autores a ON la.idAutores = a.idAutores
                    WHERE l.pdf='' OR l.pdf IS NULL ORDER BY l.stock DESC";
        }
    }

    $stmt = $dbh->prepare($query);

    $stmt->execute();

    $resultado = $stmt->fetchAll();
    if(!empty($resultado)){
        foreach($resultado as $fila):
            echo '<div class="libro-prueba" id="libro-prueba">
            <a class="link" id="id-libro" href="single-book.php?sku=' . $fila['idLibro'] . '">
                <div class="imagen-libro">
                    <img class="imagen-libro" data-lazy="' . $fila['ruta'] . ' " alt="">
                </div>
                <div id="informacion" class="informacion">
                    <div class="custom-shape-divider-bottom-1635630968">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                        </svg>
                    </div>															  
                    <p class="libro-info">';
                    echo 'Titulo:<span class="portal-info"> ' . $fila['titulo'] . '</span>  <br>';
                    echo 'Autor:<span class="portal-info"> ' . $fila['nombreAutor']. '</span>  <br>';
                    echo 'Categoria:<span class="portal-info"> ' . $fila['nombreCategoria'] . '</span>
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
    }else{
        echo '<h3>No se encontraron resultados</h3><br>';
    }
}
?>

