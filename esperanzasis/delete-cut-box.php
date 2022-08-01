<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_box'])) {
        $idCutSuper = $_GET['id_box'];

        $query_delete = "DELETE FROM cutbox_super WHERE id_box = '$idCutSuper'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente el corte de caja, intente de nuevo...");
        }

        header("location: show-cut-box.php");
    }
?>