<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Tipo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_tortilleria_la_esperanza.svg">
    <title>EsperaznzaSis</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body class="page-top">
    <div id="wrapper">

        <?php   
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se guardo correctamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-all-orders-payments.php";
                });
            </script>
        <?php } ?>
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                            <p class="text-primary text-center p-3">Exportar a excel entre fechas</p>
                                <div class="card-body">
                                    <form method="POST" class="form" action="report-order-payables.php">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" name="date1" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" name="date2" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <input type="submit" name="generate-report" value="Descargar" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="container">
                    <div class="row">
                        <h2 class="d-flex justify-content-start mb-4">Pedidos por pagar</h2>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Fecha de entrega</th>
                                                    <th>Comentarios</th>
                                                    <th>Número de nota</th>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Pago</th>
                                                    <?php }?>
                                            
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Detalle del pedido</th>
                                                    <?php }?>

                                                    <?php  if($typeUser === "Administrador") {?>
                                                        <th>Cambiar a pagado</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_orders_to_credito = "SELECT * FROM ordens_admin INNER JOIN status_payment_orders ON ordens_admin.purchaseid = status_payment_orders.order_id WHERE payment_status = 'Por pagar'";
                                                    $result_orders_to_credito = mysqli_query($conexion, $search_orders_to_credito);

                                                    while($row = mysqli_fetch_array($result_orders_to_credito)) {
                                                        $noteOne = $row['note_cobranza_credito'];
                                                        $noteTwo = $row['note_cobranza_credito_two'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_client']; ?></td>
                                                    <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
                                                    <td><?php echo $row['comments']; ?></td>
                            
                                                    <td>
                                                        <?php
                                                            if(!$noteOne) {
                                                                echo $noteTwo;
                                                            } else {
                                                                echo $noteOne;
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center">
                                                            <span class="badge bg-danger">
                                                                <?php echo $row['payment_status']; ?> <i class="fa-solid fa-money-check-dollar"></i>
                                                            </span>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center"> 
                                                            <a href="show-detail-order.php?purchaseid=<?php echo $row['purchaseid']; ?>" class="btn btn-primary btn-sm">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td class="text-center">
                                                            <form action="change-to-payment-for-not-payment.php" method="POST">
                                                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">

                                                                <button type="submit" class="btn btn-success" name="click">
                                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    <?php }?>

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

    <!-- Scripts for buttons for export to excel -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

	<script>
		const table = $('#dataTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'EXCEL',
                    className: 'btn btn-success'
                }
            ],
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