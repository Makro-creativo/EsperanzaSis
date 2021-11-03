<?php
	include('./config/conexion.php');

	$id = $_GET['product'];

	$sql="delete from product where productid='$id'";
	$conexion->query($sql);

	header('location:product.php');
?>