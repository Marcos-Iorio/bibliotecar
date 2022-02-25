
<?php

  function gestionLibros(){

  // if (!isset ($_GET['page']) ) {  
  //           $page = 1;  
  //       } else {  
  //           $page = $_GET['page'];  
  //       }  
  //         $results_per_page = 5;  

  //       //determine the sql LIMIT starting number for the results on the displaying page  
  //       $page_first_result = ($page-1) * $results_per_page;  
  //       //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query = "SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial, DATE_FORMAT(l.fechaAlta,'%d-%m-%Y') AS fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores ORDER BY l.idLibro";
            //INNER JOIN autores a ON la.idAutores = a.idAutores ORDER BY l.idLibro DESC LIMIT $page_first_result , $results_per_page";

$stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
    //echo "<form action='' method = 'POST' class= 'form-libro' enctype='multipart/form-data'

    echo "
                          <tr>
                            <td>" . $fila['idLibro']. "</td>
                            <td>".  $fila['titulo']."</td>
                            <td>". $fila['nombreAutor']."</td>
                            <td>". $fila['nombreCategoria']."</td>
                            <td>". $fila['stock']. "</td>
                            <td>" . $fila['fechaAlta']. "</td>
                            <td><a href='#modal-libros' id='abrir-modal-libros'><button onclick=\"javascript:cargarLibros('".$fila["titulo"]."','".$fila["nombreAutor"]."','".$fila["nombreCategoria"]."','".$fila["stock"]."',`".$fila["descripcion"]."`,'".$fila["nombreEditorial"]."','".$fila["idLibro"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                            <td><a href='#modal-ejemplares' id='abrir-ejemplares' style='text-decoration: none;'><button class='btnVerEjemplares' onclick=\"javascript:cargarEjemplares('".$fila["idLibro"]."', '".$fila["titulo"]."')\">Ver ejemplares</button></a></td>
                          </tr>


                        ";

  endforeach;
}
  }

function llenarTabla($titulo,$autor, $descripcion,$categoria,$editorial, $stock, $pdf, $tapa, $contratapa){
    include('db.php');

        if(!$_FILES['pdf']['name'] == ""){
                  $pdf = $_FILES['pdf']['tmp_name'];
        $destinoPdf ="assets/libros/pdf/".$_FILES['pdf']['name'];
        move_uploaded_file($pdf,$destinoPdf);

        } else {
        $destinoPdf ="";

        }

    $fechaAlta = date('Y-m-d');


    cargarLibro($titulo,$descripcion,$stock,$fechaAlta,$destinoPdf);
    cargarEjemplar($stock, $fechaAlta);
    cargarAutor($autor);
    cargarCategoria($categoria);
    cargarEditorial($editorial);



    llenarImagen($tapa, $contratapa);
    

    //llenarAutorLibro();
    //llenarCategoriaLibro();
    //llenarEditorialLibro();
}


