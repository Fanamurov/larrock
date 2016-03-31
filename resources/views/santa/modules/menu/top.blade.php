<ul class="list-unstyled list-inline block-menu">
    <li>
        <a href="#">Компания</a>
    </li>
    <li>
        <a href="/tours/strany">Страны</a>
    </li>
    <li>
        <a href="/tours/vidy-otdykha">Виды отдыха</a>
    </li>
    <li>
        <a href="#">Услуги</a>
    </li>
    <li>
        <a href="/page/kontakty">Контакты</a>
    </li>
    <li @if(Route::current()->getName() === 'otzyvy') class="active" @endif>
        <a href="/otzyvy/">Отзывы</a>
    </li>
    <li @if(Route::current()->getName() === 'blog.item' OR Route::current()->getName() === 'blog.main') class="active" @endif>
        <a href="/blog">Блог</a>
    </li>

    @foreach($menu as $data_item)
        <li @if(
        (ends_with($data_item->url, Route::getCurrentRoute()->getParameter('url')))
        OR (Route::current()->getUri() === '/' AND $data_item->url === '/')
        OR (starts_with(Route::getCurrentRoute()->getUri(), $data_item->connect))
        ) class="active" @endif>
            <a href="{{ $data_item->url }}">{{ $data_item->title }}</a>
        </li>
    @endforeach
</ul>