@if(count($slideshow['big']) > 0)
    <div id="carousel-mainpage" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            @for($i=1; $i < count($slideshow['big']); $i++)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($slideshow['big'] as $key => $value)
                <div class="item @if($key === 0) active @endif">
                    <a href="{{ $value->banner_url }}">
                        <span class="carousel-caption">{!! $value->description !!}</span>
                        <img src="/_assets/_santa/_images/main_big_banner_button.png" class="banner_button" alt="Подробнее">
                        <img src="{{ $value->images->first()->getUrl() }}" alt="{{ $value->title }}" class="all-width">
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
@endif
@if(count($slideshow['small']) > 0)
    <div class="row block-akcii">
        @foreach($slideshow['small'] as $value)
            <div class="col-sm-8">
                <a href="{{ $value->banner_url }}">
                    <img src="{{ $value->images->first()->getUrl() }}" class="all-width">
                </a>
            </div>
        @endforeach
    </div>
@endif
<div class="clearfix"></div>