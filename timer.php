<?php
	$skey = "LoKittyXTC";
	if (!empty($_GET["skey"])) {
		if ($_GET["skey"]==$skey) {
			date_default_timezone_set('Europe/Moscow' );
			$timenow = date('H:i');
			echo $timenow;
		};
	};
?>