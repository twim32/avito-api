<?php

namespace Twim32\AvitoApi\Service;

class Tariff extends BaseService
{
    /**
     * Получение информации по тарифу.
     * 
     * Внимание: информация доступна только для тарифов в категории "Транспорт". Тариф должен быть не "СРА"
     * 
     * @link https://developers.avito.ru/api-catalog/tariff/documentation#operation/getTariffInfo
     */
    public function getInfo(): array
    {
        return $this->client->get("tariff/info/1");
    }
}