function editarLibro($idLibro, $titulo, $autor, $descripcion,$categoria,$editorial, $stock, $pdf, $tapa, $contratapa){
    include('db.php');


            $flagLibro="error";
            $flagAutor="error";
            $flagEditorial="error";
            $flagCategoria="error";
            $flagImagen="error";
            $flagStock="error";


$tapa=$_FILES['tapa']['name'];
    $contratapa=$_FILES['contratapa']['name'];
    $pdf=$_FILES['pdf']['name'];
        
    if (!$tapa == "") {
        updateTapa($idLibro, $tapa);        
      }

      if (!$contratapa == "") {
        updateContratapa($idLibro, $contratapa);        
      }

      if (!$pdf == ""){
        updatePDF($idLibro, $pdf);  
      }
      if(!$_FILES['pdf']['name'] == ""){
        $pdf = $_FILES['pdf']['tmp_name'];
        $destinoPdf ="assets/libros/pdf/".$_FILES['pdf']['name'];
//move_uploaded_file($pdf,$destinoPdf);

        } else {
        $destinoPdf ="";

        }
          $stockOriginal= getStockActual($idLibro);


                    if ($stockOriginal <= $stock) {
                        $flagStock="ok";
                    $updateStock = $dbh->prepare("UPDATE libros set stock = ? where idLibro = ?");

                    $updateStock->bindParam(1, $stock);
                    $updateStock->bindParam(2, $idLibro);

                    if ($updateStock->execute()) {
                      editarStockEjemplar($idLibro, $stock);
                      
                      }


                    }


                    $updateLibro = $dbh->prepare("UPDATE libros set titulo = ?, descripcion= ? where idLibro = ?");

                    $updateLibro->bindParam(1, $titulo);
                    $updateLibro->bindParam(2, $descripcion);
                    //$updateLibro->bindParam(3, $destinoPdf);
                    $updateLibro->bindParam(3, $idLibro);

//$varLibro = "UPDATE libros set titulo = $titulo, descripcion= $descripcion, stock= $stock, pdf=$destinoPdf where idLibro = $idLibro";
                          if ($updateLibro->execute()) {
                            $flagLibro="ok";
                          }




                  $getAutor = $dbh->prepare("SELECT idAutores FROM autores WHERE nombreAutor = ? LIMIT 1");
                  $getAutor->bindParam(1, $autor);

                  if ($getAutor->execute()) {

                    $arr = $getAutor->fetch(PDO::FETCH_ASSOC);
                    $idAutor = $arr['idAutores'];

                    $updateAutor = $dbh->prepare("UPDATE libro_autores set idAutores = ? where idLibro = ?");

                    $updateAutor->bindParam(1, $idAutor);
                    $updateAutor->bindParam(2, $idLibro);

                          if ($updateAutor->execute()) {
                            $flagAutor="ok";
                          }
                  }



                  $getEditorial = $dbh->prepare("SELECT idEditorial FROM editoriales WHERE nombreEditorial = ? LIMIT 1");
                  $getEditorial->bindParam(1, $editorial);

                  if ($getEditorial->execute()) {

                    $arr = $getEditorial->fetch(PDO::FETCH_ASSOC);
                    $idEditorial = $arr['idEditorial'];

                    $updateEditorial = $dbh->prepare("UPDATE libro_editoriales set idEditorial = ? where idLibro = ?");

                    $updateEditorial->bindParam(1, $idEditorial);
                    $updateEditorial->bindParam(2, $idLibro);

                          if ($updateEditorial->execute()) {
                            $flagEditorial="ok";
                          }
                  }


 
                  $getCategoria = $dbh->prepare("SELECT idCategoria FROM categorias WHERE nombreCategoria = ? LIMIT 1");
                  $getCategoria->bindParam(1, $categoria);

                  if ($getCategoria->execute()) {

                    $arr = $getCategoria->fetch(PDO::FETCH_ASSOC);
                    $idCategoria = $arr['idCategoria'];

                    $updateCategoria = $dbh->prepare("UPDATE libro_categorias set idCategoria = ? where idLibro = ?");

                    $updateCategoria->bindParam(1, $idCategoria);
                    $updateCategoria->bindParam(2, $idLibro);

                          if ($updateCategoria->execute()) {
                            $flagCategoria="ok";
                          }
                  }



                  //Editar tapa y/o contratapa
                  //Update contratapa si no hay registro existente
                  //Editar ejemplares, eliminar/agregar registros segun stock libro 
                  // ver js cuando hay un quote '' en el medio 

                    if ($flagStock=="error") {
                        $msjStock="El stock ingresado es menor al original. Para reducir el stock, por favor gestionelo desde ejemplares.";
                        $titulo="Alerta";
                        $tipo="warning";
                    } else {
                        $msjStock="Registro editado correctamente";
                        $titulo="Exito";
                        $tipo="success";
                    }

                     if ($flagLibro="ok" || $flagEditorial="ok" || $flagAutor="ok" || $flagCategoria="ok" || $flagStock="ok") {
                    echo "<script>swal({title:'$titulo',text:'Registro editado correctamente.',type:'$tipo', showConfirmButton: false, html: '<h6>$msjStock</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";
// //                      # code...
                    } else {
// //         //echo "<script>swal({title:'Error',text:'El registro no pudo ser editado. flagLibro= $flagLibro, flagEditorial= $flagEditorial, flagAutor= $flagAutor, flagCategoria= $flagCategoria, $varLibro ',type:'error'});</script>";
            echo "<script>swal({title:'Error',text:'El registro no pudo ser editado.',type:'error'});</script>";
                    }
 }

