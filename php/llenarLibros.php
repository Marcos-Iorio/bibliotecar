<?php
  include_once 'db.php';

  $stmt = $dbh->prepare('SELECT * FROM libros, categorias, autores');
  $stmt->execute();
  $resultado=$stmt->fetchAll();


?>