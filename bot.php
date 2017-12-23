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
?>