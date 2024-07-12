<?php
session_start();
include("../BD/conexion.php");

$producto = $conn->real_escape_string($_POST['producto']);
$precio = $conn->real_escape_string($_POST['precio']);
$categoria = $conn->real_escape_string($_POST['categoria']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);


$sql = "INSERT INTO productos (pro_Producto, pro_precio, pro_decripcion,pro_status, cat_id) VALUES ('$producto','$precio','$descripcion', 1,'$categoria')";


if ($conn->query($sql)) {
    $id = $conn->insert_id;
    $_SESSION['color']="success";
    $_SESSION['msg']="Registro guardado";


    if($_FILES['imagen']['error']== UPLOAD_ERR_OK){
        $Formato = array("image/jpg", "image/jpeg");
        if(in_array($_FILES['imagen']['type'],$Formato)){
            $dir ="imagenes";

            $info_img=pathinfo($_FILES['imagen']['name']);
            $info_img['extension'];

            $imagen = $dir .'/'.$id.'jpg';

            if (!file_exists($dir)) {
                mkdir($dir,0777);
            }

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)){
                $_SESSION['color']="danger";
                $_SESSION['msg'].="<br>Error al guardar imagen";
            }

        }else{
            $_SESSION['color']="danger";
            $_SESSION['msg'].="<br>Formato no permitido";
        }
    }
} else {
    $_SESSION['color']="danger";
    $_SESSION['msg']="<br>Error al guardar imagen";

}

header('Location: ../index.php');
?>