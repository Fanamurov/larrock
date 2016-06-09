<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns/article#">
@include('santa.sections.head')
<body class="mainpage {{ $app_name or '' }} {{ $app_param or '' }}">
<div class="container container-body">
    @include('santa.sections.header')
    <section class="row" id="content">
        @include('santa.sections.tabsWhiteLabel')
        <section id="right_colomn" class="col-xs-24 col-sm-8 col-md-7">
            <div class="col-xs-24 content-padding">
                @include('santa.modules.forms.subscribe')
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
                @include('santa.modules.list.vidy')
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24">
                @include('santa.errors')
                @include('santa.modules.slideshow.mainpage', $slideshow)

                <div class="toursPageCountry-bestcost row">
                    <div class="col-xs-24"><h5 class="title-header">Горящие туры</h5></div>
                    <div class="col-xs-24">
                        @if(App::environment() !== 'local')
                            <div class="tv-hot-tours tv-moduleid-932987"></div>
                                <script type="text/javascript" src="//tourvisor.ru/module/init.js"></script>
                            </div>
                        @else
                            <p>Модуль отключен на локали</p>
                        @endif
                </div>
                <div class="clearfix"></div>
                @include('santa.modules.list.news')
                @include('santa.modules.list.tours')
                @include('santa.modules.list.blog')
                @yield('content')
                @include('santa.modules.html.socialGroups')
                <div class="col-xs-24 content_bottom-sharing">
                    <span>Поделитесь с друзьями:</span> @include('santa.modules.share.sharing')
                </div>
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