<ul class="block-module_listCatalog list-unstyled">
    <li @if(URL::current() === 'http://'.$_SERVER['SERVER_NAME'] OR URL::current() === 'http://'.$_SERVER['SERVER_NAME'] .'/catalog/all') class="active" @endif>
        <a href="/catalog/all">Вся рыбная продукция</a>
    </li>
    @foreach($module_listCatalog as $item)
        <li @if(URL::current() === 'http://'.$_SERVER['SERVER_NAME'] .'/catalog/'. $item->url) class="active" @endif>
            <a href="/catalog/{{ $item->url }}">{{ $item->title }}</a>
        </li>
    @endforeach
</ul>