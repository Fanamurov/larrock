<ul class="block-module_listVidy list-unstyled">
    @foreach($module_vidy as $item)
        <li>
            <a href="{{ $item->url }}">{{ $item->title }}</a>
        </li>
    @endforeach
</ul>