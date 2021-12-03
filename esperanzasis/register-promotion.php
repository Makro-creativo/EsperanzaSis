<?php
	include('./config/conexion.php');
	
	
	if(isset($_POST['savedDiscount'])){
        $id_user = $_POST['id_user_promotion'];
        $array = explode("_", $id_user);
        $idClient = $array[0];
        $nameClient = $array[1];


        
        foreach($_POST['productid'] as $product):
            $productInfo = explode("||",$product);
            $productid = $productInfo[0];
            $iterate = $productInfo[1];
    
            $query_products = "SELECT * FROM products WHERE productid = '$productid'";
        endforeach;

		
		$search_clients = "SELECT name_client, id_user FROM clients WHERE id_user = '$id_user'";
		$querySearch = mysqli_query($conexion, $search_clients);
		$rowClient = mysqli_fetch_array($querySearch);

		$nameClient = $rowClient['name_client'];
		$idClient = $rowClient['id_user'];
        $discount = number_format($_POST['discount'], 2);
	
 
		$query_promotion = "INSERT INTO promotions (productid, id_user, name_user, discount) VALUES ('$productid', '$idClient', '$nameClient', '$discount')";
		$result_promotion = mysqli_query($conexion, $query_promotion);
		
        if(!$result_promotion) {
            die("No se pudo crear el descuento, intente de nuevo...");
        }
 		
		header('location: show-promotions.php');		
	}
?>