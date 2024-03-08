<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $id_client = $_GET['id'];

        $query_delete = "UPDATE clients SET status_deleted='1', deleted_at=NOW() WHERE id = '$id_client'";
        $result_delete = mysqli_query($conexion, $query_delete);

        if($result_delete) {
            echo "<script>window.location='show-clients.php?delete'; </script>";
        }
    }
?>