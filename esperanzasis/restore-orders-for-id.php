<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];

        $query_restore_order = "UPDATE ordens_admin SET delete_tempory=0, deleted_at=NULL WHERE purchaseid = '$purchaseid'";
        $result_restore_order = mysqli_query($conexion, $query_restore_order);

        if($result_restore_order) {
            echo "<script>window.location='show-orders-deleted_temporarily.php?delete'; </script>";
        }
    }
?>