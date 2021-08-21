<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include('db.php');

    if(isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['genero']) && isset($_POST['stock']) && isset($_POST['desc'])){
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
        $stock = $_POST['stock'];
        $descripcion = $_POST['desc'];
        $fechaAlta = date('m/d/Y');

    }
    $archivo = $_POST['portada'];
    $pdf = $_POST['pdf'];


    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $imageFileType = strtolower(pathinfo($target_pdf, PATHINFO_EXTENSION));

    

    if($imageFileType == "jpg" && $imageFileType == "png" && $imageFileType == "jpeg" && $imageFileType == "jfif" ) {
        
        $target_dir = "../assets/libros/";
        $target_file = $target_dir . basename($_FILES[$archivo]['']);

    }elseif ($imageFileType == "pdf") {

        $target_pdf = $target_dir . basename($_FILES[$pdf]['']);
        $pdf_dir = "../assets/pdf/";
    }

    $stmt = $dbh->prepare("INSERT into libros (titulo, descripcion, pdf, stock, fechaAlta, imagen_libro) values(? ? ? ? ? ?)");
    $stmt->bindParam(1, $titulo);
    $stmt->bindParam(2, $descripcion);
    $stmt->bindParam(3, $target_pdf);
    $stmt->bindParam(4, $stock);
    $stmt->bindParam(5, $fechaAlta);
    $stmt->bindParam(6, $tarjet_file);




}
    

?>