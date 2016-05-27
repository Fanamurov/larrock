<h1 style="font:26px/32px Calibri,Helvetica,Arial,sans-serif;">Заявка на покупку тура на сайте santa-avia.ru</h1>
<h3 style="font:20px/36px Calibri,Helvetica,Arial,sans-serif;">Информация о заказчике:</h3>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Имя:</strong> {{ $fio }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Телефон:</strong> {{ $tel }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Email:</strong> {{ $email }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Адрес:</strong> {{ $address }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Паспорт:</strong> {{ $passport }} {{ $passportDate }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Комментарий:</strong> {{ $comment }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Тур {{ $countryName }} - {{ $cityFromName }}:</strong>
    <a href="http://santa-avia.ru/sletat/ActualizePrice?sourceId={{ $sourceId }}&offerId={{ $offerId }}&countryId={{ $countryId }}&requestId={{ $requestId }}">Результат поиска на сайте</a>
</p>
<hr/>

<h3 style="font:20px/36px Calibri,Helvetica,Arial,sans-serif;">Информация о туристах:</h3>
@foreach($firstname as $key => $value)
    <table lang="ru" style="width: 100%; padding-top: 15px" cellspacing="0" cellpadding="5">
        <tbody>
        <tr>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Имя(латиницей): {{ $firstname[$key] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Фамилия(латиницей): {{ $lastname[$key] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Гражд-во: {{ $citizenship[$key] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Пол: {{ $gender[$key] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Дата рождения: {{ $birthday[$key*2] }}</td>
        </tr>
        <tr>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Серия и номер загранпаспорта: {{ $seriaZagran[$key] }} {{ $numberZagran[$key] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Дата выдачи: {{ $dateZagran[$key*2] }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Срок действия: {{ $srokZagran[$key*2] }}</td>
            <td colspan="2" style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Кем выдан: {{ $ktoZagran[$key] }}</td>
        </tr>
        </tbody>
    </table>
    <br/>
@endforeach

<br/>
<hr/>
<h3 style="font:20px/36px Calibri,Helvetica,Arial,sans-serif;">Информация о туре:</h3>
<p>Подробнее о туре #{{ $sletat['randomNumber'] }}</p>
<h1>{{ $sletat['data'][1] }} - {{ $sletat['data'][0] }}({{ $sletat['data'][2] }})</h1>
<p class="h3">{{ $sletat['data'][3] }}</p>

<p>Отель: {{ $sletat['data'][6] }} {{ $sletat['data'][8] }}</p>

<p>Рейтинг отеля:
    @if($sletat['data'][48] > 0)
        {{ $sletat['data'][48] }}/10
    @else
        не изв.
    @endif
</p>

@if( !empty($sletat['data'][43]))
    <p>Сайт отеля: <a href="{{ $sletat['data'][43] }}">{{ $sletat['data'][43] }}</a></p>
@endif
<p>Вылет: {{ $sletat['data'][4] }}</p>
<p>Обратно: {{ $sletat['data'][10] }}</p>
<p>Ночей: {{ $sletat['data'][5] }}</p>
<p>Тип номера: {{ $sletat['data'][9] }} ({{ $sletat['data'][50] }})</p>
<p>Тип размещения: {{ $sletat['data'][22] }} ({{ $sletat['data'][53] }} взрослых / {{ $sletat['data'][54] }} детей)</p>
<p>Тип питания: {{ $sletat['data'][11] }} ({{ $sletat['data'][49] }})</p>

@if($sletat['data'][13] === '0')
    <p><strong>Нет доступных мест в отеле</strong></p>
@else
    <p><strong>Есть свободные номера ({{ $sletat['data'][13] }})</strong></p>
@endif

@if($sletat['data'][14] === '-1')
    <p>Билеты эконом-класса(туда): нет</p>
@elseif($sletat['data'][14] === '0')
    <p>Билеты эконом-класса(туда): нет</p>
@else
    <p>Билеты эконом-класса(туда): {{ $sletat['data'][14] }}</p>
@endif

@if($sletat['data'][15] === '-1')
    <p>Билеты эконом-класса(обратно): нет</p>
@elseif($sletat['data'][15] === '0')
    <p>Билеты эконом-класса(обратно): нет</p>
@else
    <p>Билеты эконом-класса(обратно): {{ $sletat['data'][14] }}</p>
@endif

@if($sletat['data'][16] === '-1')
    <p>Билеты бизнес-класса(туда): нет</p>
@elseif($sletat['data'][16] === '0')
    <p>Билеты бизнес-класса(туда): нет</p>
@else
    <p>Билеты бизнес-класса(туда): {{ $sletat['data'][14] }}</p>
@endif

@if($sletat['data'][17] === '-1')
    <p>Билеты бизнес-класса(обратно): нет</p>
@elseif($sletat['data'][17] === '0')
    <p>Билеты бизнес-класса(обратно): нет</p>
@else
    <p>Билеты бизнес-класса(обратно): {{ $sletat['data'][14] }}</p>
@endif

<p class="cost-info">В стоимость входит авиаперелёт, проживание, трансфер, питание, медицинская
    страховка, услуги гида, страхование ответственности туроператора</p>

<p class="cost">Цена: {{ $sletat['data'][19] }} {{ $sletat['data'][21] }}</p>