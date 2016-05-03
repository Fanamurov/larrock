@extends('santa.main')
@section('title') {{ $category->title }} @endsection

@section('content')
    <div class="pageBlogCategory">
        <h1>{{ $category->title }}</h1>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row">
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