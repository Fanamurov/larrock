@extends('front.main')
@section('title'){{ $seo['title'] }}. {{ $seo_midd['postfix_global'] }}@endsection

@section('content')
    <div class="catalogPageCategory catalogPageCategory-2 row">
        @each('front.catalog.blockCategory', $data, 'data')
    </div>
@endsection