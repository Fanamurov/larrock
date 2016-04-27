@extends('santa.main')
@section('title') {{ $data->get_seo->seo_title or $data->title }} @endsection

@section('content')
    <div class="page-{{ $data->url }} pagePage">
        <h1>{{ $data->title }}</h1>
        <div class="page_description">{!! $data->description !!}</div><br/>

        <script type="text/javascript" async="async" defer="defer">
            var kiwitaxiWidgetOptions = {
                language: 'ru',    /* Язык отображения виджета, может быть "en" или "ru" */
                display_currency: 'RUB',    /* Валюта, в которых отображается стоимость трансфера, есть возможность выбрать из трех валют: "USD", "EUR", "RUB" */
                payment_currency: 'RUB',    /* Валюта, в которой производится предоплата (если отличается от display_currency), на данный момент возможны три значения: "RUB", "EUR", "USD" */
                country: '',    /* Страна, в переделах которой будет ограничен поиск трансферов (можно указать как наименование на англ. или рус., так и двухсимвольный код IATA) */
                place_from: '',    /* Значение поля "Откуда" по умолчанию (можно указать как наименование маршрутной точки на англ. или рус., так и ее код IATA) */
                place_to: '',    /* Значение поля "Куда" по умолчанию (можно указать как наименование маршрутной точки на англ. или рус., так и ее код IATA) */
                hide_form_extras: false,    /* Скрыть дополнительные элементы оформления с первой страницы виджета, true или false */
                hide_external_links: false,    /* Скрыть внешние ссылки на сайт Кивитакси (справочные материалы и условия перевозки) , true или false */
                default_form_title: 'Найдите недорогой трансфер из аэропорта!', /* Заголовок формы когда точки отправления и назначения не выбраны; указав пустую строку "" можно скрыть этот заголовок */
                /*max_height: 1000,*/     /* Максимальная высота виджета в пикселях: вертикальная полоса прокрутки будет появлятся в случае, когда содержимое виджета не уместиться в это ограничение */
                partner_id: '56107a755e432',    /* Партнерский идентификатор */
                banner_id: '22995c4e',    /* Идентификатор баннера */
                target: 'kiwitaxi_widget_wrapper'    /* Идентификатор HTML-контейнера, внутрь которого будет вставлен виджет */
            };
            (function () {
                var kw = document.createElement('script');
                kw.type = 'text/javascript';
                kw.async = true;
                kw.src = '//widget.kiwitaxi.com/widget.js';
                try {
                    var s = document.getElementsByTagName('head')[0];
                    s.appendChild(kw);
                } catch (e) {
                    console.error(e.message)
                }
            })();
        </script>
        <div id="kiwitaxi_widget_wrapper"></div>
    </div>
@endsection