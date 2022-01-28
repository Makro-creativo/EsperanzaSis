<?php 
    include "./config/conexion.php";
    
    if(isset($_GET['id_provider'])) {
        $id_provider = $_GET['id_provider'];

        $query_delete_bills = "DELETE FROM bills_to_pay WHERE id_provider = '$id_provider'";
        $result_delete = mysqli_query($conexion, $query_delete_bills);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente la factura...");
        }

        header("location: show-bills-to-pay.php");
    }
?>