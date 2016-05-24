@extends('santa.main')
@section('title') Отели @endsection

@section('content')
    <div class="toursVid row">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('hotels.index', $data) !!}
            @include('santa.modules.share.sharing')
        </div>
        <div class="clearfix"></div><br/>
        <div class="catalogPageCategoryItems row">
            @each('santa.hotels.blockHotel', $data, 'data')
        </div>

        <div class="Pagination catalogPagination">{!! $data->render() !!}</div>
    </div>
@endsection