@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">{{ $app['title'] }}</h1>
                <a href="/{{ $app['name'] }}/">/{{ $app['name'] }}/</a>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create">Добавить материал</a>
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
                    @foreach($app['rows'] as $rows_name)
                        @if(isset($rows_name['in_table_admin']))
                            <th>{{ $rows_name['title'] }}</th>
                        @endif
                    @endforeach
                    <th>URL</th>
                    <th width="141">Изменено</th>
                    <th width="90" data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">Порядок</th>
                    <th width="93">Активность</th>
                    <th width="90"></th>
                    <th width="90"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $data_value)
                    <tr>
                        <td class="row-id">{{ $data_value->id }}</td>
                        @foreach($app['rows'] as $rows_key => $rows_name)
                            @if(isset($rows_name['in_table_admin']))
                                <td class="row-{{ $rows_key }}">
                                    @if($rows_key === 'title')
                                        <a href="/admin/{{ $app['name'] }}/{{ $data_value->id }}/edit">{{ $data_value->$rows_key }}</a>
                                    @else
                                        {{ $data_value->$rows_key }}
                                    @endif
                                </td>
                            @endif
                        @endforeach
                        <td>
                            {{ $data_value->url }}
                        </td>
                        <td class="row-updated_at">{{ $data_value->updated_at }}</td>
                        <td class="row-position">
                            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
                        </td>
                        <td class="row-active">
                            <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                                <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                                        data-row="active" data-value="1">on</button>
                                <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                                        data-row="active" data-value="0">off</button>
                            </div>
                        </td>
                        <td class="row-edit">
                            <a href="/admin/{{ $app['name'] }}/{{ $data_value->id }}/edit" class="btn btn-info btn-xs">Свойства</a>
                        </td>
                        <td class="row-delete">
                            <form action="/admin/{{ $app['name'] }}/{{ $data_value->id }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="id_connect" type="hidden" value="{{ $data_value->id }}">
                                <input name="type_connect" type="hidden" value="{{ $app['name'] }}">
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