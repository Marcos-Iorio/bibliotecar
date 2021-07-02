<?php

 $dbname = "S83WlvOPYk";
 $user = "S83WlvOPYk";
 $password = 'PZYFMdycMI';

 try {
    $dsn = "mysql:host=remotemysql.com:3306;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo "No se pudo conectar";
}

?>z