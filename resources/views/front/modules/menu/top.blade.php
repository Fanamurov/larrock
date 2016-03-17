<ul class="list-unstyled list-inline block-menu">
    @foreach($menu as $data_item)
        <li @if(
        (ends_with($data_item->url, Route::getCurrentRoute()->getParameter('url')))
        OR (Route::current()->getUri() === '/' AND $data_item->url === '/')
        OR (starts_with(Route::getCurrentRoute()->getUri(), $data_item->connect))
        ) class="active" @endif>
            <a href="{{ $data_item->url }}">{{ $data_item->title }}</a>
        </li>
    @endforeach
    <li>
        @include('front.modules.cart.moduleSplash-menu')
    </li>
</ul>