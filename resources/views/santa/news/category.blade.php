@extends('santa.main')
@section('title') {{ $category->title }} @endsection

@section('content')
    <div class="pageBlogCategory">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('news.index', $data) !!}
        </div>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row col-xs-24">
                <div class="col-sm-4">
                    @if($item->getFirstMediaUrl('images', '110x110'))
                        <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-sm-20">
                    <a class="h4" href="/news/{{ $item->url }}">{{ $item->title }}</a>
                    <div class="pageBlogCategory-item_short">{!! $item->short !!}</div>
                </div>
            </div>
        @endforeach
        {!! $data->render() !!}
    </div>
@endsection

@section('contentBottom')
    @include('santa.modules.html.socialGroups')
@endsection