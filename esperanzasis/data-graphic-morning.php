<?php
    header('Content-Type: application/json');

    include "./config/conexion.php";

    $query_graphic_result = "SELECT opening_date, closing_amount, opening_amount FROM cutbox WHERE turn = 'Turno de la mañana'";

    $result_graphic = mysqli_query($conexion, $query_graphic_result);

    $data = array();

    foreach ($result_graphic as $row) {
        $data[] = $row;
    }

    echo json_encode($data);
?>