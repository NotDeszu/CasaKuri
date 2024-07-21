<?php
function getSucursales() {
    global $conn;
    $sql = "SELECT * FROM sucursal";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCategorias() {
    global $conn;
    $sql = "SELECT * FROM categoria";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getFilteredProducts($sucursal_id = 0, $categoria_id = 0) {
    global $conn;
    $sql = "SELECT DISTINCT p.* FROM productos p
            LEFT JOIN inventario i ON p.pro_id = i.pro_id
            WHERE p.pro_status = 1";
    
    if ($sucursal_id > 0) {
        $sql .= " AND i.suc_id = $sucursal_id";
    }
    
    if ($categoria_id > 0) {
        $sql .= " AND p.cat_id = $categoria_id";
    }
    
    // Debug: Print the SQL query
    echo "<!-- Debug: SQL Query: " . htmlspecialchars($sql) . " -->";
    
    $result = $conn->query($sql);
    
    if (!$result) {
        // Debug: Print any SQL errors
        echo "<!-- Debug: SQL Error: " . $conn->error . " -->";
        return [];
    }
    
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
