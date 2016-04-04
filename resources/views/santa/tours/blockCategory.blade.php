<div class="toursBlockCategory col-xs-8">
    <div class="link_block_this col-xs-22 col-xs-offset-2" data-href="/tours{{ $data->FullUrl }}">
        <h3 class="text-center">
            <a href="/tours{{ $data->FullUrl }}">{{ $data->title }}</a>
        </h3>
        <img src="{{ $data->FirstImage }}" class="categoryImage all-width" title="{{ $data->title }}">
        <div class="short">
            {!! $data->ShortWrap !!}
        </div>
    </div>
</div>