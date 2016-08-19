<?php

namespace App\Helpers\Otapi;

class OtapiCategory
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = FALSE;

	public function get($categoryId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetCategoryInfo', ['categoryId' => $categoryId]);
		return $data->OtapiCategory;
	}
}