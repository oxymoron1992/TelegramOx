<?
function cmd($str)
{
	if( is_array($str) )
	{
		$str = serialize($str);
		$str = iconv('UTF-8', 'CP866', $str);
		$str = unserialize($str);
		print_r( $str );
	}
	else
	{
		print_r( iconv('UTF-8', 'CP866', $str) );
	}
	print_r(PHP_EOL);
}

function generateEvent($message)
{
	if( $message['callback_query']['data'] ) # Проверка на нажатие с инлайн клавиатуры
			{
				BotEvent::pressButtonOnInlineKeyboard($message['callback_query']['message']['chat']['id'], $message['callback_query']['from']['id'], $message['callback_query']['from']['first_name'], $message['callback_query']['from']['last_name'], $message['callback_query']['from']['username'], $message['callback_query']['data'], $message['callback_query']['message']['chat']['type']);
			}
			else
			{ # Обычное сообщение и его подвиды
				$mess = mb_strtolower($message['message']['text'], 'UTF-8'); # сообщение в нижнем регистре
				if($message['message']['new_chat_member']) # Проверка на приглашение
				{
					$lastName = ($message['message']['new_chat_member']['last_name']) ? $message['message']['new_chat_member']['last_name'] : 'null';
					if($message['message']['new_chat_member']['id'] == BOT_ID)
					{ # Приглашение бота
						BotEvent::invitationBotInGroup($message['message']['chat']['id'], $message['message']['from']['id'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username']);
					}
					elseif($message['message']['new_chat_member']['id'] == $message['message']['from']['id'])
					{ # Пользователь сам вступил в беседу (по ссылке)
						BotEvent::newChatMember($message['message']['chat']['id'], $message['message']['new_chat_member']['id'], $message['message']['new_chat_member']['first_name'], $lastName, $message['message']['new_chat_member']['username']);
					}
					else
					{ # приглашение пользователя пользователем
						BotEvent::newChatMemberByAdmin($message['message']['chat']['id'], $message['message']['new_chat_member']['id'], $message['message']['new_chat_member']['first_name'], $lastName, $message['message']['new_chat_member']['username'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username']);
					}
					return;
				}

				if($message['message']['left_chat_member']) # исключение с беседы
				{
					if($message['message']['left_chat_member']['id'] != BOT_ID)
					{
						if($message['message']['left_chat_member']['id'] == $message['message']['from']['id'])
						{
							BotEvent::leftChatMember($message['message']['chat']['id'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username']);
						}
						else
						{
							BotEvent::leftChatMemberByAdmin($message['message']['chat']['id'], $message['message']['left_chat_member']['id'], $message['message']['left_chat_member']['first_name'], $lastName, $message['message']['left_chat_member']['username'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username']);
						}
					}
					return;
				}
				if($message['message']['contact'])
				{
					BotEvent::requestContact($message['message']['chat']['id'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username'], $message['message']['contact']['phone_number']);
					return;
				}
				if($message['message']['location'])
				{
					BotEvent::requestLocation($message['message']['chat']['id'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username'], $message['message']['location']['latitude'], $message['message']['location']['longitude']);
					return;
				}
				BotEvent::newMessage($message['message']['chat']['type'], $message['message']['chat']['id'], $message['message']['from']['id'], $message['message']['from']['first_name'], $message['message']['from']['last_name'], $message['message']['from']['username'], $mess, $message['message']['text']); # Сообщение
			}
}
?>