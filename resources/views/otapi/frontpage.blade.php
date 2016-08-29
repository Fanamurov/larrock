@extends('tbkhv.frontpage')
@section('title') Товары с китайских интернет-магазинов в Хабаровске. Доставка @endsection

@section('content')
    <div class="catalog-frontpage">
        <div class="col-md-24 catalog-frontpage-content">
            @include('tbkhv.modules.catalog.popular', ['data' => $modulePopular])
            <div class="clearfix"></div><br/><br/>

            @include('tbkhv.modules.catalog.last', ['data' => $moduleLast])
            <div class="clearfix"></div><br/><br/>

            @foreach($data as $data_value)
                @include('tbkhv.modules.catalog.category', ['data' => $data_value])
            @endforeach
        </div>
    </div>
@endsection