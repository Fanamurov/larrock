<?php

namespace App\Helpers\Otapi;

class OtapiReview
{
	/** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
	protected $allow_safe_mode = TRUE;

	public function get($itemId, $framePosition = 0, $frameSize = 6)
	{
		$otapiConnection = new OtapiConnection;
		$data = $otapiConnection->create_request('GetTradeRateInfoListFrame', [
			'itemId' => $itemId,
			'framePosition' => $framePosition,
			'frameSize' => $frameSize]);
		return $data->TradeRateInfoList;
	}
}