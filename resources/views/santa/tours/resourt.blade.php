@extends('santa.main')
@section('title') {{ $data->title }} {{ $data->get_parent->title }} @endsection

@section('content')
    <div class="toursPageCountry row">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('tours.category', $data) !!}
        </div>
        <div class="clearfix"></div>
        <div class="tours_tabs">
            @include('santa.modules.share.sharing')
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
                    <div id="map" data-place="{{ $data->title }}" data-place-country="{{ $data->get_parent->title }}" data-coord=""></div>
                    @push('scripts')
                        <script>
                            function initMap() {
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 9,
                                    center: {lat: -34.397, lng: 150.644}
                                });
                                var geocoder = new google.maps.Geocoder();

                                geocodeAddress(geocoder, map);
                            }

                            function geocodeAddress(geocoder, resultsMap) {
                                var address = $('#map').attr('data-place');
                                geocoder.geocode({'address': address}, function(results, status) {
                                    if (status === google.maps.GeocoderStatus.OK) {
                                        resultsMap.setCenter(results[0].geometry.location);
                                        $('#map').attr('data-coord', results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: resultsMap,
                                            position: results[0].geometry.location
                                        });
                                    } else {
                                        geocodeAddress_backup(geocoder, resultsMap);
                                    }
                                });
                            }
                            function geocodeAddress_backup(geocoder, resultsMap) {
                                var address = $('#map').attr('data-place-country');
                                geocoder.geocode({'address': address}, function(results, status) {
                                    if (status === google.maps.GeocoderStatus.OK) {
                                        resultsMap.setCenter(results[0].geometry.location);
                                        $('#map').attr('data-coord', results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: resultsMap,
                                            position: results[0].geometry.location
                                        });
                                    } else {
                                        //alert('Geocode was not successful for the following reason: ' + status);
                                    }
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxKB99A6FyIpROOUAOJSJqZGQEB6bgd2E&callback=initMap"
                                async defer></script>
                    @endpush
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

        @if(count($data->get_toursActive) > 0)
        <div class="toursPageCountry-recommented row">
            <div class="col-xs-24"><h5 class="title-header">Рекомендуемые туры</h5></div>
            @each('santa.tours.blockTour', $data->get_toursActive, 'data')
        </div>
        @endif

        @if(count($data->get_parent->get_toursActive) > 0)
            <div class="toursPageCountry-recommented row">
                <div class="col-xs-24"><h5 class="title-header">{{ $data->get_parent->title }}. Рекомендуемые туры</h5></div>
                @each('santa.tours.blockTour', $data->get_parent->get_toursActive, 'data')
            </div>
        @endif

        <div class="sletatResult" data-country-id="{{ $country_id_sletat }}">
            @if($GetTours['hotelsCount'] > 0)
                @include('santa.sletat.searchResultShort')
            @else
                <div class="toursPageCountry-bestcost row">
                    <div class="col-xs-24"><h5 class="title-header">Лучшие цены</h5></div>
                    <div class="col-xs-24" id="loadState">
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                <span class="progress-current">0%</span>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning col-xs-24 alert-progress">Обработка запроса продолжается</div>
                </div>
            @push('scripts')
                <script>
                    $(document).ready(function(){
                        GetLoadStateShort({{ $GetTours['requestId'] }}, 20, 3);
                    });
                </script>
            @endpush
            @endif
        </div>

        <div class="toursPageCountry-description">
            {!! $data->description !!}
        </div>

        @if(count($other_resourts) > 0)
            <br/>
            <div class="toursPageCountry-recommented row">
                <div class="col-xs-24"><h5 class="title-header">{{ $data->get_parent->title }}. Другие курорты</h5></div>
                @each('santa.tours.blockTour', $other_resourts, 'data')
            </div>
        @endif
    </div>
@endsection