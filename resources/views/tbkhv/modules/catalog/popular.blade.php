<div class="modulePopular">
    <p class="h1 container-fluid">Популярные товары</p><hr/>
    @foreach($data->Content->Content->Item as $data_value)
        <div class="col-xs-12 col-sm-4 item-catalog">
            <div class="div-img">
                <a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">
                    @if(is_array($data_value->Pictures->ItemPicture))
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ (string)$data_value->Title }}">
                    @else
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                    @endif
                </a>
            </div>
            <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">
                    {{ mb_strimwidth((string)$data_value->OriginalTitle, 0, 15, '...') }}
                </a>
            </p>

            @if(isset($data_value->PromotionPrice->OriginalPrice))
                <p class="cost">{{ (string)$data_value->PromotionPrice->ConvertedPriceList->DisplayedMoneys->Money }} <small>{{ (string)$data_value->Price->CurrencySign }}</small></p>
            @else
                <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} <small>{{ (string)$data_value->Price->CurrencySign }}</small></p>
            @endif
            <p>{{ mb_strimwidth((string)$data_value->Title, 0, 45, '...') }}</p>

            <p class="vendor">
                @for($i=0; $i < ceil((string)$data_value->VendorScore/5); $i++)
                    <i class="fa fa-star"></i>
                @endfor
                </p>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>