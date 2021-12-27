<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query_delete_expense = "DELETE FROM gastos WHERE id = '$id'";
        $result_expense_delete = mysqli_query($conexion, $query_delete_expense);

        if(!$result_expense_delete) {
            die("No se pudo eliminar correctamente, intente de nuevo");
        }

        header("location: show-expenses.php");
    }
?>