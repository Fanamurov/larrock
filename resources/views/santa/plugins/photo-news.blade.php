<div class="gallery-news row">
    @foreach($images as $key => $image)
        @if($key === 0)
            <div class="col-xs-24">
        @else
            @if($key === 1)
                <div class="clearfix"></div>
                <div class="row"><div class="col-xs-24">
            @endif
            <div class="col-xs-24 col-sm-4">
        @endif
            <div class="gallery-news-item">
                <a class="fancybox" onclick="yaCounter27992118.reachGoal('ShowGallery'); return true;"
                   rel="fancybox-{{ $image->getCustomProperty('gallery') }}"
                   href="{{ $image->getUrl() }}" title="{{ $image->getCustomProperty('alt', 'фото') }}">
                    <img src="{{ $image->getUrl() }}" alt="{{ $image->getCustomProperty('alt', 'фото') }}" class="max-width">
                </a>
            </div>
        </div>
    @endforeach
</div>