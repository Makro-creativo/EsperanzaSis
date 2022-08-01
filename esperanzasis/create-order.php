<?php
    
    include "./config/conexion.php";

    if(isset($_POST['newOrder'])){
        $id_user = $_POST['id_user_active_order'];
        $nameClient = $_POST['name_order'];
        $addressSend = $_POST['address_send'];
        $dateSend = $_POST['date_send'];
        $hourSend = $_POST['hour_send'];
        $peopleOrder = $_POST['people_order'];
        $comments = $_POST['comments'];
        $nameDelivery = $_POST['name_delivery'];
        $statusPayment = $_POST['status_payment'];
        $noteCredito = $_POST['note_cobranza_credito'];
        $noteCreditoTwo = $_POST['note_cobranza_credito_two'];

        $arrayCheck = $_POST['productid'];
        $arrayQuantity = $_POST['quantity'];

        $tamanio =  sizeof($arrayCheck);
    
        //INSERTA ORDER
       
            $query_orders = "INSERT INTO orders_admin(id_user, name_order, address_send, date_send, hour_send, people_order, comments, name_delivery, date_purchase, status_payment, note_cobranza_credito, note_cobranza_credito_two) VALUES('$id_user', '$nameClient', '$addressSend', '$dateSend', '$hourSend', '$peopleOrder', '$comments', '$nameDelivery', NOW(), '$statusPayment', '$noteCredito', '$noteCreditoTwo')";
            $result_orders = mysqli_query($conexion, $query_orders);     

            //$pid = $conexion->insert_id;
            
            //RECORRRER CHECKBOX CON CANTIDAD DE PRODUCTO
            $total = 0;
            $total_neto = 0;   
            
        
        foreach ($arrayQuantity as $key => $value) {
            if( ($value !="") && ($arrayCheck[$key] !="") ){
                $array2 = $value;
                $array1 = $arrayCheck[$key];

                //CONSULT LAST ID ORDER
                $searchO = "SELECT * FROM orders_admin ORDER BY purchaseid DESC";
                $query_order = mysqli_query($conexion, $searchO);
                $row_order = mysqli_fetch_array($query_order);
                $pid = $row_order['purchaseid'];

            
                //echo "Valor de check: ".$array1." y el valor de input: ".$array2."<br>";
            $arr = explode("_", $array1);
            $id_product = $arr[0];
            $original_price = $arr[1];
            //$original_price = (float)$original_price;
            $quantity = $array2;
            $quantity = (float)$quantity;

            //Detalle de venta
            $query_purchase_detail = "INSERT INTO purchase_detail_admin (purchaseid, productid, quantity) VALUES ('$pid', '$id_product', '$quantity')";
			$result_purchase_detail = mysqli_query($conexion, $query_purchase_detail);
            
            //Validacion producto con o sin descuento
            $query_products = "SELECT * FROM products INNER JOIN promotions ON products.productid = promotions.productid INNER JOIN purchase_detail ON products.productid = purchase_detail.productid WHERE products.productid = '$id_product' AND promotions.id_user = '$id_user'";
		    $result_products = mysqli_query($conexion, $query_products);


            $products_contain_discount = mysqli_num_rows($result_products);
                
                if($products_contain_discount > 0) {
                    
                    //Operacion para productos con descuento
                    $row = mysqli_fetch_array($result_products);
                    $apply_discount = $row['discount']; //$5.00
                    $apply_discount = (float)$apply_discount;
                    $discountPartial = $original_price - $apply_discount;//5 por pz
                    $discountPartial = (float)$discountPartial;
                    $total = $quantity * $discountPartial; //8 * 5 = $40.00
                    //10
                }else{

                    //Operacion para productos sin descuento
                    $total = $original_price * $quantity; 

                }
                $total = (float)$total;
                $total_neto = $total_neto + $total; 
            }
        }

        $query_update_orders = "UPDATE orders_admin SET total='$total_neto' WHERE purchaseid = '$pid'";
	    $result_update_orders = mysqli_query($conexion, $query_update_orders);
 		
		header('location: show-all-orders-admin.php');	

    }else{
		?>
		<script>
			window.alert('Por favor selecciona un producto');
			window.location.href='new-order-admin.php';
		</script>
		<?php
	}
?>