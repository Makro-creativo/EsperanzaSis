<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_corte_super.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Fecha', 'Persona que entrego', 'Persona que recibio', 'Turno', 'Concepto', 'Efectivo', 'Bauchers', 'Gastos Súper', 'Gastos Tortillería', 'Recargas', 'Ticket', 'Total de efectivo'));
	
	$reporteCsv = $conexion->query("SELECT * FROM cutbox_super WHERE opening_date BETWEEN '$date1' AND '$date2' ORDER BY opening_date DESC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['id_box'], 
				$filaR['opening_date'],
				$filaR['person_delivery'],
				$filaR['person_receive'],
                $filaR['turn'],
                $filaR['concept'],
                $filaR['closing_amount'],
				$filaR['payment_services'],
                $filaR['gastos_super'],
                $filaR['gastos_tortilleria'],
				$filaR['recargas'],
                $filaR['number_notes'],
                $filaR['closing_amount']+$filaR['payment_services']+$filaR['gastos_super']+$filaR['gastos_tortilleria'],
	));

}

?>