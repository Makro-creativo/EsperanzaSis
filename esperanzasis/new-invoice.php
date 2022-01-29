<?php 
    include "./config/conexion.php";

    if(isset($_POST['saveBills'])) {
        $info_client_id = $_POST['info_client_id'];
        $array = explode("_", $info_client_id);
        $idClient = $array[0];
        $nameCustomer = $array[1];

        $amount = floatval($_POST['amount']);
        $iva = floatval($_POST['iva']   );
        $concept = $_POST['concept'];
        $date_saved = $_POST['date_saved'];
        $date_to_pay_bills = $_POST['date_to_pay_bills'];
        $invoiceNotes = $_POST['invoice_notes'];
        $numberNotes = $_POST['number_notes'];
        $date_bills = $_POST['date_bills'];

        $query_bills = "INSERT INTO bills(id_user, customer_name, amount, iva, concept, date_saved, date_to_pay_bills, invoice_notes, number_notes, date_bills) VALUES('$idClient', '$nameCustomer', '$amount', '$iva', '$concept', '$date_saved', '$date_to_pay_bills', '$invoiceNotes', '$numberNotes', NOW())";
        $result_bills = mysqli_query($conexion, $query_bills);

        if(!$result_bills) {
            die("No se pudo guardar correctamente la factura");
        }

        header("location: show-invoices.php");
    }

?>