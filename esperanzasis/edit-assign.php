<?php 
    include "./config/conexion.php";

    if(isset($_POST['edit'])) {
        $id = $_POST['id_assign'];
        $idProduct = $_POST['edit_id_name_product'];
        $idClient = $_POST['edit_id_name_client'];

        $query = "UPDATE assign_product SET product_id='$idProduct', client_id='$idClient', status_deleted='0', updated_at=NOW() WHERE id = '$id'";
        $result = mysqli_query($conexion, $query);

        if($result) {
            echo "<script>window.location='edit-assign.php?success'; </script>";
        }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="page-top">
    <div>
    <div id="wrapper">
        <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se actualizo correctamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-asign-product.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLateral.php" ?>

        <?php 
            include "./config/conexion.php";
                
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            }

            $search_id = "SELECT * FROM assign_product WHERE id = '$id'";
            $result = mysqli_query($conexion, $search_id);

            if($result) {
                $row = mysqli_fetch_array($result);

                $id = $row['id'];
                $productId = $row['product_id'];
                $clientId = $row['client_id'];
            }
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-around align-items-center">
                            <h2 class="mb-4">Editar Asignación Producto a Cliente</h2>
                            <a href="DashboardAdmin.php" class="btn btn-success">
                                <i class="fas fa-arrow-left"></i>
                                Regresar atras
                            </a>
                        </div>
                

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-header">Editar Asignación nuevo producto a cliente</div>

                                <div class="card-body">
                                    <form action="edit-assign.php" method="POST">
                                        <input type="hidden" name="id_assign" value="<?php echo $id; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Producto: </label>
                                                    <select name="edit_id_name_product" class="form-control">
                                                    <option selected disabled>Seleccionar producto</option>
                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $search_products = "SELECT * FROM products ORDER BY name_product DESC";
                                                            $result_products = mysqli_query($conexion, $search_products);

                                                            while($rowProducts = mysqli_fetch_array($result_products)) {
                                                                $idproduct = $rowProducts['id'];
                                                                $nameProduct = $rowProducts['name_product'];
                                                        ?>
                                                            <option value="<?php echo $idproduct; ?>"><?php echo $nameProduct; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Cliente: </label>
                                                    <select name="edit_id_name_client" class="form-control">
                                                        <option selected disabled>Seleccionar cliente</option>

                                                        <?php 
                                                            include "./config/conexion.php";

                                                            $search_clients = "SELECT * FROM clients ORDER BY name_client DESC";
                                                            $result_clients = mysqli_query($conexion, $search_clients);

                                                            while($rowClients = mysqli_fetch_array($result_clients)) {
                                                                $idClient = $rowClients['id'];
                                                                $nameClient = $rowClients['name_client'];
                                                        ?>
                                                            <option value="<?php echo $idClient; ?>"><?php echo $nameClient; ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-grid gap-2">
                                            <input type="submit" class="btn btn-outline-success mt-4" value="Actualizar" name="edit">
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

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