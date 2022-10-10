<?php 
    include "./config/conexion.php";

    if(isset($_POST['save'])) {
        $idOrder = $_POST['order_id'];
        $paymentStatus = $_POST['payment_status'];

        $query_insert = "INSERT INTO status_payment(order_id, payment_status, created_at) VALUES('$idOrder', '$paymentStatus', NOW())";
        $result_insert = mysqli_query($conexion, $query_insert);

        if($result_insert) {
            echo "<script>window.location='show-orders-admin-test.php?success'; </script>";
        }
    }
?>