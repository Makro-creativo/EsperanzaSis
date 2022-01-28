<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM orders WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se pudo eliminar el pedido");
        }

        header("location: new-order.php");
    }
?>