@extends('front.main')
@section('title') {{ $seo['title'] }} @endsection

@section('content')
    <div class="catalogPageCategory row">
        @each('front.catalog.blockCategory', $data, 'data')
    </div>
@endsection