<?php 
    include "./config/conexion.php";

    if(isset($_GET['productid'])) {
        $productid = $_GET['productid'];

        $query_delete_promotion = "DELETE FROM promotions WHERE productid = '$productid'";
        $result_operation = mysqli_query($conexion, $query_delete_promotion);

        if(!$result_operation) {
            die("No se pudo eliminar el descuento, verifique nuevamente...");
        }

        header("location: show-promotions.php");
    }

?>