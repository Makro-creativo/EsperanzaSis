<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];

        $query_clear_order = "DELETE FROM orders WHERE purchaseid = '$purchaseid'";
        $result = mysqli_query($conexion, $query_clear_order);
        
        if(!$result) {
            die("No se vaciar el pedido, verifique de nuevo por favor...");
        }

        header("location: new-order.php");
    }

?>