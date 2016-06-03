<div class="block-module_listNews">
    <p class="h5 title-header">Новости <a href="/news" class="pull-right" onclick="yaCounter27992118.reachGoal('newsModule'); return true;">Все новости</a></p>
    <ul class="list-unstyled list-inline">
        @foreach($list_news as $item)
            <li class="col-xs-12 col-sm-8 news-item-module block-module-padding">
                <div class="row link_block" onclick="yaCounter27992118.reachGoal('newsModule'); return true;">
                    <div class="col-sm-24">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-24">
                        <a href="/{{ $item->get_category->url }}/{{ $item->url }}">{{ $item->title }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<div class="clearfix"></div>