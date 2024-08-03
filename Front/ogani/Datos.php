<?php
session_start();
include("../../BD/conexion.php");
include "../../funciones/usuario.php";

// Captura de datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$rfc = $conn->real_escape_string($_POST['rfc']);
$regimen = $conn->real_escape_string($_POST['regimen']);
$domicilio = $conn->real_escape_string($_POST['domicilio']);
$cfdi = $conn->real_escape_string($_POST['uso_cfdi']);
$fecha = date('Y-m-d H:i:s'); // Captura de la fecha y hora actual

// Obtener el rf_id y cfdi_id correspondientes a las selecciones
$sql_regimen = "SELECT rf_id FROM regimen_fiscal WHERE rf_clave = '$regimen'";
$result_regimen = $conn->query($sql_regimen);
$rf_id = $result_regimen->fetch_assoc()['rf_id'];

$sql_cfdi = "SELECT cfdi_id FROM cfdi_uso WHERE cfdi_clave = '$cfdi'";
$result_cfdi = $conn->query($sql_cfdi);
$cfdi_id = $result_cfdi->fetch_assoc()['cfdi_id'];

// Insertar en la tabla de facturas
$sql = "INSERT INTO facturas (fac_nombre, fac_rfc, fac_domicilio, fac_fecha, ven_id, rf_id, cfdi_id) 
        VALUES ('$nombre', '$rfc', '$domicilio' , '$fecha', NULL, '$rf_id', '$cfdi_id')";

if ($conn->query($sql) === TRUE) {
    // Redireccionar a detalles.php con un mensaje de éxito
    header("Location: detalles.php?message=datos_recibidos");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

