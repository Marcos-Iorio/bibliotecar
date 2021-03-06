<?php

function gestionReservas(){
  include 'db.php';
//  if (!isset ($_GET['page']) ) {  
//             $page = 1;  
//         } else {  
//             $page = $_GET['page'];  
//         }  
//           $results_per_page = 5;  

//         //determine the sql LIMIT starting number for the results on the displaying page  
//         $page_first_result = ($page-1) * $results_per_page;  

  //$stmt = $dbh->prepare("SELECT * FROM reservas WHERE idReservaEstado <> '0' LIMIT " . $page_first_result . ',' . $results_per_page );
  $stmt = $dbh->prepare("SELECT *, DATE_FORMAT(fechaDesde,'%d-%m-%Y') as fechaDesde, DATE_FORMAT(fechaHasta,'%d-%m-%Y') as fechaHasta FROM reservas WHERE idReservaEstado <> '0'");




if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
  

  $idEstado = getReservaEstado($fila['idReservaEstado']);
  $tituloLibro = getTitulo($fila['idEjemplar']);
  $mailUsuario = getMailUsuario($fila['idUsuario']);
/*if ($fila['idReservaEstado'] == '1' ) {

  $idEstado = 'Pendiente';
}

if ($fila['idReservaEstado'] == '2' ) {

  $idEstado = 'Activa';

}
if ($fila['idReservaEstado'] == '3' ) {

  $idEstado = 'Expirada';
}

if ($fila['idReservaEstado'] == '4' ) {

  $idEstado = 'Cancelada';
}*/
  	echo "
                <tr>
                  <td id='idReserva'>" . $fila['idReserva']. "</td>
                  <td>" .  $fila['idEjemplar']. "</td>
                  <td>" .  $tituloLibro. "</td>
                  <td id='idEstado'>" .  $idEstado . "</td>
                  <td id='mailUsuario'>" .  $mailUsuario. "</td>
                  <td>" .  $fila['fechaDesde']. "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  <td><a href='#container-form' id='modal-reservas'><button onclick=\"javascript:cargarReserva('".$fila["idReserva"]."','".$mailUsuario."','".$idEstado."','".$fila['idEjemplar']."')\" ><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></a></td>
                </tr>


  	";
  	endforeach;
}
  


}


function ingresarReserva ($idReserva){
    include 'db.php';
    //include 'sendmail.php';

    //echo $sql;
    $stmt = $dbh->prepare("UPDATE reservas SET idReservaEstado = '2' where idReserva = '$idReserva'");

    if ($stmt->execute()) {

      if($stmt->rowCount() !== 0){

      
        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Reserva realizada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Reserva realizada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-reservas.php\"><button type=\"submit\" class=\"btnConfirmarReserva\">OK</button></a>'});</script>";

      }else{
        echo "<script>swal({title:'Error',text:'El c??digo ingresado no corresponde a ninguna reserva.',type:'error'});</script>";

      }
    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar reserva',type:'error'});</script>";

    }

}


function editarReserva ($idReserva, $idEstado, $idEjemplar){
include 'db.php';
include 'reservar.php';
    //include 'sendmail.php';

    $idEstadoReserva = getReservaID($idEstado);
    $idLibro = obtenerIDLibro($idEjemplar);
    //echo $sql;

    if ($idEstadoReserva == 0 || $idEstadoReserva == 4) {
      cambiarEstadoEjemplar($idEjemplar, "0");
      $stock = obtenerStock($idLibro);
      $stock = $stock+1;

      $stmt = $dbh->prepare("UPDATE libros SET stock='".$stock."' where idLibro ='".$idLibro."'");
      $stmt->execute();
      
    } else {
      cambiarEstadoEjemplar($idEjemplar, "1");
      $stock = obtenerStock($idLibro);
      $stock = $stock-1;

      $stmt = $dbh->prepare("UPDATE libros SET stock='".$stock."' where idLibro ='".$idLibro."'");
      $stmt->execute();
    }


    $stmt = $dbh->prepare("UPDATE reservas SET idReservaEstado = '$idEstadoReserva' where idReserva = '$idReserva'");
    if ($stmt->execute()) {

        //enviarPwd($nombre, $mail, $pass);
      echo "<script>swal({title:'Exito',text:'Reserva modificada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Reserva modificada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-reservas.php\"><button type=\"submit\" class=\"btnConfirmarReserva\">OK</button></a>'});</script>";


    } else {
        echo "<script>swal({title:'Error',text:'Error al modificar la reserva',type:'error'});</script>";

    }
    
}

