<div class="block-module_listNews">
    <p class="h2">Новые туры ручной сборки</p>
    <ul class="list-unstyled list-inline">
        @foreach($list_tours as $item)
            <li class="col-xs-24 col-sm-8 blog-item-module block-module-padding">
                <div class="row">
                    <div class="col-sm-24">
                        @if($item->getFirstMediaUrl('images'))
                            <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="all-width">
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
    <a href="/tours" class="btn btn-default btn-small pull-right">Все туры</a>
</div>
<div class="clearfix"></div>