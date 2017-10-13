<?php
class telebot
{
	# Автор: Karamon
	# VK: vk.com/a.monarkhov
	# YouTube: www.youtube.com/channel/UCq8b_NsoOwJfKbQ93Kwry7A
	# Версия: 0.2
	# Последние изменения:
	/*
		Адаптация под Long Poll архитектуру запросов

	*/
	#==========ОШИБКИ===========
	# 21 - не указали токен
	# 22 - ошибка получения обновлений. Сервер не отвечает
	#
	#===========================
	#========ПЕРЕМЕННЫЕ=========
	private static $token;
	#===========================
	public function start($token)
	{
		telebot::$token = $token;
	}
	#====================ПРИВАТНЫЕ ФУНКЦИИ=================
	private function get($s)
	{
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $s);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$r = curl_exec ($ch);
			curl_close($ch);
			if ($r == NULL) {
				return "Ошибка: ".curl_errno($ch) . " - " . curl_error($ch);
			}else{
				return $r;
			}
	}
	#======================================================

	#=====================ПУБЛИЧНЫЕ========================
	public function log($str)
	{
		file_put_contents("log.txt", PHP_EOL."[".date('M-d-y_H:i:s')."]: ".$str.PHP_EOL, FILE_APPEND);
	}

	public function getUpdates($offset)
	{
		if(!telebot::$token) return 21;
		$offset++;
		$get = telebot::get("https://api.telegram.org/".telebot::$token."/getUpdates?offset=".$offset."&timeout=600");
		preg_match('#<title>(.*?)</title>#', $get, $match);
			if(strpos($match[1], '302')===0)
			{
				telebot::log('Ошибка при получении обновлений. Не указан токен');
				return 21;
			}
			elseif(strpos($match[1], '502')===0)
			{
				telebot::log('Ошибка при получении обновлений');
				return 22;
			}
			else
			{
				$r = json_decode( $get, true );
				return $r['result'];
			}
	}
	public function sMessage($w, $s, $parseMode = false, $disableWebPreview = false, $keyboard = [] )
	{
		if(!telebot::$token) return 21;
		$query = ['chat_id' => $w, 'text' => $s];
		if($parseMode or $parseMode == 'Markdown' or $parseMode == 'HTML') $query['parse_mode'] = $parseMode;
		if( is_array($keyboard['keyboard']) )
		{
			if($keyboard['type'] == 'inline') $reply = json_encode( ['inline_keyboard' => $keyboard['keyboard']] );
			else $reply = json_encode( ['keyboard' => $keyboard['keyboard'], "resize_keyboard" => true,"one_time_keyboard" => true] );
		}
		if(isset($reply)) $query['reply_markup'] = $reply;
		if($disableWebPreview) $query['disable_web_page_preview'] = true;
		return telebot::get("https://api.telegram.org/".telebot::$token."/sendmessage?". http_build_query($query) );		
	}

	#======================================================
}
telebot::start(TOKEN);

?>