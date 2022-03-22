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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                   
                <div class="row mt-4">

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
                                                    Roles de usuarios (Creados)</div>
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
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
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
                                        <a href="orders-delivered.php">
                                            Pedidos entregados
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                             </div>
                        
                        <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Clientes con (Descuento)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query_discount = mysqli_query($conexion, "SELECT * FROM promotions");
                                                        $discount_count = mysqli_num_rows($query_discount);

                                                        echo $discount_count;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-tags fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-promotions.php">
                                            Clientes con descuento
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                             </div>


                             <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Facturas para (Clientes)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query_bills = mysqli_query($conexion, "SELECT * FROM bills");
                                                        $bills_count = mysqli_num_rows($query_bills);

                                                        echo $bills_count;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-invoices.php">
                                            Facturas
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                             </div>

                             <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Categorias de (Gastos)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query_categories = mysqli_query($conexion, "SELECT * FROM categories");
                                                        $result_categories = mysqli_num_rows($query_categories);

                                                        echo $result_categories;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-categories.php">
                                            Categorias
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>
                            
                </div>
            </div>


            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Categorias de (Ingresos)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query_categories_income = mysqli_query($conexion, "SELECT * FROM categories_income");
                                                        $result_categories_income = mysqli_num_rows($query_categories_income);

                                                        echo $result_categories_income;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="far fa-list-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-categories.php">
                                            Categorias
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Facturas por (Cobrar)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_status = mysqli_query($conexion, "SELECT * FROM bills INNER JOIN payment_status ON bills.id_user = payment_status.id_user AND payment_status.payment = 'Por cobrar'");
                                                        $result_status = mysqli_num_rows($search_status);

                                                        echo $result_status;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="invoices-receivable.php">
                                            Facturas por cobrar
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Facturas (Pagadas)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_status = mysqli_query($conexion, "SELECT * FROM bills INNER JOIN payment_status ON bills.id_user = payment_status.id_user AND payment_status.payment = 'Pagada'");
                                                        $result_status = mysqli_num_rows($search_status);

                                                        echo $result_status;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="bills-paid.php">
                                            Facturas Pagadas
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Facturas (Pagadas a Proveedores)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_status = mysqli_query($conexion, "SELECT * FROM bills_to_pay INNER JOIN payment_status_to_pay ON bills_to_pay.id_provider = payment_status_to_pay.id_provider AND payment_status_to_pay.payment = 'Pagada'");
                                                        $result_status = mysqli_num_rows($search_status);

                                                        echo $result_status;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fab fa-cc-amazon-pay fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="bills-to-paid.php">
                                            Facturas Pagadas
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Facturas por (Pagar a Proveedores)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_status = mysqli_query($conexion, "SELECT * FROM bills_to_pay INNER JOIN payment_status_to_pay ON bills_to_pay.id_provider = payment_status_to_pay.id_provider AND payment_status_to_pay.payment = 'Por pagar'");
                                                        $result_status = mysqli_num_rows($search_status);

                                                        echo $result_status;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comment-dollar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="bills-not-to-paid.php">
                                            Facturas por pagar
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Proveedores (Registrados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_providers = mysqli_query($conexion, "SELECT * FROM providers");
                                                        $result_providers = mysqli_num_rows($search_providers);

                                                        echo $result_providers;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-providers.php">
                                            Proveedores
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total de ingresos de (Corte de Caja)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $query_total_morning = mysqli_query($conexion, "SELECT * FROM cutbox_super");
                                                        $query_total_two = mysqli_query($conexion, "SELECT * FROM cutbox_ruta");
                                                        

                                                        $total = 0;
                                                        $total_two = 0;

                                            
                                                        while($rowRuta = mysqli_fetch_array($query_total_two)) {
                                                            $amount = $rowRuta['amount'];
                                                            $paymentServicesTwo = $rowRuta['payment_services_two'];

                                                            $total_ruta =  $amount + $paymentServicesTwo;
                                                        

                                                        while($row = mysqli_fetch_array($query_total_morning)) {
                                                            $closing_amount = $row['closing_amount'];
                                                            $payment_services = $row['payment_services'];

                                                            $total_cut = $closing_amount + $payment_services;
                                                    ?>
                                                    <?php 
                                                        $total_two+=$total_ruta;
                                                    }?>

                                                    <?php 
                                                       $total+=$total_cut;
                                                    }?>

                                                    <tr>
                                                        <th colspan='' class='text-center'>
                                                            <i class="fas fa-dollar-sign"></i>
                                                            <?php
                                                                $total_day = $total+=$total_two;

                                                                echo number_format($total_day, 2);
                                                            ?>
                                                        </th>
                                                    </tr> 
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    
                                </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                            <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Mis (Pedidos realizados)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_orders_my = mysqli_query($conexion, "SELECT * FROM orders_admin");
                                                        $result_orders_my = mysqli_num_rows($search_orders_my);

                                                        echo $result_orders_my;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-solid fa-bag-shopping fa-2x text-gray-300"></i>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <a href="show-all-orders-admin.php">
                                            Mis pedidos
                                            <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                        </a>
                                    </div>
                                </div>
                    </div>

                </div>
            </div>

            <h2 class="mt-4 d-flex justify-content-center text-dark">Administración de Gastos e Ingresos</h2>

            <div class="container p-4">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="card border-left-primary shadow h-100 py-5">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total de (Gastos)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                        include "./config/conexion.php";

                                        $query = mysqli_query($conexion, "SELECT * FROM gastos");
                                        
                                        $total_real = 0;
                                        
                                        while($row = mysqli_fetch_array($query)){
                                            $real = $row['amount'];
                                        ?>
                                       
                                            <?php
                                                $total_real+=$real;
                                            }
                                        ?>
	
                                       <tr>
                                            <th colspan='' class='text-center'>
                                                <i class="fas fa-dollar-sign"></i>
                                                <?php echo number_format($total_real, 2);?>
                                            </th>
                                        </tr> 

                                    </div>
                                </div>

                                <div class="col-auto">
                                    <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                                </div>

                            </div>

                            </div>

                            <div class="card-footer">
                                <a href="show-expenses-for-date.php">
                                    Grafica de gastos
                                    <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="card border-left-success shadow h-100 py-5">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total de (Ingresos)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php 
                                        include "./config/conexion.php";

                                        $query_incomes = mysqli_query($conexion, "SELECT * FROM ingresos");
                                        
                                        $total_real = 0;
                                        
                                        while($row = mysqli_fetch_array($query_incomes)){
                                            $real = $row['quantity'];
                                        ?>
                                        <!--<tr>
                                            <td class='text-center'><?php echo number_format($real, 2,'.','');?></td>
                                        </tr>-->
                                            <?php
                                                $total_real+=$real;
                                            }
                                        ?>
	
                                       <tr>
                                            <th colspan='' class='text-center'>
                                                <i class="fas fa-dollar-sign"></i>
                                                <?php echo number_format($total_real, 2);?>
                                            </th>
                                        </tr> 
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                                </div>

                            </div>

                            </div>

                            <div class="card-footer">
                                <a href="show-income-for-date.php">
                                    Grafica de ingresos
                                    <i class="fas fa-long-arrow-alt-right mr-2"></i>
                                </a>
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