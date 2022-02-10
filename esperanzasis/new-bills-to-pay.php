<?php 
    include "./config/conexion.php";

    if(isset($_POST['save'])) {
        $inforClientId = $_POST['info_client_id'];
        $array = explode("_", $inforClientId);
        $idClient = $array[0];
        $nameClient = $array[1];

        $amount = floatval($_POST['amount']);
        $iva = floatval($_POST['iva']);
        $concept = $_POST['concept'];
        $dateSaved = $_POST['date_saved'];
        $dateToPay = $_POST['date_to_pay'];

        $query_saved_bills = "INSERT INTO bills_to_pay(id_provider, name_customer, amount, iva, concept, date_saved, date_to_pay, date_bills_to_pay) VALUES('$idClient', '$nameClient', '$amount', '$iva', '$concept', '$dateSaved', '$dateToPay', NOW())";
        $result_bills = mysqli_query($conexion, $query_saved_bills);

        if(!$result_bills) {
            die("No se pudo guardar correctamente la factura, verifica de nuevo...");
        }

        header("location: show-bills-to-pay.php");
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

                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Capturar nuevo proveedor</h2>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">Nuevo proveedor</div>

                                <div class="card-body">
                                <form action="new-provider.php" method="POST">
                                        <div class="row">
                                        <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>DNI: </label>
                                                    <input type="text" placeholder="Ejemplo: 101, 102, 103, etc..." name="dni_provider" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre del proveedor: </label>
                                                    <input type="text" placeholder="Ejemplo: Leche lala, coca cola, etc..." name="name_provider" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección de la empresa: </label>
                                                    <input type="text" placeholder="Ejemplo: Gardines del bosque, etc..." name="adress" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Teléfono de contacto: </label>
                                                    <input type="tel" name="contact" placeholder="Ejemplo: 333 134 4567" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de celular: </label>
                                                    <input type="tel" name="number_cel" class="form-control" placeholder="Ejemplo: 33 135 4678">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha de registro: </label>
                                                    <input type="date" name="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>RFC: </label>
                                                    <input type="text" placeholder="Ejemplo: MELM8305281H0" class="form-control" name="rfc_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Giro de la empresa: </label>
                                                    <input type="text" placeholder="Mueblería, Ferretería, etc..." class="form-control" name="giro_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estatus del proveedor: </label>
                                                    <select name="status_provider" require required class="form-select">
                                                        <option selected disabled>Elije un opción</option>
                                                        <option value="Activo">Activo</option>
                                                        <option value="Inactivo">Inactivo</option>
                                                        <option value="Suspendido">Suspendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Código postal: </label>
                                                    <input type="text" placeholder="Ejemplo: 47910, etc..." class="form-control" name="code_postal">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Municipio: </label>
                                                    <input type="text" placeholder="Ejemplo: San pedro tlaquepaque, etc..." class="form-control" name="municipio_provider">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Correo electronico: </label>
                                                    <input type="email" name="email_provider" class="form-control" placeholder="Ejemplo: mail@gmail.com">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Guardar proveedor" class="btn btn-success btn-block" name="save">
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