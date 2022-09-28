<?php 
    include "./config/conexion.php";

    if(isset($_POST['changesStatus'])) {
        $purchaseid = $_POST['id_credito'];

        $query_update = "UPDATE ordens_admin SET status_payment='contado' WHERE purchaseid = '$purchaseid'";
        $result = mysqli_query($conexion, $query_update);

        if($result) {
            echo "<script>window.location='show-all-orders-credito.php?bien'; </script>";
        }
    }
?>