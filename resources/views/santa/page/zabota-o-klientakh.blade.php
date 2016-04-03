@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }} pagePage">
        <h1>{{ $data->title }}</h1>
        <div class="page_description">{!! $data->description !!}</div>
    </div>
@endsection

@section('contentBottom')
    <div class="row"><br/><br/>
        <div class="col-sm-16 col-sm-offset-4">
            @include('santa.modules.forms.contact')
        </div>
    </div>
    <div class="clearfix"></div>
@endsection