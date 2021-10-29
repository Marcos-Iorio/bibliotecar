
<?php

function mainReservar($mail, $skuLibro){
   include 'db.php';
   //include "isLogin.php";
    
   
   /* Busca los datos del usuario por el mail */
    $stmt = $dbh->prepare("SELECT * from usuarios where mail = '". $mail . "'");

    $stmt->execute();
      
    // recorremos las filas en busca del mail
    global $user;
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   $GLOBALS['idUsuario'] = $user['idUsuario'];

   global $nombre;
   $nombre = $user['nombre'];

   global $correo;
   $correo = $mail;

   global $skuLibro;
   $skuLibro = $_GET['sku'];

    $stmt = $dbh->prepare("SELECT * FROM libros l, autores a, categorias c where idLibro = '". $skuLibro  ."' LIMIT 1");
    $stmt->execute();

    global $libros;
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
      insertarReserva($nombre, $correo);


}
      function insertarReserva($nombre, $correo){
         $skuLibro = $_GET['sku'];
         $idUsuario = $GLOBALS['idUsuario'];
         //echo $idUsuario;
         //echo $skuLibro;
          $idEjemplar=reservaEjemplar($skuLibro);

         include 'db.php';
         $fechaDesde = date('Y/m/d H:i:s');
         $fechaHasta = date('Y-m-d', strtotime($fechaDesde. ' + 2 weeks'));

          $codigo=mt_rand(1,999999);
          while(strlen($codigo) < 6 && strlen($codigo)){
              $codigo=mt_rand(1,999999);
          }
          
          $codigo="R$codigo$skuLibro";

         $reservaEstado = 1;
         $stmt = $dbh->prepare("INSERT INTO reservas (idReserva, idEjemplar, idReservaEstado, idUsuario, fechaDesde, fechaHasta) VALUES (? ,?, ?, ?, ?, ?)");
         $stmt->bindParam(1, $codigo);
         $stmt->bindParam(2, $idEjemplar);
         $stmt->bindParam(3, $reservaEstado);
         $stmt->bindParam(4, $idUsuario);
         $stmt->bindParam(5, $fechaDesde);
         $stmt->bindParam(6, $fechaHasta);
         if($stmt->execute()){

                   //header('Location: ../single-book.php?sku='.$skuLibro);
          confirmarReserva($skuLibro, $nombre, $correo, $codigo);
         }
      }
  
function confirmarReserva($idLibro, $nombre, $correo, $codigo){
         include 'db.php';

        $stmt = $dbh->prepare("SELECT stock FROM libros where idLibro ='".$idLibro."'");

        if($stmt->execute()){
          $arr = $stmt->fetch(PDO::FETCH_ASSOC);
          $stock = $arr['stock'];
          $stock = $stock-1;

          $stmt = $dbh->prepare("UPDATE libros SET stock='".$stock."' where idLibro ='".$idLibro."'");
          /*if ($stmt->execute()) {
            include "sendmail.php";
            enviarReserva($nombre, $correo, $codigo);*/
              echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success'});</script> ";
              //header("Location: single-book.php?sku='" . $idLibro . "'");

            //echo "<script>swal({title:'Exito',text:'Su reserva se ha realizado. Por favor verifica tu correo para mas informacion.',type:'success', html:'<a href=\"libros.php\">Regresar</a>'});</script> ";
                        

                     /* return $codigo;
        header('Location: ../single-book.php?sku='.$idLibro);*/          
          //}
          
        }


  }

function reservaEjemplar($idLibro){

           include 'db.php';

        $stmt = $dbh->prepare("SELECT idEjemplar FROM ejemplares where idEjemplarEstado ='0' and idEjemplar like '%L".$idLibro."E%' LIMIT 1");
        if ($stmt->execute()) {
  $resultado=$stmt->fetchColumn();

  return $resultado;

}
}


  ?>

