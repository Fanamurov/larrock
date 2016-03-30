<div class="toursBlockItem col-xs-12">
    <div>
        <div class="toursImage link_block_this" data-href="{!! URL::current() !!}/{{ $data->url }}">
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
        <div class="toursShort">
            <h5>
                <a href="{!! URL::current() !!}/{{ $data->url }}">{{ $data->title }}</a>
            </h5>
            <p>{!! $data->short !!}</p>
            <div class="tours-descriptions-rows">
                @foreach($config_app['rows'] as $row_key => $row)
                    @if(array_key_exists('template', $row) && $row['template'] === 'description' && isset($data->$row_key) && !empty($data->$row_key))
                        <p><strong>{{ $row['title'] }}:</strong> {{ $data->$row_key }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>