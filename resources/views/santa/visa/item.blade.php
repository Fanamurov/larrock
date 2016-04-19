@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <h1>{{ $data->title }}</h1>
            <div class="page_description">{!! $data->description !!}</div>
            <br/>
            <div class="blog-categorys">
                <p class="h3">Все материалы визовой поддержки:</p>
                <ul class="list-unstyled list-inline">
                    @foreach($category as $category_item)
                        <li @if($category_item->url === $data->url) class="active" @endif>
                            <a href="/blog/{{ $category_item->url }}">{{ $category_item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection