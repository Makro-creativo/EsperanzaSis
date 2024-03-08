<?php 
    include "./config/conexion.php";

    if(isset($_POST['changesStatus'])) {
        $purchaseid = $_POST['id_credito'];

        $query_update = "UPDATE new_orders_admin SET status_payment='contado' WHERE id = '$purchaseid'";
        $result = mysqli_query($conexion, $query_update);

        if($result) {
            echo "<script>window.location='show-all-orders-credito.php?bien'; </script>";
        }
    }
?>