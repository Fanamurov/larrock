@extends('tbkhv.main')
@section('title') Товары продавца {{ $data->Content->Item[0]->VendorName }} @endsection

@section('content')
    <div class="page-catalog-category">
        <h1>Товары продавца {{ $data->Content->Item[0]->VendorName }}</h1>
        <p>Всего товаров в разделе: {{ $data->TotalCount }}</p>
        <div class="row">
            @foreach($data->Content->Item as $data_value)
                <div class="col-xs-12 col-sm-6 col-md-4 item-catalog link_block_this" data-href='/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}'>
                    <div class="div-img">
                    @if(isset($data_value->Pictures))
                        @if(is_array($data_value->Pictures->ItemPicture))
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture[0]->Medium }}" alt="{{ $data_value->Title }}">
                        @else
                            <img class="all-width" src="{{ $data_value->Pictures->ItemPicture->Medium }}" alt="{{ $data_value->Title }}">
                        @endif
                        @endif
                    </div>
                    <p class="cost">{{ $data_value->Price->ConvertedPriceWithoutSign }} {{ $data_value->Price->CurrencySign }}</p>
                    <p><a href="/otapi/{{ $data_value->CategoryId }}/tovar/{{ $data_value->Id }}">
                            {{ mb_strimwidth($data_value->Title, 0, 70, '...') }}
                        </a></p>
                    <p class="vendor">{{ $data_value->VendorName }}
                        @php($score_delim = ceil($data_value->VendorScore/5))
                        <br/>@for($i=0; $i < $score_delim; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="pagination">
        {{ $paginator->render() }}
    </div>
@endsection