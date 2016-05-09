<div class="block-module_listNews">
    <p class="h5 title-header">Свежие статьи <a href="/blog" class="pull-right">Все материалы блога</a></p>
    <ul class="list-unstyled list-inline">
        @foreach($list_blog as $item)
            <li class="col-xs-12 col-sm-8 blog-item-module block-module-padding">
                <div class="row link_block">
                    <div class="col-sm-24">
                        @if($item->image)
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-24">
                        <a href="/blog/{{ $item->get_category->url }}/{{ $item->url }}">{{ $item->title }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
</div>