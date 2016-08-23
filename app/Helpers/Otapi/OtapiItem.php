<?php

namespace App\Helpers\Otapi;

use Cache;

class OtapiItem
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = FALSE;

	public function get($itemId, $load_description = NULL, $blockList = 'Promotions,RootPath')
	{
		if($load_description){
			$blockList .= ',Description';
		}
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('BatchGetItemFullInfo', ['itemId' => $itemId, 'blockList' => $blockList, 'sessionId' => mt_rand(100000,99999999)]);
		$data = $this->find_relations($data->Result);
		if(isset($data->ConfiguredItems->OtapiConfiguredItem)){
			$data->ConfiguredItems = collect($data->ConfiguredItems->OtapiConfiguredItem);
		}
		return $data;
	}

	/**
	 * Поиск товаров по Id раздела
	 * @param        $categoryId
	 * @param int    $framePosition
	 * @param int    $frameSize
	 * @param string $blockList
	 *
	 * @return mixed
	 */
	public function getSearchByCategory($categoryId, $framePosition = 0, $frameSize = 16, $blockList = '')
	{
		$key = 'getSearch'. $categoryId . $framePosition . $frameSize . $blockList;
		$data = Cache::remember($key, 1440, function() use ($categoryId, $framePosition, $frameSize, $blockList) {
			$xmlParameters = '<SearchItemsParameters><IsClearItemTitles>false</IsClearItemTitles><CategoryId>'. $categoryId .'</CategoryId></SearchItemsParameters>';
			$otapiConnection = new OtapiConnection;
			$data = $otapiConnection->create_request('BatchSearchItemsFrame', ['xmlParameters' => $xmlParameters, 'blockList' => $blockList,
				'sessionId' => mt_rand(100000,99999999), 'framePosition' => $framePosition, 'frameSize' => $frameSize]);
			return $data->Result->Items;
		});
		return $data;
	}

	/**
	 * Глобальный поиск товаров по названию
	 * @param        $itemTitle
	 * @param        $search_params
	 * @param string $OrderBy
	 * @param int    $framePosition
	 * @param int    $frameSize
	 * @param string $blockList
	 *
	 * @return mixed
	 */
	public function BatchSearchItemsFrame($itemTitle, $search_params, $OrderBy = 'Default', $framePosition = 0, $frameSize = 16, $blockList = 'SearchProperties,AvailableSearchMethods')
	{
		$xmlParameters = '<SearchItemsParameters><IsClearItemTitles>false</IsClearItemTitles><ItemTitle>'.
			$itemTitle .'</ItemTitle><Configurators>'. $search_params .'</Configurators><OrderBy>'.
			$OrderBy .'</OrderBy></SearchItemsParameters>';
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('BatchSearchItemsFrame', ['xmlParameters' => $xmlParameters, 'blockList' => $blockList,
			'sessionId' => mt_rand(100000,99999999), 'framePosition' => $framePosition, 'frameSize' => $frameSize]);
		abort('404', 'method BatchSearchItemsFrame in progress');
		dd($data);
		//return $data->Result->Items;
		return $data;
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

	/**
	 * Получение подборки товаров
	 *
	 * @param string $itemRatingTypeId	Popular|Last
	 * @param int    $numberItem
	 * @param string $categoryId
	 *
	 * @return mixed
	 */
	public function popularTovars($itemRatingTypeId = 'Popular', $numberItem = 12, $categoryId = '')
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetItemRatingList', ['itemRatingTypeId' => $itemRatingTypeId, 'numberItem' => $numberItem, 'categoryId' => $categoryId]);
		abort('404', 'method popularTovars in progress');
		dd($data);
		return $data;
	}

	public function categoryTovars($categoryId, $categoryItemFilter = '', $framePosition = 0, $frameSize = 16)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('FindCategoryItemInfoListFrame', [
			'framePosition' => $framePosition,
			'frameSize' => $frameSize,
			'categoryId' => $categoryId,
			'categoryItemFilter' => $categoryItemFilter]);
		abort('404', 'method categoryTovars in progress');
		dd($data);
		return $data;
	}
}