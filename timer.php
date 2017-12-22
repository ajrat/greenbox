<?php
	$skey = "LoKittyXTC";
	if (!empty($_GET["skey"])) {
		if ($_GET["skey"]==$skey) {
			date_default_timezone_set('Europe/Moscow' );
			$timenow = date('H:i');

			$timerdata = file_get_contents('timer.txt');
			$timerarray = explode(";", $timerdata);

			$timeron = strval($timerarray[0]);
			$timeroff = strval($timerarray[1]);

			$DateTimeNow = strtotime(date('Y-m-d')  ." ". $timenow); 


			echo $DateTimeNow;
		};
	};
?>