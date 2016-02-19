<ul>
@foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
    <li>
        <p>{{ (string)$data_value->Title }}</p>
        <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
        <p>Продавец: {{ (string)$data_value->VendorName }} (Рейтинг: {{ (string)$data_value->VendorScore }})</p>
        <p>Price: {{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
    </li>
@endforeach
</ul>