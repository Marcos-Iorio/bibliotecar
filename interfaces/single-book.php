<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include('../php/db.php');
    $idLibro = $_GET['sku'];

    $stmt = $dbh->prepare('SELECT * FROM libros where idLibro =  "'. $idLibro .'"');

    $stmt->execute();
    $arr = $stmt->fetch(PDO::FETCH_ASSOC);
    
    print_r($arr);
}


?>