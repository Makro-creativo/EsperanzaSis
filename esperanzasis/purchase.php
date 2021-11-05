<?php
	include('./config/conexion.php');
	
	if(isset($_POST['saveOrder'])){
        $client_name = $_POST['name_client'];
        $address_send = $_POST['address_send'];
        $quantity_product = $_POST['quantity_product'];
        $date_send = $_POST['date_send'];
        $hour_send = $_POST['hour_send'];
        $people_order = $_POST['people_order'];
 
		$query = "INSERT INTO orders (client_name, address_send, date_send, hour_send, people_order, date_purchase) VALUES ('$client_name', '$address_send', '$date_send', '$hour_send', '$people_order', NOW())";
		$result = mysqli_query($conexion, $query);
		
		$pid = $conexion->insert_id;
 
		$total = 0;
 
		foreach($_POST['productid'] as $product):
		$productInfo = explode("||",$product);
		$productid = $productInfo[0];
		$iterate = $productInfo[1];

		$query = "SELECT * FROM products WHERE productid='$productid'";
		$result = mysqli_query($conexion, $query);
		
		$row = mysqli_fetch_array($result);
		
 
		if (isset($_POST['quantity_'.$iterate])){
			$subTotal = $row['price'] * $_POST['quantity_'.$iterate];
			$total+=$subTotal;

			$query = "INSERT INTO purchase_detail (purchaseid, productid, quantity) VALUES ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
			$result = mysqli_query($conexion, $query);
		}
		endforeach;
 		
 		$query = "UPDATE purchase SET total='$total' WHERE purchaseid='$pid'";
		$result = mysqli_query($conexion, $query);
 		
		

		header('location: show-sales.php');		
	}
	else{
		?>
		<script>
			window.alert('Por favor selecciona un producto');
			window.location.href='new-order.php';
		</script>
		<?php
	}
?>