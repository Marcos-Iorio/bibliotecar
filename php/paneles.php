<?php

    function panelReserva($nombreUsuario){

        include 'php/db.php';

        $query = "SELECT usuarios.nombre, COUNT(reservas.idReserva) as totalReservas, reservas.fechaHasta from reservas
                INNER JOIN usuarios ON reservas.idUsuario = usuarios.idUsuario
                WHERE usuarios.nombre = '$nombreUsuario' AND reservas.fechaHasta > NOW() 
                AND reservas.idReservaEstado = 2 ORDER BY reservas.fechaHasta ASC";


        $stmt = $dbh->prepare($query);
    

        // Ejecutamos
        $stmt->execute();

        // Mostramos los resultados
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($arr['totalReservas'] == 0) {
            echo 'No tenes reservas realizadas';
        }elseif($nombreUsuario != null){
            echo $nombreUsuario . ", tenés: <strong>" . $arr['totalReservas'] . "</strong> reservas hechas,
             la fecha próxima para devolver el libro es: <strong>" . $arr['fechaHasta'] . "</strong>";
        }else{
            echo 'Acá aparecerían tus reservas, SI TUVIERAS CUENTA!<br>';
        }

        
    }

?>