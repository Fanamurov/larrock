<div class="col-xs-12 col-sm-8 col-md-6 item-catalog link_block_this-blank" data-href='/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}'>
    <div class="div-img">
        @if(isset($data_value->Pictures))
            @if(is_array($data_value->Pictures->ItemPicture))
                <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ $data_value->Title }}">
            @else
                <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
            @endif
        @endif
    </div>
    @if(isset($data_value->PromotionPrice->ConvertedPriceList->Internal) && $data_value->PromotionPrice->Quantity > 0)
        <p class="cost">{{ $data_value->PromotionPrice->ConvertedPriceList->Internal }}</p>
    @else
        <p class="cost">{{ $data_value->Price->ConvertedPrice }}</p>
    @endif
    <p><a class="title-tovar" href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}" target="_blank">
            {{ mb_strimwidth($data_value->Title, 0, 70, '...') }}
        </a></p>
    <p class="vendor">{{ $data_value->VendorName }}
        @php($score_delim = ceil($data_value->VendorScore/5))
        <br/>@for($i=0; $i < $score_delim; $i++)
            <i class="fa fa-star"></i>
        @endfor
    </p>
</div>