<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report-orders'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_lista_de_pedidos.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('Cliente', 'Fecha de entrega', 'Estatus de pago', 'Número de nota', 'Monto'));
	
	$reporteCsv = $conexion->query("SELECT * FROM new_orders_admin INNER JOIN purchase_detail_admin ON new_orders_admin.id = purchase_detail_admin.purchaseid 
	INNER JOIN clients ON clients.id = new_orders_admin.client_id 
	WHERE new_orders_admin.date_send BETWEEN '$date1' AND '$date2' GROUP BY new_orders_admin.id ORDER BY new_orders_admin.date_send
	DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['name_client'],
				date("d/m/Y", strtotime($filaR['date_send'])),
				$filaR['status_payment'],
				$filaR['number_note'],
				number_format($filaR['amount'], 2),
	));

}

?>