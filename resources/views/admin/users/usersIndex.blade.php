@extends('admin.layouts.main')
@section('title', 'Users admin')
@section('page_h1', 'User list')
@section('page_h1_new', 'пользователя')
@section('app_name', 'users')
@section('app_title', 'Пользователи')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Роль</th>
                <th>Изменено</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $data_value)
            <tr>
                <td>{{ $data_value->id }}</td>
                <td>{{ $data_value->email }}</td>
                <td>{{ $data_value->first_name or 'n/a' }}</td>
                <td>{{ $data_value->last_name or 'n/a' }}</td>
                <td>
                    @foreach($data_value->role as $role)
                        {{ $role->name }}
                    @endforeach
                </td>
                <td>{{ $data_value->updated_at }}</td>
                <td>
                    <a href="/admin/users/{{ $data_value->id }}/edit" class="btn btn-block btn-primary btn-xs"><i class="fa fa-pencil"></i> Изменить</a>
                </td>
                <td>
                    <form action="/admin/users/{{ $data_value->id }}" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-block btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <?=$data->render()?>
@endsection