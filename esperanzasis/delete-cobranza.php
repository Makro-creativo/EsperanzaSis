<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_cobranza'])) {
        $idCobranza = $_GET['id_cobranza'];

        $query_delete = "DELETE FROM cobranza WHERE id_cobranza = '$idCobranza'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if(!$result_delete) {
            die("No se pudo eliminar correctamente, intentelo de nuevo...");
        }

        header("location: show-cobranza.php");
    }
?>