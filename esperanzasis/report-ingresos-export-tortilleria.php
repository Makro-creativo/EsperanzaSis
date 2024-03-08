<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report-ingresos'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_ingresos-tortilleria.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('Fecha', 'Nombre de la categoría', 'descripción', 'Efectivo'));
	
	$reporteCsv = $conexion->query("SELECT * FROM ingresos WHERE created_at BETWEEN '$date1' AND '$date2' ORDER BY created_at DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array( 
				date('d/m/Y', strtotime($filaR['created_at'])),
				$filaR['category_name'],
				$filaR['description'],
                number_format($filaR['quantity'], 2)
	));

}

?>