@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>{{ $data->title }}</h1>
        @foreach($data->get_feedActive as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-sm-4">
                    <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}">
                </div>
                <div class="col-sm-20">
                    <a class="h4" href="/news/{{ $item->url }}">{{ $item->title }}</a>
                    <div class="pageBlogCategory-item_short">{!! $item->short !!}</div>
                    <div>
                        <a class="btn btn-default" href="/news/{{ $item->url }}">Читать далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection