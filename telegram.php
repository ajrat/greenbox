
<?php $botkey = '372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ'; //key полученный от botfather

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];



if (!$chatID) die("no");

$msg = "Нажмите на ссылку";
$replyMarkup['keyboard'][] = array("Включить лампы","Выключить лампы"); 
$replyMarkup['keyboard'][] = array("Расписание"); 
$replyMarkup['keyboard'][] = array("Датчики"); 



$temptimevar = preg_split('//u', $update["message"]["text"], NULL, PREG_SPLIT_NO_EMPTY);


if ( ($temptimevar[2] ==":")&&($temptimevar[5]==";")&&($temptimevar[8]==":") ) {
	file_put_contents ('timer.txt', $temptimevar[0].$temptimevar[1].":".$temptimevar[3].$temptimevar[4].";".$temptimevar[6].$temptimevar[7].":".$temptimevar[9].$temptimevar[10].";".'1');
	$msg = "Таймер установлен";
}


if (substr_count($update["message"]["text"],'Включить лампы')) {
	$timerdata = file_get_contents('timer.txt');
	$timerarray = explode(";", $timerdata);
	$timerstart = date("H:i",strtotime($timerarray[0]));
	$timerfinish = date("H:i",strtotime($timerarray[1]));
	file_put_contents ('timer.txt', $timerstart.';'.$timerfinish.';'.'0');

	file_put_contents ('lamps.txt', "on");
	$msg = "Включил";
}

if (substr_count($update["message"]["text"],'Выключить лампы')) {
	$timerdata = file_get_contents('timer.txt');
	$timerarray = explode(";", $timerdata);
	$timerstart = date("H:i",strtotime($timerarray[0]));
	$timerfinish = date("H:i",strtotime($timerarray[1]));
	file_put_contents ('timer.txt', $timerstart.';'.$timerfinish.';'.'0');

	file_put_contents ('lamps.txt', "off");
	$msg = "Выключил";
}

if (substr_count($update["message"]["text"],'Расписание')) {
	$msg = "Введи время (XX:XX;YY:YY)";
}


if (substr_count($update["message"]["text"],'Датчики')) {
	$freshstatedata = file_get_contents('freshstate.txt');
	$freshstatearray = explode(";", $freshstatedata);
	$temperature = date($freshstatearray[0]);
	//$msg = "Температура: ".$temperature;

	$lampsdata = file_get_contents('lamps.txt');
	//$lampsarray = explode(";", $lampsdata);
	
	$msg = "Температура: ".$temperature."\n"."Лампа: ".$lampsdata;

	//$msg = "LOL";
}


$sendto ="https://api.telegram.org/bot$botkey/sendmessage?parse_mode=HTML&chat_id=".$chatID."&text=".urlencode($msg)."&disable_web_page_preview=true&reply_markup=".json_encode($replyMarkup);
file_get_contents($sendto);

?>
