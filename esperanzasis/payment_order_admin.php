<?php
	include "./config/conexion.php";

	$sql_count = mysqli_query($conexion, "SELECT * FROM order_temporal");
	$count = mysqli_num_rows($sql_count);
	if ($count == 0) {
        echo "<script>alert('No hay productos agregados a la orden')</script>";
        echo "<script>window.close();</script>";
        exit;
	}
	
	//Variables por GET
	$nameClient = $_GET['name_client'];
	$condiciones = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['adress_send'], ENT_QUOTES)));
	
	

	//Fin de variables por GET
	$sql = mysqli_query($conexion, "SELECT LAST_INSERT_ID(id) AS LAST FROM ordenes ORDER BY id DESC LIMIT 0,1");
	$rw = mysqli_fetch_array($sql);
	$numero = $rw['last']+1;	
	
    
    include(dirname('__FILE__').'/orden_html.php');
    $content = ob_get_clean();

