<?php
	include('./config/conexion.php');
	
	if(isset($_POST['saveOrder'])){
 
		$query = "INSERT INTO orders (client_name, address_send, date_send, hour_send, people_order, date_purchase) VALUES ('$client_name', '$address_send', '$date_send', '$hour_send', '$people_order', NOW())";
		$result = mysqli_query($conexion, $query);
		
		$pid = $conexion->insert_id;
 
		$total=0;
 
		foreach($_POST['productid'] as $product):
		$proinfo = explode("||",$product);
		$productid = $proinfo[0];
		$iterate = $proinfo[1];

		$query = "SELECT * FROM product WHERE productid='$productid'";
		$result = mysqli_query($conexion, $query);
		
		$row = mysqli_fetch_array($result);
		
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt = $row['price']*$_POST['quantity_'.$iterate];
			$total+=$subt;

			$sql="INSERT INTO purchase_detail (purchaseid, productid, quantity) values ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
			$conexion->query($sql);
		}
		endforeach;
 		
 		$sql="UPDATE purchase set total='$total' where purchaseid='$pid'";
 		$conexion->query($sql);
		header('location:sales.php');		
	}
	else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='order.php';
		</script>
		<?php
	}
?>