function updateTapa($idLibro, $tapa){
  include('db.php');
  $tmpTapa = $_FILES['tapa']['tmp_name'];
  $destinoTapa ="assets/libros/".$_FILES['tapa']['name'];
  move_uploaded_file($tmpTapa,$destinoTapa);

     
  $editarImagen = $dbh->prepare("UPDATE imagen_libros set ruta = '$destinoTapa', idCategoriaImg='1' where idLibro = '$idLibro'");

  $editarImagen->execute();
  //    if ($editarImagen->execute()) {
  //          echo "<script>swal({title:'Exito',text:'Autor editado correctamente.',type:'success', showConfirmButton: false, html: '<br><button type=\"submit\" style=\"background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;\" ><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\">OK</a></button>'});</script>";

  //  } else {
  //      echo "<script>swal({title:'Error',text:'Error al editar el autor. $destinoTapa',type:'error'});</script>";

  //  }
 }        

 function updateContratapa($idLibro, $contratapa){
  include('db.php');

   $tmpContratapa = $_FILES['contratapa']['tmp_name'];
   $destinoCtapa ="assets/libros/".$_FILES['contratapa']['name'];
    move_uploaded_file($tmpContratapa,$destinoCtapa);
     
  $editarImagen = $dbh->prepare("UPDATE imagen_libros set idCategoriaImg='1', ruta_contratapa='$destinoCtapa' where idLibro = '$idLibro'");

  $editarImagen->execute();
  
  //    if ($editarImagen->execute()) {
  //          echo "<script>swal({title:'Exito',text:'Autor editado correctamente.',type:'success', showConfirmButton: false, html: '<br><button type=\"submit\" style=\"background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;\" ><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\">OK</a></button>'});</script>";

  //  } else {
  //      echo "<script>swal({title:'Error',text:'Error al editar el autor., $destinoCtapa',type:'error'});</script>";

  //  }
 }   

 function updatePDF($idLibro, $pdf){
  
  include('db.php');

    $pdf = $_FILES['pdf']['tmp_name'];
    $destinoPdf ="assets/libros/pdf/".$_FILES['pdf']['name'];
    move_uploaded_file($pdf,$destinoPdf);
  
    $editarPDF = $dbh->prepare("UPDATE libros set pdf = '$destinoPdf' where idLibro = '$idLibro'");

    $editarPDF->execute();
//     if ($editarPDF->execute()) {
//       echo "<script>swal({title:'Exito',text:'Autor editado correctamente.',type:'success', showConfirmButton: false'});</script>";

// } else {
//   echo "<script>swal({title:'Error',text:'Error al editar el autor. $pdf, $idLibro',type:'error'});</script>";

// }
 }


