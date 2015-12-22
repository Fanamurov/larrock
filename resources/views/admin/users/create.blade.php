@extends('admin.main')
@section('title', 'Управление пользователями')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline"><a href="/admin/users">Пользователи/</a> Добавление нового пользователя</h1>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <form action="/admin/users" method="POST">
                <div class="form-group">
                    <label for="email">Email/login</label>
                    <input type="text" name="email" value="{{ Input::old('email') }}" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" value="" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" value="{{ Input::old('first_name') }}" class="form-control" id="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" value="{{ Input::old('last_name') }}" class="form-control" id="last_name">
                </div>
                <div class="form-group">
                    <label for="role">Роль</label>
                    <select class="form-control" name="role" id="role">
                        @foreach($roles as $roles_value)
                            <option value="{{ $roles_value->id }}">{{ $roles_value->slug }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-info"><i class="fa fa-pencil"></i> Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection