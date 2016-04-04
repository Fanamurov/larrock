@extends('santa.main')
@if($data->get_seo)
    @section('title') {{ $data->get_seo->title }} @endsection
@else
    @section('title') {{ $data->title }} @endsection
@endif

@section('content')
    {!! Breadcrumbs::render('tours.items', $data) !!}

    <div class="catalogPageCategoryItems row">
        @each('santa.tours.blockTour', $data->get_toursActive, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection