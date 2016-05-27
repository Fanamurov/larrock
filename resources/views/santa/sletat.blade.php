<!DOCTYPE html>
<html lang="ru">
@include('santa.sections.head')
<body class="{{ $app_name or '' }} {{ $app_param or '' }}">
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        <section id="right_colomn" class="hidden-xs hidden-sm col-md-7">
            <div class="col-xs-24">
                @if(isset($siteSearch) && is_array($siteSearch) && count($siteSearch['categories']) > 0)
                    @include('santa.modules.search.site')
                @endif
                @yield('rightColomn')
                @include('santa.modules.list.vidy')
            </div>
        </section>
        <div class="col-xs-24 col-md-17">
            <div class="col-xs-24 content-padding">
                @include('santa.errors')
                @yield('content')
            </div>
            <div class="content_bottom-sharing col-xs-24">
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
@stack('scripts')
</body>
</html>