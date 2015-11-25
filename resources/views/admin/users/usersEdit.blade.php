@extends('admin.layouts.main')
@section('title', 'Users admin')
@section('page_h1', 'User edit')
@section('page_h1_new', 'пользователя')
@section('app_name', 'users')
@section('app_title', 'Пользователи')

@section('content')
    @foreach($users as $data_value)
        <form action="/admin/users/{{ $data_value->id }}" method="post">
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ Input::old('email', $data_value->email) }}" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="first_name">first_name</label>
                <input type="text" name="first_name" value="{{ Input::old('first_name', $data_value->first_name) }}" class="form-control" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">last_name</label>
                <input type="text" name="last_name" value="{{ Input::old('last_name', $data_value->last_name) }}" class="form-control" id="last_name">
            </div>
            <div class="form-group">
                <label for="role">Роль</label>
                <select class="form-control" name="role" id="role">
                    @foreach($roles as $roles_value)
                        <option
                                @foreach($data_value->role as $role)
                                    @if($role->id === $roles_value->id)
                                        selected
                                    @endif
                                @endforeach
                                value="{{ $roles_value->name }}">{{ $roles_value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-right">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Сохранить</button>
            </div>
        </form>
    @endforeach
@endsection