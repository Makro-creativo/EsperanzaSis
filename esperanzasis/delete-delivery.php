<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $idUser = $_GET['id_user'];

        $query_delete = "DELETE FROM delivery_man WHERE id_user = '$idUser'";
        $result = mysqli_query($conexion, $query_delete);

        if(!$result) {
            die("No se pudo eliminar correctamente el repartidor, intentelo de nuevo...");
        }

        header("location: show-deliveries-man.php");
    }
?>