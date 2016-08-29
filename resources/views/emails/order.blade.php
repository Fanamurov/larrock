<h1 style="font:26px/32px Calibri,Helvetica,Arial,sans-serif;">Заявка на покупку товаров</h1>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>ФИО:</strong> {{ $name }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Номер телефона:</strong> {{ $tel }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Адрес получателя:</strong> {{ $address }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Способ оплаты:</strong> {{ $method_pay }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Адрес доставки:</strong> {{ $method_delivery }}</p>
<p style="font:14px/16px Calibri,Helvetica,Arial,sans-serif;"><strong>Комментарий:</strong> {{ $comment }}</p>
<table lang="ru" style="width: 100%; padding-top: 15px" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Фото товара</td>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Наименование</td>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Количество</td>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Стоимость</td>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">Итого</td>
    </tr>
    </thead>
    <tbody>
    @foreach($cart as $item)
        <tr>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">
                <p>
                @if(isset($item->options['img']) && !empty($item->options['img']))
                    <a href="http://tbkhv.ru/otapi/{{ $tao_items[$item->id]->CategoryId }}/tovar/{{ $tao_items[$item->id]->Id }}">
                        <img width="150" src="{{ $item->options['img'] }}" class="all-width" alt="Фото товара">
                    </a>
                @else
                    <a href="http://tbkhv.ru/otapi/{{ $tao_items[$item->id]->CategoryId }}/tovar/{{ $tao_items[$item->id]->Id }}">
                        <img width="150" src="{{ $tao_items[$item->id]->MainPictureUrl }}" class="all-width" alt="Фото товара">
                    </a>
                @endif
                </p>
            </td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">
                <p>
                <a href="http://tbkhv.ru/otapi/{{ $tao_items[$item->id]->CategoryId }}/tovar/{{ $tao_items[$item->id]->Id }}">
                    {{ $item->name }}
                </a>
                </p>
                <p>{{ $tao_items[$item->id]->Title }}</p>
                @if(isset($item->options['config']))
                    <br/>{{ $item->options['config'] }}
                @endif
                <p><i><a href="{{ $tao_items[$item->id]->TaobaoItemUrl }}">[Этот товар на таобао]</a></i></p>
            </td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">{{ $item->qty }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">{{ $item->price }}</td>
            <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;">{{ $item->subtotal }} руб.</td>
        </tr>
    @endforeach
    <tr>
        <td style="border: #bcbcbc 1px solid;font:14px/16px Calibri,Helvetica,Arial,sans-serif;" colspan="5">Всего к оплате: {!! Cart::total() !!} руб.</td>
    </tr>
    </tbody>
</table>

<br/><br/>
<p>
Общество с ограниченной ответственностью "ХАЙВЕЙ"<br/>
ИНН 2724185430 КПП 272401001 ОГРН 1142724000528<br/>
680024, РОССИЯ, Хабаровск, проспект 60-летия Октября, 148Ж<br/>
<a href="mailto:tbkhv@mail.ru">tbkhv@mail.ru</a>
</p>