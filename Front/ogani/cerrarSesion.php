<?php
session_start();
session_destroy();
header("location: login3.php");
?>