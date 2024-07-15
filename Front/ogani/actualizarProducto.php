<?php
session_start();
include("../../BD/conexion.php");
function uploadImage($file) {
    // $target_dir = '../AMG/';
    $target_dir='../AMG/';
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return false;
    }
    
    if ($file["size"] > 5000000) {
        return false;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : null;
    $producto = isset($_POST['producto']) ? $conn->real_escape_string($_POST['producto']) : null;
    $precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : null;
    $categoria = isset($_POST['categorias']) ? $conn->real_escape_string($_POST['categorias']) : null; // Changed from 'categoria' to 'categorias'
    $descripcion = isset($_POST['descripcion']) ? $conn->real_escape_string($_POST['descripcion']) : null;

    $imagen = '';
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = uploadImage($_FILES['imagen']);
        if($imagen === false) {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] = "Error al subir la imagen. Asegúrese de que sea un archivo de imagen válido y no exceda 5MB.";
            header('Location: ../../indexAdmin.php');
            exit();
        }
    }

    // Prepare the SQL statement
    if ($imagen !== '') {
        $sql = "UPDATE productos SET pro_Producto = ?, pro_precio = ?, pro_decripcion = ?, pro_imagen = ?, cat_id = ? WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsssi", $producto, $precio, $descripcion, $imagen, $categoria, $id);
    } else {
        $sql = "UPDATE productos SET pro_Producto = ?, pro_precio = ?, pro_decripcion = ?, cat_id = ? WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssi", $producto, $precio, $descripcion, $categoria, $id);
    }

    try {
        if ($stmt->execute()) {
            $_SESSION['color'] = "success";
            $_SESSION['msg'] = "Registro actualizado con éxito";
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        $_SESSION['color'] = "danger";
        $_SESSION['msg'] = "Error al actualizar registro: " . $e->getMessage();
    }

    $stmt->close();
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Método de solicitud inválido";
}

$conn->close();
header('Location: ../../indexAdmin.php');
?>