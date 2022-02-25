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
                where idReservaEstado IN (0,4) AND fechaDesde >= (DATE_SUB(NOW(), INTERVAL '120' DAY))
                group BY mes order by DATE_FORMAT(fechaDesde, '%Y%m') ASC"; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);    
}
?>