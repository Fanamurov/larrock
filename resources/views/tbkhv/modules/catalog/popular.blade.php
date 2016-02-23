<div class="modulePopular">
    <p class="h1 container-fluid">Популярные товары</p><hr/>
    @foreach($data->Content->Content->Item as $data_value)
        <div class="col-xs-12 col-sm-6 item-catalog">
            <div class="div-img">
                <a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">
                    <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                </a>
            </div>
            <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
            <p>{{ (string)$data_value->Title }}</p>
            <p>Продавец: {{ (string)$data_value->VendorName }} (Рейтинг: {{ (string)$data_value->VendorScore }})</p>
            <p>Price: {{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>