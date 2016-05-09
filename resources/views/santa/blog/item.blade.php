@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <div class="col-xs-24">
                {!! Breadcrumbs::render('blog.item', $data) !!}
            </div>
            <div class="blog-categorys">
                <ul class="list-unstyled list-inline hidden-xs hidden-sm">
                    @foreach($categorys as $category_value)
                        <li @if($category_value->id === $category->id) class="active" @endif>
                            <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</a>
                        </li>
                    @endforeach
                </ul>
                <div class="form-group hidden-md hidden-lg">
                    <div class="row">
                        <div class="col-xs-24">
                            <label for="category_blog">Разделы блога:</label>
                        </div>
                        <div class="col-xs-24">
                            <select name="category_blog" class="form-control" id="category_blog">
                                @foreach($categorys as $category_value)
                                    <option @if($category_value->url === $category->url) selected @endif value="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page_description">{!! $data->description !!}</div>
        </div>
    </div>
@endsection

@section('contentBottom')
    <div>
        <a class="btn btn-default" href="/blog/{{ $category->url }}">Назад к блогу</a>
    </div>
    @include('santa.modules.cackle.comments')
    @include('santa.modules.html.socialGroups')
@endsection