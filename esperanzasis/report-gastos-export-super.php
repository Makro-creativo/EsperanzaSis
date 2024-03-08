<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report-gastos'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_gastos_super.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Fecha', 'Nombre de la categoría', 'Descripción', 'Efectivo'));
	
	$reporteCsv = $conexion->query("SELECT * FROM gastos WHERE created_at BETWEEN '$date1' AND '$date2' ORDER BY created_at DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['id'], 
				$filaR['created_at'],
				$filaR['name_category'],
				$filaR['description'],
                $filaR['amount']
	));

}

?>