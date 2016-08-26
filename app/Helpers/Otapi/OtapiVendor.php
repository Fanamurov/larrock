<?php

namespace App\Helpers\Otapi;

class OtapiVendor
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = TRUE;

	/**
	 * Получение информации о бренде по его Id
	 * @param $brandId
	 *
	 * @return mixed
	 */
	public function get($brandId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetBrandInfo', ['brandId' => $brandId], $this->allow_safe_mode);
		return $data;
	}

	/**
	 * Получение списка товаров продавца по его Id
	 * @param        $vendorId
	 * @param int    $framePosition
	 * @param int    $frameSize
	 * @param string $sortingParameters
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function tovars($vendorId, $framePosition = 0, $frameSize = 6, $sortingParameters = '')
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetVendorItemInfoSortedListFrame', [
			'vendorId' => $vendorId,
			'framePosition' => $framePosition,
			'frameSize' => $frameSize,
			'sortingParameters' => $sortingParameters]);
		if(isset($data->OtapiItemInfoSubList)){
			return $data->OtapiItemInfoSubList;
		}
		return collect();
	}

	/**
	 * Получение подборки товаров продавца
	 * @param string $itemRatingTypeId
	 * @param int    $numberItem
	 * @param string $categoryId
	 *
	 * @return mixed
	 */
	public function GetVendorRatingList($itemRatingTypeId = 'Popular', $numberItem = 6, $categoryId = '')
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetVendorRatingList', [
			'itemRatingTypeId' => $itemRatingTypeId, 'numberItem' => $numberItem, 'categoryId' => $categoryId], $this->allow_safe_mode);
		return $data->Result->Content->Item;
	}
}