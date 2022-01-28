<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_provider'])) {
        $idProvider = $_GET['id_provider'];

        $query_delete_provider = "DELETE FROM providers WHERE id_provider = '$idProvider'";
        $result_deleted = mysqli_query($conexion, $query_delete_provider);

        if(!$result_deleted) {
            die("No se pudo eliminar correctamente el proveedor");
        }

        header("location: show-providers.php");
    }

?>