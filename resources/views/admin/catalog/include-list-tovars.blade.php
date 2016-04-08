{{-- Список товаров --}}
@foreach($data as $data_value)
    <tr>
        <td width="110">
            <a href="/admin/catalog/{{ $data_value->id }}/edit">
                @if($data_value->image)
                    <img src="{{ $data_value->image->getUrl('110x110') }}">
                @else
                    <i class="icon-padding icon-color glyphicon glyphicon-file"></i>
                @endif
            </a>
        </td>
        <td>
            <a href="/admin/catalog/{{ $data_value->id }}/edit">
                {{ $data_value->title }}
            </a>
        </td>
        <td width="200">
            <a href="/catalog/{{ $data_value->get_category()->first()->url }}/{{ $data_value->url }}">
                /catalog/{{ $data_value->get_category()->first()->url }}/{{ $data_value->url }}
            </a>
        </td>
        <td>
            <input type="text" name="cost" value="{{ $data_value->cost }}" class="ajax_edit_row form-control"
                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="catalog">
        </td>
        <td class="row-position">
            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="catalog"
                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
        </td>
        <td class="row-active">
            <div class="btn-group pull-right btn-group_switch_ajax" role="group">
                <button type="button" class="btn btn-xs btn-info @if($data_value->active === 0) btn-outline @endif"
                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="catalog"
                        data-row="active" data-value="1"
                        data-toggle="tooltip" data-placement="bottom" title="Включить">on</button>
                <button type="button" class="btn btn-xs btn-danger @if($data_value->active === 1) btn-outline @endif"
                        data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="catalog"
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