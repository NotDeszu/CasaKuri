<?php
session_start();
include("../../BD/conexion.php");

//Funcion para subir una imagen png y que aparezca en la pagina de catalogo de prod 
function uploadImage($file) {
    
    $target_dir = '../AMG/';

    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return false;
    }
    
    // Check file size (limit to 5MB)
    if ($file["size"] > 5000000) {
        return false;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $conn->real_escape_string($_POST['producto']);
    $precio = $conn->real_escape_string($_POST['precio']);
    $precioIva = $precio + ($precio*0.16);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);

    // Handle image upload
    $imagen = '';
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = uploadImage($_FILES['imagen']);
        if($imagen === false) {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] = "Error al subir la imagen";
            header('Location: ../../indexAdmin.php');
            exit();
        }
    }

    // Insert into database
    $sql = "INSERT INTO productos (pro_Producto, pro_precio, pro_decripcion, pro_imagen, cat_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsss", $producto, $precioIva, $descripcion, $imagen, $categoria);

    if ($stmt->execute()) {
        $id = $conn->insert_id;
        $_SESSION['color'] = "success";
        $_SESSION['msg'] = "Registro guardado";
    } else {
        $_SESSION['color'] = "danger";
        $_SESSION['msg'] = "Error al guardar registro: " . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Método de solicitud inválido";
}

$conn->close();
header('Location: ../../indexAdmin.php');
?>