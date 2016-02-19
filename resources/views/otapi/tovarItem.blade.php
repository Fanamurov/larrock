<p>{{ (string)$data->OtapiItemFullInfo->Title }}</p>
<p>{{ (string)$data->OtapiItemFullInfo->OriginalTitle }}</p>
<p>Продавец: {{ (string)$data->OtapiItemFullInfo->VendorName }} (Рейтинг: {{ (string)$data->OtapiItemFullInfo->VendorScore }})</p>
<p>Url: {{ (string)$data->OtapiItemFullInfo->TaobaoItemUrl }}</p>
<p>Price: {{ (string)$data->OtapiItemFullInfo->Price->ConvertedPriceWithoutSign }} {{ (string)$data->OtapiItemFullInfo->Price->CurrencySign }}</p>
<p>Есть доставка: {{ (string)$data->OtapiItemFullInfo->Price->IsDeliverable }}</p>
<p>Местонахождение товара: {{ (string)$data->OtapiItemFullInfo->Location->City }} ({{ (string)$data->OtapiItemFullInfo->Location->State }})</p>
<p>Количество товара: {{ (string)$data->OtapiItemFullInfo->MasterQuantity }} шт.</p>

@foreach($data->OtapiItemFullInfo->Pictures->ItemPicture as $picture)
    <p>Картинка: {{ (string)$picture->Large }}</p>
@endforeach

Раздел:
<p>Id Category: {{ (string)$category->OtapiCategory->Id }}</p>
<p>Category name: {{ (string)$category->OtapiCategory->Name }}</p>
<p>Id parent category: {{ (string)$category->OtapiCategory->ParentId }}</p>