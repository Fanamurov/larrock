@extends('admin.main')
@section('title') {{ $app['title'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">{{ $app['title'] }}</h1>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create">Добавить</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Keywords</th>
                    <th>Url connect</th>
                    <th>Id connect</th>
                    <th>Type connect</th>
                    <th width="90"></th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data_value)
                    <tr>
                        <td class="row-id">{{ $data_value->id }}</td>
                        <td>{{ $data_value->seo_title }}</td>
                        <td>{{ $data_value->seo_description }}</td>
                        <td>{{ $data_value->seo_keywords }}</td>
                        <td>{{ $data_value->url_connect }}</td>
                        <td>{{ $data_value->id_connect }}</td>
                        <td>{{ $data_value->type_connect }}</td>
                        <td class="row-edit">
                            <a href="/admin/{{ $app['name'] }}/{{ $data_value->id }}/edit" class="btn btn-info btn-xs">Свойства</a>
                        </td>
                        <td class="row-delete">
                            <form action="/admin/{{ $app['name'] }}/{{ $data_value->id }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-danger btn-xs please_conform">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($data) === 0)
                <div class="alert alert-warning">Данных еще нет</div>
            @endif
            {!! $data->render() !!}
        </div>
    </div>
@endsection