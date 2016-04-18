<ul class="block-module_listVidy list-unstyled">
    @foreach($module_vidy as $item)
        <li>
            <a href="/tours/vidy-otdykha/{{ $item->url }}">
                @if($item->title === 'Пляжный отдых')
                    <span class="fi flaticon-summer"></span>
                @elseif($item->title === 'Экскурсионные туры')
                    <span class="fi flaticon-technology"></span>
                @elseif($item->title === 'Комби-туры')
                    <span class="fi flaticon-transport-1"></span>
                @elseif($item->title === 'Отдых с детьми')
                    <span class="fi flaticon-people-4"></span>
                @elseif($item->title === 'Учимся и отдыхаем')
                    <span class="fi flaticon-people-2"></span>
                @elseif($item->title === 'Отдых и здоровье')
                    <span class="fi flaticon-medical"></span>
                @elseif($item->title === 'Экхотические острова')
                    <span class="fi flaticon-beach"></span>
                @elseif($item->title === 'Luxury')
                    <span class="fi flaticon-luxury"></span>
                @elseif($item->title === 'Туристические круизы')
                    <span class="fi flaticon-icon-430"></span>
                @elseif($item->title === 'Свадебные путешествия')
                    <span class="fi flaticon-circles"></span>
                @elseif($item->title === 'Горнолыжные туры')
                    <span class="fi flaticon-sport"></span>
                @else
                    <span class="fi flaticon-summer"></span>
                @endif
                {{ $item->title }}
            </a>
        </li>
    @endforeach
</ul>