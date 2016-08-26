<?php

namespace App\Helpers\Otapi;

class OtapiBrand
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = FALSE;

	public function get($brandId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetVendorInfo', ['brandId' => $brandId], $this->allow_safe_mode);
		if(isset($data->VendorInfoAnswer)){
			return $data->VendorInfoAnswer;
		}
		return collect();
	}

	public function tovars($brandId, $framePosition = 0, $frameSize = 6)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('SearchItemsFrame', [
			'xmlParameters' => '<SearchItemsParameters><BrandId>'. $brandId .'</BrandId></SearchItemsParameters>',
			'framePosition' => $framePosition,
			'frameSize' => $frameSize]);
		return $data->Result;
	}

	public function GetVendorRatingList($itemRatingTypeId = 'Popular', $numberItem = 6, $categoryId = '')
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetVendorRatingList', [
			'itemRatingTypeId' => $itemRatingTypeId, 'numberItem' => $numberItem, 'categoryId' => $categoryId], TRUE);
		return $data->Result->Content->Item;
	}
}