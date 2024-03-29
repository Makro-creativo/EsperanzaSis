<?php 
    include "./config/conexion.php";
    
    if(isset($_POST['editBills'])) {
        $id_customer = $_POST['info_client_id_edit'];
        $name_customer = $_POST['customer_name'];
        $amount = floatval($_POST['amount']);
        $iva = number_format($_POST['iva'], 2);
        $concept = $_POST['concept'];
        $date_saved = $_POST['date_saved'];
        $invoiceNotes = $_POST['invoice_notes'];
        $numberNotes = $_POST['number_notes'];
        $date_to_pay_bills = $_POST['date_to_pay_bills'];

        $query_update_bills = "UPDATE bills SET customer_name='$name_customer', amount='$amount', iva='$iva', concept='$concept', date_saved='$date_saved', invoice_notes='$invoiceNotes', number_notes='$numberNotes', date_to_pay_bills='$date_to_pay_bills' WHERE id_user = '$id_customer'";
        $result_update_bills = mysqli_query($conexion, $query_update_bills);

        header("location: show-invoices.php");
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <title>EsperanzaSis</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <?php 
                    include "./config/conexion.php";

                    if(isset($_GET['id_user'])) {
                        $id_customer = $_GET['id_user'];
                    }

                    $query_search_customer = "SELECT * FROM bills WHERE id_user = '$id_customer'";
                    $result_search_customer = mysqli_query($conexion, $query_search_customer);
                    
                    if($result_search_customer) {
                        $row = mysqli_fetch_array($result_search_customer);

                        $customer_name = $row['customer_name'];
                        $amount = $row['amount'];
                        $iva = $row['iva'];
                        $concept = $row['concept'];
                        $date_saved = $row['date_saved'];
                        $invoiceNotes = $row['invoice_notes'];
                        $numberNotes = $row['number_notes'];
                        $date_to_pay_bills = $row['date_to_pay_bills'];
                    }
                ?>

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Editar Factura</h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">Editar factura</div>

                                <div class="card-body">
                                <form action="edit-invoice.php" method="POST">
                                    <input type="hidden" name="info_client_id_edit" value="<?php echo $id_customer; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Elejir cliente: </label>
                                                    <select name="customer_name" require class="form-select">
                                                        <option selected disabled>Seleccionar cliente</option>
                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $query_customer_update = "SELECT * FROM clients ORDER BY name_client ASC";
                                                            $result_customers_update = mysqli_query($conexion, $query_customer_update);

                                                            while($row = mysqli_fetch_array($result_customers_update)) {
                                                                $name_customer = $row['name_client'];
                                                        ?>
                                                        
                                                        <option value="<?php echo $name_customer; ?>"><?php echo $name_customer; ?></option>

                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Monto: </label>
                                                    <input value="<?php echo $amount; ?>" type="text" name="amount" class="form-control" placeholder="Ejemplo: 1500">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Iva: </label>
                                                    <input value="<?php echo $iva; ?>" type="text" name="iva" class="form-control" placeholder="Ejemplo: 0.5">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <input value="<?php echo $concept; ?>" type="text" name="concept" class="form-control" placeholder="Ejemplo: Describir servicio, producto, etc...">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha de la factura: </label>
                                                    <input value="<?php echo $date_saved; ?>" type="date" name="date_saved" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Fecha de pago de factura: </label>
                                                    <input value="<?php echo $date_to_pay_bills; ?>" type="date" name="date_to_pay_bills" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Eligir opción: </label>
                                                    <select name="invoice_notes" require required class="form-select">
                                                        <option disabled selected>Selecciona una opción</option>
                                                        <option value="Notas" <?php if($invoiceNotes == "Notas"){?> selected <?php } ?>>Notas</option>
                                                        <option value="Factura" <?php if($numberNotes == "Factura"){?> selected <?php } ?>>Factura</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de nota o factura: </label>
                                                    <input value="<?php echo $numberNotes; ?>" type="text" name="number_notes" class="form-control" placeholder="Ejemplo: 456789, etc...">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Editar factura" class="btn btn-success btn-block" name="editBills">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "./partials/footer.php" ?>

        </div>

    </div>






    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Data tables -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>
</html>