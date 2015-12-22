@extends('admin.main')
@section('title', 'Свойства роли')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline"><a href="/admin/roles">Роли/</a> {{ Input::old('name', $roles->name) }}</h1>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form action="/admin/roles/{{ $roles->id }}" method="post">
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label class="control-label" for="slug">Название роли</label>
                    <input type="text" name="slug" value="{{ Input::old('email', $roles->slug) }}" class="form-control" id="slug">
                </div>
                <div class="form-group">
                    <label class="control-label" for="name">Name (машинное)</label>
                    <input type="text" name="name" value="{{ Input::old('name', $roles->name) }}" class="form-control" id="name">
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection