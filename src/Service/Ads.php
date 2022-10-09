<?php

namespace Twim32\AvitoApi\Service;

use DateTime;

class Ads extends BaseService
{
    /**
     * Обновление цены объявления
     * Обновляет цену товара по id. Максимальное количество запросов в минуту - 150. 
     * Внимание! Доступно для категорий Товары, Запчасти, Авто, Недвижимость (кроме краткосрочной)
     * 
     * @link https://developers.avito.ru/api-catalog/item/documentation#operation/updatePrice
     */
    public function updatePrice(int $item_id, int $price): array
    {
        return $this->client->post("core/v1/items/{$item_id}/update_price", [
            'price' => $price
        ]);
    }

    /**
     * Получение информации о стоимости услуг продвижения и доступных значках
     * 
     * @link https://developers.avito.ru/api-catalog/item/documentation#operation/vasPrices
     */
    public function getVasPrices(int $user_id, array $ids): array
    {
        return $this->client->post("core/v1/accounts/{$user_id}/vas/prices", [
            'itemIds' => $ids,
        ]);
    }

    /**
     * Получение агрегированной статистики звонков, полученных пользователем
     * 
     * @link https://developers.avito.ru/api-catalog/item/documentation#operation/postCallsStats
     */
    public function getCallsStats(int $user_id, DateTime $date_from, DateTime $date_to, ?array $ids): array
    {
        return $this->client->post("core/v1/accounts/{$user_id}/calls/stats/", [
            'dateFrom' => $date_from->format(self::DATETIME_FORMAT),
            'dateTo' => $date_to->format(self::DATETIME_FORMAT),
            'itemIds' => $ids,
        ]);
    }

    /**
     * Возвращает данные об объявлении - его статус, список примененных услуг
     * 
     * @link https://developers.avito.ru/api-catalog/item/documentation#operation/getItemInfo
     */
    public function getItemInfo(int $user_id, int $item_id): array
    {
        return $this->client->get("core/v1/accounts/{$user_id}/items/{$item_id}/");
    }
}