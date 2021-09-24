<?php

function gestionUsuarios(){
  include_once 'db.php';

  $stmt = $dbh->prepare('SELECT * FROM usuarios');
  
if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
  	echo "<tbody>
                <tr>
                  <td>" . $fila['idUsuario']. "</td>
                  <td>" .  $fila['idRol']. "</td>
                  <td>" .  $fila['nombre']. "</td>
                  <td>" .  $fila['apellido']. "</td>
                  <td>" .  $fila['numeroDocumento']. "</td>
                  <td>" .  $fila['mail']. "</td>
                  <td>" .  $fila['check_mail']. "</td>
                  <td><button><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></td>
                  <td><button><i class=\"far fa-trash-alt tbody-icon\"></i></button></td>
                </tr>
              </tbody>


  	";
  	endforeach;
}
  


}



    function getPages(){
        include_once 'db.php';

        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  


        //define total number of results you want per page  
        $results_per_page = 5;  

        $query = "select * from usuarios";  
        $this->conectar();
        $res = $this->con->query($query);  
        $number_of_result = mysqli_num_rows($res);  
  
        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page);  

          $this->desconectar();

          return $number_of_page;
    }


?>