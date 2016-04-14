<!DOCTYPE html>
<html lang="ru">
<head>
    @include('front.sections.header')
</head>
<body>
<div class="container container-body">
    <header class="row">
        <div class="logo_link">
            <a href="/"></a>
        </div>
        <div class="col-xs-24 div-menu">
            @include('front.modules.menu.top', $menu)
        </div>
    </header>

    <section class="row" id="content">
        <div class="col-xs-17">
            <div class="col-xs-22 col-xs-offset-1">
                @include('front.errors')
                @if(isset($promo_text))
                    @if(Cookie::has('promo') OR Session::has('promo'))
                        <div class="promo_text">{!! $promo_text->description !!}</div>
                    @endif
                @endif
                @yield('content')
                @if(isset($seofish))
                    @include('front.modules.seofish.item')
                @endif
            </div>
        </div>
        <section id="right_colomn" class="col-xs-7">
            <div class="col-xs-19 col-xs-offset-2">
                @if(Route::current()->parameter('url') !== 'kontakty')
                    <a href="/page/kontakty#form-contact" class="btn btn-primary btn-block btn-to-form">Оформить заявку</a>
                @endif
                @yield('front.modules.list.catalog')
                @include('front.modules.forms.getPrice')
                @yield('rightColomn')
                @if(isset($banner))
                    @include('front.modules.list.banner')
                @endif
            </div>
        </section>
    </section>

    <footer class="row">
        <div class="col-xs-16">
            <div class="col-xs-22 col-xs-offset-1">
                @yield('footer')
                <address class="footer-left-text">
                    <p><strong>Рыболовецкий колхоз «Витязь»</strong><br>680009, Хабаровский край, г. Хабаровск,
                        <br/>ул. Промышленная, 12г, оф. 10<br/>
                        <a href="/page/kontakty">Контакты</a>
                    </p>
                </address>
            </div>
        </div>
        <div class="footer-copyright">
            <img src="/_assets/_front/_images/icons/ico_mart.png" alt="Разработка сайтов в Хабаровске: ДС «Март»">
            <a href="http://martds.ru" title="Разработка сайтов в Хабаровске: ДС «Март»">Разработка сайтов в Хабаровске: ДС «Март»</a>
        </div>
    </footer>
</div>

@include('front.sections.footer')
</body>
</html>