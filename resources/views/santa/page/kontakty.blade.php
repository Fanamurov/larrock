@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }} pagePage">
        <div class="page_description">{!! $data->description !!}</div>
        <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=iEUdKqwag4FCQaqgLTNH9_Hvy7Tk8KTy&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
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