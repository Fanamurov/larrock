<div class="row block-seofish">
    <h1 class="col-xs-24">{{ $seofish->first()->title }}</h1>
    <div class="col-xs-12 block-seofish-col">
        @foreach($seofish as $key => $item)
            @if($key & 1)
                <div class="block-seofish-item">
                    <h4>{{ $item->title }}</h4>
                    <div>
                        @level(2)
                        <a class="admin_edit" href="/admin/feed/{{ $item->id }}/edit">Edit element</a>
                        @endlevel
                        {!! $item->short !!}
                        {!! $item->description !!}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-xs-12 block-seofish-col">
        @foreach($seofish as $key => $item)
            @if($key & 1 OR $key === 0)
            @else
                <div class="block-seofish-item">
                    <h4>{{ $item->title }}</h4>
                    <div>
                        @level(2)
                        <a class="admin_edit" href="/admin/feed/{{ $item->id }}/edit">Edit element</a>
                        @endlevel
                        {!! $item->short !!}
                        {!! $item->description !!}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>