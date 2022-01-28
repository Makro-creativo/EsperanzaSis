<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query_delete_inbox = "DELETE FROM notifications WHERE id = '$id'";
        $result_delete_inbox = mysqli_query($conexion, $query_delete_inbox);

        if(!$result_delete_inbox) {
            die("No se pudo eliminar correctamente el mensaje, intentelo de nuevo...");
        }

        header("location: new-inbox.php");
    }

?>