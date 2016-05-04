<div class="block-searchSiteTours colomn-container">
    <p class="h3 block-title">Индивидуальные туры</p>
    @foreach($siteSearch['categories'] as $country)
        <div class="block-searchSiteTours-item link_block">
            @if($country->getFirstMediaUrl('images'))
                <img class="all-width" src="{{ $country->getFirstMediaUrl('images') }}">
            @endif
            <p class="h3"><a href="/tours/strany/{{ $country->url }}">{{ $country->title }}</a></p>
            <p>{!! mb_strimwidth($country->short, 0, 200, '...') !!}</p>
        </div>

        @if(count($country->get_toursActive) > 0)
            <p class="h3">Туры по стране</p>
        @endif
        @foreach($country->get_toursActive as $tour)
            <div class="block-searchSiteTours-item link_block">
                @if($tour->getFirstMediaUrl('images'))
                    <img class="all-width" src="{{ $tour->getFirstMediaUrl('images') }}">
                @endif
                <p class="h4"><a href="/tours/strany/{{ $country->url }}/{{ $tour->url }}">{{ $tour->title }}</a></p>
            </div>
        @endforeach

        @if(count($country->get_childActive) > 0)
            <h3>Курорты</h3>
        @endif
        @foreach($country->get_childActive as $resort)
            <div class="block-searchSiteTours-item link_block">
                @if($resort->getFirstMediaUrl('images'))
                    <img class="all-width" src="{{ $resort->getFirstMediaUrl('images') }}">
                @endif
                <p class="h4"><a href="/tours/strany/{{ $resort->url }}">{{ $resort->title }}</a></p>
            </div>

            @foreach($resort->get_toursActive as $tour)
                <div class="block-searchSiteTours-item link_block">
                    @if($tour->getFirstMediaUrl('images'))
                        <img class="all-width" src="{{ $tour->getFirstMediaUrl('images') }}">
                    @endif
                    <p class="h4"><a href="/tours/strany/{{ $country->url }}/{{ $resort->url }}/{{ $tour->url }}">{{ $tour->title }}</a></p>
                </div>
            @endforeach
        @endforeach
    @endforeach
    <div class="clearfix"></div>
</div>