<div class="catalogBlockCategory col-xs-8 col-md-8 col-lg-6">
    <div class="link_block_this" data-href="/catalog/{{ $data->url }}">
        @if(count($data->get_images) > 0)
            <img src="/images/category/140-140/{{ $data->get_images->first()->name }}" alt="{{$data->title}}" class="categoryImage">
        @else
            Not photo
        @endif
        <h3>
            <a href="/catalog/{{ $data->url }}">{{ $data->title }}</a>
        </h3>
    </div>
</div>