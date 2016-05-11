@extends('admin.main')
@section('title', 'Свойства роли '. $role->slug)

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline"><a href="/admin/roles">Роли/</a> {{ Input::old('name', $role->name) }}</h1>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form action="/admin/roles/{{ $role->id }}" method="post">
                <input name="_method" type="hidden" value="PUT">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="slug">Название роли</label>
                            <input type="text" name="slug" value="{{ Input::old('email', $role->slug) }}" class="form-control" id="slug">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="name">Name (машинное)</label>
                            <input type="text" name="name" value="{{ Input::old('name', $role->name) }}" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group text-right">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-info">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection