<div class="block-module_listNews">
    <p class="h5 title-header">Новые туры ручной сборки <a href="/tours" class="pull-right">Все туры</a></p>
    <ul class="list-unstyled list-inline">
        @foreach($list_tours as $item)
            <li class="col-xs-24 col-sm-8 blog-item-module block-module-padding">
                <div class="row">
                    <div class="col-sm-24">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-24">
                        <a href="/tours/{{ $item->get_category->first()->url }}/{{ $item->url }}">{{ $item->title }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>