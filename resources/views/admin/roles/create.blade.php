@extends('admin.main')
@section('title', 'Создание роли')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline"><a href="/admin/roles">Роли/</a> Создание новой роли</h1>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form action="/admin/roles" method="POST">
                <div class="form-group">
                    <label class="control-label" for="email">Название роли</label>
                    <input type="text" name="slug" value="{{ Input::old('slug') }}" class="form-control" id="slug">
                </div>
                <div class="form-group">
                    <label class="control-label" for="name">Name (машинное)</label>
                    <input type="text" name="name" value="{{ Input::old('name') }}" class="form-control" id="name">
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection