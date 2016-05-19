@extends('santa.main')
@section('title') {{ $data->title }} @endsection
@section('description') {!! strip_tags($data->short) !!} @endsection

@section('content')
    <div class="toursPageItem row">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('tours.item', $data) !!}
        </div>
        <div class="clearfix"></div>
        <div class="row relative">
            @include('santa.modules.share.sharing')
            <div class="col-xs-24">
                <div class="toursImage">
                    @if(count($data->images) > 0)
                        <div id="carousel-tour" class="carousel slide" data-ride="carousel">
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
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if($data->cost_notactive === 1 OR (($data->actual > \Carbon\Carbon::createFromFormat('Y-m-d h:s:i', '2015-01-01 00:00:00')) AND ($data->actual < \Carbon\Carbon::now())))
            <div class="clearfix"></div>
            <div class="block-cost_notactive">
                <p>Цены не актуальны.<br/>
                Закажите индивидуальный расчет.</p>
            </div>
        @endif
        <div class="clearfix"></div>
        <div class="row-btn-group">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Забронировать по тел:<br/>+7 (4212) 45-45-46</button>
                <a href="#uptocall" class="btn btn-default btn-uptocall">Заказать звонок</a>
                <a href="#form-zakaz" role="button" class="btn btn-default">Заказать тур</a>
            </div>
        </div>
        <div class="row row-description">
            <div class="col-xs-24">
                <div class="toursFull">
                    <div class="tour-description">{!! $data->description !!}</div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row row-form-zakaz">
            @include('santa.modules.forms.zakaz')
        </div>
    </div>
@endsection