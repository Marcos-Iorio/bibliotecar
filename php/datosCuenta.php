<?php



function getReservas($idUsuario){
  include 'db.php';
  include 'gestion-reservas.php';
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
  

  $stmt = $dbh->prepare("SELECT * FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '1' or idReservaEstado = '2' ");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
  $nombreEstado = getReservaEstado($fila['idReservaEstado']);
  $nombreLibro = getTitulo($fila['idEjemplar']);



  	echo "
    <tbody>
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $nombreLibro . "</td>
                  <td>" .  $nombreEstado. "</td>
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
  $nombreLibro = getTitulo($fila['idEjemplar']);


    echo "
    <tbody>
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $nombreLibro . "</td>
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
    echo "
    <tbody>
                <tr>
                  <td>No hay descargas realizadas</td>
                  <td></td>
                  
                </tr>
              </tbody>

    ";
  foreach($resultado as $fila):

  $nombreLibro = getTitulo($fila['idEjemplar']);

    /*echo "
    <tbody>
                <tr>
                  <td>" .  $nombreLibro . "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>
              </tbody>

    ";*/




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
                        <input name='name' type='text'  placeholder='Nombre..' value='".$fila['nombre']."' required/>
                        
                        <label for='last_name'>Apellido:</label>
                        <input name='last_name' type='text'  placeholder='Apellido..' value='".$fila['apellido']."' required/>
                        
                        <label for='email'>Email:</label>
                        <input name='email' type='text' id='mail'  readonly placeholder='you@dominio.com..' value='".$fila['mail']."' required/>
                    </div>  
                      <br>
                    <div  class='input-group'>  
                        <label for='message'>DNI:</label>
                        <input type='text' value='".$fila['numeroDocumento']."'required>
                        
                        <label for='message'>Telefono:</label>
                        <input type='text' value='".$fila['telefono']."'>
                        
                        <label for='message'>Direccion:</label>
                        <input type='text' value='".$fila['direccion']."'>
                        
                        </div>
                        <br>
                        <div  class='input-group'>

                        <div class='boton-modificar'>
                            <button class='modificar' id='modificar'>Modificar</button>
                        </div>
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

  function bajaUsuario($id){
    include 'db.php';

    $query = "UPDATE usuarios
              set idEstado = 2
              WHERE idUsuario = $id";

    $stmt = $dbh->prepare($query);
    if ($stmt->execute()) {
      include 'logout.php';
      cerrarSesion();
      
      echo "<script>
      swal({title:'Exito',text:'Tu cuenta se dio de baja éxitosamente, esperamos volver a verte!. Serás redireccionado en 1 segundo.',type:'success'});
      setTimeout(function(){
        window.location.href = 'login.php';
      }, 1500);
    </script>";
                
                
    }else{
      echo "<script>swal({title:'Error',text:'No hemos podido dar de baja su cuenta. Por favor contacta al administrador para mas información.',type:'error'});</script> ";
    }
  }
?>