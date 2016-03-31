@extends('santa.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.category', $data) !!}
    <div class="toursPageCategory row">
        @each('santa.tours.blockCategory', $data->get_child, 'data')
    </div>
@endsection