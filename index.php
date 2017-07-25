<?php
function sendMessage($text) {
file_get_contents("https://api.telegram.org/bot372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ/sendMessage?chat_id=288119914&text=". urlencode($text));
};



//Если пришел запрос на статус
if (!empty($_GET["sendstate"])) {
	$freshstate = file_get_contents('freshstate.txt');
	echo $freshstate;
}else{
	//echo "#TEST HELLO,WORLD!$";
}

if (!empty($_GET["getlamps"])) {
  if ($_GET["getlamps"]=="LoKittyXTC") {
    $lamps = file_get_contents('lamps.txt');
    echo "#".$lamps."$";
  }
}



/*

$skey = $_GET["skey"];
$t_air = $_GET["t_air"];
$h_air = $_GET["h_air"];

if ($skey == "LoKittyXTC") {
	file_put_contents ('freshdata.txt', "t = $t_air;h = $h_air;");
};


/*
$skey = $_GET["skey"];
$t_air = $_GET["t_air"];
$h_air = $_GET["h_air"];
$h_ground = $_GET["h_ground"];
*/


/*$t_air = 22;
$h_air = 11;*
//if ($skey == "LoKittyXTC") {
	//file_put_contents ('file.txt', "t = $t_air;h = $h_air;g = $h_ground;\n", FILE_APPEND);
 $message="t = $t_air;\nh = $h_air;";

sendMessage($message)

 /*file_get_contents("https://api.telegram.org/bot372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ/sendMessage?chat_id=288119914&text=urlencode($message)");
*/
//}






?>