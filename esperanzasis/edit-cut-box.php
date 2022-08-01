<?php 
    include "./config/conexion.php";

    if(isset($_POST['editCut'])) {
        $idCutSuper = $_POST['id_cut_super'];
        $array = explode("_", $idCutSuper);
        $idNameSuper = $array[0];

        $openingDate = $_POST['opening_date'];
        $personDelivery = $_POST['person_delivery'];
        $personReceive = $_POST['person_receive'];
        $turn = $_POST['turn'];
        $concept = $_POST['concept'];
        $closingAmount = $_POST['closing_amount'];
        $paymentServices = $_POST['payment_services'];
        $numberNotes = $_POST['number_notes'];
        $gastosSuper = $_POST['gastos_super'];
        $gastosTortilleria =$_POST['gastos_tortilleria'];
        $recargas = $_POST['recargas'];

        $query_update = "UPDATE cutbox_super SET id_box='$idCutSuper', opening_date='$openingDate', person_delivery='$personDelivery', person_receive='$personReceive', turn='$turn', concept='$concept', closing_amount='$closingAmount', payment_services='$paymentServices', number_notes='$numberNotes', gastos_super='$gastosSuper', gastos_tortilleria='$gastosTortilleria', recargas='$recargas' WHERE id_box = '$idCutSuper'";
        mysqli_query($conexion, $query_update);

        header("location: show-cut-box.php");
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=l, initial-scale=1.0">
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
                        $idBox = $_GET['id_box'];

                        $search_data = "SELECT * FROM cutbox_super WHERE id_box = '$idBox'";
                        $result = mysqli_query($conexion, $search_data);

                        if($result) {
                            $row = mysqli_fetch_array($result);

                            $openingDate = $row['opening_date'];
                            $personDelivery = $row['person_delivery'];
                            $personReceive = $row['person_receive'];
                            $turn = $row['turn'];
                            $concept = $row['concept'];
                            $closingAmount = $row['closing_amount'];
                            $paymentServices = $row['payment_services'];
                            $numberNotes = $row['number_notes'];
                            $gastosSuper = $row['gastos_super'];
                            $gastosTortilleria = $row['gastos_tortilleria'];
                            $recargas = $row['recargas'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Editar corte de caja súper</h2>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <form action="edit-cut-box.php" method="POST">
                                        <input type="hidden" name="id_cut_super" value="<?php echo $idBox; ?>">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input value="<?php echo $openingDate; ?>" type="date" name="opening_date" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que entrego: </label>
                                                    <input type="text" value="<?php echo $personDelivery; ?>" name="person_delivery" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Persona que recibio: </label>
                                                    <input type="text" value="<?php echo $personReceive; ?>" name="person_receive" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Turno: </label>
                                                    <input type="text" value="<?php echo $turn; ?>" name="turn" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Concepto: </label>
                                                    <input type="text" value="<?php echo $concept; ?>" name="concept" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Efectivo: </label>
                                                    <input type="text" value="<?php echo $closingAmount; ?>" name="closing_amount" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Bauchers: </label>
                                                    <input type="text" value="<?php echo $paymentServices; ?>" name="payment_services" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Tickets: </label>
                                                    <input type="text" value="<?php echo $numberNotes; ?>" name="number_notes" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de súper: </label>
                                                    <input type="text" placeholder="Ejemplo: 4500, 2500, etc..." class="form-control" name="gastos_super" value="<?php echo $gastosSuper; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Gastos de tortillería: </label>
                                                    <input type="text" placeholder="Ejemplo: 4500, 2500, etc..." class="form-control" name="gastos_tortilleria" value="<?php echo $gastosTortilleria; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Recargas: </label>
                                                    <input type="text" placeholder="Ejemplo: 4500, 2500, etc..." class="form-control" name="recargas" value="<?php echo $recargas; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar corte" class="btn btn-success btn-block mt-4" name="editCut">
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