<ul class="block-module_listVidy list-unstyled">
    @foreach($module_vidy as $item)
        <li>
            <a href="/tours/vidy-otdykha/{{ $item->url }}">
                <span class="glyphicon glyphicon-chevron-right"></span>
                {{ $item->title }}
            </a>
        </li>
    @endforeach
</ul>