@extends('santa.sletat')
@section('title')
    Бронирование тура {{ $item['data'][3] }} {{ $item['data'][1] }} - {{ $item['data'][0] }} ({{ $item['data'][2] }})
@endsection

@section('content')
    <div class="page-loadSletatTour search-result">
        <div class="col-xs-24">
            <p class="h4">Подробнее о туре #{{ $item['randomNumber'] }}</p>
            <h1>{{ $item['data'][1] }} - {{ $item['data'][0] }}({{ $item['data'][2] }})</h1>
            <p class="h3">{{ $item['data'][3] }}</p>

            <div class="row row-photo">
                @if( !empty($item['data'][44]))
                    <div class="col-xs-10">
                        <a class="fancybox" rel="group" href="{{ str_replace('_0.jpg', '_0_300_300.jpg', $item['data'][44]) }}">
                            <img src="{{ str_replace('_0.jpg', '_0_300_300.jpg', $item['data'][44]) }}" align="Hotel" class="all-width">
                        </a>
                    </div>
                    <div class="col-xs-14 addict-photo">
                        @if($item['data'][45] > 1)
                            @for($i=0; $i < $item['data'][45]; $i++)
                                <a class="fancybox" rel="group" href="{{ str_replace('_0.jpg', '_'. $i .'_300_300.jpg', $item['data'][44]) }}">
                                    <img src="{{ str_replace('_0.jpg', '_'. $i .'.jpg', $item['data'][44]) }}" align="Hotel" width="90">
                                </a>
                            @endfor
                        @endif
                    </div>
                @endif
            </div>
            <div class="clearfix"></div>

            <div class="row row-description">
                <div class="col-sm-24">{{ $item['data'][51] }}</div>
            </div>

            <div class="row row-info">
                <div class="col-sm-12">
                    <div><small class="muted">Отель:</small> {{ $item['data'][6] }} {{ $item['data'][8] }}</div>

                    @if($item['data'][8] === '*')
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item['data'][8] === '2*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item['data'][8] === '3*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item['data'][8] === '4*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @elseif($item['data'][8] === '5*')
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                        <i class="glyphicon glyphicon-star"></i>
                    @endif

                    <div><small class="muted">Рейтинг отеля:</small>
                        @if($item['data'][48] > 0)
                            {{ $item['data'][48] }}<small class="muted">/10</small>
                        @else
                            не изв.
                        @endif
                    </div>

                    <div><small class="muted">Вылет:</small> {{ $item['data'][4] }}</div>
                    <div><small class="muted">Обратно:</small> {{ $item['data'][10] }}</div>
                    <div><small class="muted">Ночей:</small> {{ $item['data'][5] }}</div>
                    <div><small class="muted">Тип номера:</small> {{ $item['data'][9] }} ({{ $item['data'][50] }})</div>
                    <div><small class="muted">Тип размещения:</small> {{ $item['data'][22] }} ({{ $item['data'][53] }} взрослых / {{ $item['data'][54] }} детей)</div>
                    <div><small class="muted">Тип питания:</small> {{ $item['data'][11] }} ({{ $item['data'][49] }})</div>
                </div>
                <div class="col-sm-12">
                    <div><strong>Есть свободные номера</strong></div>

                    <div class="cost-info">В стоимость входит авиаперелёт, проживание, трансфер, питание, медицинская
                        страховка, услуги гида, страхование ответственности туроператора</div>

                    <div class="cost"><small class="muted">Цена:</small> {{ $item['data'][19] }} {{ $item['data'][21] }}</div>

                    <div class="row row-buttons">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-default btn-block btn-show-online"
                                    data-toggle="collapse" data-target="#collapsesletatOrderFull" aria-expanded="true"
                                    aria-controls="collapsesletatOrderFull" onclick="yaCounter27992118.reachGoal('SletatShowForm'); return true;">Купить онлайн</button>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-default btn-block btn-show-office"
                                    data-toggle="collapse" data-target="#collapsesletatOrderShort" aria-expanded="true"
                                    aria-controls="collapsesletatOrderShort" onclick="yaCounter27992118.reachGoal('SletatShowForm'); return true;">Купить в офисе</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="form-order-sletat container">
            <div class="collapse" id="collapsesletatOrderShort">
                @include('santa.modules.forms.sletatOrderShort', ['request' => $request, 'countryName' => $item['data'][1],
                'cityFromName' => $item['data'][0], 'currencyAlias' => $item['data'][21]])
            </div>
            <div class="collapse" id="collapsesletatOrderFull">
                @include('santa.modules.forms.sletatOrderFull', ['people' => $item['data'][53], 'kids' => $item['data'][54],
                'request' => $request, 'countryName' => $item['data'][1],
                'cityFromName' => $item['data'][0], 'currencyAlias' => $item['data'][21]])
            </div>
        </div>
    </div>
@endsection