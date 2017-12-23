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


$bot->on(function($Update) use ($bot){
	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();
	
	if(mb_stripos($mtext,"lol") !== false){
		$bot->sendMessage($message->getChat()->getId(), "Смерть богатым!");
	}
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});

	// запускаем обработку
	$bot->run();
?>