<?php

namespace Twim32\AvitoApi\Service;

class Autoload extends BaseService
{
	/**
	 * Показывает общую информацию только по последнему закрытому отчёту: 
	 * статус загрузки и сколько денег списано из кошелька. 
	 * Не показывает статистику по отдельным объявлениям и услугам продвижения.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getLastCompletedReport
	 */
	public function getLastCompletedReport()
	{
		return $this->client->get('autoload/v2/reports/last_completed_report');
	}

	/**
	 * По запросу API отдаст данные по конкретным объявлениям.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getAutoloadItemsInfoV2
	 */
	public function items(array $query)
	{
		return $this->client->get('autoload/v2/reports/items', [
			'query' => $this->stringify($query)
		]);
	}

	/**
	 * Метод возвращает сводную статистику с результатами конкретной выгрузки — по ID отчёта. 
	 * Например, сколько объявлений было в файле и сколько из них было опубликовано с ошибками или без.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getReportByIdV2
	 */
	public function getReport(int $report_id): array
	{
		return $this->client->get("autoload/v2/reports/{$report_id}");
	}

	/**
	 * С помощью этого метода можно получить результаты обработки каждого объявления в конкретной выгрузке.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getReportItemsById
	 */
	public function getReportItemsById(int $report_id): array
	{
		return $this->client->get("autoload/v2/reports/{$report_id}/items");
	}

	/**
	 * По запросу вы получите список отчётов автозагрузки. 
	 * Они будут отсортированы в порядке убывания: самый свежий отчёт — в начале списка.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getReportsV2
	 */
	public function getReports(int $per_page = 50, int $page = 0, ?string $date_from = null, ?string $date_to = null)
	{
		return $this->client->get("autoload/v2/reports", [
			'per_page' => $per_page,
			'page' => $page,
			'date_from' => $date_from,
			'date_to' => $date_to,
		]);
	}

	/**
	 * ID объявлений из файла (Новый)
	 * 
	 * Метод позволяет получить идентификаторы (ID) объявлений
	 * из файла автозагрузки по ID объявлений на Авито.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/getAvitoIdsByAdIds
	 */
	public function getAdIds(array $ids)
	{
		return $this->client->get('autoload/v2/items/ad_ids', [
			'query' => $this->stringify($ids),
		]);
	}

	/**
	 * Метод запускает процесс выгрузки объявлений из файла по ссылке, 
	 * которая указана в настройках автозагрузки в профиле Авито. 
	 * В течение часа таким способом можно запустить только одну выгрузку.
	 * Важно: на загрузки с помощью этого метода не распространяются лимиты 
	 * на количество публикаций, которые указаны в настройках автозагрузки
	 * в профиле Авито. Все объявления из файла, которые могут быть опубликованы
	 * или активированы, будут опубликованы или активированы.
	 * 
	 * @link https://developers.avito.ru/api-catalog/autoload/documentation#operation/upload
	 */
	public function upload()
	{
		return $this->client->get('autoload/v1/upload');
	}
}
