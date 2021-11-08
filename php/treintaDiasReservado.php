<?php
diasReservas();


function diasReservas(){
    /* Obtiene los libros más reservados de los ultimos 30 días de mayor a menor */

    include("db.php");

    /* $query = "CREATE VIEW vw_libri_res as
    SELECT l.titulo,e.idEjemplar, r.idReserva, fechaDesde
    FROM libros AS l
    INNER JOIN ejemplares e ON l.idLibro = e.idLibro
      INNER JOIN reservas r ON r.idEjemplar = e.idEjemplar
      WHERE fechaDesde >= (DATE_SUB(NOW(), INTERVAL '30' DAY))";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); */

    $query2 = "SELECT DISTINCT(idEjemplar),titulo,
    (SELECT COUNT(idEjemplar) 
     from vw_libri_res  WHERE idEjemplar = vr.idEjemplar)  
     as `ejem_count`
     from vw_libri_res as vr LIMIT 8"; 

     $stmt = $dbh->prepare($query2);
     $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);     
}

function historialReservas(){
      /* Obtiene los libros más reservados de todos los tiempos */

      include("db.php");

      /* $query = "CREATE VIEW vw_libri_res as
      SELECT l.titulo,e.idEjemplar, r.idReserva, fechaDesde
      FROM libros AS l
      INNER JOIN ejemplares e ON l.idLibro = e.idLibro
        INNER JOIN reservas r ON r.idEjemplar = e.idEjemplar
        WHERE fechaDesde >= (DATE_SUB(NOW(), INTERVAL '30' DAY))";
  
      $stmt = $dbh->prepare($query);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); */
  
      $query2 = "SELECT DISTINCT(idEjemplar),titulo,
      (SELECT COUNT(idEjemplar) 
       from vw_libri_res  WHERE idEjemplar = vr.idEjemplar)  
       as `ejem_count`
       from vw_libri_res as vr
       ORDER BY ejem_count desc"; 
  
       $stmt = $dbh->prepare($query2);
       $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      echo json_encode($data);    
}
  
?>