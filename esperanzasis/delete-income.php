<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_categories'])) {
        $idCategories = $_GET['id_categories'];

        $query_delete_income = "DELETE FROM categories_income WHERE id_categories = '$idCategories'";
        $result_delete = mysqli_query($conexion, $query_delete_income);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente la categoría, intentelo de nuevo...");
        }

        header("location: show-categories-income.php");
    }
?>