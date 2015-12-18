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
            @include('admin.menu')
            <div class="wrapper wrapper-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <i class="icon-plus"></i> {{ $error }}
                                </div>
                            @endforeach
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
                            @yield('content')
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