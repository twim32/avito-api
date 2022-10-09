<?php

namespace Twim32\AvitoApi\Service;

class Messenger extends BaseService
{
    /**
     * Получение информации по чатам
     * 
     * @link https://developers.avito.ru/api-catalog/messenger/documentation#operation/getChatsV2
     */
    public function getChats($user_id)
    {
        return $this->client->get("messenger/v2/accounts/{$user_id}/chats");
    }

    /**
     * Получение информации по чату
     * 
     * @link https://developers.avito.ru/api-catalog/messenger/documentation#operation/getChatByIdV2
     */
    public function getChat(int $user_id, string $chat_id)
    {
        return $this->client->get("messenger/v2/accounts/{$user_id}/chats/{$chat_id}");
    }

    /**
     * Получение списка сообщений
     * 
     * @link https://developers.avito.ru/api-catalog/messenger/documentation#operation/getChatByIdV2
     */
    public function getMessages(int $user_id, string $chat_id)
    {
        return $this->client->get("messenger/v2/accounts/{$user_id}/chats/{$chat_id}/messages");
    }
}