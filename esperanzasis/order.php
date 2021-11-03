<?php
  	include "./config/conexion.php";

	$query = "SELECT * FROM product order by productid asc limit 1";
	
	$result = mysqli_query($conexion, $query);
	$row = mysqli_fetch_array($result);
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
						<h2 class="d-flex justify-content-start mb-4">Crear nuevo pedido</h2>
						<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card shadow-lg">
								<div class="card-body">
								<form method="POST" action="purchase.php">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<th class="text-center"><input type="checkbox" id="checkAll"></th>
											<th>Nombre del producto</th>
											<th>Cantidad</th>
										</thead>
										<tbody>
											<?php 
												$query = "SELECT * FROM product";
												$result = mysqli_query($conexion, $query);
												
												$iterate=0;

												while($row = mysqli_fetch_array($result)){
													?>
													<tr>
														<td class="text-center"><input type="checkbox" value="<?php echo $row['productid']; ?>||<?php echo $iterate; ?>" name="productid[]" style=""></td>
														<td><?php echo $row['productname']; ?></td>
														<td><input type="text" class="form-control" name="quantity_<?php echo $iterate; ?>"></td>
													</tr>
													<?php
													$iterate++;
												}
											?>
										</tbody>
									</table>
								</div>

								<div class="row">
									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<div class="form-group">
											<?php  
												include "./config/conexion.php";

												$query = mysqli_query($conexion, "SELECT * FROM clients");
											?>

											<label>Seleccionar el cliente: </label>
											<select name="client_name" name="tipo" require class="form-select">
												<option selected disabled>Seleccionar cliente</option>
													<?php 
														while($row = mysqli_fetch_array($query)) {
															$name_client = $row['name_client'];
														}
													?>

												<option value="<?php echo $name_client; ?>"><?php echo $name_client; ?></option>
											</select>
										</div>
									</div>

									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<div class="form-group">
											<label>Dirección de envió: </label>
											<input type="text" name="address_send" placeholder="Ejemplo: Avenida los Arcos #345" class="form-control">
										</div>
									</div>

									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<div class="form-group">
											<label>Fecha de envío: </label>
											<input type="date" name="date_send" class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
										<div class="form-group">
											<label>Hora de entrega: </label>
											<input type="time" name="hour_send" class="form-control">
										</div>
									</div>

									<div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
										<div class="form-group">
											<label>Nombre a quien va el pedido: </label>
											<input type="text" name="people_send" placeholder="Ejemplo: Maria Rodriguez Hernandez..." class="form-control">
										</div>
									</div>
								</div>

								<div class="d-grid-gap-2">
									<input type="submit" value="Enviar pedido" class="btn btn-outline-success" name="saveOrder">
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

	<script type="text/javascript">
		$(document).ready(function(){
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		});
	</script>
</body>
</html>