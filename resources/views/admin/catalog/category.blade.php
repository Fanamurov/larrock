@extends('admin.main')
@section('title') {{ $app['name'] }} admin @endsection

@section('content')
    {!! Breadcrumbs::render('admin.catalog.category', $data) !!}

    <div class="ibox float-e-margins">
        <div class="ibox-title background-transparent">
            <div>
                <h1 class="inline">{{ $app['title'] }}</h1>
                <a href="/{{ $app['name'] }}/">/{{ $app['name'] }}/</a>
                <div class="add-panel">
                    <a class="btn btn-info pull-right" href="/admin/{{ $app['name'] }}/create">Добавить товар</a>
                    <a class="btn btn-info" href="/admin/category/create?type=catalog">Добавить раздел</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if(count($data) === 0)
                <div class="alert alert-warning">Разделов еще нет</div>
            @elseif(count($data->get_child) > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>URL</th>
                        <th width="90" data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">Вес</th>
                        <th width="93" class="pull-right">Активность</th>
                        <th width="90"></th>
                        <th width="90"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">
                            <a href="#" style="font-size: 22px">
                                <i class="glyphicon glyphicon-level-up"></i>..
                            </a>
                        </td>
                    </tr>
                    @foreach($data->get_child as $data_value)
                        <tr>
                            <td><a href="/admin/catalog/{{ $data_value->id }}"><i class="icon-padding icon-color glyphicon glyphicon-folder-close"></i> {{ $data_value->title }}</a></td>
                            <td>
                                <a href="{{ action('Admin\FeedController@index') }}/{{ $data_value->url }}">
                                    /catalog/{{ $data_value->url }}
                                </a>
                            </td>
                            <td class="row-position">
                                <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                                       data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                       data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
                            </td>
                            <td class="row-active">
                                <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                                    <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                                            data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                            data-row="active" data-value="1">on</button>
                                    <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                                            data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                            data-row="active" data-value="0">off</button>
                                </div>
                            </td>
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
                        <tr>
                            <td colspan="7">
                                @foreach($data->get_tovars as $data_value)
                                    <tr>
                                        <td><a href="/admin/catalog/{{ $data_value->id }}"><i class="icon-padding icon-color glyphicon glyphicon-folder-close"></i> {{ $data_value->title }}</a></td>
                                        <td>
                                            <a href="{{ action('Admin\FeedController@index') }}/{{ $data_value->url }}">
                                                /catalog/{{ $data_value->url }}
                                            </a>
                                        </td>
                                        <td class="row-position">
                                            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                                                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
                                        </td>
                                        <td class="row-active">
                                            <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                                                <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                                                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                                        data-row="active" data-value="1">on</button>
                                                <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                                                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                                        data-row="active" data-value="0">off</button>
                                            </div>
                                        </td>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>URL</th>
                        <th width="90" data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">Вес</th>
                        <th width="93" class="pull-right">Активность</th>
                        <th width="90"></th>
                        <th width="90"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data->get_tovars as $data_value)
                            <tr>
                                <td><a href="/admin/catalog/{{ $data_value->id }}"><i class="icon-padding icon-color glyphicon glyphicon-folder-close"></i> {{ $data_value->title }}</a></td>
                                <td>
                                    <a href="{{ action('Admin\FeedController@index') }}/{{ $data_value->url }}">
                                        /catalog/{{ $data_value->url }}
                                    </a>
                                </td>
                                <td class="row-position">
                                    <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                                           data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                           data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
                                </td>
                                <td class="row-active">
                                    <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                                        <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                                data-row="active" data-value="1">on</button>
                                        <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="category"
                                                data-row="active" data-value="0">off</button>
                                    </div>
                                </td>
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
            @endif
        </div>
    </div>
@endsection