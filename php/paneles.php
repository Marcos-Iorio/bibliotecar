<?php

    function panelReserva($mailUsuario){

        include 'php/db.php';

        $query = "SELECT usuarios.nombre, COUNT(reservas.idReserva) as totalReservas, reservas.fechaHasta from reservas
                INNER JOIN usuarios ON reservas.idUsuario = usuarios.idUsuario
                WHERE usuarios.mail = '$mailUsuario' AND reservas.fechaHasta > NOW() 
                AND reservas.idReservaEstado = 2 ORDER BY reservas.fechaHasta ASC";


        $stmt = $dbh->prepare($query);
    

        // Ejecutamos
        $stmt->execute();

        // Mostramos los resultados
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($arr['totalReservas'] > 1 ) {
            $reserva="reservas activas";
        } else {
            $reserva="reserva activa";
        }
        
        if ($mailUsuario != null) {
            if ($arr['totalReservas'] == 0 ) {
            echo 'Actualmente no tenes ninguna reserva activa.';
            }else{
                echo "Tenés: <strong>" . $arr['totalReservas'] . "</strong> $reserva,
                la fecha próxima para devolver el libro es: <strong>" . $arr['fechaHasta'] . "</strong>
                <br><br><br>
                <a class='ver-mas-paneles' href='cuenta.php'>Ver más</a>";
            }
        } else {
            echo 'Ingresá o registrate para acceder a tus libros y reservas.<br>';
        
    }
        
    }

?>