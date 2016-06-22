<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Туры, горящие путевки в Тайланд, Китай, Вьетнам, Турцию, отдых из Хабаровска 2016. Туристическая компания Cанта-авиа Хабаровск')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Santa-avia.ru Санта-авиа">
    <meta name='yandex-verification' content='409dfa0fa1b91fe7' />
    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />

    <meta itemprop="name" content="@yield('title', 'Туристическая компания Cанта-авиа Хабаровск')"/>
    <meta itemprop="description" content="@yield('description')"/>
    <meta itemprop="image" content="http://santa-avia.local/media/Tours/Tours-20-7626a760b41079212fc7a852beebd00ejpg.jpg"/>

    <meta name="twitter:card" content="summary"/>  <!-- Тип окна -->
    <meta name="twitter:site" content="Cанта-авиа Хабаровск"/>
    <meta name="twitter:title" content="@yield('title', 'Туристическая компания Cанта-авиа Хабаровск')">
    <meta name="twitter:description" content="@yield('description')"/>
    <meta name="twitter:image" content="http://santa-avia.local/media/Tours/Tours-20-7626a760b41079212fc7a852beebd00ejpg.jpg"/>
    <meta name="twitter:domain" content="santa-avia.ru"/>

    <!-- https://developers.facebook.com/docs/sharing/webmasters#markup -->
    <!-- https://developers.facebook.com/tools/debug/ -->
    <meta property="og:type" content="article"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:title" content="@yield('title', 'Туристическая компания Cанта-авиа Хабаровск')"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:image" content="http://santa-avia.local/media/Tours/Tours-20-7626a760b41079212fc7a852beebd00ejpg.jpg"/>
    <meta property="og:url" content="http://santa-avia.ru"/>
    <meta property="og:site_name" content="Cанта-авиа Хабаровск"/>
    <meta property="og:see_also" content="http://santa-avia.ru"/>

    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_assets/_santa/_css/min/front.min.css')}}"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    @yield('styles')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="alternate" type="application/rss+xml" title="Santa-avia.ru :: Новости, блог, туры" href="http://santa-avia.ru/feed.rss">
    <script charset="UTF-8" src="//cdn.sendpulse.com/js/push/fc36d3f858210b2d9e8fe1288fab4cce_0.js" async></script>
</head>