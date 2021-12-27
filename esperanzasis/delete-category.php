<?php 
    include "./config/conexion.php";


    if(isset($_GET['id_category'])) {
        $idCategory = $_GET['id_category'];

        $query_delete_category = "DELETE FROM categories WHERE id_category = '$idCategory'";
        $result_delete_categories = mysqli_query($conexion, $query_delete_category);

        if(!$result_delete_categories) {
            die("No se pudo eliminar correctamente la categoría, intentelo de nuevo...");
        }

        header("location: show-categories.php");
    }
?>