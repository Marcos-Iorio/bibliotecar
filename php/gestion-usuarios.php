<?php

function gestionUsuarios(){
   
if (isset($_SESSION["gestion"])) {
  unset($_SESSION["gestion"]);
  echo "";

  // code...
} 
    include 'db.php';


 /*   if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    $results_per_page = 5;

    //determine the sql LIMIT starting number for the results on the displaying page
    $page_first_result = ($page - 1) * $results_per_page;*/
    //retrieve the selected results from database
    //$res = mysqli_query($this->con, $query);
    //$start = 1 * ($page - 1);
    //$rows = 10;
    //$query ="select * from producto LIMIT $start, $rows";

    //$stmt = $dbh->prepare("SELECT * FROM usuarios LIMIT " . $page_first_result . ',' . $results_per_page);
    $stmt = $dbh->prepare("SELECT * FROM usuarios");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchAll();

        foreach ($resultado as $fila):

            if ($fila['idEstado'] == '2') {
                $icono  = 'fas fa-ban';
                $titulo = 'Dado de baja';
            } else {
                $icono  = 'far fa-check-circle';
                $titulo = 'Activo';

                /*if ($fila['check_mail'] == '0')  {
            $icono='fas fa-exclamation';
            $titulo='Mail';
            } */
            }



            /*if ($fila['check_mail'] == '1') {
                $check_mail = 'Si';
            } else {
                $check_mail = 'No';
            }*/

            $check_mail = getAltaMail($fila['check_mail']);
            $idRol = getNombreRol($fila['idRol']);

/*

            if ($fila['idRol'] == '1') {
                $idRol = 'Usuario';
            }

            if ($fila['idRol'] == '2') {
                $idRol = 'Colaborador';
            }

            if ($fila['idRol'] == '3') {
                $idRol = 'Administrador';
            }
            echo "<form action='' method = 'POST'>*/

            echo "
                  <tr>
                    <td>" . $fila['idUsuario'] . "</td>
                    <td>" . $idRol . "</td>
                    <td>" . $fila['nombre'] . "</td>
                    <td>" . $fila['apellido'] . "</td>
                    <td>" . $fila['numeroDocumento'] . "</td>
                    <td>" . $fila['mail'] . "</td>
                    <td>" . $check_mail . "</td>
                    <td><button><i title='" . $titulo . "'class=\"" . $icono . "\" value=\"Estado\" name=\"btnEstado\" id=\"btnEstado\" title=" . $titulo . " ></i></button></td>
                    <td><a href='#container-form' id='abrir-modal-usuario'><button  onclick=\"javascript:cargarUsuario('" . $fila["idUsuario"] . "','" . $fila["nombre"] . "','" . $fila["apellido"] . "','" . $idRol . "','" . $fila["numeroDocumento"] . "','" . $fila["mail"] . "','" . $check_mail . "','" . $titulo . "')\"><i title='Editar'class=\"fas fa-pencil-alt tbody-icon\" value=\"Modificar\" name=\"btnModificar\"></i></button></a></td>

                  </tr>

      ";
        endforeach;
    }

}




/*function getPages(){
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

function conectar(){
try {
$this->con= new mysqli(SERVIDOR, USUARIO, CONTRA,BD) or die ("Error al conectar");
} catch (Exception $exc) {
echo $exc->getTraceAsString();
}

}
function desconectar(){
$this->con->close();
}
 */

/*function getTabla(){

include 'db.php';

$stmt = $dbh->prepare('SELECT * FROM usuarios');

//ahora crearemos una tabla en bootstrap
//los enlaces a los css y js estaran en las respectivas visatas
$tabla = "<table class='table' style=\"border: 100px\">"
. "<thead class='thead-dark'>";

$tabla .="<tr style=\"text-align: center\">"
. "<th>Codigo</th>"
. "<th>Nombre</th>"
. "<th>Descripcion</th>"
. "<th>Precio</th>"
. "<th>Cantidad</th>"
. "<th>Ruta de imagen</th>"
. "<th>Imagen</th>"
. "<th>Accion</th>"
. "</tr></thead><tbody>";

while($fila = mysqli_fetch_assoc($res)){
$tabla .= "<tr>"
. "<td style=\"text-align: center\">".$fila["codigo"]."</td>"
. "<td style=\"text-align: center\">".$fila["nombre_prod"]."</td>"
. "<td style=\"text-align: center\">".$fila["descripcion"]."</td>"
. "<td style=\"text-align: center\">".$fila["precio_unit"]."</td>"
. "<td style=\"text-align: center\">".$fila["existencia"]."</td>"
. "<td style=\"text-align: center\">".$fila["imagen"]."</td>"
. "<td style=\"text-align: center\"><img style=\"width: 200px\" class= 'imagentabla 'src= '".$fila["imagen"]."'></td>"
. "<td style=\"text-align: center\"><a href=\"javascript:cargar('".$fila["codigo"]."','".$fila["nombre_prod"]."','".$fila["descripcion"]."','".$fila["precio_unit"]."','".$fila["existencia"]."','".$fila["imagen"]."')\">Seleccionar</a></td>"
. "</tr>";
}
$tabla .="</tbody></table>";
$res->close();
return $tabla;

}*/

