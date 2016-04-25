<!DOCTYPE html>
<html lang="ru">
@include('santa.sections.head')
<body>
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
                @include('santa.modules.forms.searchTourShort', $SearchFormShort)
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
                @include('santa.modules.list.vidy')
                @include('santa.modules.forms.subscribe')
            </div>
        </section>
        <div class="col-xs-24 col-sm-16 col-md-17">
            <div class="col-xs-24">
                @include('santa.errors')
                @include('santa.modules.slideshow.mainpage', $slideshow)
                @include('santa.modules.list.news')
                @include('santa.modules.list.blog')
                @yield('slideshow')
                @yield('content')
                @include('santa.modules.html.socialGroups')
            </div>
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