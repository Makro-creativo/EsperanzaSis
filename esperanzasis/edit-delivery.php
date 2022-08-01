<?php 
    include "./config/conexion.php";

    if(isset($_POST['edit'])) {
        $idUser = $_POST['id_delivery_man'];
        $name = $_POST['name'];
        $lastName = $_POST['last_name'];
        $adress = $_POST['adress'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        $query_edit = "UPDATE delivery_man SET name='$name', last_name='$lastName', adress='$adress', phone='$phone', status='$status' WHERE id_user = '$idUser'";
        $result = mysqli_query($conexion, $query_edit);

        header("location: show-deliveries-man.php");
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

                    if(isset($_GET['id_user'])) {
                        $idUser = $_GET['id_user'];

                        $search_edit_delivery = "SELECT * FROM delivery_man WHERE id_user = '$idUser'";
                        $result_edit_delivery = mysqli_query($conexion, $search_edit_delivery);

                        if($result_edit_delivery) {
                            $row = mysqli_fetch_array($result_edit_delivery);

                            $name = $row['name'];
                            $lastName = $row['last_name'];
                            $adress = $row['adress'];
                            $phone = $row['phone'];
                            $status = $row['status'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Editar repartidor</h2>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    Editar repartidor
                                </div>

                                <div class="card-body">
                                    <form action="edit-delivery.php" method="POST">
                                        <input type="hidden" value="<?php echo $idUser; ?>" name="id_delivery_man">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombres: </label>
                                                    <input value="<?php echo $name; ?>" type="text" placeholder="Ejemplo: Jose luis, etc..." name="name" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Apellidos: </label>
                                                    <input value="<?php echo $lastName; ?>" type="text" placeholder="Ejemplo: Rodriguez Hernandez, etc..." name="last_name" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección: </label>
                                                    <input value="<?php echo $adress; ?>" type="text" placeholder="Ejemplo: Avenida los arcos #235, etc..." name="adress" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de teléfono o celular: </label>
                                                    <input value="<?php echo $phone; ?>" type="text" placeholder="Ejemplo: 3331 123 456, etc..." name="phone" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estatus: </label>
                                                    <select name="status" require required class="form-select">
                                                        <option disabled selected>Seleccionar opción</option>
                                                        <option value="Activo" <?php if($status == "Activo"){?> selected <?php } ?>>Activo</option>
                                                        <option value="Inactivo" <?php if($status == "Inactivo"){?> selected <?php } ?>>Inactivo</option>
                                                        <option value="Suspendido" <?php if($status == "Suspendido"){?> selected <?php } ?>>Suspendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar" class="btn btn-success btn-block mt-3" name="edit">
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