function insertarUsuario($nombre, $apellido, $rol, $dni, $mail, $alta, $estado)
{
    include 'db.php';
    include 'sendmail.php';

    $pass = substr(sha1(mt_rand()), 17, 8);

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $rol= getIdRol($rol);

    $alta= getIdAltaMail($alta);

    $estado= getIdEstadoUsuario($estado);

    //echo $sql;
    $stmt = $dbh->prepare("INSERT INTO usuarios (nombre, apellido, idRol, numeroDocumento, mail, check_mail, idEstado, contrasena) VALUES ('$nombre', '$apellido', '$rol', '$dni', '$mail', '$alta', '$estado', '$passHash')");

    if ($stmt->execute()) {

        enviarPwd($nombre, $mail, $pass);
        echo "<script>swal({title:'Exito',text:'Usuario creado correctamente. Se ha enviado un correo a $mail',type:'success', showConfirmButton: false, html: '<h6>Usuario creado correctamente. Se ha enviado un correo a $mail</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-usuarios.php\"><button type=\"submit\" class=\"btnConfirmarUsuario\">OK</button></a>'});</script>";

    } else {
        echo "<script>swal({title:'Error',text:'El usuario no pudo ser creado INSERT INTO usuarios (nombre, apellido, idRol, numeroDocumento, mail, check_mail, idEstado, contrasena) VALUES ($nombre, $apellido, $rol, $dni, $mail, $alta, $estado, $passHash',type:'error'});</script>";

    }
    /*if($this->con->query($sql)){
//aplicamos cuadros de mensaje de SweetAlert
echo "<script>swal({title:'Exito',text:'El registro fue modificado satisfactoriamente',type:'success'});</script>";
//echo "<script>bs4pop.notice('El registro fue modificado satisfactoriamente', {type: 'success'});</script>";
}else{
echo "<script>swal({title:'Error',text:'El registro no se pudo modificar',type:'error'});</script>";
}
$this->desconectar();*/

}

function editarEstado($idEstado, $mail)
{
    include 'db.php';

    if ($idEstado == '2') {

        $nuevoID = '1';
    } else {

        $nuevoID = '2';

    }

    //echo $sql;
    $stmt = $dbh->prepare("UPDATE usuarios SET idEstado='$nuevoID' where mail='$mail'");
    if ($stmt->execute()) {
        //$resultado=$stmt->fetchAll();
        if ($idEstado == '2') {

            echo "<script>swal({title:'Exito',text:'El usuario fue habilitado exitosamente',type:'success'});</script>";

        } else {

            echo "<script>swal({title:'Exito',text:'El usuario fue deshabilitado exitosamente',type:'success'});</script>";

        }

        gestionUsuarios();

    }

    /*if($this->con->query($sql)){
//aplicamos cuadros de mensaje de SweetAlert
echo "<script>swal({title:'Exito',text:'El registro fue modificado satisfactoriamente',type:'success'});</script>";
//echo "<script>bs4pop.notice('El registro fue modificado satisfactoriamente', {type: 'success'});</script>";
}else{
echo "<script>swal({title:'Error',text:'El registro no se pudo modificar',type:'error'});</script>";
}
$this->desconectar();*/

}

