<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_customer'])) {
        $id_customer = $_GET['id_customer'];

        $query_delete_invoice = "DELETE FROM customers WHERE id_customer = '$id_customer'";
        $result_delete = mysqli_query($conexion, $query_delete_invoice);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente, por verifique nuevamente...");
        }

        header("location: show-customers.php");
    }

?>