<ul>
@foreach($module_listCatalog as $item)
    <li><a href="{{ $item->url }}">{{ $item->title }}</a></li>
@endforeach
</ul>