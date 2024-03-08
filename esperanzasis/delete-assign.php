<?php 
    include "./config/conexion.php";

    if(isset($_GET['product_id'])) {
        $idProduct = $_GET['product_id'];

        $query_delete = "UPDATE assign_product SET status_deleted='1', deleted_at=NOW() WHERE product_id = '$idProduct'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if($result_delete) {
            echo "<script>window.location='show-asign-product.php?delete'; </script>";
        }
    }
?>