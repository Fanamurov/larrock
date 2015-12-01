@extends('admin.layouts.main')

@section('title') {{ $apps->name }} admin @endsection
@section('page_h1', 'Список')
@section('page_h1_new', 'страницы')
@section('app_name'){{ $apps->name }}@endsection
@section('app_title') {{ $apps->title }} @endsection

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="50">ID</th>
            @foreach($apps->rows as $rows_name)
                @if(isset($rows_name['in_table_admin']))
                    <th>{{ $rows_name['title'] }}</th>
                @endif
            @endforeach
            <th>URL</th>
            <th width="141">Изменено</th>
            <th width="90">Вес</th>
            <th width="93" class="pull-right">Активность</th>
            <th width="130"></th>
            <th width="76"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $data_value)
            <tr>
                <td class="row-id">{{ $data_value->id }}</td>
                @foreach($apps->rows as $rows_key => $rows_name)
                    @if(isset($rows_name['in_table_admin']))
                        <td class="row-{{ $rows_key }}">
                            @if($rows_key === 'title')
                                <a href="/admin/{{ $apps->name }}/{{ $data_value->id }}/edit">{{ $data_value->$rows_key }}</a>
                            @else
                                {{ $data_value->$rows_key }}
                            @endif
                        </td>
                    @endif
                @endforeach
                <td>
                    <a href="{{ action('Page\PageController@getIndex') }}/{{ $data_value->url }}">
                        {{ action('Page\PageController@getIndex', [], FALSE) }}/{{ $data_value->url }}
                    </a>
                </td>
                <td class="row-updated_at">{{ $data_value->updated_at }}</td>
                <td class="row-position">
                    <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                           data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $apps->table_content }}">
                </td>
                <td class="row-active">
                    <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                        <button type="button" class="btn btn-xs btn-primary @if($data_value->active === 0) btn-outline @endif"
                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $apps->table_content }}"
                                data-row="active" data-value="1">on</button>
                        <button type="button" class="btn btn-xs btn-warning @if($data_value->active === 1) btn-outline @endif"
                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $apps->table_content }}"
                                data-row="active" data-value="0">off</button>
                    </div>
                </td>
                <td class="row-edit" title="Чем больше, тем выше в списках">
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
    <?=$data->render()?>
@endsection