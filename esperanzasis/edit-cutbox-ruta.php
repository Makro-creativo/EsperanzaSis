<?php 
    include "./config/conexion.php";
    
    if(isset($_POST['editRuta'])) {
        $idCutRute = $_POST['id_cutbox_ruta'];
        $array = explode("_", $idCutRute);
        $idNameRute = $array[0];

        $openingDateTwo = $_POST['opening_date'];
        $personDeliveryTwo = $_POST['person_delivery'];
        $personReceiveTwo = $_POST['person_receive'];
        $turn = $_POST['turn'];
        $conceptTwo = $_POST['concept_two'];
        $amount = $_POST['amount'];
        //$paymentServicesTwo = $_POST['payment_services_two'];
        $notes = $_POST['notes'];
        $gastosSuper = $_POST['gastos_super'];
        $gastosTortilleria = $_POST['gastos_tortilleria'];
        $numberNoteRepartidor = $_POST['number_note_repartidor'];

        $query_update_rute = "UPDATE cutbox_ruta SET id_box='$idCutRute', opening_date='$openingDateTwo', person_delivery='$personDeliveryTwo', person_receive='$personReceiveTwo', turn='$turn', concept_two='$conceptTwo', amount='$amount', notes='$notes', gastos_super='$gastosSuper', gastos_tortilleria='$gastosTortilleria', number_note_repartidor='$numberNoteRepartidor' WHERE id_box = '$idCutRute'";
        mysqli_query($conexion, $query_update_rute);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <?php 
                    include "./config/conexion.php";
                    

                    if(isset($_GET['id_box'])) {
                        $idBoxRuta = $_GET['id_box'];

                        $search_cutbox_ruta = "SELECT * FROM cutbox_ruta WHERE id_box = '$idBoxRuta'";
                        $result_ruta = mysqli_query($conexion, $search_cutbox_ruta);

                        if($result_ruta) {
                            $row = mysqli_fetch_array($result_ruta);

                            $openingDateTwo = $row['opening_date'];
                            $personDeliveryTwo = $row['person_delivery'];
                            $personReceiveTwo = $row['person_receive'];
                            $turn = $row['turn'];
                            $conceptTwo = $row['concept_two'];
                            $amount = $row['amount'];
                            //$paymentServicesTwo = $row['payment_services_two'];
                            $notes = $row['notes'];
                            $gastosSuper = $row['gastos_super'];
                            $gastosTortilleria = $row['gastos_tortilleria'];
                            $numberNoteRepartidor = $row['number_note_repartidor'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Editar corte de repartidores</h2>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <form action="edit-cutbox-ruta.php" method="POST">
                                        <input type="hidden" value="<?php echo $idBoxRuta; ?>" name="id_cutbox_ruta">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input value="<?php echo $openingDateTwo; ?>" type="date" name="opening_date" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que entrega: </label>
                                                    <input value="<?php echo $personDeliveryTwo; ?>" type="text" name="person_delivery" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que recibe: </label>
                                                    <input value="<?php echo $personReceiveTwo; ?>" type="text" name="person_receive" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Tipo de ruta: </label>
                                                    <input type="text" value="<?php echo $turn; ?>" name="turn" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <input type="text" value="<?php echo $conceptTwo; ?>" name="concept_two" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Efectivo: </label>
                                                    <input type="text" value="<?php echo $amount; ?>" name="amount" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label>Nota de crédito: </label>
                                                    <input type="text" value="<?php echo $notes; ?>" name="notes" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de Súper: </label>
                                                    <input type="text" placeholder="Ejemplo: 4500, 5000, etc..." class="form-control" name="gastos_super" value="<?php echo $gastosSuper; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de Tortillería: </label>
                                                    <input type="text" placeholder="Ejemplo: 4500, 5000, etc..." class="form-control" name="gastos_tortilleria" value="<?php echo $gastosTortilleria; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de notas: </label>
                                                    <input type="text" placeholder="Ejemplo: 10, 20 etc..." class="form-control" name="number_note_repartidor" value="<?php echo $numberNoteRepartidor; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar corte" class="btn btn-success btn-block mt-4" name="editRuta">
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