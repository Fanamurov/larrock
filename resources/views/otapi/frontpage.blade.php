@extends('tbkhv.main')
@section('title') Category @endsection

@section('content')
    <div class="catalog-frontpage">
        <div class="col-sm-6 menu-items">
            @foreach($data->Item as $data_value)
                <a href="/otapi/{{ (string)$data_value->Id }}"><i class="fa fa-folder-o"></i> {{ (string)$data_value->Name }}</a>
            @endforeach
        </div>
        <div class="col-sm-18 catalog-frontpage-content">
            @include('tbkhv.modules.catalog.popular', $modulePopular)

            <br/><br/>
            <div class="row">
                <div class="col-xs-24 col-sm-8">
                    <a href="#">
                        <img src="/d2-05.jpg" class="all-width">
                    </a>
                </div>
                <div class="col-xs-24 col-sm-8">
                    <a href="#">
                        <img src="/d2-06.jpg" class="all-width">
                    </a>
                </div>
                <div class="col-xs-24 col-sm-8">
                    <a href="#">
                        <img src="/d2-07.jpg" class="all-width">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div><br/><br/>

            @include('tbkhv.modules.catalog.last', $moduleLast)

            <br/><br/>
            <div class="row">
                <div class="col-xs-24 col-sm-12">
                    <a href="#">
                        <img src="/d2-08.jpg" class="all-width">
                    </a>
                </div>
                <div class="col-xs-24 col-sm-12">
                    <a href="#">
                        <img src="/d2-09.jpg" class="all-width">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div><br/><br/>

            @include('tbkhv.modules.catalog.vendorPopular', $moduleVendorPopular)

            <br/><br/>

            <div class="row">
                <div class="col-xs-24">
                    <a href="#">
                        <img src="/d1-12.jpg" class="all-width">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div><br/><br/>
        </div>
    </div>
@endsection