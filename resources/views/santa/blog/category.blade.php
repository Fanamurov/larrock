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
        <div class="clearfix"></div><br/>
        @foreach($data->get_blogActive as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-sm-6">
                    @if($item->getFirstMediaUrl('images', '140x140'))
                        <img src="{{ $item->getFirstMediaUrl('images', '140x140') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-sm-18">
                    <h4><a href="/blog/{{ $item->url }}">{{ $item->title }}</a></h4>
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