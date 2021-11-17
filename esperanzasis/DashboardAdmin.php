<?php 
    session_start();
    error_reporting(0);

    $typeUser = $_SESSION['Tipo'];
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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

            <!-- Content -->
            <div class="container">
            <h2 class="text-dark d-flex justify-content-start mb-4">Panel de Control</h2>
                <div class="row">

                        <div class="col-xl-3 col-lg-3 col-xxl-3 col-sm-12 col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Productos (Registrados)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $query = mysqli_query($conexion, "SELECT * FROM products");

                                                    $products_count = mysqli_num_rows($query);

                                                    echo $products_count;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                        <a href="show-products.php">
                                            Ver lista de productos
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                        
                        
                            <div class="col-xl-3 col-lg-3 col-xxl-3 col-sm-12 col-md-3 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Clientes (Registrados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php  
                                                        include "./config/conexion.php";

                                                        $query = mysqli_query($conexion, "SELECT * FROM clients");

                                                        $clients_count = mysqli_num_rows($query);

                                                        echo $clients_count;
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="show-clients.php">
                                            Ver lista de clientes
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-xxl-3 col-sm-12 col-md-3 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Pedidos (Realizados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $status_pedido = $_GET['status_pedido'];

                                                        $query = mysqli_query($conexion, "SELECT * FROM orders");

                                                        $orders_count = mysqli_num_rows($query);

                                                        echo $orders_count;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-all-orders.php">
                                            Ver lista de todos los pedidos
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-xxl-3 col-sm-12 col-md-3 mb-4">
                                <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Roles de usuario (Creados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query = mysqli_query($conexion, "SELECT * FROM users WHERE Tipo != 'SuperAdmin'");

                                                        $users_count = mysqli_num_rows($query);

                                                        echo $users_count;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-roles.php">
                                            lista de roles de usuario
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        
                </div>
            </div>

            <div class="container">
                <div class="row">
                <div class="col-xl-3 col-lg-3 col-xxl-3 col-sm-12 col-md-3 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Pedidos (Entregados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $status_pedido = $_GET['status_pedido'];

                                                        $query = mysqli_query($conexion, "SELECT * FROM orders WHERE status_pedido = '1'");

                                                        $orders_delivery = mysqli_num_rows($query);

                                                        echo $orders_delivery;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-truck fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-all-orders.php">
                                            Pedidos entregados
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>
</html>