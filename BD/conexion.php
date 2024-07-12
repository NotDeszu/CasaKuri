<?php
$servidor= "localhost";
$usuario="root";
$password="";
$basedatos="nuevacasakuri";   

$conn =mysqli_connect($servidor, $usuario,$password,$basedatos);

if (!$conn) {
    die('Error. conexion fallida: '.mysqli_connect_error());
}else{
    
}
?>
