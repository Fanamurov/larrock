<?php

namespace App\Helpers\Otapi;

class OtapiVendor
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = TRUE;

	public function get($vendorId)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetVendorInfo', ['vendorId' => $vendorId], $this->allow_safe_mode);
		if(isset($data->VendorInfoAnswer)){
			return $data->VendorInfoAnswer;
		}
		return collect();
	}

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
}