function editarUsuario($id, $nombre, $apellido, $rol, $dni, $mail, $alta, $estado)
{
    include 'db.php';

    $idRol = getIdRol($rol);
    $idAltaMail = getIdAltaMail($alta);
    $idEstadoUsuario = getIdEstadoUsuario($estado);

    //echo $sql;
    $stmt = $dbh->prepare("UPDATE usuarios SET nombre='$nombre', apellido='$apellido', idRol='$idRol', numeroDocumento='$dni', mail='$mail', check_mail='$idAltaMail', idEstado='$idEstadoUsuario' where idUsuario='$id'");

//echo "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', idRol='$idRol', numeroDocumento='$dni', mail='$mail', check_mail='$idAltaMail', idEstado='$idEstadoUsuario' where idUsuario='$id'";
    if ($stmt->execute()) {
        $resultado = $stmt->fetchAll();

            echo "<script>swal({title:'Exito',text:'El usuario fue modificado satisfactoriamente',type:'success', showConfirmButton: false, html: '<h6>El usuario fue modificado satisfactoriamente</h6><br><a  style=\"background-color: #343A40; color:white;\" href=\"admin-usuarios.php\"><button type=\"submit\" class=\"btnConfirmarUsuario\">OK</button></a>'});</script>";


    } else {
        echo "<script>swal({title:'Error',text:'El usuario no pudo ser modificado.',type:'error'});</script>";

    }
    /*if($this->con->query($sql)){
//aplicamos cuadros de mensaje de SweetAlert
echo "<script>swal({title:'Exito',text:'El registro fue modificado satisfactoriamente',type:'success'});</script>";
//echo "<script>bs4pop.notice('El registro fue modificado satisfactoriamente', {type: 'success'});</script>";
}else{
echo "<script>swal({title:'Error',text:'El registro no se pudo modificar',type:'error'});</script>";
}
$this->desconectar();*/

}

// function getPages2()
// {
//     include 'db.php';

//     if (!isset($_GET['page'])) {
//         $page = 1;
//     } else {
//         $page = $_GET['page'];
//     }
//     define total number of results you want per page
//     $results_per_page  = 5;
//     $page_first_result = ($page - 1) * $results_per_page;

//     $stmt = $dbh->prepare("SELECT * from usuarios");

//     echo $sql;

//     if ($stmt->execute()) {
//         $number_of_result = $stmt->rowCount();

//     }
//     $page_filtro = 0;
//     $page_total = 0;

//     $_GET[$page_filtro] = $page_filtro;
//     $_GET[$page_total] = $page_total;

//     determine the total number of pages available
//     $number_of_page = ceil($number_of_result / $results_per_page);

//     $page_total = $number_of_page;

//     return $number_of_page;
// }

// function getPages($buscar, $criterio)
// {
//     include 'db.php';

//     if (!isset($_GET['page'])) {
//         $page = 1;
//     } else {
//         $page = $_GET['page'];
//     }
//     define total number of results you want per page
//     $results_per_page  = 5;
//     $page_first_result = ($page - 1) * $results_per_page;

//     if (!$buscar == 0 && !$criterio == 0) {
//         $stmt = $dbh->prepare("SELECT * from usuarios where $criterio like '%$buscar%'");

//     } else {

//         $stmt = $dbh->prepare("SELECT * from usuarios");

//     }
//     echo $sql;

//     if ($stmt->execute()) {
//         $number_of_result = $stmt->rowCount();

//     }
//     $page_filtro = 0;
//     $page_total  = 0;

//     $_GET[$page_filtro] = $page_filtro;
//     $_GET[$page_total] = $page_total;

//     determine the total number of pages available
//     $number_of_page = ceil($number_of_result / $results_per_page);
//     if (!$buscar == 0 && !$criterio == 0) {

//         $page_filtro = $number_of_page;
//     } else {

//         $page_total = $number_of_page;
//     }

//     return $number_of_page;
// }

// function getFiltro($buscar, $criterio)
// {

//     include 'db.php';

//     if (!isset($_GET['page'])) {
//         $page = 1;
//     } else {
//         $page = $_GET['page'];
//     }
//     $results_per_page = 5;

//     determine the sql LIMIT starting number for the results on the displaying page
//     $page_first_result = ($page - 1) * $results_per_page;
//     retrieve the selected results from database
//     $res = mysqli_query($this->con, $query);
//     $start = 1 * ($page - 1);
//     $rows = 10;
//     $query ="select * from producto LIMIT $start, $rows";

//     echo $sql;
//     $stmt = $dbh->prepare("SELECT * from usuarios where $criterio like '%$buscar%' LIMIT " . $page_first_result . ',' . $results_per_page);

//     if ($stmt->execute()) {
//         $resultado = $stmt->fetchAll();

//         foreach ($resultado as $fila):

