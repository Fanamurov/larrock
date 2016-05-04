<!DOCTYPE html>
<html lang="ru">
@include('santa.sections.head')
<body>
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        <section class="mainpage_tabs col-xs-24 row">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#sletat" aria-controls="sletat" role="tab" data-toggle="tab">Пакетные туры</a></li>
                <li role="presentation"><a href="#indiv" aria-controls="indiv" role="tab" data-toggle="tab">Индивидуальные туры</a></li>
                <li role="presentation"><a href="#avia" aria-controls="avia" role="tab" data-toggle="tab">Авиабилеты</a></li>
                <li role="presentation"><a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">Отели</a></li>
                <li role="presentation"><a href="#transfers" aria-controls="transfers" role="tab" data-toggle="tab">Трансферы</a></li>
                <li role="presentation"><a href="#strahovki" aria-controls="strahovki" role="tab" data-toggle="tab">Страховки</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="sletat">
                    @include('santa.modules.forms.sletatShortSearch')
                </div>
                <div role="tabpanel" class="tab-pane" id="indiv">
                    @include('santa.modules.forms.siteToursSearch')
                </div>
                <div role="tabpanel" class="tab-pane" id="avia">
                    <script charset="utf-8" src="//www.travelpayouts.com/widgets/f099c6c9e3ea04e03b82d2df6290a130.js?v=559" async></script>
                    <p></p>
                </div>
                <div role="tabpanel" class="tab-pane" id="hotels">...</div>
                <div role="tabpanel" class="tab-pane" id="transfers">
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
                <div role="tabpanel" class="tab-pane" id="strahovki">...</div>
            </div>
        </section>

        <section id="right_colomn" class="col-xs-24 col-sm-8 col-md-7">
            <div class="col-xs-24 content-padding">
                @include('santa.modules.forms.subscribe')
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
                @include('santa.modules.list.vidy')
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24">
                @include('santa.errors')
                @include('santa.modules.slideshow.mainpage', $slideshow)

                <div class="sletatResult" data-country-id="{{ $country_id_sletat }}">
                    @if($GetTours['hotelsCount'] > 0)
                        @include('santa.sletat.searchResultShort')
                    @else
                        <div class="toursPageCountry-bestcost row">
                            <div class="col-xs-24"><h5 class="title-header">Лучшие цены</h5></div>
                            <div class="col-xs-24" id="loadState">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                        <span class="progress-current">0%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning col-xs-24 alert-progress">Обработка запроса продолжается</div>
                        </div>
                        @push('scripts')
                        <script>
                            $(document).ready(function(){
                                GetLoadStateShort({{ $GetTours['requestId'] }}, 20, 3);
                            });
                        </script>
                        @endpush
                    @endif
                </div>

                @include('santa.modules.list.news')
                @include('santa.modules.list.blog')
                @include('santa.modules.list.tours')
                @yield('content')
                @include('santa.modules.html.socialGroups')
            </div>
        </div>
    </section>
</div>
<footer>
    @include('santa.sections.footer')
    @yield('footer')
</footer>
@include('santa.sections.bottomScripts')
@stack('scripts')
</body>
</html>