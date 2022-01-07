<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_provider'])) {
        $id_provider = $row['id_provider'];
    }

    if(isset($_POST['saveStatus'])) {
        $idProvider = $_POST['id_save_payment'];
        $searchCustomer = "SELECT * FROM bills_to_pay WHERE id_provider = '$id_provider'";

        $payment = $_POST['payment'];

        $query_status_payment = "INSERT INTO payment_status_to_pay(id_provider, payment, created_at) VALUES('$idProvider', '$payment', NOW())";
        $result_payment = mysqli_query($conexion, $query_status_payment);

        if(!$result_payment) {
            die("No se pudo guardar correctamente los datos, verifique de nuevo...");
        }

        header("location: show-bills-to-pay.php");
       
    }

?>