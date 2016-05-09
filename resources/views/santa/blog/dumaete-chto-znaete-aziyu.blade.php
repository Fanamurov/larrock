@extends('santa.main')
@section('title') {{ $data->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <div class="col-xs-24">
                {!! Breadcrumbs::render('blog.item', $data) !!}
            </div>
            <div class="blog-categorys">
                <ul class="list-unstyled list-inline">
                    @foreach($categorys as $category_value)
                        <li @if($category_value->id === $category->id) class="active" @endif>
                            <a href="/blog/{{ $category_value->url }}">{{ $category_value->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="page_description">{!! $data->description !!}</div>
            <div>
                <script type="text/javascript" src="//cdn.playbuzz.com/widget/feed.js"></script>
                <div class="pb_feed" data-embed-by="4ba2c002-9a1c-4b61-8150-720438701693" data-game="/ekaterinar10/1-28-2016-3-45-14-am" data-recommend="false" data-comments="false" ></div>
            </div>
        </div>
    </div>
@endsection

@section('contentBottom')
    @include('santa.modules.cackle.comments')
    @include('santa.modules.html.socialGroups')
@endsection