function llenarImagen($tapa,$contratapa){
    include('db.php');
       
  

            $tmpTapa = $_FILES['tapa']['tmp_name'];

           if (!$tmpTapa == "") {
            $destinoTapa = "assets/libros/".$_FILES['tapa']['name'];
            move_uploaded_file($tmpTapa,$destinoTapa);
           } else {
            $destinoTapa = "assets/libros/default_book.png";
           }

            $tmpContratapa = $_FILES['contratapa']['tmp_name'];
            $destinoCtapa ="assets/libros/".$_FILES['contratapa']['name'];
             move_uploaded_file($tmpContratapa,$destinoCtapa);
              
             $idTapa = buscarIdTapa();
             $idCtapa = buscarIdcontraTapa();
             $idLibro = buscarIdLibro();
            
            //echo "<script>swal({title:'Error',text:'la tapa es $tmpTapa... y la contratapa $destinoTapa',type:'error'});</script>";


            
             if ($destinoCtapa=='assets/libros/') {
                  cargarTapaImagenLibro($idLibro,$destinoTapa, $idTapa);

             } else {
                cargarCTapaImagenLibro($idLibro,$destinoCtapa,$idCtapa, $destinoTapa);
                /* cargarTapaImagenLibro($idLibro,$destinoTapa, $idTapa); */

             }


}



    

                function cargarLibro($titulo,$descripcion,$stock,$fechaAlta,$destino){
                    include('db.php');

                    $insertLibro = $dbh->prepare("INSERT into `libros` (titulo,descripcion,stock,fechaAlta,pdf) 
                    values(?,?,?,?,?)");

                    $insertLibro->bindParam(1, $titulo);
                    $insertLibro->bindParam(2, $descripcion);
                    $insertLibro->bindParam(3, $stock);
                    $insertLibro->bindParam(4, $fechaAlta);
                    $insertLibro->bindParam(5,$destino);

                          $insertLibro->execute();


                    
                }

                function cargarAutor($autor){
                    include('db.php');
                    $buscarAutor = $dbh->prepare("SELECT idAutores FROM `autores` WHERE nombreAutor='$autor' limit 1");
                    $buscarAutor->execute();

                    $arr=$buscarAutor->fetch(PDO::FETCH_ASSOC);
                    $idAutor=$arr['idAutores'];

                    if (!$idAutor == '') {
                      $idLibro=buscarIdLibro();
                      llenarAutorLibro($idAutor, $idLibro);
                      # code...
                    } else {
                    //$insertAutor = $dbh->prepare("INSERT into `autores` (nombreAutor) values(?)");
                    //$insertAutor->bindParam(1, $autor);    
                    //$insertAutor->execute();
                    echo "<script>swal({title:'Error',text:'Error al ingresar el registro, ya existe el autor insertado',type:'error'});</script>";

                    }



                }

                function cargarCategoria($categoria){
                    include('db.php');
                    $buscarCategoria = $dbh->prepare("SELECT idCategoria FROM `categorias` WHERE nombreCategoria='$categoria' limit 1");
                    $buscarCategoria->execute();

                    $arr=$buscarCategoria->fetch(PDO::FETCH_ASSOC);
                    $idCategoria=$arr['idCategoria'];

                    if (!$idCategoria == '') {
                      $idLibro=buscarIdLibro();
                      llenarCategoriaLibro($idCategoria, $idLibro);
                      # code...
                    } else {
                    //$insertAutor = $dbh->prepare("INSERT into `autores` (nombreAutor) values(?)");
                    //$insertAutor->bindParam(1, $autor);    
                    //$insertAutor->execute();
                    echo "<script>swal({title:'Error',text:'Error al ingresar el registro, ya existe la categoria insertada',type:'error'});</script>";

                    }

                    //$insertCategoria = $dbh->prepare("INSERT into `categorias` (nombreCategoria) values(?)");
                    //$insertCategoria->bindParam(1, $categoria);    
                    //$insertCategoria->execute();

                }


                function cargarEditorial($editorial){
                    include('db.php');

                    $buscarEditorial = $dbh->prepare("SELECT idEditorial FROM `editoriales` WHERE nombreEditorial='$editorial' limit 1");
                    $buscarEditorial->execute();

                    $arr=$buscarEditorial->fetch(PDO::FETCH_ASSOC);
                    $idEditorial=$arr['idEditorial'];

                    if (!$idEditorial == '') {
                      $idLibro=buscarIdLibro();
                      llenarEditorialLibro($idEditorial, $idLibro);
                      # code...
                    } else {
                    //$insertAutor = $dbh->prepare("INSERT into `autores` (nombreAutor) values(?)");
                    //$insertAutor->bindParam(1, $autor);    
                    //$insertAutor->execute();
                    echo "<script>swal({title:'Error',text:'Error al ingresar el registro, ya existe la editorial insertada',type:'error'});</script>";

                    }                   
                    //$insertEditorial = $dbh->prepare("INSERT into `editoriales`(nombreEditorial) values(?)");
                    //$insertEditorial ->bindParam(1, $editorial);    
                    //$insertEditorial ->execute();

                }

               
           
           function llenarAutorLibro($idAutor, $idLibro){
               include('db.php');
           
                 //$idAutor = buscarIdAutor();
                 //$idLibro = buscarIdLibro();
               
               
                    $insertAutorLibro = $dbh->prepare("INSERT into `libro_autores` (idAutores,idLibro) values(?,?)");
                    $insertAutorLibro->bindParam(1, $idAutor);
                    $insertAutorLibro->bindParam(2, $idLibro);
           
                       $insertAutorLibro->execute();
           
                
           
           }
           
           
           function llenarCategoriaLibro($idCategoria, $idLibro){
               include('db.php');
           
               //$idCategoria = buscarIdCategoria();
               //$idLibro = buscarIdLibro();
               
               
                    $insertCategoriaLibro = $dbh->prepare("INSERT into `libro_categorias` (idCategoria,idLibro) values(?,?)");
                    $insertCategoriaLibro->bindParam(1, $idCategoria);
                    $insertCategoriaLibro->bindParam(2, $idLibro);
           
                         $insertCategoriaLibro->execute();
           
             
           }
           
           
           
           function llenarEditorialLibro($idEditorial, $idLibro){
               include('db.php');
           
               //$idEditorial = buscarIdEditorial();
               //$idLibro = buscarIdLibro();
               
               
                    $insertEditorialLibro = $dbh->prepare("INSERT into `libro_editoriales` (idEditorial,idLibro) values(?,?)");
                    $insertEditorialLibro->bindParam(1,  $idEditorial);
                    $insertEditorialLibro->bindParam(2, $idLibro);
           
                        
               $insertEditorialLibro->execute();
    
             
           }
           



                function cargarTapaImagenLibro($idLibro,$destinoTapa, $idCat){
                    include('db.php');
                         
                         $insertTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta,idCategoriaImg) values(?,?,?)");
                         $insertTapa->bindParam(1,$idLibro); 
                         $insertTapa->bindParam(2,$destinoTapa);    
                         $insertTapa->bindParam(3, $idCat);
                        
                              //$insertTapa->execute();

                if ($insertTapa->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Éxito',text:'Registro ingresado correctamente.',type:'success', showConfirmButton: false, html: '<h6>Registro ingresado correctamente</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

        //gestionLibros();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar el registro.',type:'error'});</script>";
        //gestionLibros();

    }

}

