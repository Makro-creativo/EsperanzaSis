<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_pedidos_por_pagar.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Cliente', 'Fecha de entrega', 'Persona quién realizo el pedido', 'Comentarios', 'Estatus de pago', 'Número de nota', 'Total', 'Pago'));
	
	$reporteCsv = $conexion->query("SELECT * FROM ordens_admin INNER JOIN status_payment ON ordens_admin.purchaseid = status_payment.order_id WHERE date_send BETWEEN '$date1' AND '$date2' AND status_payment.payment_status = 'Por pagar' AND ordens_admin.status_payment = 'credito' ORDER BY date_send DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['purchaseid'], 
				$filaR['name_client'],
				$filaR['date_send'],
				$filaR['people_order'],
                $filaR['comments'],
                $filaR['status_payment'],
				$filaR['note_cobranza_credito'],
                $filaR['monto'],
                $filaR['payment_status']
	));

}

?>