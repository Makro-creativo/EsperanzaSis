<?php 
    include "./config/conexion.php";

    if(isset($_POST['save'])) { 

        //$search_id = "SELECT id_box FROM cutbox_super";

        // Info table super
        $openingDate = $_POST['opening_date'];
        $personDelivery = $_POST['person_delivery'];
        $personReceive = $_POST['person_receive'];
        $turn = $_POST['turn'];
        $concept = $_POST['concept'];
        $closingAmount = $_POST['closing_amount'];
        //$paymentServices = $_POST['payment_services'];
        $numberNotes = $_POST['number_notes'];

        // info table tortillería
        $conceptTwo = $_POST['concept_two'];
        $amount = $_POST['amount'];
        $paymentServicesTwo = $_POST['payment_services_two'];
        $notes = $_POST['notes'];
        $gastosSuperRepartidor = $_POST['gastos_super'];
        $gastosTortilleria = $_POST['gastos_tortilleria'];
        $numberNoteRepartidor = $_POST['number_note_repartidor'];

        //$query_save_cut_box = "INSERT INTO cutbox_super(opening_date, person_delivery, person_receive, turn, concept, closing_amount, payment_services, number_notes) VALUES('$openingDate', '$personDelivery', '$personReceive', '$turn', '$concept', '$closingAmount', '$paymentServices', '$numberNotes')";
        $query_save_cut_box_two = "INSERT INTO cutbox_ruta(opening_date, person_delivery, person_receive, turn, concept_two, amount, notes, gastos_super, gastos_tortilleria, number_note_repartidor) VALUES('$openingDate', '$personDelivery', '$personReceive', '$turn', '$conceptTwo', '$amount', '$notes', '$gastosSuperRepartidor', '$gastosTortilleria', '$numberNoteRepartidor')";

        //$result_one = mysqli_query($conexion, $query_save_cut_box);
        $result_two = mysqli_query($conexion, $query_save_cut_box_two);
        
        if(!$result_two) {
            die("No se pudo guardar el corte de caja correctamente, intentelo de nuevo...");
        }

        header("location: show-cut-box-repartidores.php");

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        .border-top {
            border-top: 3px solid #4e73df !important;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Repartidores </h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg border-top">
                                <div class="card-body">
                                    <form action="new-cut-box-repartidores.php" method="POST">
                                        <h6 class="text-center mt-4 text-primary">Concepto Ruta</h6>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input type="date" name="opening_date" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que entrega: </label>
                                                    <input type="text" placeholder="Fatima, Rigo camejo, etc..." name="person_delivery" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que recibe: </label>
                                                    <input type="text" placeholder="Rigo camejo, Hector, etc..." name="person_receive" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <select name="concept_two" require required class="form-select">
                                                        <option selected value="Ruta">Ruta</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Efectivo: </label>
                                                    <input type="text" placeholder="Ejemplo: 6000, 4500, etc.." class="form-control" name="amount">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Nota de crédito: </label>
                                                    <input name="notes" type="text" placeholder="Ejemplo: 0589, 1234 etc..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-group">
                                                    <label>Número de notas: </label>
                                                    <input type="text" placeholder="Ejemplo: 20, 10, etc..." class="form-control" name="number_note_repartidor">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Tipo de Ruta: </label>
                                                    <select name="turn" require required class="form-select">
                                                        <option selected disabled>Seleccionar Ruta</option>
                                                        <option value="Venta">Venta</option>
                                                        <option value="Cobranza">Cobranza</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de súper: </label>
                                                    <input type="text" placeholder="Ejemplo: 5000, 6500, etc..." class="form-control" name="gastos_super">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de tortillería: </label>
                                                    <input type="text" placeholder="Ejemplo: 5000, 6500, etc..." class="form-control" name="gastos_tortilleria">
                                                </div>
                                            </div>
                                        </div>


                                        <input type="submit" value="Registar corte" class="btn btn-success btn-block" name="save">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>

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