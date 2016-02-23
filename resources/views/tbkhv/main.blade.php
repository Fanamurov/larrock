<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Front</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="MartDS">

    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="/_assets/tbkhv/_css/min/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{asset('_assets/tbkhv/_css/min/front.min.css')}}"/>
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
<div class="header_line row">
    <div class="container">
        <div class="block-headerCart col-xs-24 col-sm-6">
            @include('tbkhv.modules.cart.moduleSplash')
        </div>
        <div class="col-xs-24 col-sm-18">
            <ul class="nav nav-pills pull-right">
                <li>
                    <a href="#">Доставка</a>
                </li>
                <li>
                    <a href="#">Оплата</a>
                </li>
                <li>
                    <a href="#">Гарантии</a>
                </li>
                <li>
                    <a href="#">Отзывы</a>
                </li>
                <li>
                    <a href="#">Документы</a>
                </li>
                <li>
                    <a href="#">Контакты</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container container-body">
    <header class="row">
        <div class="col-xs-5">
            <div class="col-xs-22 col-xs-offset-0">
                <a href="/" class="logo">
                    <img src="/_assets/tbkhv/_images/logo.png" width="165" height="31" alt="Company name">
                </a>
            </div>
        </div>
        <div class="col-xs-19">
            <div class="blockHeader-benefits">
                <div class="col-xs-8">
                    <i class="fa fa-truck"></i>
                    <p>
                        <span class="strong text-uppercase">Наша доставка из Китая</span><br/>
                        <span class="color-grey">Везем в собственных грузовиках</span>
                    </p>
                </div>
                <div class="col-xs-8">
                    <i class="fa fa-money"></i>
                    <p>
                        <span class="strong text-uppercase">Без лишних трат</span><br/>
                        <span class="color-grey">Заказывать через нас выгоднее</span>
                    </p>
                </div>
                <div class="col-xs-8">
                    <i class="fa fa-support"></i>
                    <p>
                        <span class="strong text-uppercase">Все официально</span><br/>
                        <span class="color-grey">Работаем честно</span>
                    </p>
                </div>
            </div>
        </div>
    </header>

    <div class="header-top_menu">
        @include('tbkhv.modules.menu.catalog', $menu)
        <div class="col-xs-6 block-categories pointer show_menu">
            <span class="text-uppercase"><i class="fa fa-reorder"></i> | Категории товаров</span>
        </div>
        <div class="col-xs-16 col-xs-offset-1">
            <div class="input-group block-search">
                <input type="text" class="form-control" placeholder="Поиск товаров по названию или коду...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i> Искать!</button>
                </span>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

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

<footer class="row footer">
    <div class="container">
        <div class="col-xs-24">
            @yield('footer')
            <address class="footer-left-text">
                <p>ООО «Таобао.кхв»<br>680007, г. Хабаровск, пер. Трубный 10, оф. 123<br>Тел./факс: +7 (4212) 48-72-57, 24-21-15</p>
                <p><a href="mailto:pshabar@mail.ru">pshabar@mail.ru</a></p>
            </address>
            <p>Powered by © OT Commerce <a href="http://otcommerce.com/" target="_blank">otcommerce.com</a></p>
        </div>
    </div>
</footer>

<!-- Mainly scripts -->
<script src="{{asset('_assets/_front/_js/bootstrap.min.js')}}"></script>
<script src="/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="{{asset('_assets/_front/_js/front_core.min.js')}}"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
@yield('scripts')
</body>
</html>