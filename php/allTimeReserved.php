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

    $query2 = "SELECT DISTINCT(idEjemplar),titulo,
    (SELECT COUNT(idEjemplar) 
     from vw_historiaLibro_res  WHERE idEjemplar = vr.idEjemplar)  
     as `ejem_count`
     from vw_historiaLibro_res as vr
     ORDER BY ejem_count desc LIMIT 8" ; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);    
}
?>