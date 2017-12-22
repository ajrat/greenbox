<?php
	$skey = "LoKittyXTC";
	if (!empty($_GET["skey"])) {
		if ($_GET["skey"]==$skey) {
			date_default_timezone_set('Europe/Moscow' );
			$timenow = date('H:i');

			$timerdata = file_get_contents('timer.txt');
			$timerarray = explode(";", $timerdata);

			$timeron = $timerarray[0];
			$timeroff = $timerarray[1];

			$DateTimeNow = strtotime(date('Y-m-d')  ." ". $timenow); 
			

			echo $DateTimeNow;
		};
	};
?>