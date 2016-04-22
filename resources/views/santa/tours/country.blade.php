@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    <div class="toursPageCountry row">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('tours.category', $data) !!}
            @include('santa.modules.share.sharing')
        </div>
        <div class="clearfix"></div>
        <div class="tours_tabs">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tour-photo">
                    <div class="toursPageCountry-photo">
                        @if(count($data->images) > 0)
                            <div id="carousel-country" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    @for($i=1; $i < count($data->images); $i++)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                                    @endfor
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    @foreach($data->images as $key => $image)
                                        <div class="item @if($key === 0) active @endif">
                                            <img src="{{ $image->getUrl() }}" alt="{{ $data->title }}" class="all-width">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-country" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-country" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tour-map">
                    <div id="map"></div>
                    @if($data->map_coordinate)
                        <script>
                            var map;
                            function initMap() {
                                map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: {{ $data->map_coordinate['lat'] }}, lng: {{ $data->map_coordinate['long'] }}},
                                    zoom: 4
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxKB99A6FyIpROOUAOJSJqZGQEB6bgd2E" async defer></script>
                    @endif
                </div>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="load-map" role="presentation"><a href="#tour-map" aria-controls="tour-map" role="tab" data-toggle="tab"><i class="fi flaticon-travel-5"></i> На карте</a></li>
                <li role="presentation" class="active"><a href="#tour-photo" aria-controls="tour-photo" role="tab" data-toggle="tab"><i class="fi flaticon-technology"></i> Фото</a></li>
            </ul>
        </div>
        <div class="toursPageCountry-short row">
            @if(isset($forecast['var']))
                <div class="col-sm-9">
                    @include('santa.modules.forecast.forecast')
                </div>
            @endif
            <div class="@if(isset($forecast['var'])) col-sm-15 @else col-sm-24 @endif">
                {!! $data->short !!}
            </div>
        </div>

        @if(count($data->get_childActive) > 0)
        <div class="toursPageCountry-popular row">
            <div class="col-xs-24"><h5 class="title-header">Популярные курорты</h5></div>
            @each('santa.tours.blockResourt', $data->get_childActive, 'data')
        </div>
        @endif

        @if($best_cost['hotelsCount'] > 0)
        <div class="toursPageCountry-bestcost row">
            <div class="col-xs-24"><h5 class="title-header">Лучшие цены</h5></div>
            @each('santa.tours.blockTourSletat', $best_cost['aaData'], 'item')
        </div>
        @endif

        @if(count($data->get_toursActive) > 0)
        <div class="toursPageCountry-recommented row">
            <div class="col-xs-24"><h5 class="title-header">Рекомендуемые туры</h5></div>
            @each('santa.tours.blockTour', $data->get_toursActive, 'data')
        </div>
        @endif

        <div class="toursPageCountry-description">
            {!! $data->description !!}
        </div>
    </div>
@endsection