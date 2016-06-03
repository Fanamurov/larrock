<div class="toursBlockTour toursBlockTourSletat col-xs-8">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/sletat?cityFromId=1286&countryId=29&s_adults=2&s_nightsMin=1&s_nightsMax=28"
         onclick="yaCounter27992118.reachGoal('blockTourSletat'); return true;">
        <h4 class="text-center">
            <a href="#">{{ $item[7] }} {{ $item[8] }} ({{ $item[19] }})</a>
        </h4>
        <p class="stars">
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
        </p>
        @if( !empty($item[29]))
            <img src="{{ $item[29] }}" align="Hotel" class="all-width">
        @else
            <img src="/_assets/_santa/_images/empty_big.png" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
        @endif
        <p class="dates">Вылет {{ $item[12] }} на {{ $item[14] }} ночей на {{ $item[16] }} взрослых</p>
        <p class="cost">{{ $item[42] }} <small>руб</small></p>
    </div>
</div>