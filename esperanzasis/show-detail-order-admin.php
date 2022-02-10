<?php 
    session_start();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <?php 
                    include "./config/conexion.php";

                    if(isset($_GET['purchaseid'])) {
                        $idOrder = $_GET['purchaseid'];

                        $query_purchaseid = "SELECT * FROM orders_admin";
                        $result_purchaseid = mysqli_query($conexion, $query_purchaseid);

                        if($result_purchaseid) {
                            $row = mysqli_fetch_array($result_purchaseid);

                            $purchaseid = $row['purchaseid'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Detalles del pedido</h2>
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex aling-items-center justify-content-between">
                                    <?php if($typeUser === "Administrador") {?>
                                        <h6 class="text-primary m-0">Mi pedido</h6>
                                    <?php }?>

                                    <?php if($typeUser === "Repartidor") {?>
                                        <h6 class="text-primary m-0">Pedido</h6>
                                    <?php }?>

                                    <a href="show-all-orders-admin.php" class="btn btn-secondary btn-sm">
                                        <i class="fa-solid fa-arrow-left mr-2"></i>
                                        Regresar
                                    </a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <?php if($typeUser === "Administrador") {?>
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-dark" href="show-ticket-admin.php?purchaseid=<?php echo $idOrder; ?>">
                                                        Ticket de compra
                                                    </a>
                                                </div>
                                            <?php }?>
                                            <br>

                                            <thead>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Dirección de entrega</th>
                                                <th>Hora de entrega</th>
                                                <th>Persona quién solicito pedido</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Total</th>
                                            </thead>

                                            <tbody> 
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $id_order = $_GET['purchaseid'];

                                                    $query_detail_order = "SELECT * FROM orders_admin INNER JOIN purchase_detail_admin ON orders_admin.purchaseid = purchase_detail_admin.purchaseid INNER JOIN products ON purchase_detail_admin.productid = products.productid AND purchase_detail_admin.purchaseid = '$id_order' AND id_user = 'Administrador'";
                                                    $result_detail_order = mysqli_query($conexion, $query_detail_order);

                                                    while($row = mysqli_fetch_array($result_detail_order)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_order']; ?></td>
                                                    <td><?php echo $row['name_product']; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                    <td><?php echo $row['address_send']; ?></td>
                                                    <td><?php echo date('h:i a', strtotime($row['hour_send'])); ?></td>
                                                    <td><?php echo $row['people_order']; ?></td>
                                                    <td><?php echo number_format($row['price'], 2); ?></td>
                                                    <td>
                                                        <?php 
                                                            $subtotal = $row['price'] * $row['quantity'];

                                                            echo number_format($subtotal, 2);
                                                        ?>
                                                    </td>

                                                    <td><?php echo number_format($row['total'], 2); ?></td>
                                                </tr>

                                                <?php }?>
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
            
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                        <?php if( $typeUser === "Repartidor") {?>
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <form action="create-delivery-admin.php" method="POST">
                                        <input type="hidden" value="<?php echo $idOrder; ?>" name="id_delivery_admin">

                                        <div class="form-group">
                                            <label class="text-center">Registrar hora y fecha de entrega del pedido: </label>
                                            <input type="hidden" class="form-control" name="hour_date_delivery">
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success mt-3" name="click">
                                                <i class="fas fa-clock"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php }?>
                    </div>

                    <!-- Card for print time of delivery -->
                    <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                        <?php 
                            include "./config/conexion.php";

                            $query_time = "SELECT * FROM delivery_order_admin WHERE purchaseid = '$idOrder'";
                            $result_query = mysqli_query($conexion, $query_time);

                            while($row = mysqli_fetch_array($result_query)) {
                        ?>
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <p class="text-center font-weight-bold text-dark">Hora y Fecha de entrega: <?php echo date('Y-m-d h:i A', strtotime(($row['hour_date_delivery']))); ?></p>
                            </div>
                        </div>

                        <?php }?>
                    </div>
                <!-- End print of tme delivery -->
                </div>
            </div>

            <br>
             
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

	<script>
		const table = $('#dataTable').DataTable({
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
			
		});
	</script>
</body>
</html>