<?php
/*
 * Создатель Аскольд Монархова
 * YouTube: youtube.com/c/Karamon_zt
 * VK: vk.com/a.monarkhov
 * НЕ подлежит свободному распространению.
*/

class shttp{
	public static function GET($url, $fields=null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.(is_array($fields)?'?'.http_build_query($fields):(($fields!==null)?'?'.$fields:'')));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	public static function POST($url, $fields=null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, (is_array($fields)?http_build_query($fields):(($fields!==null)?$fields:'')));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
?>