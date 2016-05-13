@extends('santa.main')
@section('title') {{ $data->title }} @endsection
@section('description') {!! strip_tags($data->short) !!} @endsection

@section('content')
    <div class="pageBlogItem">
        <div class="col-xs-24">
            {!! Breadcrumbs::render('news.item', $data) !!}
        </div>
        <div class="page-{{ $data->url }} col-xs-24">
            <div class="page_description">{!! $data->description !!}</div>
        </div>
    </div>
@endsection

@section('contentBottom')
    <div>
        <a class="btn btn-default" href="/news">Назад к новостям</a>
    </div>
    @include('santa.modules.cackle.comments')
    @include('santa.modules.html.socialGroups')
@endsection