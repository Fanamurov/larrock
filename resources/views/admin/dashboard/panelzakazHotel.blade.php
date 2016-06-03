@foreach($zakazHotel as $key => $value)
    <div>
        <button type="button" class="btn btn-info btn-block btn-show-full-info btn-{{ str_slug($value->status) }}"
                data-target="{{ $key_panel }}_{{ $key }}">{{ $value->params['name'] }}
            <span class="label label-info label-{{ str_slug($value->status) }}">{{ $value->status }}</span>
            <small class="pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
        </button>

        <div class="full-info hidden" id="{{ $key_panel }}_{{ $key }}">
            <small class="pull-right text-navy">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
            <strong>{{ $value->params['name'] }} <span class="label label-info">{{ $value->status }}</span></strong>
            <p>{{ $value->params['tel'] }} <a href="mailto:{{ $value->params['email'] }}">{{ $value->params['email'] }}</a></p>
            <p><strong>Дата заезда:</strong> {{ $value->params['date'] }}</p>
            <p><strong>Название отеля:</strong> {{ $value->params['hotel_name'] }}</p>
            <p><strong>Город вылета:</strong> {{ $value->params['city'] }}</p>
            <p><strong>Дата выезда:</strong> {{ $value->params['date_out'] }}</p>
            <p><strong>Взрослых:</strong> {{ $value->params['adult'] }}</p>
            <p><strong>Детей:</strong> {{ $value->params['kids'] }}</p>
            <p><strong>Младенцев:</strong> {{ $value->params['baby'] }}</p>
            <p><strong>Страница отеля:</strong> {{ $value->params['hotel_name'] }} <a target="_blank" href="{{ $value->params['hotel_url'] }}">{{ $value->params['hotel_url'] }}</a></p>
            <blockquote>{{ $value->params['comment'] }}</blockquote>
            <small class="text-muted">{{ $value->created_at }}</small>
        </div>
    </div>
@endforeach