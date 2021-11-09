<?php 
    include "./config/conexion.php";

    if(isset($_GET['productid'])) {
        $productid = $_GET['productid'];

        echo $query = "DELETE FROM products WHERE productid = $productid";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se realizo correctamente la operación");
        }

        header("location: show-products.php");
    }
?>