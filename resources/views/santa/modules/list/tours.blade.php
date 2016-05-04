<div class="block-module_listNews">
    <p class="h5 title-header">Новые туры ручной сборки <a href="/tours" class="pull-right">Все туры</a></p>
    <ul class="list-unstyled list-inline">
        @foreach($list_tours as $item)
            <li class="col-xs-24 col-sm-8 blog-item-module block-module-padding">
                <div class="row link_block">
                    <div class="col-sm-24">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-24">
                        <a href="{{ $item->FullUrl }}">{{ $item->title }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<div class="clearfix"></div>