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
    <link rel="stylesheet" href="assets/css/orders.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLateral.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/header.php" ?>

                <div class="container">
                    <div class="row">
                        <?php if($typeUser === "Administrador") {?>
                            <h2 class="d-flex justify-content-start mb-4">Mis pedidos</h2>
                        <?php }?>

                        <?php if($typeUser === "Repartidor") {?>
                            <h2 class="d-flex justify-content-start mb-4">Pedidos</h2>
                        <?php }?>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex aling-items-center justify-content-between">
                                    <?php if($typeUser === "Administrador") {?>
                                        <h6 class="text-primary fw-bold m-0">Lista de mis pedidos</h6>
                                    <?php }?>

                                    <?php if($typeUser === "Repartidor") {?>
                                        <h6 class="text-primary fw-bold m-0">Lista de pedidos</h6>
                                    <?php }?>
                                    
                                    <?php if($typeUser === "Administrador") {?>
                                        <a href="new-order-admin.php" class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-circle-plus mr-2"></i>
                                            Nuevo pedido
                                        </a>
                                    <?php }?>

                                    <?php if($typeUser === "Repartidor") {?>
                                        <a href="DashboardRepartidor.php" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-house mr-2"></i>
                                            Regresar a inicio
                                        </a>
                                    <?php }?>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Cliente</th>
                                                <th>Dirección de envío</th>
                                                <th>Fecha de envío</th>
                                                <th>Hora de envío</th>
                                                <th>Persona quién realizo pedido</th>
                                                <th>Comentarios</th>
                                                <th>Calificación</th>
                                                <th>Detalles del pedido</th>
                                                <th>Estatus de entrega</th>
                                            </thead>

                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $query_order_admin = "SELECT * FROM orders_admin";
                                                    $result_order_admin = mysqli_query($conexion, $query_order_admin);

                                                    while($row = mysqli_fetch_array($result_order_admin)) {
                                                        $purchaseid = $row['purchaseid'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name_order']; ?></td>
                                                    <td><?php echo $row['address_send']; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($row['date_send'])); ?></td>
                                                    <td><?php echo date('h:i a', strtotime($row['hour_send'])); ?></td>
                                                    <td><?php echo $row['people_order']; ?></td>
                                                    <td><?php echo $row['comments']; ?></td>
                                                    <td><?php echo $row['calification']; ?></td>

                                                    <td>
                                                        <input type="hidden" name="id_pedido" value="<?php echo $purchaseid; ?>">
                                                        <a class="btn btn-primary" href="show-detail-order-admin.php?purchaseid=<?php echo $row['purchaseid']; ?>">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </td>

													<td>
														<?php 
															if($row['status_order'] == "1") 
																echo "<a href=desactivate-admin.php?purchaseid=".$row['purchaseid']." class='btn-status green'>Entregado</a>";
															else 
																echo "<a href=activate-admin.php?purchaseid=".$row['purchaseid']." class='btn-status red'>Sin entregar</a>";
														?>
													</td>
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