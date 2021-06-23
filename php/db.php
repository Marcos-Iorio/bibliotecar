<?php

 $dbname = "bibliotecar";
 $user = "root";
 $password = '';

 try {
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo "No se pudo conectar";
}

?>