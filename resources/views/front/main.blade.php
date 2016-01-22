<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - Front</title>
    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_assets/_front/_css/min/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_assets/_front/_css/min/front.min.css')}}"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,500,500italic,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
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
        <div class="col-xs-16">
            <div class="col-xs-22 col-xs-offset-1">
                <a href="/" class="logo">
                    <img src="/_assets/_front/_images/logo.png" width="400" height="160" alt="Company name">
                </a>
                @if(isset($header_email))
                    <div class="block-headerEmail">
                        {!! $header_email->description !!}
                    </div>
                @endif
                <div class="block-headerSearch">
                    @include('front.modules.search.catalog')
                </div>
                @if(isset($header_slogan))
                    <div class="block-headerSlogan">
                        {!! $header_slogan->description !!}
                    </div>
                @endif
            </div>
        </div>
    </header>

    <section class="row" id="content">
        <div class="col-xs-17">
            <div class="col-xs-22 col-xs-offset-1">
                @include('front.errors')

                @yield('content')

                @if(isset($contentBottom))
                    @include('front.modules.seofish.item', $contentBottom)
                @endif
            </div>
        </div>
        <section id="right_colomn" class="col-xs-7">
            <div class="col-xs-19 col-xs-offset-2">
                @yield('rightColomn', 'RIGHT COLOMN test content with float width a b RIGHT COLOMN test content with float width')
            </div>
        </section>
    </section>

    <footer class="row">
        <div class="col-xs-16">
            <div class="col-xs-22 col-xs-offset-1">
                @yield('footer', 'FOOTER')
            </div>
        </div>
    </footer>
</div>

<!-- Mainly scripts -->
<script src="{{asset('_assets/_front/_js/bootstrap.min.js')}}"></script>
<script src="{{asset('_assets/_front/_js/front_core.min.js')}}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
</body>
</html>