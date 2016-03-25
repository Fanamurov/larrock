@extends('admin.main')
@section('title', 'Управление пользователями')

@section('content')
    <div class="ibox float-e-margins col-md-8 col-md-offset-2">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline"><a href="/admin/users">Пользователи/</a> {{ Input::old('email', $user->email) }}</h1>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/users/create">Добавить пользователя</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins col-md-8 col-md-offset-2">
        <div class="ibox-content">
            <form action="/admin/users/{{ $user->id }}" method="post">
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="email">Email/login</label>
                    <input type="text" name="email" value="{{ Input::old('email', $user->email) }}" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" value="{{ Input::old('first_name', $user->first_name) }}" class="form-control" id="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" value="{{ Input::old('last_name', $user->last_name) }}" class="form-control" id="last_name">
                </div>
                <div class="form-group">
                    <label for="role">Роль</label>
                    <select class="form-control" name="role" id="role">
                        @foreach($roles as $roles_value)
                            <option
                                @if($roles_value->id === $user->role->first()->id)
                                selected
                                @endif
                                value="{{ $roles_value->name }}">{{ $roles_value->slug }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection