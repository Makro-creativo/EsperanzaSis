<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_corte_ruta.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Fecha', 'Persona que entrego', 'Persona que recibio', 'Turno', 'Concepto', 'Efectivo', 'Gastos Súper', 'Gastos Tortillería', 'Nota de crédito', 'Número de notas', 'Total del corte'));
	
	$reporteCsv = $conexion->query("SELECT * FROM cutbox_ruta WHERE opening_date BETWEEN '$date1' AND '$date2' ORDER BY opening_date ASC");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['id_box'], 
                                $filaR['opening_date'],
                                $filaR['person_delivery'],
                                $filaR['person_receive'],
                                $filaR['turn'],
                                $filaR['concept_two'],
                                $filaR['amount'],
                                $filaR['gastos_super'],
                                $filaR['gastos_tortilleria'],
                                $filaR['notes'],
                                $filaR['number_note_repartidor'],
                                $filaR['amount']+$filaR['notes']+$filaR['gastos_super']+$filaR['gastos_tortilleria'],
	));

}

?>