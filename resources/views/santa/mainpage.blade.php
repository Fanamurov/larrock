<!DOCTYPE html>
<html lang="ru">
@include('santa.sections.head')
<body>
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
                @yield('slideshow')
                @yield('content')
                @include('santa.modules.html.socialGroups')
            </div>
        </div>
    </section>
    <footer>
        @include('santa.sections.footer')
        @yield('footer')
    </footer>
</div>
@include('santa.sections.bottomScripts')
</body>
</html>