function obtenerIDLibro($idEjemplar){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT idLibro FROM ejemplares where idEjemplar='". $idEjemplar . "'");


  if ($stmt->execute()) {
    //$idReserva=$stmt->fetchColumn();
    if($stmt->rowCount() !== 0){
      $arr = $stmt->fetch(PDO::FETCH_ASSOC);
      $idLibro = $arr['idLibro'];
      return $idLibro;
    }else{
      echo "";
    }
  }

}

function obtenerStock($idLibro){
  include 'db.php';

  $stmt = $dbh->prepare("SELECT stock FROM libros where idLibro='" . $idLibro . "'");


  if ($stmt->execute()) {
    //$idReserva=$stmt->fetchColumn();
      $arr=$stmt->fetch(PDO::FETCH_ASSOC);
      $stock=$arr['stock'];
      return $stock;
      }

}

//function ingresarDevolucion ($idReserva, $idEstado, $idEjemplar){

function ingresarDevolucion ($idEjemplar){

    include 'db.php';
    include 'reservar.php';
    //include 'sendmail.php';
    $idLibro = obtenerIDLibro($idEjemplar);


    $stmt = $dbh->prepare("SELECT idReserva FROM reservas where idEjemplar='" . $idEjemplar. "' and idReservaEstado = '2'");

if ($stmt->execute()) {
  //$idReserva=$stmt->fetchColumn();
    $arr=$stmt->fetch(PDO::FETCH_ASSOC);
    $idReserva = $arr['idReserva'];
    if (empty($arr)) {
        echo "<script>swal({title:'Error',text:'Para realizar una devolucion, la reserva debe estar en estado Activo',type:'error'});</script>";

    } else {  
  
      cambiarEstadoEjemplar($idEjemplar, "0");
      $stock = obtenerStock($idLibro);
      $stock = $stock+1;

      $stmt = $dbh->prepare("UPDATE libros SET stock='".$stock."' where idLibro ='".$idLibro."'");
      $stmt->execute();

      //echo $sql;
      $stmt = $dbh->prepare("UPDATE reservas SET idReservaEstado = '0' where idEjemplar = '" . $idEjemplar ."' and idReserva= '".$idReserva."'");
      //echo "UPDATE reservas SET idReservaEstado = '0' where idEjemplar = '$idEjemplar' and idReserva= '$idReserva'";
      //REPONER STOCK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    if ($stmt->execute()) {

        //enviarPwd($nombre, $mail, $pass);
      echo "<script>swal({title:'Exito',text:'Devolucion realizada correctamente.',type:'success', showConfirmButton: false, html: '<h6>Devolucion realizada correctamente.</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-reservas.php\"><button type=\"submit\" class=\"btnConfirmarReserva\">OK</button></a>'});</script>";


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar devolucion',type:'error'});</script>";

    }
  }
}


  
}

function getReservaEstado ($idEstado) {
  include 'db.php';

$stmt = $dbh->prepare("SELECT nombreReserva FROM reserva_estados WHERE idReservaEstado=$idEstado");
  

if ($stmt->execute()) {
  $resultado=$stmt->fetchColumn();

  return $resultado;

}
}

function getReservaID ($nombreEstado) {
  include 'db.php';

$stmt = $dbh->prepare("SELECT idReservaEstado FROM reserva_estados WHERE nombreReserva='$nombreEstado'");

if ($stmt->execute()) {
  $resultado=$stmt->fetchColumn();

  return $resultado;

}
}

function getTitulo ($idEjemplar){
  include 'db.php';

$stmt = $dbh->prepare("SELECT l.titulo FROM libros l, ejemplares e WHERE l.idLibro=e.idLibro AND e.idEjemplar='$idEjemplar'
");
  

if ($stmt->execute()) {
  $resultado=$stmt->fetchColumn();

  return $resultado;

}

}


function getMailUsuario($idUsuario){

    include 'db.php';

$stmt = $dbh->prepare("SELECT mail FROM usuarios WHERE idUsuario = $idUsuario");
  

if ($stmt->execute()) {
  $resultado=$stmt->fetchColumn();

  return $resultado;

}
}

      

function getEstadoReservas(){

include('db.php');

                            $stmt = $dbh->prepare('SELECT nombreReserva from reserva_estados');
                            $stmt ->execute();
                            $arr = $stmt->fetchAll();
                            //$editoriales = $arr['nombreEditorial'];
                            
                                  foreach($arr as $fila):

echo "<option>".$fila['nombreReserva']."</option>";
                          endforeach;  
}




?>