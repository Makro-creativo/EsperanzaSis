<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_pedidos_cobrados.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Cliente', 'Fecha de entrega', 'Persona quién realizo el pedido', 'Comentarios', 'Estatus de pago', 'Número de nota', 'Total'));
	
	$reporteCsv = $conexion->query("SELECT * FROM ordens_admin WHERE date_send BETWEEN '$date1' AND '$date2' AND status_payment = 'cobrado' ORDER BY date_send DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['purchaseid'], 
				$filaR['name_client'],
				$filaR['date_send'],
				$filaR['people_order'],
                $filaR['comments'],
                $filaR['status_payment'],
				$filaR['note_cobranza_credito_two'],
                $filaR['monto']
	));

}

?>