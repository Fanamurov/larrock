@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }} pagePage">
        <h1>{{ $data->title }}</h1>
        <div class="tv-hot-tours tv-moduleid-932987"></div>
            <script type="text/javascript" src="//tourvisor.ru/module/init.js"></script>
        </div>
        <div class="page_description">{!! $data->description !!}</div>
    </div>
@endsection