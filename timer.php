<?php
	$skey = "LoKittyXTC";
	if (!empty($_GET["skey"])) {
		if ($_GET["skey"]==$skey) {	

			date_default_timezone_set('Europe/Moscow' );
			$timenow = date('H:i');

			$timerdata = file_get_contents('timer.txt');
			$timerarray = explode(";", $timerdata);

			$timerstart = date("H:i",strtotime($timerarray[0]));
			$timerfinish = date("H:i",strtotime($timerarray[1]));


			if ($timerstart>$timerfinish) {	
				if (($timenow>$timerfinish)&&($timenow<$timerstart)) {
					echo "#Off$";
				}else{
					echo "#On$";
				}
			}else{
				if (($timenow>$timerstart)&&($timenow<$timerfinish)) {
					echo "#On$";
				}else{
					echo "#Off$";
				}	
			}

		}
	}


/*
на память


			$timerstart = date("Y-m-d H:i",strtotime(date("2017-10-10 ".(strval($timerarray[0]))).":00"));
			$timerfinish = date("Y-m-d H:i",strtotime(date("2017-10-10 ".(strval($timerarray[1]))).":00"));

$time = date("Y-m-d H:i",strtotime($timerstart)-86400);
echo date("d H:i",strtotime($time));
*/





//8
//20
//2
/*


$timerstart = (int)(strval($timerarray[0]));
			$timerofinish = (int)(strval($timerarray[1]));
			//$timenow = 22;//(int)strval($timenow);



			if (($timerstart+$timeron)>24) {
				$timeroff = ($timerstart+$timeron)-24;
				if (($timenow>$timerstart)&&()) {
					# code...
				}
			}else{
				$timeroff = ($timerstart+$timeron);
				
			}*/

?>