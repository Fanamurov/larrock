<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="MartDS">

    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="/_assets/tbkhv/_css/min/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{asset('_assets/tbkhv/_css/min/tbkhv.min.css')}}"/>
    <link rel="stylesheet" href="/_assets/bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/_assets/bower_components/selectize/dist/css/selectize.bootstrap3.css"/>
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,500,500italic,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    @yield('styles')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if(App::environment() === 'local')
        <script src="{{asset('_assets/_admin/_js/jquery-1.11.1.min.js')}}"></script>
    @else
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    @endif
</head>
<body>
@include('tbkhv.sections.headerLine')
<div class="container container-body">
    <header class="row">
        <div class="col-xs-5">
            <div class="col-xs-22 col-xs-offset-0">
                <a href="/" class="logo">
                    <img src="/_assets/tbkhv/_images/logo.png" width="225" height="49" alt="Company name">
                </a>
            </div>
        </div>
        <div class="col-xs-offset-1 col-xs-18">
            @include('tbkhv.sections.headBenefits')
        </div>
    </header>

    <div class="header-top_menu">
        <div class="col-xs-6 block-categories pointer show_menu">
            <span class="text-uppercase"><i class="fa fa-reorder"></i> Категории товаров</span>
        </div>
        <div class="col-xs-16 col-xs-offset-1">
            <form action="/otapi/search" method="get">
                <div class="input-group block-search">
                    <input name="search" type="text" class="form-control" placeholder="Поиск товаров по названию или коду..." value="{{ Request::get('search') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Искать!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="menu_hidden hidden">
            @include('tbkhv.modules.menu.catalog-left')
        </div>
        <div class="col-xs-24">
            @if(Route::current()->getName() !== 'otapi.index')
                @if(Route::current()->getName() !== 'mainpage')
                    <section class="block-breadcrumbs">
                        <div class="col-xs-24">
                            @yield('breadcrumbs')
                        </div>
                    </section>
                @endif
            @endif

            <section class="block-filters">
                <div class="col-xs-24">
                    @yield('filters')
                </div>
            </section>

            <section class="row" id="content">
                <div class="col-xs-24">
                    @include('front.errors')
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</div>
<a href="#all" title="Переместиться наверх страницы" id="toTop"></a>
@include('tbkhv.sections.footer')
@include('tbkhv.sections.bottomScripts')
</body>
</html>