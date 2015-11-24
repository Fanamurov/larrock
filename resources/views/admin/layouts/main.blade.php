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

<div id="wrapper">
    <nav id="navbar-static-side" class="navbar-default navbar-static-side" role="navigation"></nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row">
            @if(App::environment() === 'local')
                <div class="col-lg-3 col-md-4 hidden-sm col-lg-offset-0">
                    <div class="wrapper wrapper-content animated fadeInUp">
                        <div class="ibox">
                            @section('sidebar')@endsection
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 col-lg-offset-0">
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

                    @if($errors->has())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <i class="icon-bug"></i> {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @include('admin.blocks.title')
                    @yield('content')
                </div>
            @else
                <div class="col-lg-12">
                    @yield('content')
                </div>
            @endif
        </div>
        <footer class="footer">
            <div class="pull-right">
                Проект: PROJECT <a href="SITE_URL">SITE_URL</a>
            </div>
            <div>
                <p><strong>ROCKET_VERSION</strong> :: LARAVEL_VERSION</p>
            </div>
        </footer>
    </div>
</div>


<!-- Mainly scripts -->
<script src="{{asset('_admin/_js/bootstrap.min.js')}}"></script>
<script src="{{asset('_admin/_js/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('_admin/_js/back_core.js')}}"></script>
@if (2 === 1)
    <script src="{{asset('_admin/_js/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('_admin/_js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('_admin/_js/tinymce/tinymce-settings.js')}}"></script>
@endif
</body>
</html>