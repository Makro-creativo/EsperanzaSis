<?php
  	include "./config/conexion.php";
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
						<h2 class="d-flex justify-content-start">Crear nuevo pedido</h2>
						<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
							<div class="card shadow-lg">
								<div class="card-body">
								<form method="POST" action="purchase.php" enctype="multipart/form-data">
									<input type="hidden" name="id_user_active" value="<?php echo $uid; ?>">
								<div class="table-responsive">
								<table class="table">
										<thead>
											<th>Nombre del producto</th>
											<th>Tipo de Unidad</th>
											<th>Cantidad</th>
											<th>Precio</th>
										
											<th>Descuento</th>
										
										</thead>
										<tbody>
											<?php
												$query = "SELECT * FROM products WHERE price != '' AND unidad != ''";
												$result = mysqli_query($conexion, $query);
												
												$iterate=0;

												while($row = mysqli_fetch_array($result)){ 
													$idProduct = $row['productid']; //30
                                                    $priceNormal =  number_format($row['price'], 2);

                                                    //Buscar si es que existe un descuento
                                                    $searchData = "SELECT * FROM promotions WHERE productid='$idProduct' AND id_user = '$uid' ";
                                                    $result_price = mysqli_query($conexion, $searchData);
                                                                
                                                    $rowProductDiscount = mysqli_fetch_array($result_price);
                                                    $discountProduct = $rowProductDiscount['discount'];
												?>
													<tr>
														<!--<td required class="text-center"><input type="checkbox" value="<?php //echo $row['productid']; ?>||<?php //echo $iterate; ?>" name="productid[]" style=""></td>-->
														<!--<td required class="text-center"><input type="checkbox" value="<?php echo $row['productid']."_".$row['price']; ?>" name="productid[]" style=""></td>-->
														<td><?php echo $row['name_product']; ?></td>

														<td><?php echo $row['unidad']; ?></td>

														<td>
															<input placeholder="Agregar cantidad del producto: 0" type="text" class="form-control" autocomplete="off" name="quantity[]">
															<input type="hidden" value="<?php echo $row['productid']."_".$row['price']; ?>" name="productid[]">
															<!--<input placeholder="Agregar cantidad del producto: 0" type="text" class="form-control" autocomplete="off" name="quantity">-->
														</td>

														<td>
															<?php echo number_format($row['price'], 2); ?>		
														</td>

														<td>
															<?php 
																if($discountProduct) {
																	echo number_format($discountProduct);
																} else {
																	$priceNormal;
																}
															?>
														</td>
														
													</tr>
													<?php
													$iterate++;
												}
											?>
										</tbody>
									</table>
								</div>


								<div class="row">
									
									
								</div>

								<div class="row">
									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<div class="form-group">
											<label>Hora de entrega: </label>
											<input type="time" name="hour_send" class="form-control" required>
										</div>
									</div>

									<div class="col-md-4 col-sm-12 col-lg-4 colxl-4 col-xxl-4">
										<div class="form-group">
											<label>Persona que va recibir el pedido: </label>
											<input type="text" name="people_order" required autocomplete="off" placeholder="Ejemplo: Maria Rodriguez Hernandez..." class="form-control" required>
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
									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<label>Comentarios del cliente: </label>
										<textarea name="comments" rows="4" class="form-control" placeholder="Ejemplo: La recepción es en la cocina o preguntar por el chef, etc..." autocomplete="off" required></textarea>
									</div>

									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<label>Califica nuestro servicio: </label>
										<select name="calification" require class="form-select">
											<option selected disabled>Elija una calificación</option>
											<option value="1 estrella">1 estrella</option>
											<option value="2 estrellas">2 estrellas</option>
											<option value="3 estrellas">3 estrellas</option>
											<option value="4 estrellas">4 estrellas</option>
											<option value="5 estrellas">5 estrellas</option>
										</select>
									</div>

									<div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
										<div class="form-group">
											<label>Estatus de pago: </label>
											<select onChange="showStatusPayment(this.value);" name="status_payment_client" require required class="form-select">
												<option selected disabled>Selecciona una opción</option>
												<option value="Credito">A Credito</option>
												<option value="Contado">A Contado</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" id="Credito" style="display: none;">
										<div class="form-group">
											<label>Número de nota: </label>
											<input type="text" placeholder="Ejemplo: 040456, etc..." name="number_note" class="form-control">
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-3" id="Contado" style="display: none;">
										<div class="form-group">
											<label>Número de nota: </label>
											<input type="text" placeholder="Ejemplo: 040458, etc..." name="number_note_two" class="form-control">
										</div>
									</div>
								</div>

								<div class="d-grid-gap-2 d-flex justify-content-end mt-3">
									<button type="submit" class="btn btn-outline-success" name="saveOrder">
										Enviar pedido
										<i class="fas fa-paper-plane"></i>
									</button>
								</div>
							</form>
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

	<script type="text/javascript">
		$(document).ready(function(){
			$("#checkAll").click(function(){
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		});
	</script>

	<script>
		function showStatusPayment(id) {
			if(id === "Credito") {
				$("#Credito").show();
				$("#Contado").hide();
			}

			if(id === "Contado") {
				$("#Credito").hide();
				$("#Contado").show();
			}
		}
	</script>
</body>
</html>