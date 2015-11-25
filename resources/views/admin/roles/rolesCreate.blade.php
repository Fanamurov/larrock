@extends('admin.layouts.main')
@section('title', 'Users admin')
@section('page_h1', 'User create')
@section('page_h1_new', 'нового пользователя')
@section('app_name', 'users')
@section('app_title', 'Пользователи')

@section('content')
    <form action="/admin/roles" method="POST">
        <div class="form-group">
            <label for="email">slug</label>
            <input type="text" name="slug" value="{{ Input::old('slug') }}" class="form-control" id="slug">
        </div>
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" value="{{ Input::old('name') }}" class="form-control" id="name">
        </div>
        <div class="form-group text-right">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Создать</button>
        </div>
    </form>
@endsection