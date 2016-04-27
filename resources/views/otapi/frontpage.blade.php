@extends('tbkhv.frontpage')
@section('title') Category @endsection

@section('content')
    <div class="catalog-frontpage">
        <div class="col-sm-24 catalog-frontpage-content">
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