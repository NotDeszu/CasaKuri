<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nuevacasakuri";

//creamos la conexion con la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// un if para saber si es que la conexion es correcta
if (!$conn) {
    die("conexion fallida: " . mysqli_connect_error());
}else{
    echo "conexion exitosa";
}

// asignamos el valor ingresado por el usuario en la pagina html gracias al metodo post
$us_nombre = $_POST['usu_nombre'];
$us_apellidoP = $_POST['usu_apellidop'];
$us_apellidoM = $_POST['usu_apellidom'];
$us_telefono = $_POST['usu_telefono'];
$us_direccion = $_POST['usu_direccion'];
$us_email = $_POST['usu_email'];
$us_password = md5($_POST['usu_pass']);
$us_cp = $_POST['usu_cp'];
$id_estado = $_POST['est_id'];


// asignamos el statement de sql a una variable 
$sql = "INSERT INTO usuarios (usu_nombre, usu_apellidoP, usu_apellidoM, usu_telefono, usu_direccion, usu_email, usu_pass, usu_cp, est_id) 
        VALUES ('$us_nombre', '$us_apellidoP', '$us_apellidoM', '$us_telefono', '$us_direccion','$us_email', '$us_password', '$us_cp', '$id_estado')";

// ejecutamos el statement de sql
if (mysqli_query($conn, $sql)) {
    header("Location: login3.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// cerramos la conexion con la base de datos
mysqli_close($conn);
?>