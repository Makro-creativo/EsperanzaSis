<?php 
    include "./config/conexion.php";

    if(isset($_POST['editProduct'])) {
        $id_product = $_POST['id_product_edit'];
        $name_product = $_POST['name_product'];
        $price = number_format($_POST['price'], 2);
        $unidad = $_POST['unidad'];
        
        $query_update = "UPDATE products SET name_product='$name_product', price='$price', unidad='$unidad', status_deleted='0', updated_at=NOW() WHERE id = '$id_product'";
        $result_update = mysqli_query($conexion, $query_update);

        if($result_update) {
            echo "<script>window.location='edit-product.php?success'; </script>";
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
</head>
<body id="page-top">
    <div id="wrapper">
        <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se actualizo correctamente el producto!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-products.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <?php 
                    if(isset($_GET['id'])) {
                        $idClient = $_GET['id'];
                    }

                    $search_client_for_id = "SELECT * FROM clients WHERE id = '$idClient'";
                    $result_client_for_id = mysqli_query($conexion, $search_client_for_id);

                    if($result_client_for_id) {
                        $row = mysqli_fetch_array($result_client_for_id);

                        $id_client = $row['id'];
                    }
                ?>

                <?php
                    if(isset($_GET['id'])) {
                        $productid = $_GET['id'];
                    }
                    
                    $query = "SELECT * FROM products WHERE id = $productid";
                        $result = mysqli_query($conexion, $query);
                
                        if($result) {
                            $row = mysqli_fetch_array($result);
                
                            $name_product = $row['name_product'];
                            $price = $row['price'];
                            $unidad = $row['unidad'];
                        }
                ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Editar producto</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg">
                                <div class="card-header">Editar producto</div>
                                
                                <div class="card-body">
                                    <form action="edit-product.php" method="POST">
                                    <input type="hidden" name="id_product_edit" value="<?php echo $productid; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Editar nombre del producto: </label>
                                                    <input type="text" autocomplete="off" name="name_product" placeholder="Editar nombre del producto" class="form-control" value="<?php echo $name_product; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Editar precio: </label>
                                                    <input type="text" name="price" class="form-control" autocomplete="off" value="<?php echo number_format($row['price'], 2); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label>Editar Tipo de Unidad: </label>
                                                    <input type="text" placeholder="Ejemplo: Bolsas, Kilos, etc..." class="form-control" name="unidad" value="<?php echo $unidad; ?>">
                                                </div>
                                            </div>
                                        </div>
                        

                                        <div class="d-grid gap-2">
                                            <input type="submit" value="Editar" class="btn btn-outline-success mt-4" name="editProduct">
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