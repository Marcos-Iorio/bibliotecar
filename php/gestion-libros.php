<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
  <title></title>
</head>


<?php

  function gestionLibros(){

  if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query = "SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores ORDER BY l.idLibro DESC LIMIT $page_first_result , $results_per_page";
  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
    //echo "<form action='' method = 'POST' class= 'form-libro' enctype='multipart/form-data'

    echo "
    <tbody>
                          <tr>
                            <td>" . $fila['idLibro']. "</td>
                            <td>".  $fila['titulo']."</td>
                            <td>". $fila['nombreAutor']."</td>
                            <td>". $fila['nombreCategoria']."</td>
                            <td>". $fila['stock']. "</td>
                            <td>" . $fila['fechaAlta']. "</td>
                            <td><a href='#modal-libros' id='abrir-modal-libros'><button onclick=\"javascript:cargarLibros('".$fila["titulo"]."','".$fila["nombreAutor"]."','".$fila["nombreCategoria"]."','".$fila["stock"]."','".$fila["descripcion"]."','".$fila["nombreEditorial"]."','".$fila["idLibro"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        </tbody>


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



        if(!$_FILES['pdf']['name'] == ""){
                  $pdf = $_FILES['pdf']['tmp_name'];
        $destinoPdf ="assets/libros/pdf/".$_FILES['pdf']['name'];
        //move_uploaded_file($pdf,$destinoPdf);

        } else {
        $destinoPdf ="";

        }


           



                    $updateLibro = $dbh->prepare("UPDATE libros set titulo = ?, descripcion= ?, stock= ?, pdf= ? where idLibro = ?");

                    $updateLibro->bindParam(1, $titulo);
                    $updateLibro->bindParam(2, $descripcion);
                    $updateLibro->bindParam(3, $stock);
                    $updateLibro->bindParam(4, $destinoPdf);
                    $updateLibro->bindParam(5, $idLibro);

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
                  //Insertar contratapa si no hay registro existente
                  //Editar ejemplares, eliminar/agregar registros segun stock libro 
                  // ver js cuando hay un quote '' en el medio 

   

                    if ($flagLibro="ok" || $flagEditorial="ok" || $flagAutor="ok" || $flagCategoria="ok" ) {
        echo "<script>swal({title:'Exito',text:'Registro editado correctamente.',type:'success'});</script>";
                     # code...
                    } else {
        //echo "<script>swal({title:'Error',text:'El registro no pudo ser editado. flagLibro= $flagLibro, flagEditorial= $flagEditorial, flagAutor= $flagAutor, flagCategoria= $flagCategoria, $varLibro ',type:'error'});</script>";
            echo "<script>swal({title:'Error',text:'El registro no pudo ser editado.',type:'error'});</script>";
                    }
}


function llenarImagen($Tapa,$contratapa){
    include('db.php');
       
  

           $tmpTapa = $_FILES['tapa']['tmp_name'];
           $destinoTapa ="assets/libros/".$_FILES['tapa']['name'];
           move_uploaded_file($tmpTapa,$destinoTapa);

            $tmpContratapa = $_FILES['contratapa']['tmp_name'];
            $destinoCtapa ="assets/libros/".$_FILES['contratapa']['name'];
             move_uploaded_file($tmpContratapa,$destinoCtapa);
              
             $idTapa = buscarIdTapa();
             $idCtapa = buscarIdcontraTapa();
             $idLibro = buscarIdLibro();
            
            //echo "<script>swal({title:'Error',text:'la tapa es $tmpTapa... y la contratapa $destinoTapa',type:'error'});</script>";


            
             if ($destinoCtapa=='assets/libros/') {
                  cargarTapaImagenLibro($idLibro,$destinoTapa,$idTapa);

             } else {
                cargarCTapaImagenLibro($idLibro,$destinoCtapa,$idCtapa);
                cargarTapaImagenLibro($idLibro,$destinoTapa,$idTapa);

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
           



                function cargarTapaImagenLibro($idLibro,$destinoTapa,$idCat){
                    include('db.php');
                         
                         $insertTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta,idCategoriaImg) values(?,?,?)");
                         $insertTapa->bindParam(1,$idLibro); 
                         $insertTapa->bindParam(2,$destinoTapa);    
                         $insertTapa->bindParam(3,$idCat);
                        
                              //$insertTapa->execute();

                if ($insertTapa->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Registro ingresado correctamente.',type:'success'});</script>";
        gestionLibros();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar el registro',type:'error'});</script>";
        gestionLibros();

    }

                    }

                    function cargarCTapaImagenLibro($idLibro,$destinoCtapa,$idCat){
                        include('db.php');
                
                            $insertCTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta,idCategoriaImg) values(?,?,?)");
                            $insertCTapa->bindParam(1,$idLibro); 
                            $insertCTapa->bindParam(2,$destinoCtapa);    
                            $insertCTapa->bindParam(3,$idCat);
                           
                         
                                //$insertCTapa->execute();

                                            $insertCTapa->execute();


                                
                
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
                                echo "<option value=".$fila['nombreAutor'].">".$fila['nombreAutor']."</option>";
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
      
      for ($i = 1; $i <= $stock; $i++) {

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









                      function getPages2(){
      include 'db.php';

        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
        //define total number of results you want per page 
        $results_per_page = 5;  
        $page_first_result = ($page-1) * $results_per_page; 

$query='SELECT distinct l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta, i.ruta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN imagen_libros i ON l.idLibro = i.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores ORDER BY l.stock DESC';
          $stmt = $dbh->prepare($query);

    //echo $sql;

    if ($stmt->execute()) {
        $number_of_result = $stmt->rowCount();  

    }
        //$page_filtro = 0;
        //$page_total = 0;
        
        //$_GET[$page_filtro] = $page_filtro; 
        //$_GET[$page_total] = $page_total; 

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page);  

          //$page_total = $number_of_page;

          return $number_of_page;
    }





    function getPages($buscar, $criterio){
      include 'db.php';

        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
        //define total number of results you want per page 
        $results_per_page = 5;  
        $page_first_result = ($page-1) * $results_per_page; 

        if (!$buscar == 0 && !$criterio == 0) {
          $stmt = $dbh->prepare("SELECT * from libros where $criterio like '%$buscar%'");

        } else {

          $stmt = $dbh->prepare("SELECT * from libros");

        }
    //echo $sql;

    if ($stmt->execute()) {
        $number_of_result = $stmt->rowCount();  

    }
        $page_filtro = 0;
        $page_total = 0;
        
        //$_GET[$page_filtro] = $page_filtro; 
        //$_GET[$page_total] = $page_total; 

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page);  
        if (!$buscar == 0 && !$criterio == 0) {

          $page_filtro = $number_of_page;
        } else {

          $page_total = $number_of_page;
        }

          return $number_of_page;
    }



    function getFiltro($buscar, $criterio){

   include 'db.php';

if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


    //echo $sql;
    $stmt = $dbh->prepare("SELECT * from libros where $criterio like '%$buscar%' LIMIT " . $page_first_result . ',' . $results_per_page);

    if ($stmt->execute()) {
      $resultado=$stmt->fetchAll();

     foreach($resultado as $fila):

    if ($fila['idEstado'] == '2')  {
      $icono='fas fa-ban';
      $titulo = 'Dada de baja';
    } else {
      $icono='far fa-check-circle';
        $titulo = 'Activa';
    
     /*if ($fila['check_mail'] == '0')  {
      $icono='fas fa-exclamation';
      $titulo='Mail';
    } */
    }

    
    //echo "<form action='' method = 'POST'>



    echo "<form action='' method = 'POST' class= 'form-libro'>
    <tbody>
                          <tr>
                            <td>".  $fila['titulo']."</td>
                            <td>". $fila['nombreAutor']."</td>
                            <td>". $fila['nombreCategoria']."</td>
                            <td>". $fila['stock']. "</td>
                            <td>" . $fila['fechaAlta']. "</td>
                            <td><button><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></td>
                          </tr>
                        </tbody>";
    endforeach;
 
    }

}


function gestionAutores(){

  if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from autores LIMIT $page_first_result , $results_per_page";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
    <tbody>
                          <tr>
                            <td>".  $fila['idAutores']."</td>
                            <td>". $fila['nombreAutor']."</td>

                            <td><a href='#modal-autor' id='abrir-modal-autor'><button onclick=\"javascript:cargarPropiedades('Autor','".$fila["idAutores"]."','".$fila["nombreAutor"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        </tbody>";

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
        echo "<script>swal({title:'Exito',text:'Autor ingresado correctamente.',type:'success'});</script>";
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
        echo "<script>swal({title:'Exito',text:'Autor editado correctamente.',type:'success'});</script>";
        //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar el autor. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }



  function gestionCategorias(){

  if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from categorias LIMIT $page_first_result , $results_per_page";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
    <tbody>
                          <tr>
                            <td>".  $fila['idCategoria']."</td>
                            <td>". $fila['nombreCategoria']."</td>

                            <td><a href='#modal-categoria' id='abrir-modal-categoria'><button onclick=\"javascript:cargarPropiedades('Categoria','".$fila["idCategoria"]."','".$fila["nombreCategoria"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        </tbody>";

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
        echo "<script>swal({title:'Exito',text:'Categoria ingresada correctamente.',type:'success'});</script>";
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
        echo "<script>swal({title:'Exito',text:'Categoria editada correctamente.',type:'success'});</script>";
        //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar la categoria. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }





function gestionEditoriales(){

  if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";

  include 'db.php';


  $query="SELECT * from editoriales LIMIT $page_first_result , $results_per_page";

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "
    <tbody>
                          <tr>
                            <td>".  $fila['idEditorial']."</td>
                            <td>". $fila['nombreEditorial']."</td>
                            <td><a href='#modal-editorial' id='abrir-modal-editorial'><button onclick=\"javascript:cargarPropiedades('Editorial','".$fila["idEditorial"]."','".$fila["nombreEditorial"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                          </tr>
                        </tbody>";

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
        echo "<script>swal({title:'Exito',text:'Editorial ingresada correctamente.',type:'success'});</script>";
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
        echo "<script>swal({title:'Exito',text:'Editorial editada correctamente.',type:'success'});</script>";
        //gestionAutores();


    } else {
        echo "<script>swal({title:'Error',text:'Error al editar la editorial. $vari',type:'error'});</script>";
        //gestionAutores();

    }

  }


?>

<body>

</body>
</html>