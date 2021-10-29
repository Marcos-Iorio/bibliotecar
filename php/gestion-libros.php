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

  include_once 'db.php';


  $query='SELECT l.idLibro, l.titulo,l.descripcion,l.pdf,l.stock, c.nombreCategoria, a.nombreAutor, e.nombreEditorial,l.fechaAlta
            FROM libros AS l
            INNER JOIN libro_autores la ON l.idLibro = la.idLibro
            INNER JOIN libro_categorias lc ON l.idLibro = lc.idLibro
            INNER JOIN libro_editoriales le ON l.idLibro = le.idLibro
            INNER JOIN categorias c ON lc.idCategoria = c.idCategoria
            INNER JOIN editoriales e ON le.idEditorial = e.idEditorial
            INNER JOIN autores a ON la.idAutores = a.idAutores';

  $stmt = $dbh->prepare($query);
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):

    echo "<form action='' method = 'POST' class= 'form-libro'
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

function llenarTabla($titulo,$autor, $descripcion,$categoria,$editorial, $stock,$fechaAlta,$pdf){
    include('db.php');

        
        if($pdf != ""){
        $pdf = $_FILES['pdf']['tmp_name'];
        $destinoPdf ="assets/libros/pdf".$_FILES['pdf']['name'];
        move_uploaded_file($pdf,$destinoPdf);
          
        }


    cargarLibro($titulo,$descripcion,$stock,$fechaAlta,$destinoPdf);
    cargarAutor($autor);
    cargarCategoria($categoria);
    cargarEditorial($editorial);
    cargarEjemplar($stock, $fechaAlta);
    llenarAutorLibro();
    llenarCategoriaLibro();
    llenarEditorialLibro();

   

   
}

function llenarImagen($Tapa,$contratapa){
    include('db.php');
       
  

           $Tapa = $_FILES['tapa']['tmp_name'];
           $destinoTapa ="assets/libros".$_FILES['tapa']['name'];
           move_uploaded_file($Tapa,$destinoTapa);

            $contratapa = $_FILES['contratapa']['tmp_name'];
            $destinoCtapa ="assets/libros".$_FILES['contratapa']['name'];
             move_uploaded_file($contratapa,$destinoCtapa);
              
             $idTapa = buscarIdTapa();
             $idCtapa = buscarIdcontraTapa();
             $idLibro = buscarIdLibro();
            
             

             cargarTapaImagenLibro($idLibro,$destinoTapa,$idTapa);
             cargarCTapaImagenLibro($idLibro,$destinoCtapa,$idCtapa);


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

                    $insertAutor = $dbh->prepare("INSERT into `autores` (nombreAutor) values(?)");
                    $insertAutor->bindParam(1, $autor);    
                          $insertAutor->execute();

                }

                function cargarCategoria($categoria){
                    include('db.php');
                    $insertCategoria = $dbh->prepare("INSERT into `categorias` (nombreCategoria) values(?)");
                    $insertCategoria->bindParam(1, $categoria);    
                           $insertCategoria->execute();

                }


                function cargarEditorial($editorial){
                    include('db.php');
                    
                     $insertEditorial = $dbh->prepare("INSERT into `editoriales`(nombreEditorial) values(?)");
                    $insertEditorial ->bindParam(1, $editorial);    
                          $insertEditorial ->execute();

                }

               
           
           function llenarAutorLibro(){
               include('db.php');
           
                 $idAutor = buscarIdAutor();
                 $idLibro = buscarIdLibro();
               
               
                    $insertAutorLibro = $dbh->prepare("INSERT into `libro_autores` (idAutores,idLibro) values(?,?)");
                    $insertAutorLibro->bindParam(1, $idAutor);
                    $insertAutorLibro->bindParam(2, $idLibro);
           
                       $insertAutorLibro->execute();
           
                
           
           }
           
           
           function llenarCategoriaLibro(){
               include('db.php');
           
               $idCategoria = buscarIdCategoria();
               $idLibro = buscarIdLibro();
               
               
                    $insertCategoriaLibro = $dbh->prepare("INSERT into `libro_categorias` (idCategoria,idLibro) values(?,?)");
                    $insertCategoriaLibro->bindParam(1, $idCategoria);
                    $insertCategoriaLibro->bindParam(2, $idLibro);
           
                         $insertCategoriaLibro->execute();
           
             
           }
           
           
           
           function llenarEditorialLibro(){
               include('db.php');
           
               $idEditorial = buscarIdEditorial();
               $idLibro = buscarIdLibro();
               
               
                    $insertEditorialLibro = $dbh->prepare("INSERT into `libro_editoriales` (idEditorial,idLibro) values(?,?)");
                    $insertEditorialLibro->bindParam(1,  $idEditorial);
                    $insertEditorialLibro->bindParam(2, $idLibro);
           
                        
               if ($insertEditorialLibro->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Registro ingresado correctamente.',type:'success'});</script>";
        gestionLibros();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar el registro',type:'error'});</script>";
        gestionLibros();

    }
    
             
           }
           



                function cargarTapaImagenLibro($idLibro,$destinoTapa,$idCat){
                    include('db.php');
                         
                         $insertTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta,idCategoriaImg) values(?,?,?)");
                         $insertTapa->bindParam(1,$idLibro); 
                         $insertTapa->bindParam(2,$destinoTapa);    
                         $insertTapa->bindParam(3,$idCat);
                        
                              $insertTapa->execute();


                    }

                    function cargarCTapaImagenLibro($idLibro,$destinoCtapa,$idCat){
                        include('db.php');
                
                            $insertCTapa = $dbh->prepare("INSERT into `imagen_libros` (idLibro,ruta,idCategoriaImg) values(?,?,?)");
                            $insertCTapa->bindParam(1,$idLibro); 
                            $insertCTapa->bindParam(2,$destinoCtapa);    
                            $insertCTapa->bindParam(3,$idCat);
                           
                         
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

                            $stmt = $dbh->prepare('SELECT nombreAutor FROM autores');
                            $stmt ->execute();
                            $arr = $stmt->fetchAll();
                             foreach($arr as $fila):

echo "<option>".$fila['nombreAutor']."</option>";
                          endforeach;  
                      }



                      function getEditoriales() {
                            include('db.php');

                            $stmt = $dbh->prepare('SELECT nombreEditorial FROM editoriales');
                            $stmt ->execute();
                            $arr = $stmt->fetchAll();
                            //$editoriales = $arr['nombreEditorial'];
                            
                                  foreach($arr as $fila):

echo "<option>".$fila['nombreEditorial']."</option>";
                          endforeach;  
                        
                      }


                      function getCategorias() {
                            include('db.php');

                            $stmt = $dbh->prepare('SELECT nombreCategoria FROM categorias');
                            $stmt ->execute();
                            $arr = $stmt->fetchAll();
                                                    //$categorias = $arr['nombreCategoria'];
                            
                        foreach($arr as $fila):

                      echo "<option>".$fila['nombreCategoria']."</option>";

                          endforeach;                        
                      }

    function cargarEjemplar($stock, $fechaAlta){
                            include('db.php');
      $idEjemplarEstado="1";

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


          $stmt = $dbh->prepare("SELECT * from libros");

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



    echo "<form action='' method = 'POST' class= 'form-libro'
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
?>

<body>

</body>
</html>