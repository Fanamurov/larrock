<div class="block-otapi-review">
    <p>Всего отзывов: {{ $opinions->TotalCount }}</p>
    @foreach($opinions->Content->Item as $item)
        @if(isset($item->Images))
            @if(is_array($item->Images->Image))
                @foreach($item->Images->Image as $image)
                    <img src="{{ $image }}" alt="Фото с отзыва товара">
                @endforeach
            @else
                <img src="{{ $item->Images->Image }}" alt="Фото с отзыва товара">
            @endif
        @endif
        <div>{{ $item->Content }}</div>
        <div>{{ $item->CreatedDate }}</div>
        <div>{{ $item->UserNick }}</div>
    @endforeach
</div>