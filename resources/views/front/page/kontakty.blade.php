@extends('front.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }}">
        <div class="page_description">{!! $data->description !!}</div>
        <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=-EMR2p-Qh5eYod3tKUZIyvUwS0mhGTG2&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
    </div>
@endsection

@section('rightColomn')
    @include('front.modules.forms.contact')
@endsection