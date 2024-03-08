<?php 
    include "./config/conexion.php";

    if(isset($_POST['save'])) {
        $orderid = $_POST['idOrder'];
        $paymentStatus = $_POST['payment_status'];

        $query_insert = "INSERT INTO status_payment_order_for_id(order_id, payment_status, created_at) VALUES('$orderid', '$paymentStatus', NOW())";
        $result_insert = mysqli_query($conexion, $query_insert);

        if($result_insert) {
            header("location: show-change-status-client-for-id-order.php?id=$orderid");
        }
    }
?>