@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <h1>{{ $data->title }}</h1>
            <div class="page_description">{!! $data->description !!}</div>
        </div>
    </div>
@endsection