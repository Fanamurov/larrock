<div class="modulePopular">
    <p class="h1 container-fluid">Сейчас просматривают</p><hr/>
    @foreach($data as $data_value)
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

            @if(isset($data_value->PromotionPrice->OriginalPrice))
                <p class="cost">{{ $data_value->PromotionPrice->ConvertedPriceList->DisplayedMoneys->Money }} <small>{{ $data_value->Price->CurrencySign }}</small></p>
            @else
                <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} <small>{{ $data_value->Price->CurrencySign }}</small></p>
            @endif
            <p>{{ mb_strimwidth($data_value->Title, 0, 45, '...') }}</p>

            <p class="vendor">{{ $data_value->VendorName }}<br/>
                @php($vendor_score = ceil($data_value->VendorScore/5))
                @for($i=0; $i < $vendor_score; $i++)
                    <i class="fa fa-star"></i>
                @endfor
            </p>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>