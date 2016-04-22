<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Cанта-авиа')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="MartDS">
    <meta name='yandex-verification' content='409dfa0fa1b91fe7' />
    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/front.min.css')}}"/>
    <link rel="stylesheet" href="/_assets/bower_components/selectize/dist/css/selectize.bootstrap3.css"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700|Open+Sans+Condensed:300,700|Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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