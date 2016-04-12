<div class="catalogBlockCategory col-xs-12">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/catalog/{{ $data->url }}">
        @level(2)
            <a class="admin_edit" href="/admin/category/{{ $data->id }}/edit">Edit element</a>
        @endlevel
        @if($data->image)
            <img src="{{ $data->image->getUrl() }}" class="categoryImage">
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