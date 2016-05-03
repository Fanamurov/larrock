<div class="block-searchSiteTours colomn-container">
    <p class="h4">Индивидуальные туры</p>
    @foreach($siteSearch['categories'] as $country)
        <div class="block-searchSiteTours-item">
            @if($country->getFirstMediaUrl('images'))
                <img class="all-width" src="{{ $country->getFirstMediaUrl('images') }}">
            @endif
            <h4><a href="/tours/strany/{{ $country->url }}">{{ $country->title }}</a></h4>
        </div>

        @if(count($country->get_toursActive) > 0)
            <h3>Туры по стране</h3>
        @endif
        @foreach($country->get_toursActive as $tour)
            <div class="block-searchSiteTours-item">
                @if($tour->getFirstMediaUrl('images'))
                    <img class="all-width" src="{{ $tour->getFirstMediaUrl('images') }}">
                @endif
                <h4><a href="/tours/strany/{{ $country->url }}/{{ $tour->url }}">{{ $tour->title }}</a></h4>
            </div>
        @endforeach

        @if(count($country->get_childActive) > 0)
            <h3>Курорты</h3>
        @endif
        @foreach($country->get_childActive as $resort)
            <div class="block-searchSiteTours-item">
                @if($resort->getFirstMediaUrl('images'))
                    <img class="all-width" src="{{ $resort->getFirstMediaUrl('images') }}">
                @endif
                <h4><a href="/tours/strany/{{ $resort->url }}">{{ $resort->title }}</a></h4>
            </div>

            @foreach($resort->get_toursActive as $tour)
                <div class="block-searchSiteTours-item">
                    @if($tour->getFirstMediaUrl('images'))
                        <img class="all-width" src="{{ $tour->getFirstMediaUrl('images') }}">
                    @endif
                    <h4><a href="/tours/strany/{{ $country->url }}/{{ $resort->url }}/{{ $tour->url }}">{{ $tour->title }}</a></h4>
                </div>
            @endforeach
        @endforeach

    @endforeach

    @if(count($siteSearch['tours']) > 0)
        <h3>Туры</h3>
    @endif
    @foreach($siteSearch['tours'] as $value)
        <div class="block-searchSiteTours-item">
            @if($value->getFirstMediaUrl('images', '110x110'))
                <img src="{{ $value->getFirstMediaUrl('images', '110x110') }}">
            @endif
            <h4><a href="/tours/strany/{{ $value->url }}">{{ $value->title }}</a></h4>
        </div>
    @endforeach
    <div class="clearfix"></div>
</div>