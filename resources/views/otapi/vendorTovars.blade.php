@extends('tbkhv.main')
@section('title') Товары продавца {{ (string)$data->OtapiItemInfoSubList->Content->Item->VendorName }} @endsection

@section('content')
    <div class="page-catalog-category">
        <h1>Товары продавца {{ (string)$data->OtapiItemInfoSubList->Content->Item->VendorName }}</h1>
        <p>Всего товаров в разделе: {{ (string)$data->OtapiItemInfoSubList->TotalCount }}</p>
        <div class="row">
            @foreach($data->OtapiItemInfoSubList->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-6 col-md-4 item-catalog">
                    <div class="div-img">
                        <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ (string)$data_value->Title }}">
                    </div>
                    <p>{{ (string)$data_value->Title }}</p>
                    <p><a href="/otapi/{{ (string)$data_value->CategoryId }}/tovar/{{ (string)$data_value->Id }}">{{ (string)$data_value->OriginalTitle }}</a></p>
                    <p>Price: {{ (string)$data_value->Price->ConvertedPriceWithoutSign }} {{ (string)$data_value->Price->CurrencySign }}</p>
                    <p>В наличии: {{ (string)$data_value->MasterQuantity }} шт.</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pagination">
        $data->OtapiItemInfoSubList->TotalCount
    </div>
@endsection