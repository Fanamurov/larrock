{{-- Список товаров --}}
@foreach($data as $data_value)
    <tr @if($data_value->cost_notactive === 1 OR
    (($data_value->actual > \Carbon\Carbon::createFromFormat('Y-m-d h:s:i', '2015-01-01 00:00:00'))
    AND ($data_value->actual < \Carbon\Carbon::now()))) class="danger" title="Тур не актуален" @endif>
        <td width="110">
            <a href="/admin/tours/{{ $data_value->id }}/edit">
                @if($data_value->getFirstImage)
                    <img src="{{ $data_value->getFirstImage->getUrl('110x110') }}">
                @else
                    <i class="icon-padding icon-color glyphicon glyphicon-file"></i>
                @endif
            </a>
        </td>
        <td>
            <a class="h4" href="/admin/tours/{{ $data_value->id }}/edit">
                {{ $data_value->title }}
            </a>
            <p title="{{ $data_value->updated_at }}">
                    <i class="text-muted">
                        {!! \Carbon\Carbon::createFromTimestamp(strtotime($data_value->updated_at))->diffForHumans(\Carbon\Carbon::now()) !!}</i></p>
        </td>
        <td>
            0 <i class="glyphicon glyphicon-envelope"></i>
        </td>
        <td>
            {{ $data_value->sharing }} <i class="glyphicon glyphicon-heart-empty"></i>
        </td>
        <td width="30">
            <a href="/tours/strany/{{ $data_value->get_category()->first()->url }}/{{ $data_value->url }}">
                <i class="glyphicon glyphicon-link"></i>
            </a>
        </td>
        <td class="row-position">
            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="tours"
                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
        </td>
        <td class="row-delete">
            <form action="/admin/tours/{{ $data_value->id }}" method="post">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-danger btn-xs please_conform">X</button>
            </form>
        </td>
    </tr>
@endforeach