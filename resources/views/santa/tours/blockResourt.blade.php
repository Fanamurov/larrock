<div class="toursBlockTour col-xs-8">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/tours{{ $data->FullUrl }}">
        <h3 class="text-center">
            <a href="/tours{{ $data->FullUrl }}">{{ $data->title }}</a>
        </h3>
        @if($data->getMedia('images')->sortByDesc('order_column')->first())
            <img src="{{ $data->getMedia('images')->sortByDesc('order_column')->first()->getUrl() }}" class="categoryImage all-width">
        @else
            <img src="/_assets/_santa/_images/empty_big.png" width="125" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
        @endif
    </div>
</div>