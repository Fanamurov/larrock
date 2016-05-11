@if($data->OtapiItemInfoSubList->TotalCount > 0)
    <div class="modulePopular">
        <p class="h1 container-fluid">Сопутствующие товары</p><hr/>
        @foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
            <div class="col-xs-12 col-sm-4 col-md-3 item-catalog">
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
                <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                <p class="vendor">{{ (string)$data_value->VendorName }}<br/>
                    @for($i=0; $i < ceil((string)$data_value->VendorScore/5); $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    </p>
            </div>
        @endforeach
    </div>
    <div class="clearfix"></div>
@endif