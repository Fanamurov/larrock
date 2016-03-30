@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.all') !!}

    <div class="toursPageCategoryItems row">
        @each('front.tours.blockItem', $data, 'data')
    </div>

    <div class="Pagination catalogPagination">{!! $paginator->render() !!}</div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection