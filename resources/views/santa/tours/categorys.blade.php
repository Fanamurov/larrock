@extends('santa.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    <div class="toursPageCategory toursPageCategory-2 row">
        @each('front.tours.blockCategory', $data, 'data')
    </div>
@endsection