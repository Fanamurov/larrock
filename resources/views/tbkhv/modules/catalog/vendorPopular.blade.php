<div class="moduleVendorPopular">
    <p class="h1 container-fluid">Популярные продавцы</p><hr/>
    @foreach($data->Result->Content->Item as $data_value)
        <div class="col-xs-8 col-sm-4 item-catalog">
            <div class="div-img">
                <a href="/otapi/vendor/{{ (string)$data_value->Id }}">
                    <img class="all-width" src="{{ (string)$data_value->PictureUrl }}" alt="{{ (string)$data_value->Name }}">
                </a>
            </div>
            <p><a href="/otapi/vendor/{{ (string)$data_value->Id }}">{{ (string)$data_value->Name }}</a></p>
            <p><span class="strong">{{ (string)$data_value->Credit->PositiveFeedbacks }}</span> из {{ (string)$data_value->Credit->TotalFeedbacks }}
                позитивных отзывов
            </p>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>