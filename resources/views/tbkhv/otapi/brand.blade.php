@extends('tbkhv.main')
@section('title') Поиск по магазину бренд {{ $data->Brands->Content->Item->BrandName }} @endsection

@section('content')
    <div class="page-catalog-category">
        <div class="col-xs-24">
            <h1>Бренд: <span class="strong-heavy">{{ $data->Brands->Content->Item->BrandName }}</span></h1>
        </div>
        <div class="row">
            @if(count($data->Categories->Content->Item) > 0)
                <div class="col-xs-24"><h2>Разделы:</h2></div>
                @foreach($data->Categories->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}'>
                        <div class="div-img">
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        </div>
                        <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} {{ $data_value->Price->CurrencySign }}</p>
                        <p>{{ $data_value->Title }}</p>
                        <p><a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">{{ $data_value->OriginalTitle }}</a></p>
                        <p class="vendor">Продавец: {{ $data_value->VendorName }} (Рейтинг: {{ $data_value->VendorScore }})</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            @if(count($data->Items->Content->Item) > 0)
                <div class="col-xs-24"><h2>Товары:</h2></div>
                @foreach($data->Items->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}'>
                        <div class="div-img">
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        </div>
                        <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} {{ $data_value->Price->CurrencySign }}</p>
                        <p>{{ $data_value->Title }}</p>
                        <p><a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">{{ $data_value->OriginalTitle }}</a></p>
                        <p class="vendor">Продавец: {{ $data_value->VendorName }} <br/>Рейтинг:
                            @php($score_delim = ceil($data_value->VendorScore/5))
                            @for($i=0; $i < $score_delim; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            </p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            @if(count($data->Brands->Content->Item) > 0)
                <div class="col-xs-24"><h2>Бренды:</h2></div>
                @foreach($data->Brands->Content->Item as $data_value)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <p><a href="/otapi/brand/{{ $data_value->BrandId }}">{{ $data_value->BrandName }}</a></p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection