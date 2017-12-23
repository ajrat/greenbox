
<?php $botkey = '372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ'; //key полученный от botfather

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];

if (!$chatID) die("no");

$msg = "Нажмите на ссылку";
$replyMarkup['keyboard'][] = array("Ссылка раз","Ссылка два"); 
$replyMarkup['keyboard'][] = array("Ссылка три"); 
$replyMarkup['keyboard'][] = array("Все взорвать 😅"); 

if (substr_count($update["message"]["text"],'Ссылка раз')) {
$msg = "Тут текст который видит юзер если нажмет кнопку 1";
}

if (substr_count($update["message"]["text"],'Ссылка раз')) {
$msg = "Тут текст который видит юзер если нажмет кнопку 1";
}

$sendto ="https://api.telegram.org/bot$botkey/sendmessage?parse_mode=HTML&chat_id=".$chatID."&text=".urlencode($msg)."&disable_web_page_preview=true&reply_markup=".json_encode($replyMarkup);
file_get_contents($sendto);

?>