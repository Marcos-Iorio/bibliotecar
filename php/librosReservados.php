<?php
librosReservas();


function librosReservas(){
    /* Obtiene los libros más reservados de los ultimos 30 días de mayor a menor */

    include("db.php");

    /* $query = "CREATE VIEW vw_libro_res as
    SELECT l.titulo,e.idEjemplar, r.idReserva, fechaDesde
    FROM libros AS l
    INNER JOIN ejemplares e ON l.idLibro = e.idLibro
      INNER JOIN reservas r ON r.idEjemplar = e.idEjemplar
      WHERE fechaDesde >= (DATE_SUB(NOW(), INTERVAL '30' DAY))";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); */


    /* Consulta nueva */
    /* SELECT l.idLibro, l.titulo, count(1) as `ejem_count` from libros AS l INNER JOIN ejemplares e ON l.idLibro = e.idLibro INNER JOIN reservas r ON r.idEjemplar = e.idEjemplar WHERE fechaDesde >= (DATE_SUB(NOW(), INTERVAL '2' DAY)) group by l.idLibro, titulo ORDER BY ejem_count desc LIMIT 8 */

    $query2 = "SELECT COUNT(*)AS cantidad,l.titulo
    FROM reservas AS r
    INNER JOIN ejemplares AS e ON r.idEjemplar = e.idEjemplar
    INNER JOIN libros AS l ON l.idLibro = e.idLibro
    where fechaDesde >= (DATE_SUB(NOW(), INTERVAL '30' DAY))
    GROUP BY titulo
    ORDER BY cantidad LIMIT 10"; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data); 
}


?>