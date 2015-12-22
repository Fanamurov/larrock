@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <h1 class="inline">
                <a href="/admin/{{ $app['name'] }}">{{ $app['title'] }}</a>/
                Новый материал
            </h1>
        </div>

        <div class="ibox-content">
            <form action="/admin/{{ $app['name'] }}" method="POST">
                <input name="type_connect" type="hidden" value="{{ $app['name'] }}">
                <input name="id_connect" type="hidden" value="{{ $id }}">
                {!! $form !!}
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection