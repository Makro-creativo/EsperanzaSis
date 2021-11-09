<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        $query = "DELETE FROM users WHERE id_user = $id_user";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("No se pudo eliminar correctamente el usuario, verifique de nuevo la acción");
        }

        header("location: show-roles.php");
    }

?>