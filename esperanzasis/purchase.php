<?php
	include('./config/conexion.php');
	
	
	if(isset($_POST['saveOrder'])){
        $id_user = $_POST['id_user_active'];

		$search_table_promotion = "SELECT discount FROM promotions WHERE id_user = '$id_user'";
		$query_discount_table = mysqli_query($conexion, $search_table_promotion);
		$rowDiscount = mysqli_fetch_array($query_discount_table);

		$discount = $rowDiscount['discount'];

		//$search = "SELECT * FROM clients WHERE id_user = '$id_user'";
		$search = "SELECT name_client, address_fiscal FROM clients WHERE id_user = '$id_user'";
		$queryS = mysqli_query($conexion, $search);
		$rowClient = mysqli_fetch_array($queryS);

		$nameClient = $rowClient['name_client'];
		$addressClient = $rowClient['address_fiscal'];
		
		//$client_name = $_POST['name_cliente'];
        //$address_send = $_POST['address_send'];
        $quantity_product = $_POST['quantity_product'];
        $date_send = $_POST['date_send'];
        $hour_send = $_POST['hour_send'];
        $people_order = $_POST['people_order'];
		$comments = $_POST['comments'];
		$calification = $_POST['calification'];
	
 
		$query = "INSERT INTO orders (id_user, client_name, address_send, date_send, hour_send, people_order, comments, calification, discount_order, date_purchase) VALUES ('$id_user','$nameClient', '$addressClient', '$date_send', '$hour_send', '$people_order', '$comments', '$calification', '$discount', NOW())";
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

			$total-=$discount;
			

			$query = "INSERT INTO purchase_detail (purchaseid, productid, quantity) VALUES ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
			$result = mysqli_query($conexion, $query);
		}
		endforeach;
 		
 		$query = "UPDATE orders SET total='$total' WHERE purchaseid='$pid'";
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