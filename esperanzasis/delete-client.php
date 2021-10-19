<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM clients WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No pudimos eliminar correctamente el cliente, verifique de nuevo");
        }

        header("location: show-clients.php");
    }
?>