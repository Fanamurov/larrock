<div class="catalogBlockCategory col-xs-12">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/catalog/{{ $data->url }}">
        @if($data->getFirstMediaUrl('images'))
            <img src="{{ $data->getFirstMediaUrl('images') }}" class="categoryImage">
        @else
            <img src="/_assets/_front/_images/empty_big.png" width="125" alt="Нет фото" class="categoryImage categoryImage-empty">
        @endif
        <h3>
            @if(isset($data->get_parent->url))
                <a href="/catalog/{{ $data->get_parent->url }}/{{ $data->url }}">{{ $data->title }}</a>
            @else
                <a href="/catalog/{{ $data->url }}">{{ $data->title }}</a>
            @endif
        </h3>
    </div>
</div>