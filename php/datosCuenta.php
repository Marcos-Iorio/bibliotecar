<?php


function getCantidadReservas($idUsuario){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT count(*) as cantidad FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '1' or idReservaEstado = '2' ");


if ($stmt->execute()) {
  $arr = $stmt->fetch(PDO::FETCH_ASSOC);

   $cantidad= $arr['cantidad'];

   return $cantidad;
}
}

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
  

  $stmt = $dbh->prepare("SELECT *, DATE_FORMAT(fechaDesde,'%d-%m-%Y') as fechaDesde,DATE_FORMAT(fechaHasta,'%d-%m-%Y') as fechaHasta FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '1' or idReservaEstado = '2' ");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();
  $cantidad='0';

  foreach($resultado as $fila):
  $nombreEstado = getReservaEstado($fila['idReservaEstado']);
  $nombreLibro = getTitulo($fila['idEjemplar']);
  $cantidad=$cantidad+'1';

    // if($cantidad<='3') {
   
  	echo "
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $nombreLibro . "</td>
                  <td id='estado'>" .  $nombreEstado. "</td>
                  <td>" .  $fila['fechaDesde']. "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>
              

  	";
  // } 
  	endforeach;
}
$_SESSION['cantidadReservas'] = $cantidad;

//  if ($cantidad>'0') {
//    echo "</table>
//    <h4>Tenes $cantidad reservas activas.";
//  } else {
//    echo "</table>
//    <h1>No tenes reservas activas</h1>";
//  } 


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
  

  $stmt = $dbh->prepare("SELECT *, DATE_FORMAT(fechaHasta,'%d-%m-%Y') as fechaHasta FROM reservas where idUsuario = '$idUsuario' and idReservaEstado = '0'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();


  foreach($resultado as $fila):
  $nombreLibro = getTitulo($fila['idEjemplar']);


    echo "
                <tr>
                  <td>" .  $fila['idReserva']. "</td>
                  <td>" .  $nombreLibro . "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  
                </tr>

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
    $nombreLibro = getTitulo($fila['idEjemplar']);
  
  
      echo "
                  <tr>
                    <td>" .  $fila['idReserva']. "</td>
                    <td>" .  $nombreLibro . "</td>
                    <td>" .  $fila['fechaHasta']. "</td>
                    
                  </tr>
  
      ";
      endforeach;
  
  
  }



  }


function datosUsuario($idUsuario){
  include 'db.php';
  
  $stmt = $dbh->prepare("SELECT * FROM usuarios where idUsuario = '$idUsuario'");


if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();
  foreach($resultado as $fila):



    echo "
      <form method='POST' name='contact_form' id='contact-form'>
                  <div  class='input-group'>
                        <label for='first_name'>Nombre</label>
                        <input required name='nombreUsuario' id='nombreUsuario' onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))' type='text'  placeholder='Nombre..' value='".$fila['nombre']."' required/>
                        
                        <label for='last_name'>Apellido:</label>
                        <input required name='apellidoUsuario' id='apellidoUsuario' type='text' onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'  placeholder='Apellido..' value='".$fila['apellido']."' required/>
                        
                        <label for='email'>Email:</label>
                        <input required name='email' type='text' id='mail' style='background-color:#b3b2b2;' disabled placeholder='you@dominio.com..' value='".$fila['mail']."' required/>
                    </div>  
                      <br>
                    <div  class='input-group'>  
                        <label for='message'>DNI:</label>
                        <input required type='text' name='dniUsuario' id='dniUsuario' maxlength='15' value='".$fila['numeroDocumento']."' required>
                        
                        <label for='message'>Telefono:</label>
                        <input required type='text' name='telefonoUsuario' id='telefonoUsuario' value='".$fila['telefono']."'>
                        
                        <label for='message'>Direccion:</label>
                        <input required type='text' name='direccionUsuario' onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))'  id='direccionUsuario'value='".$fila['direccion']."'>
                        
                        </div>
                        <br>
                        <div  class='input-group'>

                        <div style='margin-top: 5px;'' class='boton-modificar'>
                            <button class='modificar' id='modificar'>Modificar</button>
                        </div>
                  </div>
      </form>

    ";
    endforeach;


}



  }



function modificarDatos($idUsuario, $nombre, $apellido, $documento, $telefono, $direccion){
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
  

  $stmt = $dbh->prepare("UPDATE usuarios set nombre='$nombre', apellido='$apellido', numeroDocumento='$documento', telefono='$telefono', direccion='$direccion' where idUsuario = '$idUsuario'");


if ($stmt->execute()) {
  echo "<script>swal({title:'Exito',text:'Tus datos fueron modificados correctamente.',type:'success', showConfirmButton: false, html: '<h6>Tus datos fueron modificados correctamente.</h6><br><button type=\"submit\" style=\"background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;\" ><a  style=\"background-color: #343A40; color:white;\" href=\"cuenta.php\">OK</a></button>'});</script>";

} else {
  echo "<script>swal({title:'Error',text:'Hubo un problema al modificar los datos. Por favor intenta nuevamente.',type:'error'});</script> ";

}

}

function modificarPwd($idUsuario, $pwd, $pwdNueva){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT contrasena from usuarios where idUsuario = '$idUsuario'");


if ($stmt->execute()) {

  $arr = $stmt->fetch(PDO::FETCH_ASSOC);
  if(!empty($arr) && password_verify($pwd, $arr['contrasena'])){
    
    $passHash = password_hash($pwdNueva, PASSWORD_DEFAULT);
    $stmt = $dbh->prepare("UPDATE usuarios SET contrasena = '$passHash' where idUsuario = '$idUsuario'");
    
    if ($stmt->execute()) {
      echo "<script>swal({title:'Exito',text:'Tus datos fueron modificados correctamente.',type:'success', showConfirmButton: false, html: '<h6>Tus datos fueron modificados correctamente.</h6><br><button type=\"submit\" style=\"background-color: #343A40; color:white; width: 160px; height: 50px; text-align:center;\" ><a  style=\"background-color: #343A40; color:white;\" href=\"cuenta.php\">OK</a></button>'});</script>";
    } else {
      echo "<script>swal({title:'Error',text:'No se pudo cambiar la contraseña. Por favor, intentelo nuevamente.',type:'error'});</script> ";
    }
  } else {
    echo "<script>swal({title:'Error',text:'La contraseña actual ingresada es incorrecta.',type:'error'});</script> ";
  }
} else {
echo "<script>swal({title:'Error',text:'No se pudo cambiar la contraseña. Por favor, intentelo nuevamente.',type:'error'});</script> ";
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