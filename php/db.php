<?php

/*a  $dbname = "S83WlvOPYk";
 $user = "S83WlvOPYk";
 $password = 'PZYFMdycMI'; */

$dbname = "bibliotecar";
 $user = "root";
 $password = '';
 try {
    /* $dsn = "mysql:host=remotemysql.com:3306;dbname=$dbname"; */
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo "No se pudo conectar";
}

?>