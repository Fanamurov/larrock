<?php

namespace App\Helpers\Otapi;

class OtapiReview
{
    /** Установка флага на игнорирование ошибок api от конкретного запроса @var  bool */
    protected $allow_safe_mode = TRUE;

    public function get($itemId, $framePosition = 0, $frameSize = 10)
    {
        $otapiConnection = new OtapiConnection;
        $data = $otapiConnection->create_request('GetTradeRateInfoListFrame', [
            'itemId' => $itemId,
            'framePosition' => $framePosition,
            'frameSize' => $frameSize], $this->allow_safe_mode);
        if(isset($data->TradeRateInfoList)){
            return $this->normalizeGet($data->TradeRateInfoList);
        }
        return collect();
    }

    protected function normalizeGet($item)
    {
        if($item->TotalCount === '1'){
            $item->Content->Item = [0 => $item->Content->Item];
        }
        return $item;
    }
}