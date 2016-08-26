<?php

namespace App\Helpers\Otapi;

class OtapiCategory
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = FALSE;

	/**
	 * Получение информации о категории по Id
	 * @param $categoryId
	 *
	 * @return mixed
	 */
	public function get($categoryId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetCategoryInfo', ['categoryId' => $categoryId], $this->allow_safe_mode);
		return $data->OtapiCategory;
	}

	/**
	 * Получение три первых уровня разделов
	 * @return mixed
	 */
	public function GetThreeLevelRootCategoryInfoList()
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetThreeLevelRootCategoryInfoList', [], $this->allow_safe_mode);
		return $data->OtapiCategory;
	}

	/**
	 * Получение списка доступных методов поиска для раздела
	 * @param $categoryId
	 *
	 * @return mixed
	 */
	public function GetCategorySearchProperties($categoryId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetCategorySearchProperties', ['categoryId' => $categoryId], $this->allow_safe_mode);
		if(isset($data->SearchPropertyInfoList->Content->Item)){
			return $data->SearchPropertyInfoList->Content->Item;
		}
		return collect();
	}
}