<?php
$access_token = '372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ';
$api = 'https://api.telegram.org/bot' . $access_token;

// Получим то, что передано скрипту ботом в POST-сообщении и распарсим
$output = json_decode(file_get_contents('php://input'), TRUE); 

$chat_id = $output['message']['chat']['id']; // Выделим идентификатор чата
$first_name = $output['message']['chat']['first_name']; // Выделим имя собеседника
$message = $output['message']['text'];

switch(strtolower_ru($message)) {
	case ('состояние'):
	case ('/state'):
		freshstate($chat_id);
	break;

	case ('Включитьлампы'):
	case ('/lampson'):
		lamps($chat_id,1);
	break;

	case ('Выключитьлампы'):
	case ('/lampsoff'):
		lamps($chat_id,0);
	break;

case ('/start'):
break;
default:
sendMessage($chat_id, 'Неизвестная команда!' );
break;
}


function lamps($chat_id,$state){
	if ($state == 1) {
		file_put_contents ('lamps.txt', "on");
	}
	if ($state == 0) {
		file_put_contents ('lamps.txt', "off");
	}
	file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=Ok');
}


function freshstate($chat_id){
	$freshstatedata = file_get_contents('freshstate.txt');
	$freshstatearray = explode(";", $freshstatedata);
	$message = "Температура воздуха : ".$freshstatearray[0]."C°\nВлажность воздуха : ".$freshstatearray[1]."%\nВлажность земли : ".$freshstatearray[2]."%\nЛампы : ".$freshstatearray[3]."\nП.Полив : ".$freshstatearray[4]."\nЗамок : ".$freshstatearray[5];
	file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}




function sendMessage($chat_id, $message) {

file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));

}

/**
* Функция перевода символов в нижний регистр, учитывающая кириллицу
*/

function strtolower_ru($text) {

   $alfavitlover = array('ё','й','ц','у','к','е','н','г', 'ш','щ','з','х','ъ','ф','ы','в', 'а','п','р','о','л','д','ж','э', 'я','ч','с','м','и','т','ь','б','ю');

     $alfavitupper = array('Ё','Й','Ц','У','К','Е','Н','Г', 'Ш','Щ','З','Х','Ъ','Ф','Ы','В', 'А','П','Р','О','Л','Д','Ж','Э', 'Я','Ч','С','М','И','Т','Ь','Б','Ю');

return str_replace($alfavitupper,$alfavitlover,strtolower($text));

}


?>