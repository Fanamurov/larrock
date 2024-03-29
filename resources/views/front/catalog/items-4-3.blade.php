@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.items', $data) !!}

    <div class="catalog-filters">
        @include('front.modules.filters.sortCost')
        @include('front.modules.filters.vid')
        @include('front.modules.filters.itemsOnPage')
    </div>

    <div class="catalogPageCategoryItems row">
        @each('front.catalog.blockItem', $data->get_tovars, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection