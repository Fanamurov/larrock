@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.items', $data) !!}

    <div class="catalogPageCategoryItems row">
        @each('front.tours.blockItem', $data->get_toursActive, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection