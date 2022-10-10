<?php
	include "./config/conexion.php";

	if(!isset($_SESSION)) {
		session_start();
	}

	$uid = $_SESSION['UID'];

	$date = date("Y-m-d H:i:s");
	$nameClient = $_POST['name_client'];	
	$dateSend = $_POST['date_send'];
	$peopleOrder = $_POST['people_order'];
	$comments = $_POST['comments'];
	$statusPayment = $_POST['status_payment'];
	$numberNote = $_POST['note_cobranza_credito'];
	$numberNoteTwo = $_POST['note_cobranza_credito_two'];
	$totalVenta = $_POST['total_venta'];


	$sql = "INSERT INTO ordens_admin (date, id_user, name_client, date_send, comments, status_payment, note_cobranza_credito, note_cobranza_credito_two, monto) 
	VALUES ('$date', '$uid', '$nameClient', '$dateSend', '$comments', '$statusPayment', '$numberNote', '$numberNoteTwo', '$totalVenta');";
	$save = mysqli_query($conexion, $sql);

	$query = mysqli_query($conexion, "SELECT * FROM order_temporal ORDER BY id DESC");
	$items = 1;
	$suma = 0;

	while($row = mysqli_fetch_array($query)){
		$total = $row['quantity']*$row['price'];
		$total = number_format($total, 2);

		$searchO = "SELECT * FROM ordens_admin ORDER BY purchaseid DESC";
        $query_order = mysqli_query($conexion, $searchO);
		$row_order = mysqli_fetch_array($query_order);  	
		$pid = $row_order['purchaseid'];

		
		
		$items++;

		$detalle = "INSERT INTO details_ordens_admin(name_product, quantity, price, purchaseid, unidad) VALUES ('".$row['name_product']."', '".$row['quantity']."', '".$row['price']."', '".$pid."', '".$row['unidad']."');";
		$result_detalle = mysqli_query($conexion, $detalle);
		}

		$delete = mysqli_query($conexion, "DELETE FROM order_temporal");

		header("location: show-detail-order.php");

?>