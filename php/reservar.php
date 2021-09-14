<?php
   include 'db.php';
   include "isLogin.php";
    
   
   /* Busca los datos del usuario por el mail */
    $stmt = $dbh->prepare("SELECT * from usuarios where mail = '". $mail . "'");

    $stmt->execute();
      
    // recorremos las filas en busca del mail
    global $user;
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   $GLOBALS['idUsuario'] = $user['idUsuario'];

   global $skuLibro;
   $skuLibro = $_GET['sku'];

    $stmt = $dbh->prepare("SELECT * FROM libros l, autores a, categorias c where idLibro = '". $skuLibro  ."'");
    $stmt->execute();

    global $libros;
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $GLOBALS['stock'] = $libros['stock'];

      insertarReserva();
      actualizarStock();

      function insertarReserva(){
         $skuLibro = $_GET['sku'];
         $idUsuario = $GLOBALS['idUsuario'];
         echo $idUsuario;
         echo $skuLibro;

         include 'db.php';
         $fechaDesde = date('Y/m/d H:i:s');
         $fechaHasta = date('Y-m-d', strtotime($fechaDesde. ' + 2 weeks'));

         $reservaEstado = 1;
         $stmt = $dbh->prepare("INSERT INTO reservas (idEjemplar, idReservaEstado, idUsuario, fechaDesde, fechaHasta) VALUES (?, ?, ?, ?, ?)");
         $stmt->bindParam(1, $skuLibro);
         $stmt->bindParam(2, $reservaEstado);
         $stmt->bindParam(3, $idUsuario);
         $stmt->bindParam(4, $fechaDesde);
         $stmt->bindParam(5, $fechaHasta);
         
         if($stmt->execute()){
            echo "Se ha reservardo exitosamente!";
         }
         header('Location: ../single-book.php?sku='.$skuLibro);
      }

      function actualizarStock(){
         include 'db.php';

         $stock = $GLOBALS['stock'];

         $stmt = $dbh->prepare("UPDATE");
         
      }
  
  ?>
