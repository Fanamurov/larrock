@extends('admin.layouts.main')

@section('title') {{ $apps->name }} admin @endsection
@section('page_h1', 'Список')
@section('page_h1_new', 'материала')
@section('app_name'){{ $apps->name }}@endsection
@section('app_title') {{ $apps->title }} @endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            @foreach($apps->rows as $rows_name)
                @if(isset($rows_name['in_table_admin']))
                    <th>{{ $rows_name['title'] }}</th>
                @endif
            @endforeach
            <th>Изменено</th>
            <th>Вес</th>
            <th>Активность</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $data_value)
            <tr>
                <td class="row-id">{{ $data_value->id }}</td>
                @foreach($apps->rows as $rows_key => $rows_name)
                    @if(isset($rows_name['in_table_admin']))
                        <td class="row-{{ $rows_key }}">{{ $data_value->$rows_key }}</td>
                    @endif
                @endforeach
                <td class="row-updated_at">{{ $data_value->updated_at }}</td>
                <td class="row-position">Изменение веса</td>
                <td class="row-active">Изменение активности</td>
                <td class="row-edit">
                    <a href="/admin/{{ $apps->name }}/{{ $data_value->id }}/edit" class="btn btn-block btn-primary btn-xs"><i class="fa fa-pencil"></i> Изменить</a>
                </td>
                <td class="row-delete">
                    <form action="/admin/{{ $apps->name }}/{{ $data_value->id }}" method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-block btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(count($data) === 0)
        <div class="alert alert-warning">Данных еще нет</div>
    @endif
    <?//=$data->render()?>
@endsection