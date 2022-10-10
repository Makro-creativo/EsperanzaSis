<?php
require_once ("./config/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] != NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	
	
	if (isset($_REQUEST['id'])){
		$id = intval($_REQUEST['id']);
		$delete = mysqli_query($conexion, "DELETE FROM order_temporal WHERE id = '$id'");
	}
	
	if (isset($_POST['name_product'])){
		
		$nameProduct = mysqli_real_escape_string($conexion,(strip_tags($_POST["name_product"],ENT_QUOTES)));
		$quantity = $_POST['quantity'];
		$price = floatval($_POST['price']);
		$unidad = mysqli_real_escape_string($conexion,(strip_tags($_POST["unidad"],ENT_QUOTES)));
		$sql = "INSERT INTO order_temporal (name_product, quantity, price, unidad) VALUES ('$nameProduct', '$quantity', '$price', '$unidad');";
		
		$insert = mysqli_query($conexion, $sql);
	}
	
	$query = mysqli_query($conexion, "SELECT * FROM order_temporal ORDER BY id");
	$items = 1;
	$suma = 0;
	
	while($row = mysqli_fetch_array($query)){
			$total = $row['quantity']*$row['price'];
			$suma+=$total;
			$total = number_format($total, 2);
		?>
	<tr>
		<td><?php echo $row['name_product'];?></td>

		<td class='text-center'><?php echo $row['unidad'];?></td>
		<td class='text-center'><?php echo $row['quantity'];?></td>
		
		
		<td class='text-right'><?php echo $row['price'];?></td>
		<td class='text-right'><?php echo $total;?></td>
		<td class="text-center">
			<a href="#" onclick="deleteItem('<?php echo $row['id']; ?>')" class="btn btn-danger">
				<i class="bi bi-trash-fill"></i>
			</a>
		</td>
	</tr>	
		<?php
		$items++;
	}
	$neto = $suma;
	
	?>
	<tr>
		<td colspan='7'>
			<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#order">
				<i class="bi bi-plus-square-fill"></i>
 				Agregar producto
			</button>
		</td>
	</tr>
	<tr>
		<td colspan='5' class='text-right'>
			<p>Subtotal :</p>
		</td>
		<th class='text-right'>
			<?php echo number_format($suma,2);?>
			<?php $total = $neto; ?>
		
		</th>
		<td></td>
	</tr>
	
	<tr>
		<td colspan='5' class='text-right'>
			<p>Total del pedido:</p>
		</td>
		<th class='text-right'>
			<input type="text" value="<?php echo number_format($total, 2);?>" readonly name="total_venta" class="form-control">
		</th>
		<td></td>
	</tr>
<?php

}