<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        $query = "DELETE FROM clients WHERE id_user = $id_user";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No pudimos eliminar correctamente el cliente, verifique de nuevo");
        }

        header("location: show-clients.php");
    }
?>