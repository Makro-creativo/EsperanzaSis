<?php 
    include "./config/conexion.php";

    if(isset($_POST['editStatus'])) {
        $idCustomerEdit = $_POST['edit_id_save_payment'];
        $paymentCustomer = $_POST['payment'];
        

        $query_update_status = "UPDATE payment_status SET id_user='$idCustomerEdit', payment='$paymentCustomer', created_at=NOW() WHERE id_user = '$idCustomerEdit'";
        $result_update_status = mysqli_query($conexion, $query_update_status);

        header("location: show-invoices.php");
    }

?>