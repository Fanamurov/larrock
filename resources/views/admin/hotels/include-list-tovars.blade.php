{{-- Список товаров --}}
@foreach($data as $data_value)
    <tr @if($data_value->cost_notactive === 1 OR
    (($data_value->actual > \Carbon\Carbon::createFromFormat('Y-m-d h:s:i', '2015-01-01 00:00:00'))
    AND ($data_value->actual < \Carbon\Carbon::now()))) class="danger" title="Тур не актуален" @endif>
        <td width="110">
            <a href="/admin/hotels/{{ $data_value->id }}/edit">
                @if($data_value->getFirstImage)
                    <img src="{{ $data_value->getFirstImage->getUrl('110x110') }}">
                @else
                    <i class="icon-padding icon-color glyphicon glyphicon-file"></i>
                @endif
            </a>
        </td>
        <td>
            <a class="h4" href="/admin/hotels/{{ $data_value->id }}/edit">
                {{ $data_value->title }}
            </a>
            <small class="text-muted">{{ $data_value->sharing }} <i class="glyphicon glyphicon-heart-empty"></i></small>
            <p title="{{ $data_value->updated_at }}">
                @if($data_value->user)
                    <i class="text-muted">Автор:
                        <a href="/admin/users/author/{{ $data_value->user_id }}">
                            {{ $data_value->user->first_name }} {{ $data_value->user->last_name }}</a><br/>
                        @endif
                        {!! \Carbon\Carbon::createFromTimestamp(strtotime($data_value->updated_at))->diffForHumans(\Carbon\Carbon::now()) !!}</i></p>
        </td>
        <td width="200">
            <a href="/hotels/{{ $data_value->url }}">
                /hotels/{{ $data_value->url }}
            </a>
        </td>
        <td class="row-position">
            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="hotels"
                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
        </td>
        <td class="row-active">
            <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="hotels"
                        data-row="active" data-value="1"
                        data-toggle="tooltip" data-placement="bottom" title="Включить">on</button>
                <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="hotels"
                        data-row="active" data-value="0"
                        data-toggle="tooltip" data-placement="bottom" title="Выключить">off</button>
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