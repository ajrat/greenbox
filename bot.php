<?php
	header('Content-Type: text/html; charset=utf-8');
	// подрубаем API
	require_once("vendor/autoload.php");

	// создаем переменную бота
	$token = "372340784:AAEGVQ7MwgcVbWD5Q9zH6eQn1VT5KNx-QFQ";
	$bot = new \TelegramBot\Api\Client($token);

	// если бот еще не зарегистрирован - регистрируем
	if(!file_exists("registered.trigger")){ 
		/**
		 * файл registered.trigger будет создаваться после регистрации бота. 
		 * если этого файла нет значит бот не зарегистрирован 
		 */
		 
		// URl текущей страницы
		$page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$result = $bot->setWebhook($page_url);
		if($result){
			file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
		}
	}	

	// обязательное. Запуск бота
	$bot->command('start', function ($message) use ($bot) {
		$pic = "https://s-media-cache-ak0.pinimg.com/736x/f2/fa/3f/f2fa3f35df165279b22c2d8f987e1fb3--rasta-man-homer-simpson.jpg";
		$bot->sendPhoto($message->getChat()->getId(), $pic);
	});

	// помощ
	$bot->command('help', function ($message) use ($bot) {
	    $answer = 'Команды:
	/help - помощ';
	    $bot->sendMessage($message->getChat()->getId(), $answer);
	});


$bot->command("лампы", function ($message) use ($bot) {
	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				['callback_data' => 'lampson', 'text' => 'Включить'],
				['callback_data' => 'lampsoff', 'text' => 'Выключить']
				['callback_data' => 'lampstimer', 'text' => 'Режим']
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Что будем делать?", false, null,null,$keyboard);
});

$bot->on(function($update) use ($bot, $callback_loc, $find_command){
	$callback = $update->getCallbackQuery();
	$message = $callback->getMessage();
	$chatId = $message->getChat()->getId();
	$data = $callback->getData();
	
	if($data == "lampson"){
		//file_put_contents ('lamps.txt', "on");
		$bot->answerCallbackQuery( $callback->getId(), "Включил",true);
	}
	if($data == "lampsoff"){
		//file_put_contents ('lamps.txt', "off");
		$bot->answerCallbackQuery( $callback->getId(), "Выключил",true);
		//$bot->sendMessage($chatId, "Это ответ!");
		//$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}
	if($data == "lampstimer"){
		$bot->answerCallbackQuery( $callback->getId(), "Недоступно",true);
	}

}, function($update){
	$callback = $update->getCallbackQuery();
	if (is_null($callback) || !strlen($callback->getData()))
		return false;
	return true;
});

	// запускаем обработку
	$bot->run();
?>