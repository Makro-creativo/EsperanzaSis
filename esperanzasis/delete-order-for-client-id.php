<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $idOrder = $_GET['id'];

        $query_delete = "UPDATE new_orders_admin SET status_deleted='1', deleted_at=NOW() WHERE id = '$idOrder'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if($result_delete) {
            echo "<script>window.location='show-new-orders-admin.php?delete'; </script>";
        }
    }
?>