<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_customer'])) {
        $id_customer = $_GET['id_customer'];

        $query_delete = "DELETE FROM bills WHERE id_customer = '$id_customer'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente...");
        }
        
        header("location: show-invoices.php");
    }

?>