<ul class="list-unstyled list-inline block-menu">
    <li>
        <a href="#">Компания</a>
    </li>
    <li class="active">
        <a href="#">Страны</a>
    </li>
    <li>
        <a href="#">Виды отдыха</a>
    </li>
    <li>
        <a href="#">Услуги</a>
    </li>
    <li>
        <a href="#">Контакты</a>
    </li>
    <li>
        <a href="#">Отзывы</a>
    </li>
    <li>
        <a href="#">Блог</a>
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