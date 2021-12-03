<?php
	include('./config/conexion.php');
	
	
	if(isset($_POST['saveOrder'])){
        $id_user = $_POST['id_user_active'];
 
		$search_table_promotion = "SELECT id_user, discount FROM promotions WHERE id_user = '$id_user'";
		$query_discount_table = mysqli_query($conexion, $search_table_promotion);
		$rowDiscount = mysqli_fetch_array($query_discount_table);

		$discount = number_format($rowDiscount['discount'], 2);
		//$search = "SELECT * FROM clients WHERE id_user = '$id_user'";
		$search_clients = "SELECT name_client, address_fiscal FROM clients WHERE id_user = '$id_user'";
		$query_clients = mysqli_query($conexion, $search_clients);
		$rowClient = mysqli_fetch_array($query_clients);

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
	
		//Insercion de registro de orden de compra
		$query_orders = "INSERT INTO orders (id_user, client_name, address_send, date_send, hour_send, people_order, comments, calification, discount_order, date_purchase) VALUES ('$id_user','$nameClient', '$addressClient', '$date_send', '$hour_send', '$people_order', '$comments', '$calification', '$discount', NOW())";
		$result_orders = mysqli_query($conexion, $query_orders);
		
		$pid = $conexion->insert_id;
 
		$total = 0;
 
		foreach($_POST['productid'] as $product):
		$productInfo = explode("||",$product);
		$productid = $productInfo[0];
		$iterate = $productInfo[1];
		
		//Bucar producto si existe descuento
		$query_products = "SELECT * FROM products INNER JOIN promotions ON products.productid = promotions.productid INNER JOIN purchase_detail ON products.productid = purchase_detail.productid WHERE products.productid = '$productid' AND promotions.id_user = '$id_user' ";
		$result_products = mysqli_query($conexion, $query_products);

		$products_contain_discount = mysqli_num_rows($result_products);

		if($products_contain_discount > 0) {
			$row = mysqli_fetch_array($result_products);
 			if (isset($_POST['quantity_'.$iterate])){

				$query_purchase_detail = "INSERT INTO purchase_detail (purchaseid, productid, quantity) VALUES ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
				$result_purchase_detail = mysqli_query($conexion, $query_purchase_detail);

				//TOTAL DE LOS PRODUCTOS CON DESCUENTO
				$unit_price = $row['price']; //$10
				$apply_discount = $row['discount']; //$5.00
				//Traer cantidad de product
				$searchCount = "SELECT * FROM purchase_detail WHERE purchaseid = '$pid' ORDER BY pdid ASC";
				$queryCount = mysqli_query($conexion, $searchCount);
				$rowCount = mysqli_fetch_array($queryCount);
				
				$quantity_purchase = $rowCount['quantity']; //8

				$discountPartial = $unit_price - $apply_discount; //5 por pz
				$net_total = $quantity_purchase * $discountPartial; //8 * 5 = $40.00

				$subTotal = $rowCount['price']*$_POST['quantity_'.$iterate];

				$total+=$subTotal;
				
			} 

		} else { 
			$query_not_discount = "SELECT * FROM products WHERE productid = '$productid'";
			$result_not_discount = mysqli_query($conexion, $query_not_discount);
			$rowNotDiscount = mysqli_fetch_array($result_not_discount);
		
			if (isset($_POST['quantity_'.$iterate])){
				$price = $rowNotDiscount['price'];
				$quantity = $_POST['quantity_'.$iterate];
				//insertar cuantos se vendio (cantidad)
				$query_normal = "INSERT INTO purchase_detail (purchaseid, productid, quantity) VALUES ('$pid', '$productid', '$quantity')";
				$result_normal = mysqli_query($conexion, $query_normal);

				//Traer cantidad de product
				$searchCount = "SELECT * FROM purchase_detail WHERE purchaseid = '$pid' ORDER BY pdid DESC";
				$queryCount = mysqli_query($conexion, $searchCount);
				$rowCount = mysqli_fetch_array($queryCount);
				$idProduct = $rowCount['productid'];
				$requested_amount = $rowCount['quantity']; 

					//Buscar precio de producto
					$searchProduct = "SELECT * FROM products WHERE productid='$idProduct'";
					$queryProduct = mysqli_query($conexion, $searchProduct);

					$rowProduct = mysqli_fetch_array($queryProduct);
					$price_product = $rowProduct['price'];
					$net_total += $price_product * $requested_amount; //2 *10 = 20
			}
	 
		}

		endforeach;
 		
 		$query_update_orders = "UPDATE orders SET total='$net_total' WHERE purchaseid = '$pid'";
		$result_update_orders = mysqli_query($conexion, $query_update_orders);
 		
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