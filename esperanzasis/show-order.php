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
                    <?php if($typeUser === "Client") {?>
                        <h2 class="d-flex justify-content-start my-4">Pedido</h2>
                    <?php }?>

                    <?php if($typeUser === "Administrador") {?>
                        <h2 class="d-flex justify-content-start my-4">Pedido</h2>
                    <?php }?>

                    <div class="row">
                        <div class="col-md-12 col-m-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body">
                            
                                    <div class="card-header p-5">
                                    
                                        <strong>Pedido</strong> 
                                        <span class="float-right">
                                            <img src="assets/img/logo_tortilleria_la_esperanza.svg" alt="Logo tortilleria" style="width: 60px;">
                                        </span>
                                    </div>

                                    <div class="card-body">
                                    
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <h6 class="mb-3">Dirección la Esperanza</h6>
                                                <div>
                                                    <strong>Dirección</strong>
                                                </div>
                                                <div>Av. Paseo de la Prímavera 2195</div>
                                                <div>Col. Arenales Tapatios</div>
                                                <div>CP 45006, Zapopan, Jal.</div>
                                            </div>

                                            <div class="col-sm-6">
                                                <h6 class="mb-3">Teléfonos la Esperanza</h6>
                                                <div>
                                                    <strong>Teléfonos</strong>
                                                </div>
                                                <div>Teléfono fijo: (33) 3180 5555</div>
                                                <div>Whatsapp: (33) 1233 3924</div>
                                            </div>



                                        </div>
                                        <h5 class="text-center mt-4 text-dark font-weight-bold text-uppercase">Datos del pedido del cliente</h5>
                                            <div class="table-responsive-sm">
                                            <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">Id</th>
                                                <th>Producto</th>
                                                <th>Cliente</th>

                                                <th class="center">Cantidad</th>
                                                <th class="right">Fecha de envio</th>
                                                <th class="right">Hora de entrega</th>
                                                <th class="right">Dirección de envio</th>
                                                <th class="right">Recibe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include "./config/conexion.php";

                                                
                                                    $id = $_GET['id'];

                                                    $query = "SELECT * FROM orders WHERE id = $id";
                                                    $result = mysqli_query($conexion, $query);

                                                    while($row = mysqli_fetch_array($result)) {
                                                
                                            ?>

                                                
                                                <tr>
                                                    <td class="center"><?php echo $row['id']; ?></td>
                                                    <td class="left strong"><?php echo $row['product_name']; ?></td>
                                                    <td class="left"><?php echo $row['client_name']; ?></td>

                                                    
                                                    <td class="center"><?php echo $row['quantity_product']; ?></td>
                                                    <td class="right"><?php echo $row['date_send']; ?></td>
                                                    <td class="right"><?php echo $row['hour_send']; ?></td>
                                                    <td class="right"><?php echo $row['address_send']; ?></td>
                                                    <td class="right"><?php echo $row['people_order']; ?></td>
                                                </tr>
                                                
                                                <?php }?>
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-5">

                                            </div>

                                            <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                        <!--
                                        <tbody>
                                           
                                                <tr>
                                                    <td class="left">
                                                    <strong>Total</strong>
                                                </td>
                                                    <td class="right">
                                                    <strong></strong>
                                                </td>
                                                </tr>
                                                
                                            </tbody>
                                                    -->
                                        </table>

                                        </div>

                                        </div>

                                    </div>
                                   
                                    
                                    
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