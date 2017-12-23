
<?php $botkey = '372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ'; //key полученный от botfather

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];



if (!$chatID) die("no");

$msg = "Нажмите на ссылку";
$replyMarkup['keyboard'][] = array("Включить лампы","Выключить лампы"); 
$replyMarkup['keyboard'][] = array("Расписание"); 
$replyMarkup['keyboard'][] = array("Датчики"); 


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
	$timertrigger = true;
	$msg = "Введи время (XX:XX;YY:YY)";
	//file_put_contents ('timer.txt', $update["message"]["text"].'1');
}


$sendto ="https://api.telegram.org/bot$botkey/sendmessage?parse_mode=HTML&chat_id=".$chatID."&text=".urlencode($msg)."&disable_web_page_preview=true&reply_markup=".json_encode($replyMarkup);
file_get_contents($sendto);

?>