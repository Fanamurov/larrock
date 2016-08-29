@if(count($data) > 0)
    <div class="modulePopular">
        <p class="h1 container-fluid">{{ $data['category'] }}</p><hr/>
        @foreach($data['items'] as $data_value)
            <div class="col-xs-12 col-sm-8 col-md-6 item-catalog">
                <div class="div-img">
                @if(isset($data_value->Pictures))
                    <a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">
                        @if(is_array($data_value->Pictures->ItemPicture))
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ $data_value->Title }}">
                        @else
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        @endif
                    </a>
                    @endif
                </div>
                <p><a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">
                        {{ mb_strimwidth($data_value->OriginalTitle, 0, 15, '...') }}
                    </a>
                </p>

                @if(isset($data_value->PromotionPrice->OriginalPrice))
                    <p class="cost">{{ $data_value->PromotionPrice->ConvertedPriceList->DisplayedMoneys->Money }} <small>{{ $data_value->Price->CurrencySign }}</small></p>
                @else
                    <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} <small>{{ $data_value->Price->CurrencySign }}</small></p>
                @endif
                <p>{{ mb_strimwidth($data_value->Title, 0, 45, '...') }}</p>

                <p class="vendor">
                    @php($score_delim = ceil($data_value->VendorScore/5))
                    @for($i=0; $i < $score_delim; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    </p>
            </div>
        @endforeach
    </div>
    <div class="clearfix"></div>
@endif