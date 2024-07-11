<?php
$servidor= "localhost";
$usuario="root";
$password="";
$basedatos="casakuri";   

$conn =mysqli_connect($servidor, $usuario,$password,$basedatos);

if (!$conn) {
    die('Error. conexion fallida: '.mysqli_connect_error());
}else{
    
}
?>
