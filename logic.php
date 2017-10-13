<?php
$messages = telebot::getUpdates( $uID );
	if($messages == 22)
	{
		$stop = 1;
		return;
	}
	if(!$messages)
	{
		$restart = 1;
		return;
	}
	foreach( $messages as $message )
	{
		/*cmd($message);
		$telebot->updateID( $message['update_id'] );
		$stop = 1;
		return;*/
		
			#===================ГЕНЕРАЦИЯ СОБЫТИЙ====================
			generateEvent($message);
			#============СОХРАНЕНИЕ ПОСЛЕДНЕГО ОБНОВЛЕНИЯ============
			$uID = $message['update_id'];
			#========================================================
	}
?>