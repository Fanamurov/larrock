@if($totalCount > 0)
    <div class="modulePopular">
        <p class="h1 container-fluid">Другие товары раздела</p><hr/>
        @foreach($data as $data_value)
            <div class="col-xs-12 col-sm-4 item-catalog">
                <div class="div-img">
                    <a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">
                        @if(is_array($data_value->Pictures->ItemPicture))
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ $data_value->Title }}">
                        @else
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        @endif
                    </a>
                </div>
                <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} {{ $data_value->Price->CurrencySign }}</p>
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
@endif