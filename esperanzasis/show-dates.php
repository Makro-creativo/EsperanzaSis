<?php 
    header('Content-Type: application/json');

    include "./config/conexion.php";
    
    $search_dates = "SELECT created_at, amount FROM gastos ORDER BY created_at DESC";
    $result_dates = mysqli_query($conexion, $search_dates);

    $data = array();

    foreach($result_dates as $row) {
        $data[] = $row;
    }

    echo json_encode($data);
?>