function cargarCTapaImagenLibro($idLibro,$destinoCtapa, $idCat, $destinoTapa){
  include('db.php');

      $insertCTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta_contratapa,idCategoriaImg, ruta) values(?,?,?,?)");
      $insertCTapa->bindParam(1,$idLibro); 
      $insertCTapa->bindParam(2,$destinoTapa);
      $insertCTapa->bindParam(3,$idCat);
      $insertCTapa->bindParam(4,$destinoCtapa);    
      
    
          //$insertCTapa->execute();

      if ($insertCTapa->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Éxito',text:'Registro ingresado correctamente.',type:'success', showConfirmButton: false, html: '<h6>Registro ingresado correctamente</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

        //gestionLibros();

    
      } else {
          echo "<script>swal({title:'Error',text:'Error al ingresar el registro.',type:'error'});</script>";
          //gestionLibros();
  
      }



          

  }

  function buscarIdLibro(){
      include('db.php');

      $buscarId = $dbh->prepare(' SELECT idLibro FROM libros ORDER BY idLibro DESC LIMIT 1');
      $buscarId->execute();
      $arr = $buscarId->fetch(PDO::FETCH_ASSOC);
      $idNuevo = $arr['idLibro'];
      
            return $idNuevo;

  }

  function buscarIdTapa(){
      include('db.php');

      $buscarImg = $dbh->prepare('SELECT idCategoriaImg FROM categoria_imagenes where idCategoriaImg = 1');
      $buscarImg->execute();
      $arr = $buscarImg->fetch(PDO::FETCH_ASSOC);
      $idTapa = $arr['idCategoriaImg'];
        
            return $idTapa;
  }
  
  function buscarIdcontraTapa(){
      include('db.php');

      $buscarImg =$dbh->prepare ('SELECT idCategoriaImg FROM categoria_imagenes where idCategoriaImg = 2');
      $buscarImg->execute();
      $arr = $buscarImg->fetch(PDO::FETCH_ASSOC);
      $idCtapa = $arr['idCategoriaImg'];

            return $idCtapa;
  }

  function buscarIdAutor(){
      include('db.php');

      $buscarIdAutor = $dbh->prepare('SELECT idAutores FROM autores ORDER BY idAutores DESC LIMIT 1;');
      $buscarIdAutor->execute();
      $arr = $buscarIdAutor->fetch(PDO::FETCH_ASSOC);
      $idAutorNuevo = $arr['idAutores'];
      
            return $idAutorNuevo;

  }

  function  buscarIdCategoria(){
      include('db.php');

      $buscarIdCategoria = $dbh->prepare('SELECT idCategoria FROM categorias ORDER BY idCategoria DESC LIMIT 1;');
      $buscarIdCategoria->execute();
      $arr = $buscarIdCategoria->fetch(PDO::FETCH_ASSOC);
      $idCategoriaNueva = $arr['idCategoria'];
      
              return $idCategoriaNueva;
  }

  function buscarIdEditorial(){
      include('db.php');

      $buscarIdEditorial = $dbh->prepare('SELECT idEditorial FROM editoriales ORDER BY  idEditorial DESC LIMIT 1;');
      $buscarIdEditorial ->execute();
      $arr = $buscarIdEditorial ->fetch(PDO::FETCH_ASSOC);
      $idEditorialNueva = $arr['idEditorial'];
      
            return $idEditorialNueva;
  }


function getAutores() {
      include('db.php');

      $stmt = $dbh->prepare('SELECT DISTINCT nombreAutor FROM autores  ORDER BY  nombreAutor ASC');
      $stmt ->execute();
      $arr = $stmt->fetchAll();
      foreach($arr as $fila):
          echo "<option>".$fila['nombreAutor']."</option>";
      endforeach;  
}



function getEditoriales() {
      include('db.php');

      $stmt = $dbh->prepare('SELECT DISTINCT nombreEditorial FROM editoriales  ORDER BY  nombreEditorial ASC');
      $stmt ->execute();
      $arr = $stmt->fetchAll();
      //$editoriales = $arr['nombreEditorial'];
      
            foreach($arr as $fila):

      echo "<option>".$fila['nombreEditorial']."</option>";
      endforeach;  
    
  }


