@extends('santa.main')
@section('title') {{ $data->title }}. {{ $category->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <h1>{{ $data->title }}. {{ $category->title }}</h1>
            <div class="page_description">{!! $data->description !!}</div>
            <br/>
            <div class="blog-categorys">
                <p class="h3">Все материалы визовой поддержки:</p>
                <ul class="list-unstyled list-inline">
                    @foreach($category->get_visaActive as $data_item)
                        <li @if($data_item->url === $data->url) class="active" @endif>
                            <a href="/blog/{{ $data_item->url }}">{{ $data_item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection