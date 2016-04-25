<div class="block-module_listNews">
    <p class="h3">Блог</p>
    <ul class="list-unstyled list-inline">
        @foreach($list_blog as $item)
            <li class="col-xs-24 col-sm-12">
                <div class="row">
                    <div class="col-sm-8">
                        @if($item->getFirstMediaUrl('images', '110x110'))
                            <img src="{{ $item->getFirstMediaUrl('images', '110x110') }}" alt="{{ $item->title }}" class="all-width">
                        @endif
                    </div>
                    <div class="col-sm-16">
                        <a href="#">{{ $item->title }}</a>
                        <p class="text-muted"><small>{{ $item->date }}</small></p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
    <a href="/blog" class="btn btn-default btn-small pull-right">Все материалы блога</a>
</div>
<div class="clearfix"></div>