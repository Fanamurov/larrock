<div class="block-module_listNews">
    <p class="h2">Новости</p>
    <ul class="list-unstyled list-inline">
        @foreach($list_news as $item)
            <li class="col-xs-24 col-sm-8 news-item-module block-module-padding">
                <div class="row">
                    <div class="col-sm-24">
                        @if($item->getFirstMediaUrl('images'))
                            <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-24">
                        <a href="/news/{{ $item->get_category->url }}/{{ $item->url }}">{{ $item->title }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
    <a href="/news" class="btn btn-info btn-small pull-right">Все новости</a>
</div>
<div class="clearfix"></div>