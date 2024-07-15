<?php
function getActiveProducts() {
    global $conn;
    $sql = "SELECT * FROM productos WHERE pro_status = 1";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
