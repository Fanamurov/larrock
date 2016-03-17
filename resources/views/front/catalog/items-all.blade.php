@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.all') !!}

    <div class="catalogPageCategoryItems row">
        @each('front.catalog.blockItem', $data, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection