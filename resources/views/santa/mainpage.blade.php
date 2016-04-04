<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="MartDS">

    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/front.min.css')}}"/>
    <link rel="stylesheet" href="/_assets/bower_components/selectize/dist/css/selectize.bootstrap3.css"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700|Open+Sans+Condensed:300,700|Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
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
<div class="container container-body">
    <header class="row">
        <div class="header-redline container-fluid">
            <div class="col-sm-7 col-sm-offset-1">
                <a href="#">Подобрать тур</a>
            </div>
            <div class="col-sm-8 text-center">
                <a href="#">Найти авиабилет</a>
            </div>
            <div class="col-sm-7 text-right">
                <a href="#">Заказать звонок</a>
            </div>
        </div>
        <div class="col-sm-15 col-sm-offset-1 header-logo">
            <a href="/">
                <img src="/_assets/_santa/_images/logo.png" width="169" height="115" alt="Туристическая компания Санта-Авиа Хабаровск" class="pull-left">
                <span>Отдыхать - правильно!</span>
            </a>
        </div>
        <div class="col-sm-6 header-address">
            <p><span class="city">г.Хабаровск</span><br/>
                <a href="tel:84212454546" class="phone">(4212) 45-45-46</a><br/>
                пн-пт: 09<sup>00</sup>-19<sup>00</sup>,
                сб: 10<sup>00</sup>-15<sup>00</sup></p>
        </div>
        <div class="col-xs-24 div-menu">
            {!! \MenuApp::render('navbar') !!}
        </div>
    </header>

    <section class="row" id="content">
        <div class="col-xs-24 col-sm-17">
            <div class="col-xs-24">
                @include('front.errors')
                @include('santa.modules.slideshow.mainpage')
                @include('santa.modules.list.hotTours')
                @include('santa.modules.list.news')
                @yield('slideshow')
                @yield('content')
            </div>
        </div>
        <section id="right_colomn" class="col-xs-24 col-sm-7">
            <div class="col-xs-24 col-sm-22 col-sm-offset-2">
                @include('santa.modules.forms.searchTourShort')
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
                @include('santa.modules.list.vidy')
                @include('santa.modules.forms.subscribe')
            </div>
        </section>
    </section>

    <footer>
        @include('santa.sections.footer')
        @yield('footer')
    </footer>
</div>

<!-- Mainly scripts -->
<script src="{{asset('_assets/_santa/_js/bootstrap.min.js')}}"></script>
<script src="/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="{{asset('_assets/_santa/_js/santa_core.min.js')}}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
@yield('scripts')
<script src="/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/_assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>
</body>
</html>