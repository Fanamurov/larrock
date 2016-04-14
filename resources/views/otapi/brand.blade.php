@extends('tbkhv.main')
@section('title') Поиск по магазину бренд {{ (string)$data->Result->Brands->Content->Item->BrandName }} @endsection

@section('content')
    <div class="page-catalog-category">
        <div class="col-xs-24">
            <h1>Бренд: <span class="strong-heavy">{{ (string)$data->Result->Brands->Content->Item->BrandName }}</span></h1>
        </div>
        <div class="row">
            @if(count($data->Result->Categories->Content->Item) > 0)
                <div class="col-xs-24"><h2>Разделы:</h2></div>
                @foreach($data->Result->Categories->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                        <div class="div-img">
                            <img class="all-width" src="{{ (string)$data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                        </div>
                        <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                        <p>{{ (string)$data_value->Title }}</p>
                        <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                        <p class="vendor">Продавец: {{ (string)$data_value->VendorName }} (Рейтинг: {{ (string)$data_value->VendorScore }})</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            @if(count($data->Result->Items->Content->Item) > 0)
                <div class="col-xs-24"><h2>Товары:</h2></div>
                @foreach($data->Result->Items->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}'>
                        <div class="div-img">
                            <img class="all-width" src="{{ (string)$data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                        </div>
                        <p class="cost">{{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                        <p>{{ (string)$data_value->Title }}</p>
                        <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                        <p class="vendor">Продавец: {{ (string)$data_value->VendorName }} Рейтинг:
                            @for($i=0; $i < ceil((string)$data_value->VendorScore/5); $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            </p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            @if(count($data->Result->Brands->Content->Item) > 0)
                <div class="col-xs-24"><h2>Бренды:</h2></div>
                @foreach($data->Result->Brands->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <p><a href="/otapi/brand/{{ (string)$data_value->BrandId }}">{{ (string)$data_value->BrandName }}</a></p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection