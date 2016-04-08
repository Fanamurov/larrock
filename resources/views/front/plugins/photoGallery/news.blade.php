<div class="gallery-news">
    @foreach($images as $image)
        <div class="gallery-news-item">
            <a class="fancybox" rel="fancybox-{{ $image->getCustomProperty('gallery') }}"
               href="{{ $image->getUrl() }}" title="{{ $image->getCustomProperty('alt', 'фото') }}">
                <img src="{{ $image->getUrl() }}" alt="{{ $image->getCustomProperty('alt', 'фото') }}" class="max-width">
            </a>
        </div>
    @endforeach
</div>