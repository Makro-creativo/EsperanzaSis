<?php 
    include "./config/conexion.php";

    if(isset($_GET['purchaseid'])) {
        $purchaseid = $_GET['purchaseid'];

        $query = "SELECT * FROM orders WHERE purchaseid = $purchaseid";
        $result = mysqli_query($conexion, $query);

        if($result) {
            $row = mysqli_fetch_array($result);
            
            $client_name = $row['client_name'];
            $address_send = $row['address_send'];
            $date_send = $row['date_send'];
            $hour_send = $row['hour_send'];
            $people_order = $row['people_order'];
            $date_purchase = $row['date_purchase'];
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <h2 class="d-flex justify-content-start mb-4">Detalles del pedido</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    <div class="d-flex justify-content-around">
                                        <h5>Cliente: <b><?php echo $client_name; ?></b></h5>

                                        <span>Fecha: <?php echo date('M d, Y h:i A', strtotime($date_purchase)) ?></span>
                                    </div>

                                </div>

                                <div class="card-body">
                                   <div class="row">
                                       
                                       <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xx-3">      
                                            <p>
                                                <?php echo $address_send; ?>
                                            </p>
                                       </div>

                                       <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xx-3">
                                           <p>
                                             <?php echo $date_send; ?>
                                           </p>
                                       </div>

                                       <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xx-3">
                                           <p>
                                             <?php echo date('h:i A', strtotime(($hour_send))); ?>
                                           </p>
                                       </div>

                                       <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3 col-xx-3">
                                           <p>
                                               <?php echo $people_order; ?>
                                           </p>
                                       </div>

                                       
                                   </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Nombre del producto</th> - <th>Cantidad</th>
                                                <th>Dirección de envío</th>
                                                <th>Hora de envío</th>
                                                <th>Fecha de envío</th>
                                                <th>Persona que solicito pedido</th>
                                            </thead>
                                        </table>
                                        <tbody>
                                            <?php 
                                                include "./config/conexion.php";

                                                $query = "SELECT * FROM purchase_detail LEFT JOIN products ON products.productid=purchase_detail.productid WHERE purchaseid='".$row['purchaseid']."'";
                                                $result = mysqli_query($conexion, $query);

                                                while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                Producto: <?php echo $row['name_product']; ?> <br>
                                                Cantidad: <?php echo $row['quantity']; ?>
                                                
                                            </tr>

                                            <?php }?>
                                        </tbody>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include "./partials/footer.php"  ?>

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