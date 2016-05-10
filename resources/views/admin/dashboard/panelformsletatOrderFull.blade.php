@foreach($formsletatOrderFull as $key => $value)
    <div>
        <button type="button" class="btn btn-info btn-block btn-show-full-info btn-{{ str_slug($value->status) }}"
                data-target="{{ $key_panel }}_{{ $key }}">{{ $value->params['fio'] }}
            <span class="label label-info label-{{ str_slug($value->status) }}">{{ $value->status }}</span>
            <small class="pull-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
        </button>

        <div class="full-info hidden" id="{{ $key_panel }}_{{ $key }}">
            <small class="pull-right text-navy">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$value->created_at)->diffForHumans() }}</small>
            <strong>{{ $value->params['fio'] }} <span class="label label-info">{{ $value->status }}</span></strong>
            <p>{{ $value->params['tel'] }} <a href="mailto:{{ $value->params['email'] }}">{{ $value->params['email'] }}</a></p>
            <p>{{ $value->params['address'] }}</p>
            <p>Паспорт: {{ $value->params['passport'] }} {{ $value->params['passportDate'] }}</p>
            <blockquote>{{ $value->params['comment'] }}</blockquote>

            @foreach($value->params['firstname'] as $key => $item)
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Имя(латиницей): {{ $value->params['firstname'][$key] }}</td>
                        <td>Фамилия(латиницей): {{ $value->params['lastname'][$key] }}</td>
                        <td>Гражд-во: {{ $value->params['citizenship'][$key] }}</td>
                        <td>Пол: {{ $value->params['gender'][$key] }}</td>
                        <td>Дата рождения: {{ $value->params['birthday'][$key] }}</td>
                    </tr>
                    <tr>
                        <td>Серия и номер загранпаспорта: {{ $value->params['seriaZagran'][$key] }} {{ $value->params['numberZagran'][$key] }}</td>
                        <td>Дата выдачи: {{ $value->params['dateZagran'][$key] }}</td>
                        <td>Срок действия: {{ $value->params['srokZagran'][$key] }}</td>
                        <td colspan="2">Кем выдан: {{ $value->params['ktoZagran'][$key] }}</td>
                    </tr>
                    </tbody>
                </table>
                <br/>
            @endforeach

            <p>Подробнее о туре #{{ $value->addict['randomNumber'] }}</p>
            <h1>{{ $value->addict['data'][1] }} - {{ $value->addict['data'][0] }}({{ $value->addict['data'][2] }})</h1>
            <p class="h3">{{ $value->addict['data'][3] }}</p>
            <p>Отель: {{ $value->addict['data'][6] }} {{ $value->addict['data'][8] }}</p>
            <p>Вылет: {{ $value->addict['data'][4] }}</p>
            <p>Обратно: {{ $value->addict['data'][10] }}</p>
            <p>Ночей: {{ $value->addict['data'][5] }}</p>
            <p>Тип номера: {{ $value->addict['data'][9] }} ({{ $value->addict['data'][50] }})</p>
            <p>Тип размещения: {{ $value->addict['data'][22] }} ({{ $value->addict['data'][53] }} взрослых / {{ $value->addict['data'][54] }} детей)</p>
            <p>Тип питания: {{ $value->addict['data'][11] }} ({{ $value->addict['data'][49] }})</p>
            <p class="cost">Цена: {{ $value->addict['data'][19] }} {{ $value->addict['data'][21] }}</p>
            <p><a href="http://santa-avia.ru/sletat/ActualizePrice?sourceId={{ $value->params['sourceId'] }}
                        &offerId={{ $value->params['offerId'] }}&countryId={{ $value->params['countryId'] }}
                        &requestId={{ $value->params['requestId'] }}">Результат поиска на сайте</a>
            </p>
            <small class="text-muted">{{ $value->created_at }}</small>
        </div>
    </div>
@endforeach