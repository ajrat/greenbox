<?php
	$skey = "LoKittyXTC";
	if (!empty($_GET["skey"])) {
		if ($_GET["skey"]==$skey) {
			$t_air = $_GET["t_air"];
			$h_air = $_GET["h_air"];
			$h_ground = $_GET["h_ground"];
			$lamps = $_GET["lamps"];
			if ($lamps=="0") {
				$lamps="Выключены";
			}
			if ($lamps=="1") {
				$lamps="Включены";
			}			
			file_put_contents ('freshstate.txt', $t_air.";".$h_air.";".$h_ground.";".$lamps.";");
			echo "true";
		};
	};
?>