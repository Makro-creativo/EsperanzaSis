<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query_delete_incomes = "DELETE FROM ingresos WHERE id = '$id'";
        $result_delete_incomes = mysqli_query($conexion, $query_delete_incomes);

        if(!$result_delete_incomes) {
            die("No se pudo eliminar correctamente, intenta de nuevo...");
        }

        header("location: show-incomes.php");
    }
?>