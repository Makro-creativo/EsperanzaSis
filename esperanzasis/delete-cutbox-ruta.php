<?php 
    include "./config/conexion.php";
    
    if(isset($_GET['id_box'])) {
        $idBoxRute = $_GET['id_box'];

        $query_delete = "DELETE FROM cutbox_ruta WHERE id_box = '$idBoxRute'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente el corte, intentelo de nuevo...");
        }

        header("location: show-cut-box-repartidores.php");
    }

?>