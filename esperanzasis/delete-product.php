<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM products WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se realizo correctamente la operación");
        }

        header("location: show-products.php");
    }
?>