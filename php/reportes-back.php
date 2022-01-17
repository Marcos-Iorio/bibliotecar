<?php
finYCan();

function finYCan(){
    /* Obtiene los libros más reservados de todos los tiempos */

    include("db.php");

    $queryLang = "SET lc_time_names = 'es_AR'";
    $stmt = $dbh->prepare($queryLang);
    $stmt->execute();

    $query2 = " SELECT MONTHNAME(fechaDesde) AS mes,
                sum(case when idReservaEstado = 0 then 1 else 0 end) as finalizado,
                sum(case when idReservaEstado= 4 then 1 else 0 end) as cancelado from reservas
                where idReservaEstado = 0 OR idReservaEstado=4 AND fechaDesde >= (DATE_SUB(NOW(), INTERVAL '90' DAY))
                group BY mes"; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);    
}
?>