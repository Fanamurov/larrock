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
                @foreach($components as $component)
                    @if(isset($component['admin_menu_items']))
                        <li class="dropdown @if(isset($component['admin_menu_active'])) active @endif">
                            <a aria-expanded="false" role="button" href="/admin/{{ $component['name'] }}" class="dropdown-toggle" data-toggle="dropdown"> {{ $component['title'] }} <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                @foreach($component['admin_menu_items'] as $menu_item)
                                    <li @if(isset($menu_item['class'])) class="{{ $menu_item['class'] }}" @endif><a href="/admin/{{ $component['name'] }}/{{ $menu_item['id'] }}">{{ $menu_item['title'] }}</a></li>
                                @endforeach
                                @if(array_key_exists('admin_menu_push', $component))
                                    @foreach($component['admin_menu_push'] as $menu_title => $menu_url)
                                        <li><a href="{{ $menu_url }}">{{ $menu_title }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="@if(isset($component['admin_menu_active'])) active @endif">
                            <a href="/admin/{{ $component['name'] }}">{{ $component['title'] }}</a>
                        </li>
                    @endif
                @endforeach
                <li class="dropdown @if(in_array('users', $current_uri)) active @endif">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Пользователи <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ action('Admin\AdminUsersController@index') }}"><i class="fa fa-list"></i> Список пользователей</a></li>
                        <li><a href="{{ action('Admin\AdminUsersController@create') }}"><i class="fa fa-plus"></i> Добавить пользователя</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action('Admin\AdminRolesController@index') }}"><i class="fa fa-list"></i> Список ролей</a></li>
                        <li><a href="{{ action('Admin\AdminRolesController@create') }}"><i class="fa fa-plus"></i> Добавить роль</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Настройки <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="{{ action('Admin\AdminSeoController@index') }}">Seo</a></li>
                        <li><a href="{{ action('Admin\AdminMenuController@index') }}">Меню сайта</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Глобальные настройки</a></li>
                        <li><a href="#">Компоненты</a></li>
                        <li><a href="#">Модули</a></li>
                        <li><a href="#">Блоки шаблона</a></li>
                        <li><a href="{{ action('Admin\AdminSettings\Image@index') }}">Картинки</a></li>
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
                    <a href="/auth/logout">
                        <i class="fa fa-sign-out"></i> Выйти
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>