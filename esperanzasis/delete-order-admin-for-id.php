<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $idOrder = $_GET['purchaseid'];

        $query_delete_order_temporarily = "UPDATE ordens_admin SET delete_tempory=1, deleted_at=NOW() WHERE purchaseid = '$idOrder'";
        $result_delete_order = mysqli_query($conexion, $query_delete_order_temporarily);

        if($result_delete_order) {
            echo "<script>window.location='show-orders-admin-test.php?delete'; </script>";
        }
    }
?>