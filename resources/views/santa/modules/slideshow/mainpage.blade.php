<div>
    <div id="carousel-mainpage" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            @for($i=1; $i < count($slideshow); $i++)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($slideshow as $key => $value)
                <div class="link_block_this item @if($key === 0) active @endif" data-href="{{ $value->banner_url }}">
                    @if( !empty($value->description))
                        <span class="carousel-caption">{!! $value->description !!}</span>
                    @endif
                    <a href="{{ $value->banner_url }}" onclick="yaCounter27992118.reachGoal('SlideshowClick'); return true;">
                        <img src="{{ $value->images }}" alt="{{ $value->title }}" class="all-width">
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-mainpage" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-mainpage" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="clearfix"></div>
</div>