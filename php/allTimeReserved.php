<?php
historialReservas();

function historialReservas(){
    /* Obtiene los libros más reservados de todos los tiempos */

    include("db.php");

    /* $query = "CREATE VIEW vw_historiaLibro_res as
    SELECT l.titulo,e.idEjemplar, r.idReserva, fechaDesde
    FROM libros AS l
    INNER JOIN ejemplares e ON l.idLibro = e.idLibro
      INNER JOIN reservas r ON r.idEjemplar = e.idEjemplar";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); */

    $query2 = "SELECT COUNT(*)AS cantidad, c.nombreCategoria
    FROM reservas AS r
    INNER JOIN ejemplares AS e ON r.idEjemplar = e.idEjemplar
    INNER JOIN libros AS l ON l.idLibro = e.idLibro
    INNER JOIN libro_categorias AS lc ON lc.idLibro = l.idLibro
    INNER JOIN categorias AS c ON c.idCategoria = lc.idCategoria
    where fechaDesde >= (DATE_SUB(NOW(), INTERVAL '90' DAY))
    GROUP BY nombreCategoria
    ORDER BY cantidad" ; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);    
}
?>