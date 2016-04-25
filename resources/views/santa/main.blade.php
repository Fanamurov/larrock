<!DOCTYPE html>
<html lang="ru">
@include('santa.sections.head')
<body class="{{ $app_name or '' }} {{ $app_param or '' }}">
<div class="header-redline">
    <div class="container">
        <div class="col-sm-7 col-sm-offset-1">
            <a href="/forms/podbor">Подобрать тур</a>
        </div>
        <div class="col-sm-8 text-center">
            <a href="/page/aviabilety">Найти авиабилет</a>
        </div>
        <div class="col-sm-7 text-right">
            <a href="#uptocall">Заказать звонок</a>
        </div>
    </div>
</div>
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        <section id="right_colomn" class="col-xs-24 col-sm-8 col-md-7">
            <div class="col-xs-24">
                @if(isset($SearchFormShort))
                    @include('santa.modules.forms.searchTourShort', $SearchFormShort)
                @endif
                @yield('rightColomn')
                @include('santa.modules.list.vidy')
                @if(isset($module_strany))
                    @include('santa.modules.list.strany')
                @endif
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24">
                @include('santa.errors')
            </div>
            @yield('content')
            <div class="content_bottom-sharing">
                <span>Поделитесь материалом с друзьями:</span> @include('santa.modules.share.sharing')
            </div>
            @yield('contentBottom')
        </div>
    </section>
</div>
<footer>
    @include('santa.sections.footer')
    @yield('footer')
</footer>
@include('santa.sections.bottomScripts')
</body>
</html>