@extends('santa.main')
@section('title') {{ $data->title }}. {{ $category->title }} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="page-{{ $data->url }}">
            <div class="blog-categorys">
                <div class="form-group hidden-md hidden-lg">
                    <div class="row">
                        <div class="col-xs-24">
                            <label for="category_blog">Страны:</label>
                        </div>
                        <div class="col-xs-24">
                            <select name="category_blog" class="form-control" id="category_blog">
                                <option value="/blog">Все страны</option>
                                @foreach($category->get_visaActive as $data_item)
                                    <option @if($data_item->url === $data->url) selected @endif value="/visa/{{ $data_item->url }}">{{ $data_item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

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
                <div class="form-group hidden-md hidden-lg">
                    <div class="row">
                        <div class="col-xs-24">
                            <label for="category_blog">Страны:</label>
                        </div>
                        <div class="col-xs-24">
                            <select name="category_blog" class="form-control" id="category_blog">
                                <option value="/blog">Все страны</option>
                                @foreach($category->get_visaActive as $data_item)
                                    <option @if($data_item->url === $data->url) selected @endif value="/visa/{{ $data_item->url }}">{{ $data_item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection