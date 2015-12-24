@if(count($data) === 0)
    <div class="alert alert-warning">Данных еще нет</div>
@else
    <table class="table table-striped">
        <tbody>
        @foreach($data as $data_value)
            <tr>
                @foreach($app['rows'] as $rows_key => $rows_name)
                    @if(isset($rows_name['in_table_admin']))
                        <td class="row-{{ $rows_key }}">
                            <i class="icon-padding icon-color glyphicon glyphicon-file"></i>
                            @if($rows_key === 'title')
                                <a href="/admin/{{ $app['name'] }}/{{ $data_value->id }}/edit">{{ $data_value->$rows_key }}</a>
                            @else
                                {{ $data_value->$rows_key }}
                            @endif
                        </td>
                    @endif
                @endforeach
                <td>
                    <a href="{{ action('Admin\FeedController@index') }}/{{ $data_value->get_category->url}}/{{ $data_value->url }}">
                        {{ action('Admin\FeedController@index', [], FALSE) }}/{{ $data_value->get_category->url}}/{{ $data_value->url }}
                    </a>
                </td>
                <td class="row-position" width="90">
                    <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                           data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                           data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
                </td>
                <td class="row-active" width="93">
                    <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                        <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                                data-row="active" data-value="1">on</button>
                        <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                                data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="{{ $app['table_content'] }}"
                                data-row="active" data-value="0">off</button>
                    </div>
                </td>
                <td class="row-edit" width="90">
                    <a href="/admin/{{ $app['name'] }}/{{ $data_value->id }}/edit" class="btn btn-info btn-xs">Свойства</a>
                </td>
                <td class="row-delete" width="90">
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
    {!! $data->render() !!}
@endif