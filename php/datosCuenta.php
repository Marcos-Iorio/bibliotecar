<?php



function getReservas($idUsuario){
  include 'db.php';

  /*if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


  $stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);*/
  

  $stmt = $dbh->prepare("SELECT * FROM reservas where idUsuario = '$idUsuario' and idReservaEstado <> '0'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):


  	echo "
    <tbody>
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $fila['idEjemplar'] . "</td>
                  <td>" .  $fila['idReservaEstado']. "</td>
                  <td>" .  $fila['fechaDesde']. "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>
              </tbody>

  	";
  	endforeach;
}
  


}


function getHistorial($idUsuario){
  include 'db.php';

  /*if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


  $stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);*/
  

  $stmt = $dbh->prepare("SELECT * FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '0'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):


    echo "
    <tbody>
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $fila['idEjemplar'] . "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>
              </tbody>

    ";
    endforeach;
}
  }



function getDescargas($idUsuario){
  include 'db.php';

  /*if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


  $stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);*/
  

  $stmt = $dbh->prepare("SELECT * FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '0'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):


    echo "
    <tbody>
                <tr>
                  <td>" .  $fila['idEjemplar'] . "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>
              </tbody>

    ";
    endforeach;
}



  }


function datosUsuario($idUsuario){
  include 'db.php';

  /*if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


  $stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);*/
  

  $stmt = $dbh->prepare("SELECT * FROM usuarios where idUsuario = '$idUsuario'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):


    echo "
      <form method='POST' name='contact_form' id='contact-form'>
                  <div  class='input-group'>
                        <label for='first_name'>Nombre</label>
                        <input name='name' type='text'  placeholder='Nombre..' value='".$fila['nombre']."'/>
                        
                        <label for='last_name'>Apellido:</label>
                        <input name='last_name' type='text'  placeholder='Apellido..' value='".$fila['apellido']."'/>
                        
                        <label for='email'>Email:</label>
                        <input name='email' type='text'  readonly placeholder='you@dominio.com..' value='".$fila['mail']."'/>
                    </div>  
                      <br>
                    <div  class='input-group'>  
                        <label for='message'>DNI:</label>
                        <input type='text' value='".$fila['numeroDocumento']."'>
                        
                        <label for='message'>Telefono:</label>
                        <input type='text' value='".$fila['telefono']."'>
                        
                        <label for='message'>Direccion:</label>
                        <input type='text' value='".$fila['direccion']."'>
                        
                        </div>
                        <br>
                        <div  class='input-group'>

                        <input style='width: 290px; margin-left: 535px;margin-top: 10px;' type='submit' value='Modificar'>
                  </div>
      </form>

    ";
    endforeach;
}



  }



function modificarDatos($idUsuario){
  include 'db.php';

  /*if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  
        //retrieve the selected results from database   
        //$res = mysqli_query($this->con, $query);  
        //$start = 1 * ($page - 1);
        //$rows = 10;
        //$query ="select * from producto LIMIT $start, $rows";


  $stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);*/
  

  $stmt = $dbh->prepare("SELECT * FROM usuarios where idUsuario = '$idUsuario'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):


    echo "
<form method='POST' name='contact_form' id='contact-form'>
                        <label for='first_name'>Nombre</label>
                        <input name='name' type='text'  placeholder='Nombre..' value='".$fila['nombre']."'/>
                        <br>
                        <label for='last_name'>Apellido:</label>
                        <input name='last_name' type='text'  placeholder='Apellido..' value='".$fila['apellido']."'/>
                        <br>
                        <label for='email'>Email:</label>
                        <input name='email' type='text'  readonly placeholder='you@dominio.com..' value='".$fila['mail']."'/>
                        <br>
                        <label for='message'>DNI:</label>
                        <input type='text' value='".$fila['numeroDocumento']."'>
                        <br>
                        <label for='message'>Telefono:</label>
                        <input type='text' value='".$fila['telefono']."'>
                        <br>
                        <label for='message'>Direccion:</label>
                        <input type='text' value='".$fila['direccion']."'>
                        <br>
                        <label for='message'>Localidad:</label>
                        <input type='text' value='".$fila['idLocalidad']."'>
                        <div class='center'>
                        <input style='width: 200px; margin-left: 1px;' type='submit' value='Modificar'>
                    </form>

    ";
    endforeach;
}



  }

  function cambiarPwd(){

  }

  function bajaUsuario(){
    
  }


?>