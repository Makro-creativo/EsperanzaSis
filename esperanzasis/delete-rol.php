<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM users WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se pudo eliminar correctamente el usuario, verifique de nuevo la acción");
        }

        header("location: show-roles.php");
    }

?>