<ul class="list-unstyled list-inline block-menu">
    @foreach($menu as $data_item)
        <li @if(URL::current() .'/' === URL::current() . $data_item->url) class="active" @endif>
            <a href="{{ $data_item->url }}">{{ $data_item->title }}</a>
        </li>
    @endforeach
    <li>
        @include('front.modules.cart.moduleSplash-menu')
    </li>
</ul>