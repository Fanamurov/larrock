@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>{{ $data->title }}</h1>
        <div class="blog-categorys">
            <ul class="list-unstyled list-inline">
                @foreach($data->get_childActive as $child)
                    <li>
                        <a href="/blog/{{ $child->url }}">{{ $child->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @foreach($data->get_feedActive as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-sm-4">
                    <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}">
                </div>
                <div class="col-sm-20">
                    <a class="h4" href="/blog/{{ $item->url }}">{{ $item->title }}</a>
                    <div class="pageBlogCategory-item_short">{!! $item->short !!}</div>
                    <div>
                        <a class="btn btn-default" href="/blog/{{ $item->url }}">Читать далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection