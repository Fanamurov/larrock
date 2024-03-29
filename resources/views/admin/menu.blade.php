<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="/admin" class="navbar-brand">L!</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Каталог <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Разделы и товары</a></li>
                        <li><a href="#">Тех. описания</a></li>
                        <li><a href="#">Wizard</a></li>
                        <li><a href="#">Фильтры, поля</a></li>
                        <li><a href="#">Настройки каталога</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ action('Admin\PageController@index') }}">Cтраницы</a>
                </li>
                <li class="dropdown active">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Ленты <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li class="active"><a href="{{ action('Admin\FeedController@index') }}/1">Новости</a></li>
                        <li><a href="{{ action('Admin\FeedController@index') }}/2">Акции</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action('Admin\FeedController@index') }}">Все материалы</a></li>
                        <li><a href="{{ action('Admin\FeedController@index') }}">Доюавить новый раздел</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Баннеры</a>
                </li>
                <li>
                    <a href="#">Блоки</a>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Корзина <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Заказы</a></li>
                        <li><a href="#">Скидки и купоны</a></li>
                        <li><a href="#">Способы доставки</a></li>
                        <li><a href="#">Способы оплаты</a></li>
                        <li><a href="#">Статистика</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Пользователи <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ action('Admin\UsersController@index') }}"><i class="fa fa-list"></i> Список пользователей</a></li>
                        <li><a href="{{ action('Admin\UsersController@create') }}"><i class="fa fa-plus"></i> Добавить пользователя</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action('Admin\RolesController@index') }}"><i class="fa fa-list"></i> Список ролей</a></li>
                        <li><a href="{{ action('Admin\RolesController@create') }}"><i class="fa fa-plus"></i> Добавить роль</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Администрирование <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ action('Admin\SeoController@index') }}">Seo</a></li>
                        <li><a href="{{ action('Admin\MenuController@index') }}">Меню сайта</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Глобальные настройки</a></li>
                        <li><a href="#">Компоненты</a></li>
                        <li><a href="#">Модули</a></li>
                        <li><a href="#">Блоки шаблона</a></li>
                        <li><a href="{{ action('Admin\Settings\Image@index') }}">Картинки</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="#" id="clear_cache"><i class="fa fa-trash-o"></i> Кэш</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <button type="button" class="btn btn-outline show-please" data-target="search-form" title="Поиск по сайту"><i class="fa fa-search"></i></button>
                    <input type="text" class="form-control search-form hidden" placeholder="Поиск...">
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Логи <span class="label label-warning label-outline">5</span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Не найдено <span class="label label-warning label-outline">5</span></a></li>
                        <li><a href="#">Ошибка ядра <span class="label label-warning label-outline">5</span></a></li>
                        <li><a href="#">Письма <span class="label label-warning label-outline">5</span></a></li>
                    </ul>
                </li>
                <li>
                    <a aria-expanded="false" role="button" href="/" target="_blank">К сайту</a>
                </li>
                <li>
                    <a href="{{ action('Admin\AuthController@getLogout') }}">
                        <i class="fa fa-sign-out"></i> Выйти
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>