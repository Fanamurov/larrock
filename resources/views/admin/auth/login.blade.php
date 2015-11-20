<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <title>Larrock Admin - @yield('title', 'Login')</title>
    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_admin/_css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_admin/_css/admin.min.css')}}"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            @if($errors->has())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <i class="icon-bug"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <div>
            <h1 class="logo-name" style="font-size: 80px; letter-spacing: -4px;">LarRock</h1>
        </div>
        <h3>Добро пожаловать!</h3>
        <p>Пожалуйста, авторизуйтесь.</p>
        <form class="m-t" role="form" action="/admin/auth/login" method="post">
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required="" value="{{ Input::old('email') }}">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        </form>
    </div>
</div>
</body>
</html>