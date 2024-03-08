<?php
    include "./config/conexion.php";

    $sql = "UPDATE new_orders_admin SET notification_status = 1 WHERE notification_status = 0";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM new_orders_admin ORDER BY id DESC LIMIT 10";
    mysqli_query($conexion, $sql);
?>