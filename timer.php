<?php
	$skey = "LoKittyXTC";
	
			date_default_timezone_set('Europe/Moscow' );
			$timenow = date('H');

			$timerdata = file_get_contents('timer.txt');
			$timerarray = explode(";", $timerdata);

			$timeron = strtotime(strval($timerarray[0]));
			$timenow = strval($timenow);
			echo date('H:i');

?>