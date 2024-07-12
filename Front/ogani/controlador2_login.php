<?php
session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usu_nombre"]) && !empty($_POST["usu_pass"])) {
        $usu_nombre = $_POST['usu_nombre'];
        $usu_pass = $_POST['usu_pass'];

        $sql=$conn->query("select * from usuarios where usu_nombre='$usu_nombre' and usu_pass='$usu_pass'");

        if ($datos = $sql->fetch_object()) {
            //estas variables tienen que tener el mismo nombre que en la base de datos
            $_SESSION["usu_id"] = $datos->usu_id; 
            $_SESSION["usu_nombre"] = $datos->usu_nombre;
            $_SESSION["usu_apellidop"] = $datos->usu_apellidop;
            $_SESSION["rol_id"] = $datos->rol_id;
            $_SESSION["usu_email"] = $datos->usu_email;

            if ($datos->rol_id == 1) {
                header("Location: ../../indexAdmin.php"); 
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<div class='alert alert-danger'>Credenciales Incorrectas</div>";
            echo "<div class='alert alert-danger'>Acceso Denegado</div>";
        }
    } else {
        echo "Llena los campos";
    }
}
?>
