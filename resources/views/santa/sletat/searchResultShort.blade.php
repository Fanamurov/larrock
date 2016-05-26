@if($GetTours['iTotalDisplayRecords'] > 1)
<div class="toursPageCountry-bestcost row">
    <div class="col-xs-24"><h5 class="title-header">Лучшие цены <a class="pull-right" target="_blank" href="/sletat?cityFromId=1286&countryId=113&s_adults=2&s_kids=">Все туры</a></h5></div>
    <ul class="list-unstyled search-result">
        @foreach($GetTours['aaData'] as $item)
            <li class="col-xs-24 col-sm-6 bestcost-row">
                <div class="col-xs-24">
                <div class="col-sm-24 search-result-photo">
                    @if( !empty($item[29]))
                        <img src="{{ str_replace('_0.jpg', '_0_250_250.jpg', $item[29]) }}" align="Hotel" class="all-width hidden-xs hidden-sm">
                    @else
                        <img src="/_assets/_santa/_images/empty_big.png" alt="Нет фото" class="categoryImage categoryImage-empty all-width hidden-xs hidden-sm">
                    @endif
                </div>
                <p class="h4 col-xs-24">{{ $item[7] }}</p>
                    <div class="hotel-stars col-xs-24">
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
                <div class="col-sm-24">
                    <div class="col-md-24">{{ $item[33] }} - {{ $item[31] }}</div>
                </div>
                <div class="col-sm-24">
                    <div class="col-md-24">с {{ $item[12] }} на {{ $item[14] }} ночей</div>
                    <br/>
                    <p class="cost">{{ $item[42] }} {{ $item[43] }}</p>
                    <form action="{{ route('sletat.ActualizePrice') }}" method="get" target="_blank">
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