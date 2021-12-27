<?php 
    header('Content-Type: application/json');

    include "./config/conexion.php";

    $search_income = "SELECT created_at, quantity FROM ingresos ORDER BY created_at DESC";
    $result_income = mysqli_query($conexion, $search_income);

    $data = array();

    foreach($result_income as $row) {
        $data[] = $row;
    }

    echo json_encode($data);
?>