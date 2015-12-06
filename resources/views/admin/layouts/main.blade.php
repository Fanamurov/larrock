<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Larrock Admin</title>
    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_admin/_css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_admin/_css/admin.min.css')}}"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,500,500italic,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if(App::environment() === 'local')
        <script src="{{asset('_admin/_js/jquery-1.11.1.min.js')}}"></script>
    @else
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    @endif
</head>
<body>

<div id="wrapper" class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="/admin" class="navbar-brand">Larrock</a>
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
                            <li>
                                <a href="#">Ленты</a>
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
                                    <li><a href="#">Картинки</a></li>
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
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Логи <span class="label label-warning">5</span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#">Не найдено</a></li>
                                    <li><a href="#">Ошибка ядра</a></li>
                                    <li><a href="#">Письма</a></li>
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

            <div class="wrapper wrapper-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
                                    <div class="alert alert-{{ $type }} alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <i class="icon-plus"></i> {{ $message }}
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    @include('admin.blocks.title')
                                </div>
                                <div class="ibox-content">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="pull-right">
                    Проект <a href="http://test.ru">test.ru</a>
                </div>
                <div>
                    <strong>Copyright</strong> LarRock v.1 © 2015-2015
                </div>
            </div>
        </div>
    </div>
</div>

<link href="/_admin/_css/plugins/jQuery.filer-master/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="/_admin/_css/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />

<script src="/_admin/_js/plugins/jQuery.filer-master/js/jquery.filer.min.js"></script>


<!-- Mainly scripts -->
<script src="{{asset('_admin/_js/bootstrap.min.js')}}"></script>
<script src="{{asset('_admin/_js/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('_admin/_js/back_core.js')}}"></script>

<script src="{{asset('_admin/_js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('_admin/_js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('_admin/_js/tinymce/tinymce-settings.js')}}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
</body>
</html>