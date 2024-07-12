<?php
session_start();
require "../BD/conexion.php";

$id = $conn->real_escape_string($_POST['id']);
$producto = $conn->real_escape_string($_POST['producto']);
$precio = $conn->real_escape_string($_POST['precio']);
$categoria = $conn->real_escape_string($_POST['categorias']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);

//query sql
$sql = "UPDATE productos  SET pro_Producto = '$producto', pro_precio = '$precio', pro_decripcion = '$descripcion', cat_id = '$categoria'  WHERE pro_id='$id'";


if ($conn->query($sql)) {
    $_SESSION['color']="success";
    $_SESSION['msg'] = "Registro Actualizado";

    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $Formato = array("image/jpg", "image/jpeg");
        if (in_array($_FILES['imagen']['type'], $Formato)) {
            $dir = "imagenes";

            $info_img = pathinfo($_FILES['imagen']['name']);
            $info_img['extension'];

            $imagen = $dir . '/' . $id . 'jpg';

            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)) {
                $_SESSION['color']="danger";
                $_SESSION['msg'] .= "<br>Error al guardar imagen";
            }
        } else {
            $_SESSION['color']="danger";
            $_SESSION['msg'] .= "<br>Formato no permitido";
        }
    }
} else {
    $_SESSION['msg'] = "<br>Error al actualizar registro";
}


header('Location: ../indexAdmin.php');
