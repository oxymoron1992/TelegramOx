<?php
/*
 * Создатель Аскольд Монархова
 * YouTube: youtube.com/c/Karamon_zt
 * VK: vk.com/a.monarkhov
 * НЕ подлежит свободному распространению.
*/


class BotEvent # Обработчик событий бота
{
	# ТЕХНИЧЕСКАЯ ИНФОРМАЦИЯ
	# ЧТОБЫ ОСТАНОВИТЬ БОТА, ФУНКЦИЯ ДОЛЖНА ВЕРНУТЬ 'STOP'
	# ЧТОБЫ ПЕРЕЗАПУСТИТЬ БОТА, ФУНКЦИЯ ДОЛЖНА ВЕРНУТЬ 'RESTART'
	#
	#
	#


	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	* 
	* Информация об пригласившем
	* @param int $inviterID (Идентификатор пользователя пригласившего бота в беседу. Может быть использовано в методе sMessage)
	* @param str $inviterFirstName (Имя пользователя пригласившего бота в беседу)
	* @param str $inviterLastName (Фамилия пользователя пригласившего бота в беседу)
	* @param str $inviterLogin (Логин пользователя пригласившего бота в беседу)
	*/
	public static function invitationBotInGroup($chatID, $inviterID, $inviterFirstName, $inviterLastName, $inviterLogin ) # Приглашение бота в беседу
	{

	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация об приглшенном
	* @param int $newMemberID (Идентификатор приглашенного пользователя Telegram. Может быть использовано в методе sMessage)
	* @param str $newMemberFirstName (Имя приглашенного пользователя)
	* @param str $newMemberLastName (Фамилия приглашенного пользователя)
	* @param str $newMemberLogin (Логин приглашенного пользователя)
	*
	* Информация об пригласившем
	* @param int $inviterID (Идентификатор пользователя пригласившего в беседу. Может быть использовано в методе sMessage)
	* @param str $inviterFirstName (Имя пользователя пригласившего в беседу)
	* @param str $inviterLastName (Фамилия пользователя пригласившего в беседу)
	* @param str $inviterLogin (Логин пользователя пригласившего в беседу)
	*/
	public static function newChatMemberByAdmin($chatID, $newMemberID, $newMemberFirstName, $newMemberLastName, $newMemberLogin, $inviterID, $inviterFirstName, $inviterLastName, $inviterLogin ) # Приглашение пользователя в беседу другим пользователем
	{
		telebot::sMessage($chatID, $newMemberFirstName.', добро пожаловать в беседу! Тебя пригласил админ');
	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация об пользователе
	* @param int $newMemberID (Идентификатор приглашенного пользователя Telegram. Может быть использовано в методе sMessage)
	* @param str $newMemberFirstName (Имя приглашенного пользователя)
	* @param str $newMemberLastName (Фамилия приглашенного пользователя)
	* @param str $newMemberLogin (Логин приглашенного пользователя)
	*/
	public static function newChatMember($chatID, $newMemberID, $newMemberFirstName, $newMemberLastName, $newMemberLogin) # Пользователь вступил в беседу по ссылке
	{
		telebot::sMessage($chatID, $newMemberFirstName.', добро пожаловать в беседу! Ты сам себя пригласил!');
	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация о пользователе покинувшем беседу
	* @param int $userID (Идентификатор пользователя покинувшего беседу. Может быть использовано в методе sMessage)
	* @param str $firstName (Имя пользователя покинувшего беседу)
	* @param str $lastName (Фамилия пользователя покинувшего беседу)
	* @param str $login (Логин пользователя покинувшего беседу)
	*/
	public static function leftChatMember($chatID, $userID, $firstName, $lastName, $login) # Пользователь покинул беседу
	{
		telebot::sMessage($chatID, 'Очень жаль, что '.$firstName.' покинул нашу беседу..');

	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация об исключенном
	* @param int $leftMemberID (Идентификатор исключенного пользователя Telegram. Может быть использовано в методе sMessage)
	* @param str $leftMemberFirstName (Имя исключенного пользователя)
	* @param str $leftMemberLastName (Фамилия исключенного пользователя)
	* @param str $leftMemberLogin (Логин исключенного пользователя)
	*
	* Информация об пригласившем
	* @param int $adminID (Идентификатор пользователя исключившего с беседы. Может быть использовано в методе sMessage)
	* @param str $adminFirstName (Имя пользователя исключившего с беседы)
	* @param str $adminLastName (Фамилия пользователя исключившего с беседы)
	* @param str $adminLogin (Логин пользователя исключившего с беседы)
	*/
	public static function leftChatMemberByAdmin($chatID, $leftMemberID, $leftMemberFirstName, $leftMemberLastName, $leftMemberLogin, $adminID, $adminFirstName, $adminLastName, $adminLogin) # Исключение пользователя с беседы другим пользователем
	{

	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	* @param str $chatType (тип чата, может принимать значения: private/group)
	*
	* Информация о пользователе
	* @param int $userID (Идентификатор пользователя. Может быть использовано в методе sMessage(В данном событии не имеет смысла))
	* @param str $firstName (Имя пользователя)
	* @param str $lastName (Фамилия пользователя)
	* @param str $login (Логин пользователя)
	*
	* Данные
	* @param str $mess (Текст сообщения в нижнем регистре)
	* @param str $text (Текст сообщения) 
	*/
	public static function newMessage($chatType, $chatID, $userID, $firstName, $lastName, $login, $mess, $text) # Сообщение от пользователя в личный чат
	{
		/*$userInfo = database::getAccount($userID);
		if(!$userInfo)
		{
			database::newAccount($userID);
			$userInfo = database::getAccount($userID);
		}

		switch ($mess) {
			case 'профиль':
				if($chatType=='group')
				{
					telebot::sMessage($chatID, $firstName.", я не могу выполнить эту функцию в беседе");
					return;
				}
				telebot::sMessage($chatID, 'Профиль пользователя: ID: *'.$userInfo['id'].'*'.PHP_EOL.'Статус: *'.$userInfo['status'].'*'.PHP_EOL.'Баланс: *'.$userInfo['balance'].'*', 'Markdown');
			break;
			
			default:
				telebot::sMessage($chatID, $firstName.', я не знаю как ответить на это сообщение...');
			break;
		}*/

		$keyboard = [
		[ ['text' => 'инлайн кнопка', 'callback_data' => 'тест'] ],
		[ ['text' => 'инлайн кнопка', 'callback_data' => 'тест2'] ]

		];

		$keyboard2 = [
		[ ['text' => 'Отправить контакт', 'request_contact' => true] ],
		[ ['text' => 'Отправить местоположение', 'request_location' => true] ]
		];
		if($chatType=='private')
		{
			telebot::sMessage($chatID, '*Жирный текст* _наклонный текст_', 'Markdown', true, ['keyboard' => $keyboard2]);
		}
	}
	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация о пользователе
	* @param int $userID (Идентификатор пользователя. Может быть использовано в методе sMessage(Отправит сообщение не в беседу, а в личный чат))
	* @param str $firstName (Имя пользователя)
	* @param str $lastName (Фамилия пользователя)
	* @param str $login (Логин пользователя)
	*
	* Данные
	* @param str $data (Данные, которые были отправлены кнопкой)
	* @param str $chatType (тип чата, может принимать значения: private/group)
	*/
	public static function pressButtonOnInlineKeyboard($chatID, $userID, $firstName, $lastName, $login, $data, $chatType) # Пользователь нажал на кнопку инлайн клавиатуры
	{
		if($data == 'тест')
			telebot::sMessage($chatID, 'Нажали тестовую кнопку');
		else telebot::sMessage($chatID, 'Нажали другую кнопку');

	}

	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация о пользователе
	* @param int $userID (Идентификатор пользователя. Может быть использовано в методе sMessage(В данном событии не имеет смысла))
	* @param str $firstName (Имя пользователя)
	* @param str $lastName (Фамилия пользователя)
	* @param str $login (Логин пользователя)
	*
	* Данные
	* @param str $phoneNumber (Отправленный номер телефона)
	*/
	public static function requestContact($chatID, $userID, $firstName, $lastName, $login, $phoneNumber) # Пользователь отправил контактные данные
	{
		telebot::sMessage($chatID, 'Кажется Вы мне отправили свой контакт, Ваш номер: '.$phoneNumber);

	}


	/**
	* Основная информация
	* @param int $chatID (Идентификатор чата в Telegram)
	*
	* Информация о пользователе
	* @param int $userID (Идентификатор пользователя. Может быть использовано в методе sMessage(В данном событии не имеет смысла))
	* @param str $firstName (Имя пользователя)
	* @param str $lastName (Фамилия пользователя)
	* @param str $login (Логин пользователя)
	*
	* Данные
	* @param str $latitude (Широта)
	* @param str $longitude (Долгота)
	*/
	public static function requestLocation($chatID, $userID, $firstName, $lastName, $login, $latitude, $longitude) # Пользователь отправил местоположение
	{
		telebot::sMessage($chatID, 'Кажется Вы мне отправили своё местоположение.'.PHP_EOL.'*Широта*: _'.$latitude.'_'.PHP_EOL.'*Долгота*: _'.$latitude.'_', 'Markdown');

	}

}

?>