@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    {!! Breadcrumbs::render('tours.category', $data) !!}
    <div class="toursPageCategory row">
        @each('santa.tours.blockCategory', $data->get_childActive, 'data')
    </div>
@endsection