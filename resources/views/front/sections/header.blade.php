<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="generator" content="Mart Larrock CMS" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title')</title>
<meta name="description" content="@yield('title')">
<meta name="author" content="MartDS">
<meta name="google-site-verification" content="ExmhHkwG1EdndOL-gSv-gs7IYIPYc8uuoBmoHYzw2eU" />
<meta name='wmail-verification' content='6003fe329c67370d0606b8f64fabc224' />

<link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
<link rel="stylesheet" href="{{asset('_assets/_front/_css/bootstrap.min.css')}}"/>
<link rel="stylesheet" href="{{asset('_assets/_front/_css/front.min.css')}}"/>
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