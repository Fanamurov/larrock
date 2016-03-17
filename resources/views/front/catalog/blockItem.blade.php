<div class="catalogBlockItem col-xs-12">
    <div>
        <div class="catalogImage link_block_this" data-href="{!! URL::current() !!}/{{ $data->url }}">
            @if($data->images->first())
                <img src="{{ $data->images->first()->getUrl() }}" class="categoryImage max-width">
            @else
                <img src="/_assets/_front/_images/empty_big.png" alt="Нет фото" class="listItemImage listItemImage-empty max-width">
            @endif
            <img src="/_assets/_front/_images/icons/icon_cart_black.png" alt="Добавить в корзину" class="add_to_cart pointer"
                 data-id="{{ $data->id }}" width="32" height="32">
            <div class="cost">
                @if($data->cost == 0)
                    <span class="empty-cost">цена договорная</span>
                @else
                    <span class="default-cost">&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->cost }} <span class="what">{{ $data->what }}</span></span>
                @endif
            </div>
        </div>
        <div class="catalogShort">
            <h5>
                <a href="{!! URL::current() !!}/{{ $data->url }}">{{ $data->title }}</a>
            </h5>
            <p>{!! $data->short !!}</p>
        </div>
    </div>
</div>