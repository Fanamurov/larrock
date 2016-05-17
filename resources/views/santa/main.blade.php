<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns/article#">
@include('santa.sections.head')
<body class="{{ $app_name or '' }} {{ $app_param or '' }}">
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        @include('santa.sections.tabsWhiteLabel')
        <section id="right_colomn" class="col-xs-24 col-sm-8 col-md-7">
            <div class="col-xs-24">
                @include('santa.modules.forms.subscribe')
                @yield('rightColomn')
                @include('santa.modules.list.vidy')
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24 content-padding">
                @include('santa.errors')
                @yield('content')
            </div>
            <div class="col-xs-24 block-contentBottom">
                @yield('contentBottom')
            </div>
            <div class="col-xs-24 content_bottom-sharing">
                <span>Поделитесь материалом с друзьями:</span> @include('santa.modules.share.sharing')
            </div>
        </div>
    </section>
</div>
<footer>
    @include('santa.sections.footer')
    @yield('footer')
</footer>
@include('santa.sections.bottomScripts')
@stack('scripts')
</body>
</html>