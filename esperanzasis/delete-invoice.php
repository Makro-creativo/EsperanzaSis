<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $id_customer = $_GET['id_user'];

        $query_delete = "DELETE FROM bills WHERE id_user = '$id_customer'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente...");
        }
        
        header("location: show-invoices.php");
    }

?>