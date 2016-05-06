@extends('santa.main')
@section('title') Блог компании Санта-авиа Хабаровск @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>Блог</h1>
        <div class="blog-categorys">
            <ul class="list-unstyled list-inline">
                @foreach($category as $category_value)
                    <li>
                        <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div><br/>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-md-4 hidden-xs hidden-sm">
                    @if($item->getFirstMediaUrl('images', '110x110'))
                        <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-xs-24 col-md-20">
                    <h4><a href="/blog/{{ $item->get_category->url }}/{{ $item->url }}">{{ $item->title }}</a></h4>
                    <div class="pageBlogCategory-item_short">{!! $item->short !!}</div>
                </div>
            </div>
        @endforeach
    </div>
    {!! $data->render() !!}
@endsection

@section('contentBottom')
    @include('santa.modules.html.socialGroups')
@endsection