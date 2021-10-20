<?php



function llenarTabla($titulo,$autor, $descripcion,$categoria,$editorial, $stock,$fechaAlta,$pdf){
    include('db.php');

        
        if($pdf != ""){
        $pdf = $_FILES['pdf']['tmp_name'];
        $destinoPdf ="../assets/libros_pdf".$_FILES['pdf']['name'];
        move_uploaded_file($pdf,$destinoPdf);
          
        }


    cargarLibro($titulo,$descripcion,$stock,$fechaAlta,$destinoPdf);
    cargarAutor($autor);
    cargarCategoria($categoria);
    cargarEditorial($editorial);
    llenarAutorLibro();
    llenarCategoriaLibro();
    llenarEditorialLibro();
   

   
}

function llenarImagen($Tapa,$contratapa){
    include('db.php');
       
  

           $Tapa = $_FILES['tapa']['tmp_name'];
           $destinoTapa ="../assets/libros_pdf".$_FILES['tapa']['name'];
           move_uploaded_file($Tapa,$destinoTapa);

            $contratapa = $_FILES['contratapa']['tmp_name'];
            $destinoCtapa ="../assets/libros_pdf".$_FILES['contratapa']['name'];
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
           
                        $insertEditorialLibro->execute();
           
             
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


                   


    

?>