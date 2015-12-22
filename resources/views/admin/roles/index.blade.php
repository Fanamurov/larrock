@extends('admin.main')
@section('title', 'Роли')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">Роли</h1>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/roles/create">Добавить роль</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Name</th>
                    <th>Права доступа</th>
                    <th>Изменено</th>
                    <th width="90"></th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data_value)
                    <tr>
                        <td class="row-id">{{ $data_value->id }}</td>
                        <td><a href="/admin/roles/{{ $data_value->id }}/edit">{{ $data_value->slug }}</a></td>
                        <td>{{ $data_value->name }}</td>
                        <td>{{ $data_value->permissions or 'n/a' }}</td>
                        <td>{{ $data_value->updated_at }}</td>
                        <td>
                            <a href="/admin/roles/{{ $data_value->id }}/edit" class="btn btn-info btn-xs">Свойства</a>
                        </td>
                        <td>
                            <form action="/admin/roles/{{ $data_value->id }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-danger btn-xs">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection