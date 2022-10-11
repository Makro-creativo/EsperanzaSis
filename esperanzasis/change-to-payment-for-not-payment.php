<?php 
    include "./config/conexion.php";


    if(isset($_POST['click'])) {
        $purchaseid = $_POST['order_id'];

        $query_change_status = "UPDATE status_payment SET order_id='$purchaseid', payment_status='Pagado' WHERE order_id = '$purchaseid'";
        $result_status_change = mysqli_query($conexion, $query_change_status);
        
        if($result_status_change) {
            echo "<script>window.location='show-all-orders-payables.php?success'; </script>";
        }
    }
?>