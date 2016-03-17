<div class="row block-seofish">
    @foreach($seofish as $key => $item)
        @if($key === 0)
            <h1 class="col-xs-24">{{ $item->title }}</h1>
        @else
            <div class="col-xs-12 block-seofish-col">
                <h4>{{ $item->title }}</h4>
                <div>
                    {!! $item->short !!}
                    {!! $item->description !!}
                </div>
            </div>
        @endif
    @endforeach
</div>