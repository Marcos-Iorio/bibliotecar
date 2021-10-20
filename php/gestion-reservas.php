<?php

function gestionReservas(){
  include 'db.php';
 if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
          $results_per_page = 5;  

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page;  

  $stmt = $dbh->prepare("SELECT * FROM reservas WHERE idReservaEstado <> '0' LIMIT " . $page_first_result . ',' . $results_per_page );
  



if ($stmt->execute()) {
  $resultado=$stmt->fetchAll();

  foreach($resultado as $fila):
  
if ($fila['idReservaEstado'] == '1' ) {

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
}
  	echo "<tbody>
                <tr>
                  <td>" . $fila['idReserva']. "</td>
                  <td>" .  $fila['idEjemplar']. "</td>
                  <td>" .  $idEstado . "</td>
                  <td>" .  $fila['idUsuario']. "</td>
                  <td>" .  $fila['fechaDesde']. "</td>
                  <td>" .  $fila['fechaHasta']. "</td>
                  <td><button onclick=\"javascript:cargarReserva('".$fila["idReserva"]."','".$fila["idUsuario"]."','".$fila["idReservaEstado"]."')\"><i class=\"fas fa-pencil-alt tbody-icon\"></i></button></td>
                </tr>
              </tbody>


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

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Reserva realizada correctamente.',type:'success'});</script>";
        gestionReservas();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar reserva',type:'error'});</script>";
        gestionReservas();

    }

}


function editarReserva ($idReserva, $idEstado){
include 'db.php';
    //include 'sendmail.php';



    //echo $sql;
    $stmt = $dbh->prepare("UPDATE reservas SET idReservaEstado = '$idEstado' where idReserva = '$idReserva'");

    if ($stmt->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Reserva modificada correctamente.',type:'success'});</script>";
        gestionReservas();


    } else {
        echo "<script>swal({title:'Error',text:'Error al modificar la reserva',type:'error'});</script>";
        gestionReservas();

    }
    
}

//function ingresarDevolucion ($idReserva, $idEstado, $idEjemplar){

function ingresarDevolucion ($idEjemplar){

    include 'db.php';
    //include 'sendmail.php';



    //echo $sql;
    $stmt = $dbh->prepare("UPDATE reservas SET idReservaEstado = '0' where idEjemplar = '$idEjemplar'");

    //REPONER STOCK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    if ($stmt->execute()) {

        //enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Devolucion realizada correctamente.',type:'success'});</script>";
        gestionReservas();


    } else {
        echo "<script>swal({title:'Error',text:'Error al ingresar devolucion',type:'error'});</script>";
        gestionReservas();

    }
  
}


       function getPages2(){
      include 'db.php';

        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
        //define total number of results you want per page 
        $results_per_page = 5;  
        $page_first_result = ($page-1) * $results_per_page; 


          $stmt = $dbh->prepare("SELECT * from usuarios");

    //echo $sql;

    if ($stmt->execute()) {
        $number_of_result = $stmt->rowCount();  

    }
        //$page_filtro = 0;
        //$page_total = 0;
        
        //$_GET[$page_filtro] = $page_filtro; 
        //$_GET[$page_total] = $page_total; 

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page);  

          //$page_total = $number_of_page;

          return $number_of_page;
    }





    function getPages(){
      include 'db.php';

        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
        //define total number of results you want per page 
        $results_per_page = 5;  
        $page_first_result = ($page-1) * $results_per_page; 

        
          $stmt = $dbh->prepare("SELECT * from reservas");

       

      
    //echo $sql;

    if ($stmt->execute()) {
        $number_of_result = $stmt->rowCount();  

    }
        $page_filtro = 0;
        $page_total = 0;
        
        //$_GET[$page_filtro] = $page_filtro; 
        //$_GET[$page_total] = $page_total; 

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page);  


          return $number_of_page;
    }
?>