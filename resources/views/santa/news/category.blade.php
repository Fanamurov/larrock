@extends('santa.main')
@section('title') {{ $category->title }} @endsection

@section('content')
    <div class="pageBlogCategory">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('news.index', $data) !!}
        </div>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row col-xs-24">
                <div class="hidden-xs col-sm-6 col-md-8">
                    @if($item->getFirstMediaUrl('images', '250x250'))
                        <img class="all-width" src="{{ $item->getFirstMediaUrl('images', '250x250') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-xs-24 col-sm-18 col-md-16">
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