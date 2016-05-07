@extends('santa.main')
@section('title') {{ $category->title }}. Блог компании Санта-авиа Хабаровск @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>Блог. {{ $category->title }}</h1>
        <div class="blog-categorys">
            <ul class="list-unstyled list-inline">
                @foreach($categorys as $category_value)
                    <li @if($category_value->id === $category->id) class="active" @endif>
                        <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div><br/>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row">
                <div class="col-sm-6">
                    @if($item->getFirstMediaUrl('images', '140x140'))
                        <img src="{{ $item->getFirstMediaUrl('images', '140x140') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-sm-18">
                    <h4><a href="/blog/{{ $category->url  }}/{{ $item->url }}">{{ $item->title }}</a></h4>
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