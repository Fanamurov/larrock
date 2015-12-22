@extends('admin.main')
@section('title', 'Управление пользователями')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">Управление пользователями</h1>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/users/create">Добавить пользователя</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email/login</th>
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
            {!! $data->render() !!}
        </div>
    </div>
@endsection