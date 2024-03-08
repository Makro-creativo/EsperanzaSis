<?php
include "./config/conexion.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

if(isset($_POST['generate-report'])) {
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_venta_tortilleria.csv"');

	$salida = fopen('php://output', 'w');

	fputcsv($salida, array('ID', 'Fecha', 'Persona que entrego', 'Persona que recibe', 'Tipo de ruta', 'Concepto', 'Efectivo', 'Gastos de Súper', 'Gastos de Tortillería', 'Nota de crédito', 'Número de notas'));
	
	$reporteCsv = $conexion->query("SELECT * FROM cutbox_ruta WHERE opening_date BETWEEN '$date1' AND '$date2' AND turn = 'Venta' ORDER BY opening_date DESC");

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
	));

}

?>