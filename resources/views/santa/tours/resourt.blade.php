@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.category', $data) !!}
    <div class="toursPageCountry row">
        <h1>{{ $data->title }}</h1>
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
        <div class="toursPageCountry-short row">
            <div class="col-sm-12">
                WEATHER
            </div>
            <div class="col-sm-12">
                {!! $data->short !!}
            </div>
        </div>

        <div class="toursPageCountry-recommented row">
            <div class="col-xs-24"><h5 class="title-header">Рекомендуемые туры</h5></div>
            @each('santa.tours.blockTour', $data->get_toursActive, 'data')
        </div>

        <div class="toursPageCountry-description">
            {!! $data->description !!}
        </div>
    </div>
@endsection