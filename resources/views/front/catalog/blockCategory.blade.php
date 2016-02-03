<div class="catalogBlockCategory col-xs-8 col-md-8 col-lg-6">
    <div class="link_block_this" data-href="/catalog/{{ $data->url }}">
        @if(count($data->get_images) > 0)
            <img src="/images/category/140-140/{{ $data->get_images->first()->name }}" alt="{{$data->title}}" class="categoryImage">
        @else
            Not photo
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