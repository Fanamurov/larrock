<ul class="block-module_listVidy block-module_listStrany list-unstyled">
    @foreach($module_strany as $item)
        <li>
            <a href="/tours/strany/{{ $item->url }}">
                <span class="glyphicon glyphicon-chevron-right"></span>
                {{ $item->title }}
            </a>
            <ul class="list-unstyled">
                @foreach($item->get_childActive as $child)
                    <li>
                        <a href="/tours/strany/{{ $item->url }}/{{ $child->url }}">
                            {{ $child->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>