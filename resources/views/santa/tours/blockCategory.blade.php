<div class="toursBlockCategory col-xs-8">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/tours/{{ $data->url }}">
        <h3 class="text-center">
            @if(isset($data->get_parent->url))
                <!--<a href="/tours/{{ $data->get_parent->url }}/{{ $data->url }}">{{ $data->title }}</a>-->
                <a href="/tours/{{ $data->url }}">{{ $data->title }}</a>
            @else
                <a href="/tours/{{ $data->url }}">{{ $data->title }}</a>
            @endif
        </h3>
        @if($data->image)
            <img src="{{ $data->image }}" class="categoryImage">
        @else
            <img src="/_assets/_santa/_images/empty_big.png" width="125" alt="Нет фото" class="categoryImage categoryImage-empty all-width">
        @endif
        <div class="description">
            {!! $data->short !!}
        </div>
    </div>
</div>