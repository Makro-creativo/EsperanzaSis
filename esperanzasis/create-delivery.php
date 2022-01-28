<?php 
    include "./config/conexion.php"; 


    if(isset($_POST['click'])) {
        $id_purchase = $_POST['id_delivery'];
        $search_purchase = "SELECT * FROM orders purchaseid = '$purchaseid'";

        $hour_order_delivery = $_POST['hour_order_delivery'];

        $query_save_hour = "INSERT INTO delivery (purchaseid, hour_order_delivery) VALUES ('$id_purchase', NOW())";
        $result = mysqli_query($conexion, $query_save_hour);

        if(!$result) {
            die("No se pudo guardar la hora de entrega");
        }

        header("location: show-all-orders.php");

    }

?>