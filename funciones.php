<?php

function diff_month( $inicio = date("Y-m-d"), $fin = date("Y-m-d") , $debug = false){
	try {
		$datetime1 = new DateTime($inicio." 00:00:00");
		$datetime2 = new DateTime($fin. " 00:00:00");
		# obtenemos la diferencia entre las dos fechas

		$interval=$datetime2->diff($datetime1);

		$intervalo['months']=$interval->format("%m");
		$intervalo['days']=$interval->format("%d");
		$intervalo['years']=$interval->format("%y");

		return $intervalo;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}