//             if ($fila['idEstado'] == '2') {
//                 $icono  = 'fas fa-ban';
//                 $titulo = 'Dada de baja';
//             } else {
//                 $icono  = 'far fa-check-circle';
//                 $titulo = 'Activa';

//                 /*if ($fila['check_mail'] == '0')  {
//             $icono='fas fa-exclamation';
//             $titulo='Mail';
//             } */
//             }

//             if ($fila['check_mail'] == '1') {
//                 $check_mail = 'Si';
//             } else {
//                 $check_mail = 'No';
//             }

//             if ($fila['idRol'] == '1') {
//                 $idRol = 'Usuario';
//             }

//             if ($fila['idRol'] == '2') {
//                 $idRol = 'Colaborador';
//             }

//             if ($fila['idRol'] == '3') {
//                 $idRol = 'Administrador';
//             }
//             echo "<form action='' method = 'POST'>

//             echo "
//       <tbody>
//                   <tr>
//                     <td>" . $fila['idUsuario'] . "</td>
//                     <td>" . $idRol . "</td>
//                     <td>" . $fila['nombre'] . "</td>
//                     <td>" . $fila['apellido'] . "</td>
//                     <td>" . $fila['numeroDocumento'] . "</td>
//                     <td>" . $fila['mail'] . "</td>
//                     <td>" . $check_mail . "</td>
//                     <td><button><i title='" . $titulo . "'class=\"" . $icono . "\" value=\"Estado\" name=\"btnEstado\" id=\"btnEstado\" title=" . $titulo . " ></i></button></td>
//                     <td><button  onclick=\"javascript:cargarUsuario('" . $fila["idUsuario"] . "','" . $fila["nombre"] . "','" . $fila["apellido"] . "','" . $fila["idRol"] . "','" . $fila["numeroDocumento"] . "','" . $fila["mail"] . "','" . $fila["check_mail"] . "','" . $fila["idEstado"] . "')\"><i title='Editar'class=\"fas fa-pencil-alt tbody-icon\" value=\"Modificar\" name=\"btnModificar\"></i></button></td>

//                   </tr>
//                 </tbody>

//       ";
//         endforeach;

//     }

// }

function getEstadousuario()
{
    include 'db.php';

    $stmt = $dbh->prepare('SELECT estado from estado_usuarios');
    $stmt->execute();
    $arr = $stmt->fetchAll();
    //$editoriales = $arr['nombreEditorial'];

    foreach ($arr as $fila):

        echo "<option>" . $fila['estado'] . "</option>";
    endforeach;
}

function getRoles()
{
    include 'db.php';

    $stmt = $dbh->prepare('SELECT nombreRol from roles');
    $stmt->execute();
    $arr = $stmt->fetchAll();
    //$editoriales = $arr['nombreEditorial'];

    foreach ($arr as $fila):

        echo "<option>" . $fila['nombreRol'] . "</option>";
    endforeach;
}

function getEstadoMail()
{
    include 'db.php';

    $stmt = $dbh->prepare('SELECT tipoEstado from estado_mail');
    $stmt->execute();
    $arr = $stmt->fetchAll();
    //$editoriales = $arr['nombreEditorial'];

    foreach ($arr as $fila):

        echo "<option>" . $fila['tipoEstado'] . "</option>";
    endforeach;
}


function getNombreRol($idRol) 
{

    include 'db.php';

    $stmt = $dbh->prepare("SELECT nombreRol FROM roles WHERE idRol='$idRol'");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchColumn();

        return $resultado;

    }

}

function getAltaMail($idEstadoMail) 
{

    include 'db.php';

    $stmt = $dbh->prepare("SELECT tipoEstado FROM estado_mail WHERE idEstadoMail='$idEstadoMail'");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchColumn();

        return $resultado;

    }

}

function getIdRol($rol) 
{

    include 'db.php';

    $stmt = $dbh->prepare("SELECT idRol FROM roles WHERE nombreRol='$rol'");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchColumn();

        return $resultado;

    }

}

function getIdAltaMail($alta)
{

    include 'db.php';

    $stmt = $dbh->prepare("SELECT idEstadoMail FROM estado_mail WHERE tipoEstado='$alta'");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchColumn();

        return $resultado;

    }  
}

function getIdEstadoUsuario($estado)
{

     include 'db.php';

    $stmt = $dbh->prepare("SELECT idEstado FROM estado_usuarios WHERE estado='$estado'");

    if ($stmt->execute()) {
        $resultado = $stmt->fetchColumn();

        return $resultado;

    } 
}


