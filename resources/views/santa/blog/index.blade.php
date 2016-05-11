@extends('santa.main')
@section('title') Блог компании Санта-авиа Хабаровск @endsection

@section('content')
    <div class="pageBlogCategory">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('blog.index', $data) !!}
        </div>
        <div class="blog-categorys">
            <ul class="list-unstyled list-inline hidden-xs hidden-sm">
                @foreach($category as $category_value)
                    <li>
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
                            @foreach($category as $category_value)
                                <option value="/blog/{{ $category_value->url }}">{{ $category_value->title }} ({{count($category_value->get_blogActive)}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div><br/>
        @foreach($data as $item)
            <div class="pageBlogCategory-item row">
                <div class="hidden-xs col-sm-6 col-md-8">
                    @if($item->getFirstMediaUrl('images', '250x250'))
                        <img class="all-width" src="{{ $item->getFirstMediaUrl('images', '250x250') }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-xs-24 col-sm-18 col-md-16">
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