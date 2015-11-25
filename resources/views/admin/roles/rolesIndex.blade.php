@extends('admin.layouts.main')
@section('title', 'Roles admin')
@section('page_h1', 'Roles list')
@section('page_h1_new', 'роли')
@section('app_name', 'roles')
@section('app_title', 'Роли')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Slug</th>
            <th>Name</th>
            <th>Permissions</th>
            <th></th>
            <th>Изменено</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $data_value)
            <tr>
                <td>{{ $data_value->id }}</td>
                <td>{{ $data_value->slug }}</td>
                <td>{{ $data_value->name }}</td>
                <td>{{ $data_value->permissions or 'n/a' }}</td>
                <td>

                </td>
                <td>{{ $data_value->updated_at }}</td>
                <td>
                    <a href="/admin/roles/{{ $data_value->id }}/edit" class="btn btn-block btn-primary btn-xs"><i class="fa fa-pencil"></i> Изменить</a>
                </td>
                <td>
                    <form action="/admin/roles/{{ $data_value->id }}" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-block btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection