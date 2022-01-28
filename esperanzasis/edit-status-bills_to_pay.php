<?php 
    include "./config/conexion.php";

    if(isset($_POST['editStatus'])) {
        $idCustomerEdit = $_POST['edit_id_save_payment_to_pay'];
        $paymentCustomer = $_POST['payment'];
        

        $query_update_status = "UPDATE payment_status_to_pay SET id_provider='$idCustomerEdit', payment='$paymentCustomer', created_at=NOW() WHERE id_provider = '$idCustomerEdit'";
        $result_update_status = mysqli_query($conexion, $query_update_status);

        header("location: show-bills-to-pay.php");
    }

?>