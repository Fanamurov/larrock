@extends('santa.main')
@section('title') {{ $data->title }}. Блог компании Санта-авиа Хабаровск @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>Блог</h1>
        <div class="blog-categorys">
            <ul class="list-unstyled list-inline">
                @foreach($category as $category_value)
                    <li @if($category_value->id === $data->id) class="active" @endif>
                        <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @foreach($data->get_blogActive as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-sm-4">
                    @if($item->getFirstMediaUrl('images', '110x110'))
                        <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-sm-20">
                    <h4><a href="/blog/{{ $item->url }}">{{ $item->title }}</a></h4>
                    <div class="pageBlogCategory-item_short">{!! $item->short !!}</div>
                    <div>
                        <a class="btn btn-default" href="/blog/{{ $item->url }}">Читать далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('contentBottom')
    @include('santa.modules.html.socialGroups')
@endsection