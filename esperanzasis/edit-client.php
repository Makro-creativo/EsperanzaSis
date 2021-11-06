<?php 
    include "./config/conexion.php";

    if(isset($_GET["id"])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM clients WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if($result) {
            $row = mysqli_fetch_array($result);

            $name_client = $row['name_client'];
            $address_fiscal = $row['address_fiscal'];
            $name_company = $row['name_company'];
            $address_company = $row['address_company'];
            $giro_company = $row['giro_company'];
            $rfc = $row['rfc'];
            $manager_payments = $row['manager_payments'];
            $activate = $row['activate'];
            $tel = $row['tel'];
            $cel = $row['cel'];
            $email = $row['email'];
        }
    }

    if(isset($_POST['editClient'])) {
        $name_client = $_POST['name_client'];
        $address_fiscal = $_POST['address_fiscal'];
        $name_company = $_POST['name_company'];
        $address_company = $_POST['address_company'];
        $giro_company = $_POST['giro_company'];
        $rfc = $_POST['rfc'];
        $manager_payments = $_POST['manager_payments'];
        $activate = $_POST['activate'];
        $tel = $_POST['tel'];
        $cel = $_POST['cel'];
        $email = $_POST['email'];

        $query_update = "UPDATE clients SET name_client='$name_client', address_fiscal='$address_fiscal', name_company='$name_company', address_company='$address_company', giro_company='$giro_company', rfc='$rfc', manager_payments='$manager_payments', activate='$activate', tel='$tel', cel='$cel', email='$email'";
        mysqli_query($conexion, $query_update);

        header("location: show-clients.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
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
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Editar cliente</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg mb-4">
                                <div class="card-header">Editar cliente</div>

                                <div class="card-body">
                                    <form action="edit-client.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Editar nombre del cliente: </label>
                                                    <input type="text" placeholder="Editar nombre del cliente" name="name_client" value="<?php echo $name_client ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <label>Editar Dirección Fiscal: </label>
                                                <input type="text" class="form-control" name="address_fiscal" value="<?php echo $address_fiscal; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre de la empresa: </label>
                                                    <input type="text" value="<?php echo $name_company; ?>" class="form-control" name="name_company" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección de la empres: </label>
                                                    <input type="text" value="<?php echo $address_company; ?>" class="form-control" name="address_company" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Giro de la empresa: </label>
                                                    <input type="text" value="<?php echo $giro_company; ?>" class="form-control" name="giro_company" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Editar RFC: </label>
                                                    <input type="text" value="<?php echo $rfc; ?>" class="form-control" name="rfc" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Encargado de compras: </label>
                                                    <input type="text" value="<?php echo $manager_payments; ?>" class="form-control" name="manager_payments" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estado: </label>
                                                    <select name="activate" require class="form-select">
                                                        <option selected disabled>Elije una opción</option>
                                                        <option value="Activo" <?php if($activate == "Activo"){?> selected <?php } ?>>Activo</option>
                                                        <option value="Inactivo" <?php if($activate == "Inactivo"){?> selected <?php } ?>>Inactivo</option>
                                                        <option value="Suspendido" <?php if($activate == "Suspendido"){?> selected <?php } ?>>Suspendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de teléfono: </label>
                                                    <input type="text" value="<?php echo $tel; ?>" name="tel" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de celular: </label>
                                                    <input type="text" value="<?php echo $cel; ?>" name="cel" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Correo electronico: </label>
                                                    <input type="email" value="<?php echo $email; ?>" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Editar" class="btn btn-outline-success mt-4" name="editClient">
                                        </div>
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