function getCategorias() {
      include('db.php');

      $stmt = $dbh->prepare('SELECT DISTINCT nombreCategoria FROM categorias  ORDER BY  nombreCategoria ASC');
      $stmt ->execute();
      $arr = $stmt->fetchAll();
                              //$categorias = $arr['nombreCategoria'];
      
  foreach($arr as $fila):

  echo "<option>".$fila['nombreCategoria']."</option>";

    endforeach;                        
}

    function cargarEjemplar($stock, $fechaAlta){
                            include('db.php');
      $idEjemplarEstado="0";

      $idLibro = buscarIdLibro();

      $stockActual = getUltimoEjemplar($idLibro);

      if ($stockActual > 0) {
        $stockActual = $stockActual;
      } else {
        $stockActual = 0;
      }
      
      
      
      for ($i = $stockActual+1; $i <= $stockActual+$stock; $i++) {
      
      // for ($i = 1; $i <= $stock; $i++) {

        $idEjemplar="L".$idLibro."E".$i;
//echo"INSERT into `ejemplares` (idEjemplar, fechaIngreso, idLibro, idEjemplarEstado) 
                    //values($idEjemplar,$fechaAlta,$idLibro, '1')";
      $insertEjemplar = $dbh->prepare("INSERT into ejemplares (idEjemplar, idLibro, idEjemplarEstado, fechaIngreso) 
                    values(?,?,?,?)");

                    $insertEjemplar->bindParam(1, $idEjemplar);
                    $insertEjemplar->bindParam(2, $idLibro);
                    $insertEjemplar->bindParam(3, $idEjemplarEstado);
                    $insertEjemplar->bindParam(4, $fechaAlta);

                          $insertEjemplar->execute();

    }

    }







//     function eliminarEjemplar($stock){
//       include('db.php');
// $idEjemplarEstado="0";

// $idLibro = buscarIdLibro();

// $stockActual = getUltimoEjemplar($idLibro);

// if ($stockActual > 0) {
//   $stockEliminar = $stockActual-$stock;

//   $quitarStock = $dbh->prepare("delete from ejemplares where idLibro = $idLibro and idEjemplarEstado = 0 LIMIT $stockEliminar");
//   $quitarStock->execute();


// } 

// }


function getUltimoEjemplar($idLibro) {

  include('db.php');

  $buscarStock = $dbh->prepare("select substr(idEjemplar,instr(idEjemplar,'E') + 1) AS cantidad from ejemplares where idLibro= $idLibro order by idEjemplar DESC LIMIT 1");
  $buscarStock->execute();
  if($buscarStock->rowCount() !== 0){
  $arr = $buscarStock->fetch(PDO::FETCH_ASSOC);
  $cantidadEjemplar = $arr['cantidad'];
  
   return $cantidadEjemplar;
  }else{
    echo "";
  }
}





   

function gestionAutores(){

  // if (!isset ($_GET['page']) ) {  
  //           $page = 1;  
  //       } else {  
  //           $page = $_GET['page'];  
  //       }  
  //         $results_per_page = 5;  

  //       //determine the sql LIMIT starting number for the results on the displaying page  
  //       $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from autores";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
                          <tr>
                            <td>".  $fila['idAutores']."</td>
                            <td>". $fila['nombreAutor']."</td>

                            <td><a href='#modal-autor' id='abrir-modal-autor'><button onclick=\"javascript:cargarPropiedades('Autor','".$fila["idAutores"]."','".$fila["nombreAutor"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        ";

  endforeach;
}
  }

  function crearAutor($nombreAutor) {
 include('db.php');

    $cargarAutor = $dbh->prepare("INSERT into autores (nombreAutor) values ('$nombreAutor')");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    

                if ($cargarAutor->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Éxito',text:'Autor ingresado correctamente.',type:'success', showConfirmButton: false, html: '<h6>Autor ingresado correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

        //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar el autor',type:'error'});</script>";
        //gestionAutores();

    }

  }

  function editarAutor($idAutor, $nombreAutor) {
include('db.php');

    $editarAutor = $dbh->prepare("UPDATE autores set nombreAutor = '$nombreAutor' where idAutores = '$idAutor'");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    
//$vari= "UPDATE autores set nombreAutor = '$nombreAutor' where idAutor = '$idAutor'";
                if ($editarAutor->execute()) {

        //enviarPwd($nombre, $mail, $pass);
            echo "<script>swal({title:'Éxito',text:'Autor editado correctamente.',type:'success', showConfirmButton: false, html: '<h6>Autor editado correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

            //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar el autor. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }



  function gestionCategorias(){

  // if (!isset ($_GET['page']) ) {  
  //           $page = 1;  
  //       } else {  
  //           $page = $_GET['page'];  
  //       }  
  //         $results_per_page = 5;  

  //       //determine the sql LIMIT starting number for the results on the displaying page  
  //       $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from categorias";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
                          <tr>
                            <td>".  $fila['idCategoria']."</td>
                            <td>". $fila['nombreCategoria']."</td>

                            <td><a href='#modal-categoria' id='abrir-modal-categoria'><button onclick=\"javascript:cargarPropiedades('Categoria','".$fila["idCategoria"]."','".$fila["nombreCategoria"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>";

  endforeach;
}
  }

function crearCategoria($nombreCategoria) {
 include('db.php');

    $cargarCategoria  = $dbh->prepare("INSERT into categorias (nombreCategoria) values ('$nombreCategoria')");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    

                if ($cargarCategoria->execute()) {

        //enviarPwd($nombre, $mail, $pass);
         echo "<script>swal({title:'Éxito',text:'Categoria ingresada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Categoria ingresada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

         //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar la categoria',type:'error'});</script>";
        //gestionAutores();

    }

  }

  function editarCategoria($idCategoria, $nombreCategoria) {
include('db.php');

    $editarCategoria = $dbh->prepare("UPDATE categorias set nombreCategoria = '$nombreCategoria' where idCategoria = '$idCategoria'");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    
//$vari= "UPDATE categorias set nombreCategoria = '$nombreCategoria' where idCategoria = '$idCategoria'";
                
                if ($editarCategoria->execute()) {

        //enviarPwd($nombre, $mail, $pass);
            echo "<script>swal({title:'Éxito',text:'Categoria editada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Categoria editada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

            //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar la categoria. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }





function gestionEditoriales(){

  // if (!isset ($_GET['page']) ) {  
  //           $page = 1;  
  //       } else {  
  //           $page = $_GET['page'];  
  //       }  
  //         $results_per_page = 5;  

  //       //determine the sql LIMIT starting number for the results on the displaying page  
  //       $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from editoriales";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
                          <tr>
                            <td>".  $fila['idEditorial']."</td>
                            <td>". $fila['nombreEditorial']."</td>
                            <td><a href='#modal-editorial' id='abrir-modal-editorial'><button onclick=\"javascript:cargarPropiedades('Editorial','".$fila["idEditorial"]."','".$fila["nombreEditorial"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        ";

  endforeach;
}
  }


function crearEditorial($nombreEditorial) {
 include('db.php');

    $cargarEditorial  = $dbh->prepare("INSERT into editoriales (nombreEditorial) values ('$nombreEditorial')");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    

                if ($cargarEditorial->execute()) {

        //enviarPwd($nombre, $mail, $pass);

            echo "<script>swal({title:'Éxito',text:'Editorial ingresada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Editorial ingresada correctamente.e</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

            //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar la editorial',type:'error'});</script>";
        //gestionAutores();

    }

  }

  function editarEditorial($idEditorial, $nombreEditorial) {
include('db.php');

    $editarEditorial = $dbh->prepare("UPDATE editoriales set nombreEditorial = '$nombreEditorial' where idEditorial = '$idEditorial'");
    //$cargarAutor->execute();
    //$arr = $cargarAutor->fetch(PDO::FETCH_ASSOC);
    //$idAutorNuevo = $arr['idAutores'];
    
//$vari= "UPDATE editoriales set nombreEditorial = '$nombreEditorial' where idEditorial = '$idEditorial'";
                
                if ($editarEditorial->execute()) {

        //enviarPwd($nombre, $mail, $pass);
         echo "<script>swal({title:'Éxito',text:'Editorial editada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Editorial editada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-libros.php\"><button type=\"submit\" class=\"confirmarEdicionLibro\">OK</button></a>'});</script>";

         //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar la editorial. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }

function buscarIdEjemplar($idLibro){
  include('db.php');

  $buscarIdEjemplar = $dbh->prepare("select * from ejemplares where idLibro = '" . $idLibro . "' and idEjemplar like '%L".$idLibro."E%' and idEjemplarEstado = '0' LIMIT 1");
  $buscarIdEjemplar->execute();
  $arr = $buscarIdEjemplar->fetch(PDO::FETCH_ASSOC);
  $idEjemplar = $arr['idEjemplar'];
  
  return $idEjemplar;

}

function reservarEjemplar($idLibro, $estado){
  include('db.php');
  $idEjemplar=buscarIdEjemplar($idLibro);

  if (!$idEjemplar == null) {

    $buscarIdEjemplar = $dbh->prepare("UPDATE ejemplares SET idEjemplarEstado = '" . $estado . "' where idEjemplar '" . $idEjemplar . "'");
    $buscarIdEjemplar->execute();
    // $arr = $buscarIdEjemplar->fetch(PDO::FETCH_ASSOC);
    // $idEjemplar = $arr['idEjemplar'];
    // echo "<script>swal({title:'Cheto',text:'Error al reservar un ejemplar.',type:'error'});</script>";

  } else {
    echo "<script>swal({title:'Error',text:'Error al reservar un ejemplar.',type:'error'});</script>";
  }


  
        return $idEjemplar;

}

function editarStockEjemplar($idLibro, $stock){
  include('db.php');
  $stockActual=getCantidadEjemplares($idLibro);
  $fechaAlta = date('Y-m-d');

  // if ($stockActual >  $stock) {
    
  //   eliminarEjemplar($stock);
  // }
  
  if ($stockActual <  $stock) {
    agregarEjemplar($idLibro, $stock, $fechaAlta);
  }
  
}

function getCantidadEjemplares($idLibro){
  include('db.php');

  $buscarStock = $dbh->prepare("select count(*) AS cantidad from ejemplares where idLibro = '". $idLibro . "'");
  $buscarStock->execute();
  $arr = $buscarStock->fetch(PDO::FETCH_ASSOC);
  $cantidadEjemplar = $arr['cantidad'];
  
   return $cantidadEjemplar;

}

function getStockActual($idLibro){
  include('db.php');

  $buscarStock = $dbh->prepare("select stock from libros where idLibro = '" .$idLibro ."'");
  $buscarStock->execute();

  $arr = $buscarStock->fetch(PDO::FETCH_ASSOC);
  $cantidadStock = $arr['stock'];
  
   return $cantidadStock;

}


function agregarEjemplar($idLibro, $stock, $fechaAlta){
  include('db.php');
  $idEjemplarEstado="0";

  // $idLibro = buscarIdLibro();

  $stockActual = getUltimoEjemplar($idLibro);

  if ($stockActual > 0) {
    $stockActual = $stockActual;
  } else {
    $stockActual = 0;
  }



  for ($i = $stockActual+1; $i <= $stock; $i++) {

    // for ($i = 1; $i <= $stock; $i++) {

    $idEjemplar="L".$idLibro."E".$i;
    //echo"INSERT into `ejemplares` (idEjemplar, fechaIngreso, idLibro, idEjemplarEstado) 
    //values($idEjemplar,$fechaAlta,$idLibro, '1')";
    $insertEjemplar = $dbh->prepare("INSERT into ejemplares (idEjemplar, idLibro, idEjemplarEstado, fechaIngreso) 
    values(?,?,?,?)");

    $insertEjemplar->bindParam(1, $idEjemplar);
    $insertEjemplar->bindParam(2, $idLibro);
    $insertEjemplar->bindParam(3, $idEjemplarEstado);
    $insertEjemplar->bindParam(4, $fechaAlta);

    $insertEjemplar->execute();

  }


}

if(isset($_POST['idLibro'])){
  $idLibro = $_POST['idLibro'];
    $_SESSION['idLibro'] = $idLibro;

  mostrarEjemplares($idLibro);
} else {
    $_SESSION['sindatos'] = "sindatos";
}


function mostrarEjemplares($idLibro){
    include 'db.php';

    $query = "SELECT idEjemplar, idEjemplarEstado from ejemplares where idLibro = '" . $idLibro ."'";
    $stmt = $dbh->prepare($query);

    if ($stmt->execute()) {
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (!isset($_SESSION['sindatos'])) {

      echo json_encode($resultado);
      }

      /* foreach($resultado as $fila):
        //echo "<form action='' method = 'POST' class= 'form-libro' enctype='multipart/form-data'
        echo "
        <tbody>
            <tr>
              <td>" . $fila['idEjemplar']. "</td>
              <td>".  $fila['idEjemplarEstado']."</td>
              <td>".  $fila['idEjemplar'] ."</td>
            </tr>
        </tbody>
        ";

      endforeach; */
    }
}

if(isset($_POST['idEjemplar']) && isset($_POST['estado'])){
  $idEjemplar = $_POST['idEjemplar'];
  $estado = $_POST['estado'];

    if ($estado=="Desactivar" ) {
        return eliminarEjemplar($idEjemplar);
    }

    if ($estado=="Activar" ) {
        return activarEjemplar($idEjemplar);
    }
}


function eliminarEjemplar($idEjemplar){
  include 'db.php';

  $idLibro=obtenerIDLibro($idEjemplar);
  $stock=obtenerStockLibro($idLibro);

  $query = "UPDATE ejemplares
            SET idEjemplarEstado = 2
            WHERE idEjemplar = '$idEjemplar'";

  $stmt = $dbh->prepare($query);
  
  if ($stmt->execute()) {
    if ($stock > 0) {
    
    $stmt = $dbh->prepare("UPDATE libros SET stock=stock-1 where idLibro ='".$idLibro."'");
      $stmt->execute();
      }
    echo "success";
  }else{
    echo "error";
  }
}


function activarEjemplar($idEjemplar){
  include 'db.php';

  $idLibro=obtenerIDLibro($idEjemplar);

  $query = "UPDATE ejemplares
            SET idEjemplarEstado = 0
            WHERE idEjemplar = '$idEjemplar'";

  $stmt = $dbh->prepare($query);
  
  if ($stmt->execute()) {

    $stmt = $dbh->prepare("UPDATE libros SET stock=stock+1 where idLibro ='".$idLibro."'");
      $stmt->execute();
    echo "success";
  }else{
    echo "error";
  }
}

function obtenerIDLibro($idEjemplar){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT idLibro FROM ejemplares where idEjemplar='" . $idEjemplar . "'");


  if ($stmt->execute()) {
    //$idReserva=$stmt->fetchColumn();
      $arr=$stmt->fetch(PDO::FETCH_ASSOC);
      $idLibro=$arr['idLibro'];
      return $idLibro;
      }

}

function obtenerStockLibro($idLibro){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT stock FROM libros where idLibro='" .$idLibro ."'");


  if ($stmt->execute()) {
    //$idReserva=$stmt->fetchColumn();
      $arr=$stmt->fetch(PDO::FETCH_ASSOC);
      $stock=$arr['stock'];
      return $stock;
      }
}

?>
