<?php 
    include "./config/conexion.php"; 


    if(isset($_POST['click'])) {
        $id_purchase = $_POST['id_delivery_admin'];
        $search_purchase = "SELECT * FROM orders_admin purchaseid = '$purchaseid'";

        $hour_date_delivery = $_POST['hour_date_delivery'];

        $query_save_hour = "INSERT INTO delivery_order_admin (purchaseid, hour_date_delivery) VALUES ('$id_purchase', NOW())";
        $result = mysqli_query($conexion, $query_save_hour);

        if(!$result) {
            die("No se pudo guardar la hora de entrega");
        }

        header("location: show-all-orders-admin.php");

    }

?>