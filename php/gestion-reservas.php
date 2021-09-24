<?php

function gestionReservas(){
  include_once 'db.php';

  $stmt = $dbh->prepare('SELECT * FROM reservas');
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
  	echo "<tbody>
                <tr>
                  <td>" . $fila['idReserva']. "</td>
                  <td>" .  $fila['idEjemplar']. "</td>
                  <td>" .  $fila['idReservaEstado']. "</td>
                  <td>" .  $fila['idUsuario']. "</td>
                  <td>" .  $fila['fechaDesde']. "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  <td><button><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></td>
                  <td><button><i class=\"far fa-trash-alt tbody-icon\"></i></button></td>
                </tr>
              </tbody>


  	";
  	endforeach;
}
  


}
?>