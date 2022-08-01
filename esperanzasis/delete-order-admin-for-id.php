<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $idOrder = $_GET['purchaseid'];

        $query_delete_order = "DELETE FROM ordens_admin WHERE purchaseid = '$idOrder'";
        $result_delete_order = mysqli_query($conexion, $query_delete_order);

        if(!$result_delete_order) {
            die("No se pudo eliminar correctamente el pedido, intentelo de nuevo...");
        }

        header("location: show-orders-admin-test.php");
    }
?>