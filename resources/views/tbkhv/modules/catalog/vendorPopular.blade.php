<div class="moduleVendorPopular">
    <p class="h1 container-fluid">Популярные продавцы</p><hr/>
    @foreach($data as $data_value)
        @if(isset($data_value->PictureUrl))
            <div class="col-xs-8 col-sm-4 item-catalog">
                <div class="div-img">
                    <a href="/otapi/vendor/{{ $data_value->Id }}">
                        <img class="all-width" src="{{ $data_value->PictureUrl }}" alt="{{ $data_value->Name }}">
                    </a>
                </div>
                <p><a href="/otapi/vendor/{{ $data_value->Id }}">{{ $data_value->Name }}</a></p>
                <p><span class="strong">{{ $data_value->Credit->PositiveFeedbacks }}</span> из {{ $data_value->Credit->TotalFeedbacks }}
                    позитивных отзывов
                </p>
            </div>
        @endif
    @endforeach
</div>
<div class="clearfix"></div>