@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('catalog.category', $data) !!}
    <div class="catalogPageCategory row">
        @each('front.catalog.blockCategory', $data->get_child, 'data')
    </div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection