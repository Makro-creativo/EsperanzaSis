<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];

        $query_delete_purchase = "DELETE FROM orders WHERE purchaseid = '$purchaseid'";
        $result = mysqli_query($conexion, $query_delete_purchase);

        if(!$result) {
            die("No se pudo eliminar el pedido, verifique sus datos");
        }

        header("location: show-sales.php");
    }
?>