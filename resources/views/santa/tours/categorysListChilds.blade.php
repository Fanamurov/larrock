@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.category', $data) !!}
    <div class="toursPageCategory row">
        @each('front.tours.blockCategory', $data->get_child, 'data')
    </div>
@endsection

@section('front.modules.list.catalog')
    @include('front.modules.list.catalog')
@endsection