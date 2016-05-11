@extends('tbkhv.frontpage')
@section('title') Товары с китайских интернет-магазинов в Хабаровске. Доставка @endsection

@section('content')
    <div class="catalog-frontpage">
        <div class="col-sm-24 catalog-frontpage-content">
            @include('tbkhv.modules.catalog.popular', $modulePopular)

            <div class="clearfix"></div><br/><br/>

            @include('tbkhv.modules.catalog.last', $moduleLast)

            <div class="clearfix"></div><br/><br/>

            @include('tbkhv.modules.catalog.vendorPopular', $moduleVendorPopular)

            <div class="clearfix"></div><br/>
        </div>
    </div>
@endsection