<?php 
    session_start();
    error_reporting(0);

    $typeUser = $_SESSION['Tipo'];

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
            $total = $row['total'];
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
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-around align-items-center">
                            <h2 class="mb-4">Detalles del pedido</h2>
                            <?php if($typeUser === "Administrador") {?>
                                <a href="show-all-orders.php" class="btn btn-success">
                                    <i class="fas fa-arrow-left"></i>
                                    Regresar atras
                                </a>
                            <?php }?>

                            <?php if($typeUser === "Cliente") {?>
                                <a href="show-sales.php" class="btn btn-success">
                                    <i class="fas fa-arrow-left"></i>
                                    Regresar atras
                                </a>
                            <?php }?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header">
                                    <div class="d-flex justify-content-around">
                                        <?php 
                                            include "./config/conexion.php";

                                            if(isset($_GET['id_user'])) {
                                                $id = $_GET['id_user'];

                                                $query = "SELECT * FROM users WHERE id_user = $id_user";
                                                $result = mysqli_query($conexion, $query);

                                                if($result) {
                                                    $row = mysqli_fetch_array($result);

                                                    $name = $row['name'];
                                                }
                                            }

                                        ?>
                                        <h5>Cliente: <b><?php echo $name; ?></b></h5>

                                        <span>Fecha: <?php echo date('Y-m-d h:i A', strtotime($date_purchase)) ?></span>
                                    </div>

                                </div>

                                <div class="card-body">
                                   <div class="row">
                                       
                                       

                                       
                                   </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="render-data">
                                            <thead>
                                                <th>Nombre del producto</th>
                                                <th>Cantidad</th>
                                                <th>Dirección de entrega</th>
                                                <th>Hora de entrega</th>
                                                <th>Fecha de entrega</th>
                                                <th>Persona que solicito pedido</th>
                                                <th>Comentario del cliente</th>
                                                <th>calificación</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                
                                                
                                                <th>Vaciar pedido</th>
                                            </thead>
                                           
                                        <tbody>
                                            <?php 
                                                include "./config/conexion.php";
                                                $id_pedido = $_GET['purchaseid'];

                                                //$query = "SELECT * FROM purchase_detail LEFT JOIN products ON products.productid=purchase_detail.productid WHERE purchaseid='".$row['purchaseid']."'";
                                                $query = "SELECT * FROM orders INNER JOIN purchase_detail ON orders.purchaseid = purchase_detail.purchaseid INNER JOIN products ON purchase_detail.productid = products.productid WHERE orders.id_user = '$uid' AND purchase_detail.purchaseid = '$id_pedido'";
                                                //$query = "SELECT * FROM orders LEFT JOIN purchase_detail ON orders.purchaseid = purchase_detail.purchaseid LEFT JOIN products ON purchase_detail.productid = products.productid WHERE orders.id_user = '$uid' AND purchase_detail.purchaseid = '$id_pedido'";
                                                $result = mysqli_query($conexion, $query);

                                                while($row = mysqli_fetch_array($result)) {
                                                    $idProduct = $row['productid']; //30
                                                    $priceNormal =  number_format($row['price'], 2);
                                                    $quantity = $row['quantity'];

                                                    //Buscar si es que existe un descuento
                                                    $searchData = "SELECT * FROM promotions WHERE productid='$idProduct' AND id_user = '$uid' ";
                                                    $result_price = mysqli_query($conexion, $searchData);
                                                                
                                                    $rowProductDiscount = mysqli_fetch_array($result_price);
                                                    $discountProduct = $rowProductDiscount['discount'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <i class="fas fa-dolly"></i>
                                                    <?php echo $row['name_product']; ?>
                                                </td> 
                                                <td>
                                                    <i class="fas fa-cart-plus"></i>
                                                    <?php echo $row['quantity'] ?> <?php echo $row['unidad']; ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-map-marked-alt"></i>
                                                    <?php echo $row['address_send']; ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-clock"></i>
                                                    <?php echo date('g:i A', strtotime(($row['hour_send']))); ?>
                                                </td>
                                                <td>
                                                    <i class="far fa-calendar-alt"></i>
                                                    <?php echo date("d/m/Y", strtotime($row['date_send'])); ?>
                                                </td>
                                                
                                                <td>
                                                    <i class="fas fa-user"></i>
                                                    <?php echo $row['people_order']; ?>
                                                </td>

                                                <td>
                                                    <i class="fas fa-comment-alt"></i>
                                                    <?php echo $row['comments']; ?>
                                                </td>

                                                <td>
                                                    <i class="fas fa-star"></i>
                                                    <?php echo $row['calification']; ?>
                                                </td>

                                                <td>
                                                    <i class="fas fa-dollar-sign"></i>
                                                    <?php 
                                                        if($discountProduct){
                                                            echo number_format($priceNormal, 2)-number_format($discountProduct, 2);
                                                        }else{
                                                            echo $priceNormal;
                                                        }
                                                    ?>
                                                </td>
                                                
                                                
                                                <td>
                                                    <i class="fas fa-money-check-alt"></i>
                                                    <?php 
                                                        if($discountProduct) {
                                                            $discountWithSubtotal = $priceNormal - $discountProduct;
                                                            
                                                            $subtotal = $quantity * $discountWithSubtotal;

                                                            echo number_format($subtotal, 2);
                                                        } else {
                                                            $total_original = $priceNormal * $quantity;

                                                            echo number_format($total_original, 2);
                                                        }
                                                    
                                                    ?>
                                                    
                                                </td>

                                                <td>
                                                    <a href="clear-order.php?purchaseid=<?php echo $row['purchaseid'] ?>" class="btn btn-info">
                                                        Editar pedido
                                                    </a>
                                                </td>
                                            
                                            </tr>
                                            
                                            
                                            
                                            <?php }?>
                                            
                                            
                                            <h3 class="text-dark font-weight-bold">
                                                TOTAL:
                                                <?php echo number_format($total, 2); ?>
                                            </h3>
                                        </tbody> 
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>

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

    <!-- Data tables for PDF -->

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#render-data').DataTable({
                rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
                "paging": true,
                "processing": true,
                
            dom: 'lBfrtip',
            buttons: [
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fas fa-file-pdf"></i>',
                    titleAttr: 'PDF',
                    className: "btn btn-primary"
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    titleAttr: 'PRINT',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'EXCEL',
                    className: 'btn btn-success'
                }
            ],
            
        });
    });

</script>

</body>
</html>