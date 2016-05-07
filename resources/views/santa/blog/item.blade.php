@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <h1>{{ $data->title }}</h1>
            <div class="blog-categorys">
                <ul class="list-unstyled list-inline">
                    @foreach($categorys as $category_value)
                        <li @if($category_value->id === $category->id) class="active" @endif>
                            <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="page_description">{!! $data->description !!}</div>
        </div>
    </div>
@endsection

@section('contentBottom')
    @include('santa.modules.cackle.comments')
    @include('santa.modules.html.socialGroups')
@endsection