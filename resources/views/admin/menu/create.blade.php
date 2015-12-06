@extends('admin.layouts.main')

@section('title') {{ $app->name }} admin @endsection
@section('page_h1', 'Создание пункта меню')
@section('page_h1_new', 'меню')
@section('app_name'){{ $app->name }}@endsection
@section('app_title') {{ $app->title }} @endsection

@section('content')
    <form action="/admin/{{ $app->name }}" method="POST">
        <input name="type_connect" type="hidden" value="{{ $app->name }}">
        <input name="id_connect" type="hidden" value="{{ $next_id }}">
        <div class="tabbable main-tabbable">
            <div class="tab-content">
                {!! $form !!}
            </div>
        </div>

        <div class="form-group text-right">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Создать</button>
        </div>
    </form>
@endsection