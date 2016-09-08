@extends('tbkhv.main')
@section('title') Товары продавца {{ $data->Content->Item[0]->VendorName }} @endsection

@section('content')
    <div class="page-catalog-category">
        <h1>Товары продавца {{ $data->Content->Item[0]->VendorName }}</h1>
        <p>Всего товаров в разделе: {{ $data->TotalCount }}</p>
        <div class="row">
            @foreach($data->Content->Item as $data_value)
                @include('tbkhv.otapi.item.block-tovar', ['data_value' => $data_value])
            @endforeach
        </div>
    </div>

    <div class="pagination">
        {{ $paginator->render() }}
    </div>
@endsection