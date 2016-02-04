<div class="catalogBlockItem col-xs-8 col-md-8 col-lg-6">
    <div class="link_block_this" data-href="{!! URL::current() !!}/{{ $data->url }}">
        <div class="catalogImage">
            @if(count($data->get_images) > 0)
                <img src="/images/catalog/140-140/{{ $data->get_images->first()->name }}" alt="{{$data->title}}" class="listItemImage">
            @else
                <img src="/_assets/_front/_images/empty_big.png" width="125" alt="Нет фото" class="listItemImage listItemImage-empty">
            @endif
            <img src="/_assets/_front/_images/icons/icon_cart.png" alt="Добавить в корзину" class="add_to_cart pointer"
                 data-id="{{ $data->id }}" width="40" height="25">
            <div class="cost">{{ $data->cost }} <span>{{ $data->what }}</span></div>
        </div>
        <h5>
            <a href="{!! URL::current() !!}/{{ $data->url }}">{{ $data->title }}</a>
        </h5>
        <p>{{ $data->short }}</p>
    </div>
</div>