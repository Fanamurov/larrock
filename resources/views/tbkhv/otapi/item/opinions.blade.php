<div class="block-otapi-review">
    @if(isset($opinions->TotalCount) && $opinions->TotalCount > 0)
        @foreach($opinions->Content->Item as $item)
            <div class="row row-review">
                <div class="col-xs-24 col-md-4">
                    @if(isset($item->CreatedDate))
                        <div class="review-date text-muted">{{ $item->CreatedDate }}</div>
                    @endif
                    @if(isset($item->UserNick))
                     <div class="review-nick text-muted">{{ $item->UserNick }}</div>
                    @endif
                </div>
                <div class="col-xs-24 col-md-20">
                    <div class="review-content">{{ $item->Content }}</div>
                    @if(isset($item->Images))
                        <div class="review-images">
                            @if(is_array($item->Images->Image))
                                @foreach($item->Images->Image as $image)
                                    <img src="{{ $image }}" alt="Фото с отзыва товара">
                                @endforeach
                            @else
                                <img src="{{ $item->Images->Image }}" alt="Фото с отзыва товара">
                            @endif
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
            <hr/>
        @endforeach
    @endif
</div>