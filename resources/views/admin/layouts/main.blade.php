<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
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

    <script src="{{asset('_admin/_js/plugins/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{asset('_admin/_js/plugins/morris/morris.js')}}"></script>
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
                            <li>
                                <a aria-expanded="false" role="button" href="/"><i class="fa fa-mail-reply"></i> К сайту</a>
                            </li>
                            <li>
                                <a href="{{ action('Admin\PageController@index') }}">Статичные страницы</a>
                            </li>
                            <li class="dropdown active">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Пользователи <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="{{ action('Admin\UsersController@index') }}"><i class="fa fa-list"></i> Список пользователей</a></li>
                                    <li><a href="{{ action('Admin\UsersController@create') }}"><i class="fa fa-plus"></i> Добавить пользователя</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ action('Admin\RolesController@index') }}"><i class="fa fa-list"></i> Список ролей</a></li>
                                    <li><a href="{{ action('Admin\RolesController@create') }}"><i class="fa fa-plus"></i> Добавить роль</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <input type="text" class="form-control" placeholder="Поиск...">
                            </li>
                            <li>
                                <a href="#" id="clear_cache"><i class="fa fa-trash-o"></i> Кэш</a>
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
                            <!-- Сообщение об успешной операции через \View::share('messages', []); -->
                            @if(isset($messages))
                                @foreach($messages as $message)
                                    <div class="alert alert-info alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <i class="icon-plus"></i> {{ $message }}
                                    </div>
                                @endforeach
                            @endif

                            <!-- Сообщение об успешной операции через ->with -->
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <i class="icon-plus"></i> {{ Session::get('message') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <i class="icon-bug"></i> {{ Session::get('error') }}
                                </div>
                            @endif

                            @if($errors->has())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <i class="icon-bug"></i> {{ $error }}
                                    </div>
                                @endforeach
                            @endif
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


<!-- Mainly scripts -->
<script src="{{asset('_admin/_js/bootstrap.min.js')}}"></script>
<script src="{{asset('_admin/_js/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('_admin/_js/back_core.js')}}"></script>

<script src="{{asset('_admin/_js/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('_admin/_js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('_admin/_js/tinymce/tinymce-settings.js')}}"></script>
</body>
</html>