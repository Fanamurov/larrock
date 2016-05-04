@extends('santa.main')
@if($data->get_seo)
    @section('title') {{ $data->get_seo->title }} @endsection
@else
    @section('title') {{ $data->title }} @endsection
@endif

@section('content')
    <div class="toursVid row">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('tours.vid', $data) !!}
            @include('santa.modules.share.sharing')
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="catalogPageCategoryItems row">
            @each('santa.tours.blockTour', $data->get_toursActive, 'data')
        </div>

        <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
    </div>
@endsection