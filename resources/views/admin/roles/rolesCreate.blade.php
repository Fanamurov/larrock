@extends('admin.layouts.main')
@section('title', 'Управление ролями пользователей')
@section('page_h1', 'Создание роли')
@section('page_h1_new', 'новой роли')
@section('app_name', 'roles')
@section('app_title', 'Роли')

@section('content')
    <form action="/admin/roles" method="POST">
        <div class="form-group">
            <label for="email">Название роли</label>
            <input type="text" name="slug" value="{{ Input::old('slug') }}" class="form-control" id="slug">
        </div>
        <div class="form-group">
            <label for="name">Name (машинное)</label>
            <input type="text" name="name" value="{{ Input::old('name') }}" class="form-control" id="name">
        </div>
        <div class="form-group text-right">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Создать</button>
        </div>
    </form>
@endsection