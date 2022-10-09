<?php

namespace Twim32\AvitoApi\Service;

use DateTime;

class User extends BaseService
{
    /**
     * @link https://developers.avito.ru/api-catalog/user/documentation#operation/postOperationsHistory
     */
    public function getOperationsHistory(DateTime $from, DateTime $to): array
    {
        return $this->client->post("core/v1/accounts/operations_history/", [
            'dateTimeFrom' => $from->format(self::DATETIME_FORMAT),
            'dateTimeTo' => $to->format(self::DATETIME_FORMAT),
        ]);
    }

    /**
     * @link https://developers.avito.ru/api-catalog/user/documentation#operation/getUserInfoSelf
     */
    public function getInfo(): array
    {
        return $this->client->get("core/v1/accounts/self");
    }

    /**
     * @link https://developers.avito.ru/api-catalog/user/documentation#operation/getUserBalance
     */
    public function getUserBalance(int $user_id): array
    {
        return $this->client->get("core/v1/accounts/{$user_id}/balance/");
    }
}