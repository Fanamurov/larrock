<?php

namespace App\Helpers\Otapi;

class OtapiItem
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = FALSE;

	public function get($itemId, $load_description = NULL, $blockList = 'Promotions,RootPath')
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('BatchGetItemFullInfo', ['itemId' => $itemId, 'blockList' => $blockList, 'sessionId' => mt_rand(100000,99999999)]);
		$data = $this->find_relations($data->Result);
		if($load_description){
			$data->Description = $this->getDescription($itemId);
		}
		if(isset($data->ConfiguredItems->OtapiConfiguredItem)){
			$data->ConfiguredItems = collect($data->ConfiguredItems->OtapiConfiguredItem);
		}
		return $data;
	}

	public function getDescription($itemId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetItemDescription', ['itemId' => $itemId]);
		return $data->OtapiItemDescription->ItemDescription;
	}

	/**
	 * Ищем дополнительные блоки
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function find_relations($data)
	{
		if(isset($data->RootPath->Content)){
			$data = $this->relationRootPath($data);
		}
		if(isset($data->Item->Promotions->OtapiItemPromotion)){
			$data = $this->relationPromotions($data);
		}
		return $data->Item;
	}

	/**
	 * Путь от товара до категории первого уровня
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function relationRootPath($data)
	{
		$data->Item->RootPath = collect($data->RootPath->Content->Item);
		return $data;
	}

	/**
	 * Промоакции (скидки) на товар
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function relationPromotions($data)
	{
		$data->Item->Promotions = $data->Item->Promotions->OtapiItemPromotion;
		return $data;
	}
}