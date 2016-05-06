@if($GetTours['iTotalDisplayRecords'] > 1)
<div class="toursPageCountry-bestcost row">
    <div class="col-xs-24"><h5 class="title-header">Лучшие цены <a class="pull-right" href="/sletat">Все туры</a></h5></div>
    <ul class="list-unstyled search-result">
        @foreach($GetTours['aaData'] as $item)
            <li class="col-xs-24 col-sm-8">
                <div class="col-xs-24">
                    <p class="h4">{{ $item[7] }} @if($item[8] !== '0.0'){{ $item[8] }}@endif ({{ $item[19] }})</p>
                    <div class="hotel-stars hidden">
                        @if($item[8] === '*')
                            <i class="glyphicon glyphicon-star"></i>
                        @elseif($item[8] === '2*')
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                        @elseif($item[8] === '3*')
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                        @elseif($item[8] === '4*')
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                        @elseif($item[8] === '5*')
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                            <i class="glyphicon glyphicon-star"></i>
                        @endif
                    </div>
                </div>
                <div class="col-sm-24 hidden-xs hidden-sm">
                    @if( !empty($item[29]))
                        <img src="{{ str_replace('_0.jpg', '_0_250_250.jpg', $item[29]) }}" align="Hotel" class="all-width">
                    @else
                        <img src="/_assets/_santa/_images/empty_big.png" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
                    @endif
                </div>
                <div class="col-sm-24">
                    <div><small>Тур:</small> {{ $item[6] }}</div>
                </div>
                <div class="col-sm-24">
                    <div><small class="muted">Тип размещения:</small> {{ $item[11] }} {{ $item[16] }} взрослых</div>
                    <div><small class="muted">Питание:</small> {{ $item[10] }} ({{ $item[36] }})</div>
                </div>
                <div class="col-sm-24">
                    <div><small class="muted">Вылет:</small> {{ $item[12] }} ({{ $item[14] }} ночей)</div>
                    @if($item[22] === '1')
                        <div class="hidden"><strong>Перелет включен в стоимость тура</strong></div>
                    @endif
                    <br/>
                    <p class="cost">{{ $item[42] }} {{ $item[43] }}</p>
                    <form action="{{ route('sletat.ActualizePrice') }}" method="get">
                        <input type="hidden" name="sourceId" value="{{ $item[1] }}">
                        <input type="hidden" name="offerId" value="{{ $item[0] }}">
                        <input type="hidden" name="countryId" value="{{ $item[30] }}">
                        <input type="hidden" name="requestId" value="{{ $GetTours['requestId'] }}">
                        <button type="submit" class="btn btn-default btn-block">Подробнее</button>
                    </form>
                </div>
                <div class="clearfix"></div><br/><br/>
            </li>
        @endforeach
    </ul>
</div>
@endif