{{-- Список товаров --}}
@foreach($data as $data_value)
    <tr>
        <td width="110">
            <a href="/admin/news/{{ $data_value->id }}/edit">
                @if($data_value->getFirstImage)
                    <img src="{{ $data_value->getFirstImage->getUrl('110x110') }}">
                @else
                    <i class="icon-padding icon-color glyphicon glyphicon-file"></i>
                @endif
            </a>
        </td>
        <td>
            <a class="h4" href="/admin/news/{{ $data_value->id }}/edit">
                {{ $data_value->title }}
            </a>
            <p title="{{ $data_value->updated_at }}">
                <i class="text-muted">
                    {!! \Carbon\Carbon::createFromTimestamp(strtotime($data_value->updated_at))->diffForHumans(\Carbon\Carbon::now()) !!}</i></p>
        </td>
        <td width="35">
            {{ $data_value->sharing }} <i class="glyphicon glyphicon-heart-empty"></i>
        </td>
        <td width="35">
            <a href="/news/{{ $data_value->url }}">
                <i class="glyphicon glyphicon-link"></i>
            </a>
        </td>
        <td class="row-position">
            <input type="text" name="position" value="{{ $data_value->position }}" class="ajax_edit_row form-control"
                   data-row_where="id" data-value_where="{{ $data_value->id }}" data-table="news"
                   data-toggle="tooltip" data-placement="bottom" title="Вес. Чем больше, тем выше в списках">
        </td>
        <td class="row-delete">
            <form action="/admin/news/{{ $data_value->id }}" method="post">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-danger btn-xs please_conform">X</button>
            </form>
        </td>
    </tr>
@endforeach