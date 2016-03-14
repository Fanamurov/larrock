<div class="catalogBlockItem col-xs-12">
    <div class="link_block_this" data-href="{!! URL::current() !!}/{{ $data->url }}">
        <div class="catalogImage">
            @if($data->getFirstMediaUrl('images'))
                <img src="{{ $data->getFirstMediaUrl('images') }}" class="categoryImage all-width">
            @else
                <img src="/_assets/_front/_images/empty_big.png" alt="Нет фото" class="listItemImage listItemImage-empty all-width">
            @endif
            <img src="/_assets/_front/_images/icons/icon_cart.png" alt="Добавить в корзину" class="add_to_cart pointer"
                 data-id="{{ $data->id }}" width="40" height="25">
            <div class="cost">
                @if($data->cost === 0)
                    цена договорная
                @else
                    {{ $data->cost }} <span>{{ $data->what }}</span>
                @endif
            </div>
        </div>
        <h5>
            <a href="{!! URL::current() !!}/{{ $data->url }}">{{ $data->title }}</a>
        </h5>
        <p>{!! $data->short !!}</p>
    </div>
</div>