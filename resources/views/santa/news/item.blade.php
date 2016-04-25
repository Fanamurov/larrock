@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <h1>{{ $data->title }}</h1>
            <div class="page_description">{!! $data->description !!}</div>
        </div>
    </div>
@endsection

@section('contentBottom')
    <div>
        <a class="btn btn-default" href="/news">Назад к новостям</a>
    </div>
@endsection