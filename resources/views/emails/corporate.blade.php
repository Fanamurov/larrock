<h1 style="font:26px/32px Calibri,Helvetica,Arial,sans-serif;">Отправлена анкета корпоративного обслуживания</h1>
<h3 style="font:18px/24px Calibri,Helvetica,Arial,sans-serif;">Информация о компании:</h3>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Название организации:</strong> {{ $name }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Фактический адрес:</strong> {{ $address }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>ФИО:</strong> {{ $fio }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Должность:</strong> {{ $place }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Телефон:</strong> {{ $tel }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Кол-во сотрудников в компании:</strong> {{ $peoples }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>В том числе ездят в командировки:</strong> {{ $peoples_active }}</p>
<br/>
<h3 style="font:18px/24px Calibri,Helvetica,Arial,sans-serif;">Потребность в услугах:</h3>
@if(isset($hotels_ru))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Отели по России (сбор за ночь или за бронирование?)</p>
@endif
@if(isset($hotels_mg))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Отели за рубежом (сбор за ночь или за бронирование?)</p>
@endif
@if(isset($passport))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Паспортно-визовые услуги</p>
@endif
@if(isset($mice))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">MICE</p>
@endif
@if(isset($avia_ru))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Авиабилеты внутренние</p>
@endif
@if(isset($avia_mg))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Авиабилеты международные</p>
@endif
@if(isset($jd))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">ЖД билеты</p>
@endif
@if(isset($subscribe))
    <p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Я хочу получать рассылку с акциями авиакомпаний</p>
@endif
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Комментарий:</strong> {{ $comment }}</p>