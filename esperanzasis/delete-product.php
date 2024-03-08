<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $productid = $_GET['id'];

        $query_delete = "UPDATE products SET status_deleted='1', deleted_at=NOW() WHERE id = '$productid'";
        $result = mysqli_query($conexion, $query_delete);

        if($result) {
            echo "<script>window.location='show-products.php?delete'; </script>";
        }
    }
?>