<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $id_customer = $row['id_user'];
    }

    if(isset($_POST['saveStatus'])) {
        $idCustomer = $_POST['id_save_payment'];
        $searchCustomer = "SELECT * FROM bills WHERE id_user = '$id_customer'";

        $payment = $_POST['payment'];

        $query_status_payment = "INSERT INTO payment_status(id_user, payment, created_at) VALUES('$idCustomer', '$payment', NOW())";
        $result_payment = mysqli_query($conexion, $query_status_payment);

        if(!$result_payment) {
            die("No se pudo guardar correctamente los datos, verifique de nuevo...");
        }

        header("location: show-invoices.php");
       
    }

?>