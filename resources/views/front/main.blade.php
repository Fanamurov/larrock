<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Mart Larrock CMS" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('title')">
    <meta name="author" content="MartDS">
    <meta name="google-site-verification" content="ExmhHkwG1EdndOL-gSv-gs7IYIPYc8uuoBmoHYzw2eU" />
    <meta name='wmail-verification' content='6003fe329c67370d0606b8f64fabc224' />

    <link href="{{asset('ico.png?6v')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{asset('_assets/_front/_css/min/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('_assets/_front/_css/min/front.min.css')}}"/>
    <link rel="stylesheet" href="/_assets/bower_components/selectize/dist/css/selectize.bootstrap3.css"/>
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/jquery.fancybox.css"/>
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-buttons.css"/>
    <link rel="stylesheet" href="/_assets/bower_components/fancybox/source/helpers/jquery.fancybox-thumbs.css"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700|Open+Sans+Condensed:300,700|Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    @yield('styles')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if(App::environment() === 'local')
        <script src="{{asset('_assets/_admin/_js/jquery-1.11.1.min.js')}}"></script>
    @else
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    @endif
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

<!-- Mainly scripts -->
<script src="{{asset('_assets/_front/_js/bootstrap.min.js')}}"></script>
<script src="/_assets/bower_components/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript">
    var root = '{{url('/')}}';
</script>
<script src="{{asset('_assets/_front/_js/front_core.min.js')}}"></script>

<script src="http://callibri.ru/api/module/js/v1/callibri.js" type="text/javascript"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@if(isset($validator)) {!! $validator !!} @endif
<script src="/_assets/bower_components/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
<script src="/_assets/bower_components/Arctext.js/js/jquery.arctext.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.empty-cost').arctext({radius: 170, dir: -1, rotate: true});
    $('.default-cost').arctext({radius: 170, dir: -1, rotate: true})
</script>
@yield('scripts')
<script src="/_assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/_assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>

@if(App::environment() !== 'local')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter36722575 = new Ya.Metrika({
                        id:36722575,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/36722575" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-76288518-1', 'auto');
        ga('send', 'pageview');

    </script>
<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
    var google_tag_params = {
        dynx_itemid: 'REPLACE_WITH_VALUE',
        dynx_itemid2: 'REPLACE_WITH_VALUE',
        dynx_pagetype: 'REPLACE_WITH_VALUE',
        dynx_totalvalue: 'REPLACE_WITH_VALUE',
    };
</script>
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 925856723;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/925856723/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>
@endif
</body>
</html>