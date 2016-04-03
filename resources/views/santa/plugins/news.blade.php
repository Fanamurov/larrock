<div class="gallery-news row">
    @foreach($images as $key => $image)
        @if($key === 0)
            <div class="col-xs-24">
        @else
            <div class="col-xs-24 col-sm-4">
        @endif
            <div class="gallery-news-item">
                <a class="fancybox" rel="fancybox-{{ $image->getCustomProperty('gallery') }}"
                   href="{{ $image->getUrl() }}" title="{{ $image->getCustomProperty('alt', 'фото') }}">
                    <img src="{{ $image->getUrl() }}" alt="{{ $image->getCustomProperty('alt', 'фото') }}" class="max-width">
                </a>
            </div>
        </div>
    @endforeach
</div>