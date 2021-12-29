<?php
	include "./config/conexion.php";

	$year = date('Y');
	$total = array();

	for ($month = 1; $month <= 12; $month ++){
		$sql = "SELECT *, SUM(amount) AS total FROM gastos WHERE month(created_at)='$month' AND year(created_at)='$year'";
        $result_query = mysqli_query($conexion, $sql);
		
        $row = mysqli_fetch_array($result_query);

		$total[] = $row['total'];
	}

	$tjan = $total[0];
	$tfeb = $total[1];
	$tmar = $total[2];
	$tapr = $total[3];
	$tmay = $total[4];
	$tjun = $total[5];
	$tjul = $total[6];
	$taug = $total[7];
	$tsep = $total[8];
	$toct = $total[9];
	$tnov = $total[10];
	$tdec = $total[11];

	$pyear = $year - 1;
	$pnum = array();

?>