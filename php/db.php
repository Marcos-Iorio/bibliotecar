<?php

require('../vendor/autoload.php');

$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

$dbname = "bibliotecar";
 $user = "root";
 $password = '';
 try {
    /* $dsn = "mysql:host=remotemysql.com:3306;dbname=$DB_NAME";
    $dbh = new PDO($dsn, $DB_USER, $DB_PASS); */
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo "No se pudo conectar";
}

?>
