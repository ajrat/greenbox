<?php
$access_token = '372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ';
$api = 'https://api.telegram.org/bot' . $access_token;

// Получим то, что передано скрипту ботом в POST-сообщении и распарсим
$output = json_decode(file_get_contents('php://input'), TRUE); 

$chat_id = $output['message']['chat']['id']; // Выделим идентификатор чата
$first_name = $output['message']['chat']['first_name']; // Выделим имя собеседника
$message = $output['message']['text'];

$settime = false;





switch(strtolower_ru($message)) {
	case ("тест"):
		sendMessage($chat_id, 'Очко себе потестируй' );
		break;
	case ("привет"):
	case ('/start'):
		sendPhoto($chat_id,'https://cdn.dribbble.com/users/5276/screenshots/2012179/tiki_illustration_kendrickkidd.jpg');
		break;
	case ('расписание'):
		$settime = true;
		showKeyboard("Включать лампы в");
		break;

	default:
		sendMessage($chat_id, 'Неизвестная команда!' );
		break;

}




function showKeyboard($text){

	file_get_contents($GLOBALS['api'].'/InlineKeyboardButton?text='.$text);
}


function sendPhoto($chat_id, $photourl){
	file_get_contents($GLOBALS['api'] . '/sendPhoto?chat_id=' . $chat_id . '&photo=' . $photourl);
}

function sendMessage($chat_id, $message) {
	file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}

//Функция перевода символов в нижний регистр, учитывающая кириллицу
function strtolower_ru($text) {
	 $alfavitlover = array('ё','й','ц','у','к','е','н','г', 'ш','щ','з','х','ъ','ф','ы','в', 'а','п','р','о','л','д','ж','э', 'я','ч','с','м','и','т','ь','б','ю');
		 $alfavitupper = array('Ё','Й','Ц','У','К','Е','Н','Г', 'Ш','Щ','З','Х','Ъ','Ф','Ы','В', 'А','П','Р','О','Л','Д','Ж','Э', 'Я','Ч','С','М','И','Т','Ь','Б','Ю');
return str_replace($alfavitupper,$alfavitlover,strtolower($text));
}


?>