<?php 
    include "./config/conexion.php";

    if(isset($_POST['delete-between-month'])) {
        $dateStartAt = $_POST['date_start_at'];
        $dateEndAt = $_POST['date_end_at'];

        $query_delete_tempory = "UPDATE new_orders_admin SET status_deleted=1, deleted_at=NOW() WHERE date_send BETWEEN '$dateStartAt' AND '$dateEndAt'";
        $result_delete = mysqli_query($conexion, $query_delete_tempory);

        if($result_delete) {
            echo "<script>window.location='delete-orders-for-month.php?delete'; </script>";
        }
    }
?>